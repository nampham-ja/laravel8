<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\about as About;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    //
    //
    public function AllAbout()
    {
        $abouts = About::latest()->paginate(5);
        Carbon::setLocale('ja');
        return view('admin.pages.about.allAbout', compact('abouts'));
    }
    //
    public function addAbout()
    {
        $about = [];
        return view('admin.pages.about.addAbout', compact('about'));
    }
    public function UpdateAbout(Request $request)
    {
        if (isset($request->id)) {
            $about = About::find($request->id);
            $rules = [
                'title' => 'required|min:4|unique:abouts,title,' . $about->id . ',id',
                'short_dis' => 'required',
                'long_dis' => 'required',
            ];
        } else {
            $rules = [
                'title' => 'required|min:4|unique:abouts',
                'short_dis' => 'required',
                'long_dis' => 'required',
            ];
        }
        $request->validate(
            $rules,
            [
                'title.unique' => 'スライダー名も既に存在します。',
                'title.required' => 'スライダー名を入力してください。',
                'title.min' => 'スライダー名は4文字以上です。',
                'short_dis.required' => '簡単な説明入力してください。',
                'long_dis.required' => '説明を入力してください。',
            ]
        );


        // 編集場合
        if (isset($request->id) && !empty($request->id)) {
            $update_data = [
                'title' => $request->title,
                'short_dis' => $request->short_dis,
                'long_dis' => $request->long_dis,
            ];
            About::where('id', $request->id)->update($update_data);
        }

        // DBにインサート
        else {
            About::create([
                'title' => $request->title,
                'short_dis' => $request->short_dis,
                'long_dis' => $request->long_dis,
            ]);
        }

        return redirect()->route('admin.allAbout')->with('success', '私について情報の保存が成功しました。');
    }
    public function EditAbout($id)
    {
        $about = About::findOrFail($id);
        return view('admin.pages.about.addAbout', compact('about'));
    }
    public function deleteAbout($id)
    {
        $about = About::findOrFail($id);
        $about->delete();

        return redirect()->route('admin.allAbout')->with('success', '私について情報を削除しました。');
    }
}
