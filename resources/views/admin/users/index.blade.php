@extends('admin.master')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6 main-header">
                        <h2> <span> مدیریت کاربران</span></h2>
                        <h6 class="mb-0">نمایش همه </h6>
                    </div>
                    <div class="col-lg-6 breadcrumb-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="pe-7s-home"></i></a></li>
                            <li class="breadcrumb-item">پنل مدیریت</li>
                            <li class="breadcrumb-item">مدیریت کاربران</li>
                            <li class="breadcrumb-item active">همه کاربران</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">

                    <div class="card">
                        <div class="card-header">
                            <h5> </span>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-xl">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th> نام </th>
                                    <th> ایمیل </th>
                                    <th> عکس </th>
                                    <th> انتخاب رول </th>
                                    <th> عملیات </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($data ?? '' as $key => $user )


                                    <tr>
                                        <th scope="row">{{$key +1}}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>

                                        <td><img src="{{asset('uploads/users'.$user->profile_photo_path)}}" alt="image post" width="40" height="40"></td>
                                        <td>
                                            @if(!empty($user->getRoleNames()))
                                                @foreach($user->getRoleNames() as $v)
                                                    <label class="badge badge-success">{{ $v }}</label>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('users.destroy',$user->id) }}" method="POST">

                                                <a href="{{ route('users.edit',$user->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                                @csrf
                                                @method('DELETE')



                                                <button type="submit"><i class="fa fa-trash-o text-danger" aria-hidden="true"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $data ?? ''->links() }}
                        </div>
                    </div>





                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>

@endsection
