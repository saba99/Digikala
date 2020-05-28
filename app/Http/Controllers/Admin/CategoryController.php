<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{   

    protected $model='Category';

    protected $title='دسته';

    protected  $route_params='category';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
       // $category=Category::with('getParent')->orderBy('id','DESC')->paginate(2);
       
       $category=Category::getData($request->all());
       
        $trash_cat_count=Category::onlyTrashed()->count();


        return view('category.index',['category'=>$category, 'trash_cat_count'=> $trash_cat_count,'request'=>$request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  

        $parent_cat=Category::get_parent();
        return view('category.create',['parent_cat'=>$parent_cat]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
         // dd($request->all());

         $notShow=$request->has('notShow') ? 1: 0;

         $category = new Category($request->all());

         $category->notShow=$notShow;

         $img_url=upload_file($request,'pic','upload');

         $category->img=$img_url;

        // $category->parent_id=0;

         $category->url=get_url($request->get('ename'));

         $category->save();

         return redirect('admin/category')->with('message','ثبت دسته با موفقیت انجام شد ');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category=Category::findOrFail($id);

        $parent_cat=Category::get_parent();

        return view('category.edit',['category'=>$category,'parent_cat'=>$parent_cat]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {   

        $data=$request->all();
        $category = Category::findOrFail($id);
        $notShow = $request->has('notShow') ? 1 : 0;
        $img_url = upload_file($request, 'pic', 'upload');

            if(!$img_url !=null){

             $category->img = $img_url;
        }

        $data['notShow']=$notShow;

        $category->update($data);

        return redirect('admin/category')->with('message', 'ویرایش دسته با موفقیت انجام شد ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model_name = "App\\" . $this->model;

        // echo $model_name;
        //$row = $model_name::withTrashed()->findOrFail($id);
        $row = Category::withTrashed()->findOrFail($id);



        if ($row->deleted_at == null) {

            $message="$this->title به سطل زباله انتقال یافت";

            $row->delete();
        } else {
            $row->forceDelete();
        }

       // return redirect('admin/'.$this->route_params)->with('message', "حذف $this->title با موفقیت انجام شد ");
        return redirect('admin/category')->with('message', 'حذف دسته با موفقیت انجام شد ');
    }

    public function remove_items(Request $request)
    {

        //dd($request->all());

        $ids = $request->get('category_id', array());

        foreach ($ids as $key => $value) {

            $row = Category::withTrashed()->where('id', $value)->firstOrFail();

            if ($row->deleted_at == null) {

                $row->delete();
            } else {

                $row->forceDelete();
            }
        }
        //return redirect('admin/'.$this->route_params.'?trashed=true')->with('message', "$this->title به سطل زباله منتقل شد ");
        return redirect('admin/category?trashed=true')->with('message', 'دسته به سطل زباله منتقل شد ');
    }

    public function restore_items(Request $request)
    {


        $ids = $request->get('category_id', array());

        foreach ($ids as $key => $value) {

            $row = Category::withTrashed()->where('id', $value)->firstOrFail();

            $row->restore();
        }
        return redirect('admin/category?trashed=true')->with('message', 'بازیابی دسته ها با موفقیت انجام شد  ');
    }

    public function restore($id)
    {

        $row = Category::withTrashed()->where('id', $id)->firstOrFail();

        $row->restore();

        return redirect('admin/category?trashed=true')->with('message', 'بازیابی دسته ها با موفقیت انجام شد  ');
    }

}
