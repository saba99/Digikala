<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;


class CustomController extends Controller{


    public function destroy($id)
    {     

        $query_string=property_exists($this,'query_string') ? '&'.$this->query_string:'';

        $model_name="App\\".$this->model;

        echo $model_name;
        $row = Category::withTrashed()->findOrFail($id);

        if ($row->deleted_at == null) {

            $row->delete();
        } else {
            $row->forceDelete();
        }


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
        return redirect('admin/category?trashed=true'.$query_string)->with('message', 'دسته به سطل زباله منتقل شد ');
    }

    public function restore_items(Request $request)
    {


        $ids = $request->get('category_id', array());

        foreach ($ids as $key => $value) {

            $row = Category::withTrashed()->where('id', $value)->firstOrFail();

            $row->restore();
        }
        return redirect('admin/category?trashed=true'.$query_string)->with('message', 'بازیابی دسته ها با موفقیت انجام شد  ');
    }

    public function restore($id)
    {

        $row = Category::withTrashed()->where('id', $id)->firstOrFail();

        $row->restore();

        return redirect('admin/category?trashed=true')->with('message', 'بازیابی دسته ها با موفقیت انجام شد  ');
    }







}