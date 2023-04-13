<?php

namespace App\Http\Controllers;

use App\Models\Madah;
use Illuminate\Http\Request;
use File;
use Brian2694\Toastr\Facades\Toastr;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;
class MadahController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:madahs-list|madahs-create|madahs-edit|madahs-delete', ['only' => ['index','show']]);
        $this->middleware('permission:madahs-create', ['only' => ['create','store']]);
        $this->middleware('permission:madahs-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:madahs-delete', ['only' => ['destroy']]);
   }

    public function index()
    {
        $madah=Madah::latest()->paginate(10);
        return view('admin.Madah.index',compact('madah'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Madah.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $madah=new Madah();


        $name = $request->file('image')->getClientOriginalName();

        $path = $request->file('image')->move('madah', $name);

        $madah->name = $request->input('name');
        $madah->bio = $request->input('bio');
        $madah->image = $name;
        $toast=Toastr::success('با موفقیت اضافه شد');
        $madah->save();


        return redirect()->route('mahdah.index')->with($toast);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Madah  $madah
     * @return \Illuminate\Http\Response
     */
    public function show(Madah $madah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Madah  $madah
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $madahs=Madah::find($id);
        return view('admin.Madah.edit',compact('madahs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Madah  $madah
     * @return \Illuminate\Http\Response
     */
    public function updateMadah(Request $request, $id)
    {
        $madahs=Madah::find($id);
        $imageName=$madahs->iamge;
        if ($request->file('image')) {
            $imagePath = $request->file('image');
            $imageName = 'madah-'.md5(time()).'.'.$request->image->getClientOriginalExtension();
            //set upload directory
            $path = $request->file('image')->move('madah', $imageName);
        }
        $madahs->name=$request->input('name');
        $madahs->bio=$request->input('bio');
        $madahs->image = $imageName;
     //insert to database
     $madahs->save();
     $toast=Toastr::success('با موفقیت به روز شد');
     return redirect()->route('mahdah.index')->with($toast);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Madah  $madah
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $madah=Madah::find($id);
        $image1=asset('/madah/'.$madah->image);


        if (!empty($image1)) {
            $web_image_path = "/madah/" . $image1;

            if (File::exists(public_path($web_image_path))) {
                File::delete(public_path($web_image_path));
            }
        }



        $madah->delete();
        $toast=Toastr::success('با موفقیت به روز شد');
             return redirect()->route('mahdah.index')->with($toast);;
    }
}
