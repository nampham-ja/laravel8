<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use App\Models\MultiImage;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MultiImageController extends Controller
{
    //
    public function AllMultiImage()
    {
        $multiImages = MultiImage::latest()->get();
        Carbon::setLocale('ja');
        return view('admin.pages.multiImage.allMultiImage', compact('multiImages'));
    }
    //
    public function addMultiImage()
    {
        $multiImage = [];
        return view('admin.pages.multiImage.addMultiImage', compact('multiImage'));
    }
    public function UpdateMultiImage(Request $request)
    {


        $request->validate(
            [
                'multi_image' => 'required',
            ],
            [
                'multi_image.unique' => '画像をアップロードしてください。',
            ]
        );
        $files = $request->file('multi_image') ?? '';

        $last_img = '';
        if (isset($files) && !empty($files)) {
            foreach ($files as $key => $file) {
                $name_gen = hexdec(uniqid());
                $img_ext = strtolower($file->getClientOriginalExtension());
                $img_name = $name_gen . '.' . $img_ext;
                $up_location = 'image/multi/';
                $last_img = $up_location . $img_name;

                if (isset($request->id)) {
                    $brand = MultiImage::find($request->id);
                    unlink($brand->brand_url);
                }
                // 画像ファイル格納
                $file->move($up_location, $img_name);

                MultiImage::create([
                    'image' => $last_img,
                ]);
            }
        }

        return redirect()->route('admin.MultiImage')->with('success', '私について情報の保存が成功しました。');
    }
    public function EditMultiImage($id)
    {
        $multiImage = MultiImage::findOrFail($id);
        return view('admin.pages.multiImage.addMultiImage', compact('multiImage'));
    }
    public function deleteMultiImage($id)
    {
        $multiImage = MultiImage::findOrFail($id);
        unlink($multiImage->multi_image);
        $multiImage->delete();

        return redirect()->route('admin.allMultiImage')->with('success', '私について情報を削除しました。');
    }
}
