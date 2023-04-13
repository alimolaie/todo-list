@extends('admin.master')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6 main-header">
                        <h2> <span> مداح</span></h2>
                        <h6 class="mb-0">افزودن </h6>
                    </div>
                    <div class="col-lg-6 breadcrumb-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="pe-7s-home"></i></a></li>
                            <li class="breadcrumb-item">پنل مدیریت</li>
                            <li class="breadcrumb-item">مداح</li>
                            <li class="breadcrumb-item active">افزودن مداح</li>
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
                            <h5>افزودن مداح</h5>
                        </div>
                        {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]),'files'=>true !!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">نام</label>
                                        <div class="col-sm-9">
                                            {!! Form::text('name', null, array('placeholder' => 'لطفا نام را وارد کنید','class' => 'form-control')) !!}
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">رمز عبور</label>
                                        <div class="col-sm-9">
                                            {!! Form::password('password', array('placeholder' => 'لطفا رمز عبور را وارد کنید','class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">تکرار رمز عبور</label>
                                        <div class="col-sm-9">
                                            {!! Form::password('confirm-password', array('placeholder' => 'لطفا تکرار رمز عبور را وارد کنید','class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">تصویر شاخص</label>
                                        <div class="col-sm-9">
                                            {!! Form::file('image', array('class' => 'form-control-file')); !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">انتخاب رول</label>
                                        <div class="col-sm-9">
                                            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
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
                        {!! Form::close() !!}
                    </div>






                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>

@endsection
