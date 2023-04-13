<?php

namespace App\Http\Controllers;

use App\Models\MonaSebat;
use Illuminate\Http\Request;
use File;
use Brian2694\Toastr\Facades\Toastr;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;
class MonaSebatController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:monasebats-list|monasebats-create|monasebats-edit|monasebats-delete', ['only' => ['index','show']]);
        $this->middleware('permission:monasebats-create', ['only' => ['create','store']]);
        $this->middleware('permission:monasebats-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:monasebats-delete', ['only' => ['destroy']]);
   }

    public function index()
    {
        $monaSebats=MonaSebat::paginate(10);
        return view('admin.monasebats.index',compact('monaSebats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.monasebats.create');
    }


    public function store(Request $request)
    {
        $madah=new MonaSebat();


        $name = $request->file('image')->getClientOriginalName();

        $path = $request->file('image')->move('uploads/monasebat', $name);

        $madah->name = $request->input('name');

        $madah->image = $name;

        $madah->save();
     $toast=Toastr::success('با موفقیت اضافه شد');

        return redirect()->route('monasebat.index')->with($toast);

    }



    public function edit($id)
    {
        $monaSebat=MonaSebat::find($id);
        return view('admin.monasebats.edit',compact('monaSebat'));
    }


    public function update(Request $request,$id)
    {
        $monaSebat=MonaSebat::find($id);
        $imageName=$monaSebat->iamge;
        if ($request->file('image')) {
            $imagePath = $request->file('image');
            $imageName = 'madah-'.md5(time()).'.'.$request->image->getClientOriginalExtension();
            //set upload directory
            $path = $request->file('image')->move('uploads/monasebat/', $imageName);
        }
        $monaSebat->name=$request->input('name');

        $monaSebat->image = $imageName;
     //insert to database
     $monaSebat->save();
     $toast=Toastr::success('با موفقیت به روز شد شد');
     return redirect()->route('monasebat.index')->with($toast);
    }


    public function destroy($id)
    {
        $monaSebat=MonaSebat::find($id);
        $image1=asset('uploads/monasebat/'.$monaSebat->image);


        if (!empty($image1)) {
            $web_image_path = "uploads/monasebat/" . $image1;

            if (File::exists(public_path($web_image_path))) {
                File::delete(public_path($web_image_path));
            }
        }



        $monaSebat->delete();
        $toast=Toastr::success('با موفقیت حدف شد');
             return redirect()->route('monasebat.index')->with($toast);
    }
    }

