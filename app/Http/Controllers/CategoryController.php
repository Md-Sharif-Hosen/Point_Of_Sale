<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Throwable;

class CategoryController extends Controller
{
    public function CategoryPage()
    {
        //function_body
        return view('pages.dashboard.category-page');
    }
    public function CategoryList(Request $request)
    {
        //function_body
        try {
            $user_id = $request->header('id');
            $categories = Category::where('user_id', $user_id)->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Request Successfull',
                'data' => $categories
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Request Failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function CategoryCreate(Request $request)
    {
        //function_body
        try {
            $user_id = $request->header('id');
            $category = new Category();
            $category->name = $request->name;
            $category->user_id=$user_id;
            $category->save();
            return response()->json([
               'status' => 'success',
               'message' => 'Category Created Successfully',
                'data' => $category
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'status' => 'failed',
               'message' => 'Request Failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function CategoryUpdate(Request $request)
    {

        $category_id=$request->input('id');
        $user_id=$request->header('id');
        $categoryUpdate=Category::where('id', $category_id)->where('user_id',$user_id)->update([
           'name'=>$request->input('name')
        ]);
           if($categoryUpdate){
               return response()->json([
                  'status' => 'success',
                  'message' => 'Category Updated Successfully'
               ], 200);
           }else{
               return response()->json([
                  'status' => 'failed',
                  'message' => 'Category Not Found'
               ], 404);
           }
    }
    public function CategoryDelete(Request $request)
    {
        $category_id=$request->input('id');
        $user_id=$request->header('id');
        $categoryDelete=Category::where('id', $category_id)->where('user_id',$user_id)->delete();
        if($categoryDelete){
            return response()->json([
               'status' => 'success',
               'message' => 'Category Deleted Successfully'
            ], 200);
        }else{
            return response()->json([
               'status' => 'failed',
               'message' => 'Category Not Found'
            ], 404);
        }
    }
}
