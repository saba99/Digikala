<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warranty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class WarrantyController extends Controller
{

    protected $model = 'Warranty';
    protected $title = 'گارانتی';

    protected $route_params = 'warranties';

    public function index(Request $request)
    {
        $warranty = Warranty::getData($request);
        //$status = Warranty::ProductStatus();

        $trash_warranty_count = Warranty::onlyTrashed()->count();

        return view('warranty.index', ['warranty' => $warranty, 'trash_warranty_count' => $trash_warranty_count, 'request' => $request]);
    }


    public function create()
    {
        return view('warranty.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required'], [], ['name' => 'نام گارانتی']);
        $warranty = new Warranty($request->all());

        $warranty->saveOrFail();
           
        return redirect('admin/warranties')->with('message', 'ثبت گارانتی با موفقیت انجام شد ');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $warranty = Warranty::findOrFail($id);

        return view('warranty.edit', ['warranty' => $warranty]);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, ['name' => 'required'], [], ['name' => 'نام گارانتی']);
        $warranty = Warranty::findOrFail($id);

        $warranty->update($request->all());
        return redirect('admin/warranties')->with('message', 'ویرایش گارانتی با موفقیت انجام شد  ');
    }



    public function destroy($id)
    {
        $warranty = Warranty::findOrFail($id);
             
        $warranty->delete();
        return redirect('admin/warranties')->with('message', 'حذف گارانتی با موفقیت انجام شد   ');


    }
}
