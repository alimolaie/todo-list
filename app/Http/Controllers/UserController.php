<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['password']=bcrypt($request->password);
        $user=User::create($data);
        Auth::login($user);
        toastr()->success('ثبت نام با موفقت انجام شد');
        return redirect()->route('admin.dashboard');
    }
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('admin.users.index',compact('data'));

    }
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('admin.users.create',compact('roles'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        if ($request->file('profile_photo_path')) {
            $imagePath = $request->file('profile_photo_path');
            $imageName = 'b-'.md5(time()).'.'.$request->profile_photo_path->getClientOriginalExtension();
            //set upload directory
            $path = $request->file('profile_photo_path')->move('uploads/users', $imageName);
        }
        $input['profile_photo_path']=$imageName;
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return view()->with('message','کاربر با موفقیت ساخته شد');

    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('admin.users.edit',compact('user','roles','userRole'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
         //upload image one
		$image=$user->profile_photo_path;
		if($request->hasfile('profile_photo_path')){

        $imageName=hexdec(uniqid()).'.'.$request->profile_photo_path->getClientOriginalExtension();

        $path = $request->file('profile_photo_path')->move('uploads/users', $imageName);

		}
        $input['profile_photo_path']=$imageName;
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        return view('admin.users.index')->with('message','کاربر با موفقیت به روز رسانی شد');

    }
    public function destroy($id)
    {
        User::find($id)->delete();
        return view('admin.users.index')->with('message','کاربر با موفقیت حدف شد');

    }
}
