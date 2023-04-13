<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks=Task::whereUser_id(Auth::id())->paginate(10);
        return view('admin.task.index',compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=array();
        $data['name']=$request->name;
        $data['description']=$request->description;
        $data['user_id']=Auth::id();
        $data['status']=0;
        Task::create($data);
        toastr()->success('وظیفه با موفقیت اضافه شد');
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userId=Auth::id();
        $task=Task::find($id);
        if ($task->user_id==$userId)
        {
            return view('admin.task.edit',compact('task'));
        }
        else
            abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $userId=Auth::id();
        $task=Task::find($id);
        if ($task->user_id==$userId)
        {
            $task->name=$request->name;
            $task->description=$request->description;
            $task->save();
            toastr()->success('وظیفه با موفقیت ویرایش شد');
            return redirect()->route('tasks.index');
        }
        else
            abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
        public function progressTask($id)
        {
            $userId=Auth::id();
            $task=Task::find($id);
            if ($task->user_id==$userId)
            {
                $task->status=1;
                $task->save();
                toastr()->success('وضعیت با موفقیت تغییر کرد');
                return back();
            }
            else
                abort(404);
        }
    public function doneTask($id)
    {
        $userId=Auth::id();
        $task=Task::find($id);
        if ($task->user_id==$userId)
        {
            $task->status=2;
            $task->save();
            toastr()->success('وظیفه با موفقیت انجام شد');
            return back();
        }
        else
            abort(404);
    }
    public function deleteTask($id)
    {
        $userId=Auth::id();
        $task=Task::find($id);
        if ($task->user_id==$userId)
        {
            $task->delete();
            toastr()->success('وظیفه با موفقیت حذف شد');
            return back();
        }
        else
            abort(404);
    }
    public function SearchItem(Request $request)
    {
        $searchName=$request->input('name');
        $searchStatus=$request->input('status');
        $tasks=DB::table('tasks')->where('name','LIKE', "%{$searchName}%")->where('status',$searchStatus)->paginate(10);
        return view('admin.task.index',compact('tasks'));
    }
}
