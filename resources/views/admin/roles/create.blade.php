@extends('admin.master')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6 main-header">
                        <h2> <span> رول</span></h2>
                        <h6 class="mb-0">افزودن </h6>
                    </div>
                    <div class="col-lg-6 breadcrumb-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="pe-7s-home"></i></a></li>
                            <li class="breadcrumb-item">پنل مدیریت</li>
                            <li class="breadcrumb-item">مداح</li>
                            <li class="breadcrumb-item active">افزودن رول</li>
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
                            <h5>افزودن رول</h5>
                        </div>
                        {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">نام</label>
                                        <div class="col-sm-9">
                                            {!! Form::text('name', null, array('placeholder' => 'لطفا نام را وارد کنید','class' => 'form-control')) !!}
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
