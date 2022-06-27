<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\WorkingTask;
use App\Models\workingTaskConversation;
use App\Models\workingTaskUser;
use App\Traits\CreateSlug;
use App\Traits\Sms;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class WorkingTaskController extends Controller
{
    use CreateSlug;
    use Sms;
    public function workingTaskCreate(){
        $user_id = Auth::guard('admin')->id();
        $data['users'] = Admin::where('id', '!=', $user_id)->get();
        return view('admin.working-task.working-task-create')->with($data);
    }
    // working task
    public function workingTask(Request $request, $type='')
    {
        $user_id = Auth::guard('admin')->id();
        $tasks = WorkingTask::with('workingTaskUsers.taskUser');
        if(Auth::guard('admin')->user()->role_id != 'admin' && $type != 'inbox'){
            $tasks->where('assign_by', $user_id);
        }
        if($type && $type == 'inbox') {
            $tasks->join('working_task_users', 'working_tasks.id', 'working_task_users.task_id')
            ->where(function ($query) use ($user_id){
                $query->where('working_task_users.user_id', $user_id)
                    ->orWhere('working_task_users.user_id', 0);
            });
        }
        if($type && $type == 'scheduled') {
            $tasks->whereDate('start_date', '>=', now());
        }else{
            $tasks->whereDate('start_date', '<=', now());
        }
        if($type && $type == 'send') {
            $tasks->where('assign_by', $user_id);
        }
        $data['tasks'] = $tasks->orderBy('id', 'desc')->selectRaw('working_tasks.*')->paginate(15);

        return view('admin.working-task.working-task')->with($data);
    }
    //task store/update
    public function workingTaskStore(Request $request, $update=null)
    {
        $request->validate([
            'subject' => 'required',
            'details' => 'required',
            'user_id' => 'required',
        ]);
        $assign_by = Auth::guard('admin')->id();
        if($update){
            $data = WorkingTask::where('assign_by', $assign_by)->where('slug', $update)->first();
            //if update delete task user
            if($data){
                workingTaskUser::where('task_id', $data->id)->delete();
            }
        }else{
            $data = New WorkingTask();
            $data->slug = $this->createSlug('working_tasks', $request->subject, 'slug');
        }
        $data->assign_by = $assign_by;
        $data->subject = $request->subject;
        $data->details = $request->details;
        $data->start_date = ($request->start_date) ? $request->start_date : null;
        $data->end_date = ($request->end_date) ? $request->end_date : null;
        $data->sms_notify = ($request->sms_notify) ? 1 : null;
        $data->status = ($request->status) ? $request->sms_notify : 'pending';
        if ($request->hasFile('attachment')) {
            $image = $request->file('attachment');
            $new_image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/workingTask'), $new_image_name);
            $data->attachment = $new_image_name;
        }
        $store = $data->save();
        if($store){
            foreach ($request->user_id as $user_id){
                $taskUser = new workingTaskUser();
                $taskUser->task_id = $data->id;
                $taskUser->user_id = $user_id;
                $taskUser->save();
                if(!$update) {
                    if ($request->sms_notify) {
                        $user = Admin::find($user_id);
                        if ($user) {
                            $msg = 'Working task (' . $request->subject . ') ' . route('admin.workingTask', 'inbox');
                            $this->sendSms($user->mobile, $msg);
                        }
                    }
                    //insert notification in database
//                    Notification::create([
//                        'type' => 'workingTask',
//                        'fromUser' => $assign_by,
//                        'toUser' => $user_id,
//                        'item_id' => $data->id,
//                        'notify' => 'working task - ' . $request->subject,
//                    ]);
                }
            }
            Toastr::success('Working task submitted success.');
        }else{
            Toastr::error('Working task submitted failed.');
        }
        return redirect()->back();
    }
    //task edit
    public function workingTaskEdit($slug){
        $user_id = Auth::guard('admin')->id();
        $taskDetails = WorkingTask::with(['workingTaskUsers.taskUser'])->where('slug', $slug)->where('assign_by', $user_id)->first();
        if($taskDetails) {
            $users = Admin::where('id', '!=', $user_id)->get();
            return view('admin.working-task.working-task-edit')->with(compact('taskDetails','users'));
        }
    }
    public function workingTaskDelete($id)
    {
        $user_id = Auth::guard('admin')->id();
        $task = WorkingTask::where('assign_by', $user_id)->where('id', $id)->first();
        if($task) {
            //delete image from folder
            $image_path = public_path('upload/workingTask/'. $task->attachment);
            if(file_exists($image_path) && $task->attachment){
                unlink($image_path);
            }
            $task->delete();
            workingTaskUser::where('task_id', $id)->delete();
            $output = [
                'status' => true,
                'msg' => 'Task deleted successful.'
            ];
        }else{
            $output = [
            'status' => false,
            'msg' => 'Task cannot deleted.'
            ];
        }
        return response()->json($output);
    }
    //task detials
    public function workingTaskDetails($slug, $converation=null)
    {
        $user_id = Auth::guard('admin')->id();
        $taskDetails = WorkingTask::with(['workingTaskUsers.taskUser'])->where('slug', $slug)->first();
        //set relation with paginate
        $taskDetails->setRelation('taskConversations', $taskDetails->taskConversations()->with('conversationUser')->paginate(10));
        if($taskDetails){
            //when click reply conversation
            if($converation && $taskDetails->status == 'pending'){
                $taskDetails->status = 'processing';
                $taskDetails->save();
            }
            return view('admin.working-task.working-task-details')->with(compact('taskDetails'));
        }else{
            return redirect()->route('admin.workingTask');
        }
    }

    public function workingTaskConversation(Request $request)
    {
        $task = WorkingTask::find($request->task_id);
        $from_user = Auth::guard('admin')->id();
        $taskConversation = new workingTaskConversation();
        $taskConversation->task_id = $request->task_id;
        $taskConversation->from_user = $from_user;
        $taskConversation->to_user = $task->assign_by;
        $taskConversation->message = $request->message;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $new_image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/workingTask'), $new_image_name);
            $taskConversation->image = $new_image_name;
        }
        $taskConversation->save();
        return redirect()->back();
    }

    public function workingTaskStatus($slug){
        $user_id = Auth::guard('admin')->id();
        $taskUser = WorkingTask::join('working_task_users', 'working_tasks.id', 'working_task_users.task_id')
            ->where('slug', $slug)
            ->where(function ($query) use ( $user_id ){
                $query->orWhere('working_task_users.user_id', $user_id)->orWhere('assign_by', $user_id);
            })->selectRaw('working_tasks.*')->first();

        if($taskUser){
            $taskUser->status = 'completed';
            $taskUser->save();
        }
        return back();
    }
}
