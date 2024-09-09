<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class ProductController extends Controller
{
    //
    public function ProductPage()
    {
        return view('pages.dashboard.product-page');
    }

    public function ProductCreate(Request $request)
    {
        $user_id = $request->header("id");

        //prepare file name and path
        $img = $request->file('img');
        $t = time();
        $fileName = $img->getClientOriginalName();
        $imgName = "{$user_id}-{$t}-{$fileName}";
        $img_url = "uploads/{$imgName}";

        // Upload File
        $img->move(public_path("uploads"), $imgName);

        //save to Database
        return Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'unit' => $request->input('unit'),
            'category_id' => $request->input('category_id'),
            'img_url' => $img_url,
            'user_id' => $user_id

        ]);
    }

    function ProductDelete(Request $request)
    {

        $user_id=$request->header('id');
        $product_id=$request->input('id');
        $filePath=$request->input('file_path');
        File::delete($filePath);
        return Product::where('id',$product_id)->where('user_id',$user_id)->delete();

    }
    public function ProductByID(Request $request)
    {
        $user_id=$request->header('id');
        $product_id=$request->input('id');
        return Product::where('id',$product_id)->where('user_id',$user_id)->first();
    }

    public function ProductList(Request $request)
    {
        $user_id=$request->header('id');
        return Product::where("user_id",$user_id)->get();
    }

    public function ProductUpdate(Request $request)
    {
        $user_id=$request->header('id');
        $product_id=$request->input("id");

        if($request->hasFile('img')){
            // Upload New File
            $img=$request->file('img');
            $t=time();
            $fileName=$img->getClientOriginalName();
            $imgName="{$user_id}-{$t}-{$fileName}";
            $img_url="uploads/{$imgName}";
            $img->move(public_path("uploads"),$imgName);

         //Delete old FIle
         $filePath=$request->input('file_path');
         File::delete($filePath);

         //Update product
         return Product::where('id',$product_id)->where('user_id',$user_id)->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'unit' => $request->input('unit'),
            'category_id' => $request->input('category_id'),
            'img_url' => $img_url
         ]);
        }
        else{
            //Update product without new file
            return Product::where('id',$product_id)->where('user_id',$user_id)->update([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'unit' => $request->input('unit'),
                'category_id' => $request->input('category_id')
            ]);
        }
    }
}
