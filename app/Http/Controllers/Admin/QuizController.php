<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\QuizExamAnswer;
use App\Models\QuizParticipant;
use App\Models\QuizQuestion;
use App\Traits\CreateSlug;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class QuizController extends Controller
{

    use CreateSlug;

    public function quiz_list(Request $request){
        $quizzes = Offer::withCount(['offer_products','offer_orders'])->where('offer_type', 'quiz')->orderBy('position', 'asc');
        if($request->title){
            $quizzes->where('title', 'LIKE', '%'. $request->title .'%');
        }
        if($request->status && $request->status != 'all'){
            $quizzes->where('status', $request->status);
        }
        $perPage = 15;
        if($request->show){
            $perPage = $request->show;
        }
        $quizzes = $quizzes->paginate($perPage);
        return view('admin.quiz.index')->with(compact('quizzes'));
    }

    //quiz store & update
    public function quiz_store(Request $request){
        $request->validate([
            'title' => 'required',
            'start_date' => 'required',
            'duration' => 'required',
        ]);
        if($request->id){
            $data = Offer::find($request->id);
            $data->updated_by = Auth::guard('admin')->id();
        }else{
            $data = new Offer();
            $data->slug = $this->createSlug('offers', ($request->slug) ? $request->slug : $request->title);
            $data->offer_type = 'quiz';
            $data->prefix_id = 'WQ';
            $data->created_by = Auth::guard('admin')->id();
        }
        $data->title = $request->title;
        $data->start_date = $request->start_date;
        $data->end_date = $request->end_date;
        $data->duration = $request->duration;
        $data->allow_item = $request->allow_item;
        $data->notes = ($request->details) ? $request->details :null;
        $data->background_color = $request->background_color;
        $data->text_color = $request->text_color;
        $data->discount = $request->fee;
        $data->discount_type = 'fixed';
        //if feature image set
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $new_image_name = $this->uniqueImagePath('offers', 'thumbnail', $image->getClientOriginalName());
            $image->move(public_path('upload/images/offer/thumbnail/'), $new_image_name);
            $data->thumbnail = $new_image_name;
        }
        //if feature image set
        if ($request->hasFile('banner')) {
            $image = $request->file('banner');
            $new_image_name = $this->uniqueImagePath('offers', 'banner', $image->getClientOriginalName());
            $image->move(public_path('upload/images/offer/banner/'), $new_image_name);
            $data->banner = $new_image_name;
        }
        $store = $data->save();
        if($store){
            Toastr::success('Quiz Create Successful.');
        }else{
            Toastr::error('Quiz Cannot Create.!');
        }
        return back();
    }

    //edit quiz
    public function quiz_edit($id){
        $quiz = Offer::find($id);
        return view('admin.quiz.quizEdit')->with(compact('quiz'));
    }

    //delete quiz
    public function quiz_delete($id)
    {
        $quiz = Offer::find($id);
        if($quiz){
            $banner = public_path('upload/images/offer/banner/' . $quiz->banner);
            $thumbnail = public_path('upload/images/offer/thumbnail/' . $quiz->thumbnail);
            if(file_exists($thumbnail) && $quiz->thumbnail){
                unlink($thumbnail);
            }if(file_exists($banner) && $quiz->banner){
                unlink($banner);
            }
            QuizQuestion::where('offer_quiz_id', $quiz->id)->delete();
            //delete offer
            $quiz->delete();
            $output = [
                'status' => true,
                'msg' => 'Quiz deleted successful.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Quiz cannot deleted.'
            ];
        }
        return response()->json($output);
    }

    public function quizQuestion(Request $request, $slug){
        $data['quiz'] = Offer::where('slug', $slug)->first();
        if($data['quiz']) {
            $quizQuestions = QuizQuestion::where('offer_quiz_id', $data['quiz']->id);
            if($request->title){
                $quizQuestions->where('question_title', 'LIKE', '%'. $request->title .'%');
            }
            if($request->status && $request->status != 'all'){
                $quizQuestions->where('status', $request->status);
            }if($request->type && $request->type != 'all'){
                $quizQuestions->where('category', $request->type);
            }
            $perPage = 15;
            if($request->show){
                $perPage = $request->show;
            }
            $data['quizQuestions'] = $quizQuestions->orderBy('id', 'desc')->paginate($perPage);
            $data['countSegments'] = QuizQuestion::selectRaw("count(case when category = 1 then 0 end) as ecommerce")
                ->selectRaw("count(case when category = 2 then 0 end) as national")
                ->selectRaw("count(case when category = 3 then 0 end) as international")
                ->selectRaw("count(case when category = 4 then 0 end) as general")
                ->selectRaw("count(case when category = 5 then 0 end) as sports")
                ->selectRaw("count(case when category = 6 then 0 end) as technology")
                ->selectRaw("count(case when level = 'beginner' then 0 end) as beginner")
                ->selectRaw("count(case when level = 'easy' then 0 end) as easy")
                ->selectRaw("count(case when level = 'normal' then 0 end) as normal")
                ->selectRaw("count(case when level = 'hard' then 0 end) as hard")
                ->selectRaw("count(case when level = 'challenging' then 0 end) as challenging")
                ->first();
            return view('admin.quiz.quizQuestions')->with($data);
        }
        Toastr::error('Quiz not found.');
        return back();
    }

    //quiz
    public function quiz_question_store(Request $request){
        $request->validate([
            'question_title' => 'required',
            'option1' => 'required',
            'option2' => 'required',
            'answer' => 'required',
            'category' => 'required',
            'level' => 'required',
        ]);
        if($request->id){
            $data = QuizQuestion::find($request->id);
            $data->updated_by = Auth::guard('admin')->id();
        }else{
            $data = new QuizQuestion();
            $data->offer_quiz_id = $request->quiz_id;
            $data->created_by = Auth::guard('admin')->id();
        }
        $data->question_title = $request->question_title;
        $data->option_1 = $request->option1;
        $data->option_2 = $request->option2;
        $data->option_3 = $request->option3;
        $data->option_4 = $request->option4;
        $data->option_5 = $request->option5;
        $data->answer = $request->answer;
        $data->category = $request->category;
        $data->level = $request->level;
        $store = $data->save();
        if($store){
            Toastr::success('Quiz Question Create Successful.');
        }else{
            Toastr::error('Quiz Question Cannot Create.!');
        }
        return back();
    }

    //edit quiz question
    public function quiz_question_edit($id){
        $quizQuestion = QuizQuestion::find($id);
        return view('admin.quiz.quizQuestionEdit')->with(compact('quizQuestion'));
    }

    //delete quiz question
    public function quiz_question_delete($id)
    {
        $quiz = QuizQuestion::find($id);
        if($quiz){
            $quiz->delete();
            $output = [
                'status' => true,
                'msg' => 'Quiz question deleted successful.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Quiz question cannot deleted.'
            ];
        }
        return response()->json($output);
    }

    public function topParticipantLists(Request $request, $slug){
        $data['quiz'] = Offer::where('slug', $slug)->first();
        if($data['quiz']){
            $quiz_id = $data['quiz']->id;
            $data['topParticipants'] = QuizParticipant::with(['get_division', 'get_city'])
                ->withCount(['TotalRightAnswers' => function ($query) use ($quiz_id){
                    $query->where('quiz_id', $quiz_id);
                }])->withCount(['TotalWrongAnswers'  => function ($query) use ($quiz_id){
                $query->where('quiz_id', $quiz_id);
            }])
            ->join('users', 'quiz_participants.user_id', 'users.id')
            ->where('quiz_participants.status', 'participate')
            ->where('quiz_id', $data['quiz']->id)
            ->orderBy('total_right_answers_count', 'desc')
            ->selectRaw('count(*) as totalParticipate, users.name,users.username,users.mobile,users.photo')
            ->groupBy('user_id')
            ->paginate(15);
        }
        return view('admin.quiz.topParticipants')->with($data);
    }

    public function participantLists(Request $request, $slug, $username=''){
        $data['quiz'] = Offer::where('slug', $slug)->first();
        if($data['quiz']){
            $quizParticipants = QuizParticipant::with(['quizAnswers'])
                ->join('users', 'quiz_participants.user_id', 'users.id')
                ->leftJoin('states', 'quiz_participants.division', 'states.id')
                ->where('quiz_participants.status', 'participate');
                if($username){
                    $quizParticipants->where('username', $username);
                }if($request->order_id){
                    $quizParticipants->where('order_id', $request->order_id);
                }
                if($request->customer){
                    $quizParticipants->where('name', $request->customer)->orWhere('mobile', $request->customer)->orWhere('email', $request->customer);
                }
            $data['quizParticipants'] = $quizParticipants->orderBy('quiz_participants.id', 'desc')
                ->selectRaw('quiz_participants.*,states.name division_name, users.name,users.username,users.mobile,users.photo')
                ->where('quiz_id', $data['quiz']->id)->paginate(25);
        }

        return view('admin.quiz.quizParticipants')->with($data);
    }

    public function setCustomTopUser(Request $request, $quiz_id){
        $data = Offer::find($quiz_id);
        $data->seller_id = ($request->user_id) ? implode(',', $request->user_id) : null;
        $data->save();
        Toastr::success('Top user set successful');
        return back();
    }
    public function participantAns($id){
        $participantAnswers = QuizExamAnswer::with(['quizQuestion'])->where('participant_id', $id)->get();
        return view('admin.quiz.participantAnswers')->with(compact('participantAnswers'));
    }
}
