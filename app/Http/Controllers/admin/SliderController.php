<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\slider as Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    //
    public function AllSlider()
    {
        $sliders = Slider::latest()->paginate(5);
        Carbon::setLocale('ja');
        return view('admin.pages.slider.allSlider', compact('sliders'));
    }
    //
    public function addSlider()
    {
        $slider = [];
        return view('admin.pages.slider.addSlider', compact('slider'));
    }
    public function UpdateSlider(Request $request)
    {
        if (isset($request->id)) {
            $slider = Slider::find($request->id);
            $rules = [
                'title' => 'required|min:4|unique:sliders,title,' . $slider->id . ',id',
                'description' => 'required',
                'image' => 'mimes:jps,png,jpeg',
            ];
        } else {
            $rules = [
                'title' => 'required|min:4|unique:sliders',
                'description' => 'required',
                'image' => 'required|mimes:jps,png,jpeg',
            ];
        }
        $request->validate(
            $rules,
            [
                'title.unique' => 'スライダー名も既に存在します。',
                'title.required' => 'スライダー名を入力してください。',
                'title.min' => 'スライダー名は4文字以上です。',
                'description.required' => '説明文を入力してください。',
                'image.required' => 'スライダー画像をアップロードしてください。',
                'image.mimes' => 'スライダー画像の拡張はjps,png,jpegのみです。'
            ]
        );
        $file = $request->file('image') ?? '';
        if (isset($file) && !empty($file)) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($file->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_ext;
            $up_location = 'image/slider/';
            $last_img = $up_location . $img_name;

            if (isset($request->id)) {
                $slider = slider::find($request->id);
                unlink($slider->image);
            }
            // 画像ファイル格納
            $file->move($up_location, $img_name);
        }

        // 編集場合
        if (isset($request->id) && !empty($request->id)) {
            $update_data = [
                'title' => $request->title,
                'description' => $request->description,
            ];
            if (!empty($file)) {
                $update_data['image'] = $last_img;
            }
            Slider::where('id', $request->id)->update($update_data);
        }

        // DBにインサート
        else {
            Slider::create([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $last_img,
            ]);
        }

        return redirect()->route('admin.allSlider')->with('success', 'スライダー情報の保存が成功しました。');
    }
    public function EditSlider($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.pages.slider.addSlider', compact('slider'));
    }
    public function deleteSlider($id)
    {
        $slider = Slider::findOrFail($id);
        unlink($slider->image);
        $slider->delete();

        return redirect()->route('admin.allSlider')->with('success', 'スライダー情報を削除しました。');
    }
}
