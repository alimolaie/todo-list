<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use File;
use Brian2694\Toastr\Facades\Toastr;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;
class AlbumController extends Controller
{
//    function __construct()
//    {
//        $this->middleware('permission:albums-list|albums-create|albums-edit|albums-delete', ['only' => ['index','show']]);
//        $this->middleware('permission:albums-create', ['only' => ['create','store']]);
//        $this->middleware('permission:albums-edit', ['only' => ['edit','update']]);
//        $this->middleware('permission:albums-delete', ['only' => ['destroy']]);
//   }
    public function index()
    {
        $albums=Album::latest()->paginate(10);
        return view('admin.albums.index',compact('albums'));
    }


    public function create()
    {
        return view('admin.albums.create');
    }


    public function store(Request $request)
    {
        $files = [];
        $nohe_name = [];
        if($request->hasfile('filenames'))
        {
           foreach($request->file('filenames') as $file)
           {
               $name = time().rand(1,100).'.'.$file->extension();
               $file->move(public_path('uploads/albums'), $name);
               $files[] = $name;
           }
        }
        foreach($request->name_nohe as $noheNames)
        {
            $nohe_name[]=$noheNames["name_nohe"];
        }


        $imageName = $request->file('image')->getClientOriginalName();

        $path = $request->file('image')->move('uploads/albums/image', $name);
        $albums=new Album();
        $albums->name_album = $request->input('name_album');
        $albums->madah_id = $request->input('madah_id');
        $albums->monasebat_id = $request->input('monasebat_id');
        $albums->image = $imageName;
        $albums->filenames = $files;
        $file->name_nohe = $nohe_name;
        $toast=Toastr::success('با موفقیت اضافه شد');
        $albums->save();
    }


    public function show(Album $album)
    {
        //
    }


    public function edit(Album $album)
    {
        //
    }


    public function update(Request $request, Album $album)
    {
        //
    }


    public function destroy(Album $album)
    {
        //
    }
}
