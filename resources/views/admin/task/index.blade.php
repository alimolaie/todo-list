@extends('admin.master')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6 main-header">
                        <h2> <span> وظایف</span></h2>
                        <h6 class="mb-0">نمایش لیست </h6>
                    </div>
                    <div class="col-lg-6 breadcrumb-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="pe-7s-home"></i></a></li>
                            <li class="breadcrumb-item">پنل مدیریت</li>
                            <li class="breadcrumb-item">وظایف</li>
                            <li class="breadcrumb-item active">نمایش لیست وظایف</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 search-bar p-0 d-none d-md-block me-2">
            <form method="get" action="{{route('search.task')}}">
                <div class="input-group">
                    <input type="text" class="form-control mr-2" name="name" placeholder="نام وظیفه" required />
                    <span class="input-group-btn" style="width:0px;"></span>

                    <select class="form-control mr-2" id="exampleFormControlSelect1" required name="status">
                        <option value="" selected>وضعیت </option>
                        <option value="0">برای انجام</option>
                        <option value="1">در حال انجام</option>
                        <option value="2">انجام شده</option>
                    </select>
                    <span class="input-group-btn" style="width:0px;"></span>

                    <input type="submit" class="btn btn-info btn-md mr-2" value="جستجو" style="margin-left:-2px" />
                </div>
            </form>
        </div>
        <br>
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
                                    <th> توضیحات </th>
                                    <th> وضعیت </th>
                                    <th> عملیات </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($tasks as $key => $row )


                                    <tr>
                                        <th scope="row">{{$key +1}}</th>
                                        <td>{{ $row->name }}</td>
                                        <td>
                                            @if($row->description==null)
                                                {{"عدم توضیحات"}}
                                            @else
                                                {{ \Illuminate\Support\Str::limit($row->description, 50) }}
                                            @endif
                                        </td>
                                        <td>

                                                <?php
                                                //چون لاراول مچ رو نداره در بلید این قسمت رو برای بهینه تر شدن وضعیت با پی اچ پی خام مجبورم بنویسم
                                                $status=$row->status;
                                                $return_value = match($status) {
                                                    0=>"<span class='badge rounded-pill bg-danger'>برای انجام</span>",
                                                    1=> "<span class='badge rounded-pill bg-warning'>در حال انجام</span>",
                                                    2=> "<span class='badge rounded-pill bg-success'>انجام شده</span>"

                                                };
                                                echo $return_value;
                                                ?>
                                        </td>
                                        <td>

                                            @switch($row->status)
                                                @case(1)
                                                    <a href="{{ route('done.task',$row->id) }}"><i class="fa fa-check text-success" aria-hidden="true"></i></a>                                        @break
                                                    @break
                                                @case(2)
                                                    <i class="fa fa-check-square-o text-success" title="انجام شده" aria-hidden="true"></i>                                       @break
                                                    @break
                                                @default
                                                    <a href="{{ route('set.task.progress',$row->id) }}"><i class="fa fa-thumbs-up text-info" aria-hidden="true"></i></a>
                                            @endswitch
                                            <a href="{{ route('tasks.edit',$row->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            <a href="{{ route('delete.task',$row->id) }}" class="delete-confirm mr-1"><i class="fa fa-trash-o text-danger" aria-hidden="true"></i></a>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $tasks->links() }}
                        </div>
                    </div>





                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>

@endsection
