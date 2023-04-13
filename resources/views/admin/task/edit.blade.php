@extends('admin.master')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6 main-header">
                        <h2> <span> وظایف</span></h2>
                        <h6 class="mb-0">ویرایش </h6>
                    </div>
                    <div class="col-lg-6 breadcrumb-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="pe-7s-home"></i></a></li>
                            <li class="breadcrumb-item">پنل مدیریت</li>
                            <li class="breadcrumb-item">وظایف</li>
                            <li class="breadcrumb-item active">ویرایش وظایف</li>
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
                            <h5>ویرایش وظایف</h5>
                        </div>
                        <form class="form theme-form" method="POST" action="{{ route('tasks.update',$task->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">نام</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" required placeholder="لطفا نام وظیفه را وارد کنید" name="name" value="{{$task->name}}">
                                            </div>
                                        </div>



                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">توضیحات</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" rows="5" cols="5" placeholder="توضیحات" name="description">{{$task->description}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="col-sm-9 offset-sm-3">
                                    <button class="btn btn-pill btn-primary mr-5" style="right: 10px" type="submit"> ارسال </button>

                                </div>
                            </div>
                        </form>
                    </div>






                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>

@endsection
