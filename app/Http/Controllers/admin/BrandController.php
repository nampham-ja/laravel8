<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    //

    public function AllBrand()
    {
        $brands = Brand::latest()->paginate(5);
        Carbon::setLocale('ja');
        return view('admin.pages.brand.allBrand', compact('brands'));
    }
    public function UpdateBrand(Request $request)
    {
        if (isset($request->id)) {
            $brand = Brand::find($request->id);
            $rules = [
                'name' => 'required|min:4|unique:brands,name,' . $brand->name,
                'brand_image' => 'mimes:jps,png,jpeg',
            ];
        } else {
            $rules = [
                'name' => 'required|min:4|unique:brands',
                'brand_image' => 'required|mimes:jps,png,jpeg',
            ];
        }
        $request->validate(
            $rules,
            [
                'name.unique' => 'ブランド名も既に存在します。',
                'name.required' => 'ブランド名を入力してください。',
                'name.min' => 'ブランド名は4文字以上です。',
                'brand_image.required' => 'ブランド画像をアップロードしてください。',
                'brand_image.mimes' => 'ブランド画像の拡張はjps,png,jpegのみです。'
            ]
        );
        $file = $request->file('brand_image') ?? '';
        if (isset($file) && !empty($file)) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($file->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_ext;
            $up_location = 'image/brand/';
            $last_img = $up_location . $img_name;

            if (isset($request->id)) {
                $brand = Brand::find($request->id);
                unlink($brand->brand_url);
            }
            // 画像ファイル格納
            $file->move($up_location, $img_name);
        }

        // 編集場合
        if (isset($request->id)) {
            $update_data = [
                'name' => $request->name,
            ];
            if (!empty($file)) {
                $update_data['brand_url'] = $last_img;
            }
            Brand::where('id', $request->id)->update($update_data);

            return redirect()->route('admin.allBrand')->with('success', 'ブランド情報の編集が成功しました。');
        }

        // DBにインサート
        else {
            Brand::create([
                'name' => $request->name,
                'brand_url' => $last_img,
            ]);
        }

        return redirect()->back()->with('success', 'ブランド情報の保存が成功しました。');
    }
    public function EditBrand($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.pages.brand.editBrand', compact('brand'));
    }
    public function deleteBrand($id)
    {
        $brand = Brand::findOrFail($id);
        unlink($brand->brand_url);
        $brand->delete();

        return redirect()->route('admin.allBrand')->with('success', 'ブランド情報を削除しました。');
    }
}
