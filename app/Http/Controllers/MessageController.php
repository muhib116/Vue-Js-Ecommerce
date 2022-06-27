<?php

namespace App\Http\Controllers;
use App\Models\Area;
use App\Models\City;
use App\Models\State;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Admin;
use App\Traits\Sms;
use Brian2694\Toastr\Facades\Toastr;
class MessageController extends Controller
{
    use Sms;
    public function message()
    {
        $data['users'] = User::all();
        return view('admin.message.message')->with($data);

    }

    //employe working task
    public function workingTask()
    {
        $user_id = Auth::guard('admin')->id();
        $data['users'] = Admin::where('id', '!=', $user_id)->get();
        return view('admin.message.dropzone')->with($data);
    }

    public function dropzoneStore(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('upload'),$imageName);

        return response()->json(['success'=>$imageName]);
    }

    public function dropzoneDelete(Request $request)
    {
        $filename = $request->filename;
        $path = public_path('upload/'. $filename) ;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }




 public function get_area($id=0){
        $areas = Area::where('city_id', $id)->orderBy('name', 'asc')->where('status', 1)->get();
        $output = '';
        if(count($areas)>0){
            $output .= '<option value="0">ALL Area</option>';
            foreach($areas as $area){
                $output .='<option value="'.$area->id.'">'.$area->name.'</option>';
            }
        }
        echo $output;
    }








  public function get_city(Request $request, $region_id){
        
        $data = [];

   
       
       
        $cities = City::where('state_id', $region_id)->where('status', 1)->get();
        $output = $allcity = '';
        if(count($cities)>0){
            $allcity .= '<option value="0">All City</option>';
            foreach($cities as $city){
                $allcity .='<option '. (old("city") == $city->id ? "selected" : "" ).' value="'.$city->id.'">'.$city->name.'</option>';
            }
        } else {
			$allcity .= '<option value="0">All City</option>';
		}
  
        $output = array('allcity'  => $allcity);
        return response()->json($output);
    }
	
	
	
	
	
	
public function bulksms(){	
		$data['states'] = State::where('country_id', 18)->where('status', 1)->get();
        return view('admin.message.bulksms')->with($data);
	
}



 public function sendssms(Request $request){
if($request->area != 0){
	User::whereNotNull('mobile')->where('area', $request->area)->orderBy('id')->chunk(100, function ($users) use ($request) {
    foreach ($users as $user) {

      pvlsms($user->mobile, $request->details);
    }
});
} else if($request->city != 0){

	User::whereNotNull('mobile')->where('city', $request->city)->orderBy('id')->chunk(100, function ($users) use ($request) {
    foreach ($users as $user) {

     pvlsms($user->mobile, $request->details);
    }
});

} else if($request->region != 0){
User::whereNotNull('mobile')->where('region', $request->region)->orderBy('id')->chunk(100, function ($users) use ($request) {
    foreach ($users as $user) {

     pvlsms($user->mobile, $request->details);
    }
});
} else if($request->region == 0){
User::whereNotNull('mobile')->orderBy('id')->chunk(100, function ($users) use ($request) {
    foreach ($users as $user) {

      pvlsms($user->mobile, $request->details);
    }
});
} else if($request->city == 0 && $request->region != 0){
User::whereNotNull('mobile')->where('region', $request->region)->orderBy('id')->chunk(100, function ($users) use ($request) {
    foreach ($users as $user) {

      pvlsms($user->mobile, $request->details);
    }
});
} else if($request->area == 0 && $request->city != 0){
User::whereNotNull('mobile')->where('city', $request->city)->orderBy('id')->chunk(100, function ($users) use ($request) {
    foreach ($users as $user) {
pvlsms($user->mobile, $request->details);
    }
});
}
Toastr::success('Sms Sent Done.');
return back();
}

public function orderwise(Request $request)
    {


if ($request->filled('min') && $request->filled('max')) {
	
	
	
$data['user'] =	User::whereNotNull('mobile')->has('orders', '>=' , $request->min)->has('orders', '<=' , $request->max)->with('orders')->orderBy('id')->take(1000)->get();


return view('admin.message.user')->with($data);
} else {
	return view('admin.message.range');
}
	}






    public function smsPanel(Request $request)
    {
       if($request->isMethod('get')){
            return view('admin.message.sms');
       }
        if($request->isMethod('post')){
            $numbers = explode(',', trim($request->number));
            foreach($numbers as $number){
                $this->sendSms($number, $request->details);
            }
        }
        return back();
    }
}
