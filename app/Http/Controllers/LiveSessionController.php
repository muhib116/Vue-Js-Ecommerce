<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\HomepageSection;
use App\Models\LiveSession;
use App\Models\LiveSessionProduct;
use App\Models\Offer;
use App\Models\Product;
use App\Traits\CreateSlug;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class LiveSessionController extends Controller
{
    use CreateSlug;
    public function index()
    {
        $data['categories'] = Category::with('get_subcategory.get_subchild_category')->where('parent_id', null)->orderBy('name', 'asc')->get();
        $data['liveSessions'] = LiveSession::orderBy('position', 'asc')->get();
        return view('admin.live_session.index')->with($data);
    }

    public function store(Request $request)
    {
        $section = new LiveSession();
        $section->title = $request->title;
        $section->slug = $this->createSlug('live_sessions', $request->title);
        $section->video_path = $request->video_path;
        $section->background_color = $request->background_color;
        $section->text_color = $request->text_color;
        $section->status = ($request->status ? 1 : 0);
        if ($request->hasFile('thumb_image')) {
            $image = $request->file('thumb_image');
            $new_image_name = $this->uniqueImagePath('live_sessions', 'thumb_image', $image->getClientOriginalName());
            $image_path = public_path('upload/images/liveSession/' . $new_image_name);
            $image_resize = Image::make($image);
            $image_resize->resize(250, 150);
            $image_resize->save($image_path);
            $section->thumb_image = $new_image_name;
        }
        $store = $section->save();
        if($store){
            foreach ($request->product_id as $product_id) {
                $prouct = new LiveSessionProduct();
                $prouct->live_session_id = $section->id;
                $prouct->product_id = $product_id;
                $prouct->save();
            }
            Toastr::success('live session added successful.');
        }else{
            Toastr::error('live session cann\'t added.');
        }

        return back();
    }

    public function edit($id)
    {
        $data['categories'] = Category::with('get_subcategory.get_subchild_category')->where('parent_id', null)->orderBy('name', 'asc')->get();
        $data['section'] = LiveSession::with('liveProducts.product:id,title')->where('id', $id)->first();

        return view('admin.live_session.edit')->with($data);
    }

    public function update(Request $request)
    {
        $section = LiveSession::find($request->id);
        $section->title = $request->title;
        $section->video_path = $request->video_path;
        $section->background_color = $request->background_color;
        $section->text_color = $request->text_color;
        $section->status = ($request->status ? 1 : 0);
        if ($request->hasFile('thumb_image')) {
            //delete image from folder
            $image_path = public_path('upload/images/liveSession/'. $section->thumb_image);
            if(file_exists($image_path) && $section->thumb_image){
                unlink($image_path);
            }
            $image = $request->file('thumb_image');
            $new_image_name = $this->uniqueImagePath('live_sessions', 'thumb_image', $image->getClientOriginalName());
            $image_path = public_path('upload/images/liveSession/' . $new_image_name);
            $image_resize = Image::make($image);
            $image_resize->resize(250, 150);
            $image_resize->save($image_path);
            $section->thumb_image = $new_image_name;
        }
        $store = $section->save();
        if($store){
            LiveSessionProduct::where('live_session_id', $section->id)->delete();
            foreach ($request->product_id as $product_id) {
                $prouct = new LiveSessionProduct();
                $prouct->live_session_id = $section->id;
                $prouct->product_id = $product_id;
                $prouct->save();
            }
            Toastr::success('live session update successfully.');
        }else{
            Toastr::error('live session update failed.');
        }

        return back();
    }

    public function delete($id)
    {
        $section = LiveSession::find($id);
        if($section){
            $section->delete();
            LiveSessionProduct::where('live_session_id', $section->id)->delete();
            $output = [
                'status' => true,
                'msg' => 'Live session deleted successful.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Live session cannot deleted.'
            ];
        }
        return response()->json($output);
    }

    public function liveSessionDetails($slug){
        $data['liveSession'] = LiveSession::with(['liveProducts.product:id,title,selling_price,discount,discount_type,slug,feature_image'])->where('slug', $slug)->where('status', 1)->first();

        $data['latestOffer'] = Offer::where('end_date', '>=', now())->where('featured', 1)->orderBy('position', 'asc')->where('status', 1)->first();
        $data['liveSessions'] = LiveSession::with(['liveProducts.product:id,feature_image'])->where('slug', '!=',$slug)->orderBy('position', 'asc')->where('status', 1)->limit(7)->get();

        if($data['liveSession']) {
            return view('frontend.pages.live-session-details')->with($data);
        }
        return view('404');
    }
}
