@extends('admin.master')
@section('content')
    <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        @include('admin.sidebar')
        <!-- Page Sidebar Ends-->
        <!-- Right sidebar Start-->
        <div class="right-sidebar" id="right_side_bar">
            <div>
                <div class="container p-0">
                    <div class="modal-header p-l-20 p-r-20">
                        <div class="col-sm-8 p-0">
                            <h6 class="modal-title font-weight-bold"> وضعیت مخاطبین </h6>
                        </div>
                        <div class="col-sm-4 text-right p-0"><i class="mr-2" data-feather="settings"></i></div>
                    </div>
                </div>
                <div class="friend-list-search mt-0">
                    <input type="text" placeholder="search friend"><i class="fa fa-search"></i>
                </div>
                <div class="p-l-30 p-r-30">
                    <div class="chat-box">
                        <div class="people-list friend-list">
                            <ul class="list">
                                <li class="clearfix"><img class="rounded-small user-image" src="./assets/images/user/1.jpg" alt="">
                                    <div class="status-circle online"></div>
                                    <div class="about">
                                        <div class="name">ایمان پاکروح</div>
                                        <div class="status"> آنلاین</div>
                                    </div>
                                </li>
                                <li class="clearfix"><img class="rounded-small user-image" src="./assets/images/user/2.jpg" alt="">
                                    <div class="status-circle away"></div>
                                    <div class="about">
                                        <div class="name">سوسن عباسی</div>
                                        <div class="status"> 28 دقیقه پیش </div>
                                    </div>
                                </li>
                                <li class="clearfix"><img class="rounded-small user-image" src="./assets/images/user/8.jpg" alt="">
                                    <div class="status-circle online"></div>
                                    <div class="about">
                                        <div class="name">آرزو زیبا</div>
                                        <div class="status"> آنلاین</div>
                                    </div>
                                </li>
                                <li class="clearfix"><img class="rounded-small user-image" src="./assets/images/user/4.jpg" alt="">
                                    <div class="status-circle online"></div>
                                    <div class="about">
                                        <div class="name">سوسن محمدی</div>
                                        <div class="status"> آنلاین</div>
                                    </div>
                                </li>
                                <li class="clearfix"><img class="rounded-small user-image" src="./assets/images/user/5.jpg" alt="">
                                    <div class="status-circle offline"></div>
                                    <div class="about">
                                        <div class="name">سینا بهبهانی</div>
                                        <div class="status"> 2 دقیقه پیش</div>
                                    </div>
                                </li>
                                <li class="clearfix"><img class="rounded-small user-image" src="./assets/images/user/6.jpg" alt="">
                                    <div class="status-circle away"></div>
                                    <div class="about">
                                        <div class="name">رضا حسنی</div>
                                        <div class="status"> 2 ساعت پیش</div>
                                    </div>
                                </li>
                                <li class="clearfix"><img class="rounded-small user-image" src="./assets/images/user/7.jpg" alt="">
                                    <div class="status-circle online"></div>
                                    <div class="about">
                                        <div class="name">آزاده امیری</div>
                                        <div class="status"> آنلاین</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Right sidebar Ends-->
        <div class="page-body">
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6 main-header">
                            <h2> <span> مدیریت رول ها</span></h2>
                            <h6 class="mb-0">نمایش همه </h6>
                        </div>
                        <div class="col-lg-6 breadcrumb-right">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="pe-7s-home"></i></a></li>
                                <li class="breadcrumb-item">پنل مدیریت</li>
                                <li class="breadcrumb-item">مدیریت رول ها</li>
                                <li class="breadcrumb-item active">همه </li>
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
                                        <th> عملیات </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($roles ?? '' as $key => $role )

                                        <tr>
                                            <th scope="row">{{$key +1}}</th>
                                            <td>{{ $role->name }}</td>
                                            <td>{{ $role->email }}</td>



                                            <td>
                                                @if(auth()->user()->can('role-edit'))


                                                    <a href="{{ route('roles.edit',$role->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                @endif
                                                @can('role-delete')


                                                    <form action="{{ route('roles.destroy',$role->id) }}" method="POST">



                                                        @csrf
                                                        @method('DELETE')



                                                        <button type="submit"><i class="fa fa-trash-o text-danger" aria-hidden="true"></i></button>
                                                        @endcan
                                                    </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $roles ?? '' ?? ''->links() }}
                            </div>
                        </div>





                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 footer-copyright">
                        <p class="mb-0">حق کپی رایت © 2021 پوکو ، کلیه حقوق محفوظ است</p>
                    </div>
                    <div class="col-md-6">
                        <p class="pull-right mb-0">بومی شده با <i class="fa fa-heart"></i> توسط : <a href="https://www.rtl-theme.com/author/iman1300/">ایمان پاکروح </a></p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

@endsection
