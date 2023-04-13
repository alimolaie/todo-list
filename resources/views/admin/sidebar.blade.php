<div class="iconsidebar-menu">
    <div class="sidebar">
      <ul class="iconMenu-bar custom-scrollbar">
        <li><a class="bar-icons" href="javascript:void(0)">
            <!--img(src='assets/images/menu/home.png' alt='')--><i class="pe-7s-home"></i><span>عمومی    </span></a>
          <ul class="iconbar-mainmenu custom-scrollbar">
            <li class="iconbar-header">داشبورد</li>
            <li><a href="{{route('admin.dashboard')}}">داشبورد</a></li>

          </ul>
        </li>


        <li><a class="bar-icons" href="javascript:void(0)"><i class="fa fa-user"></i><span> مدیریت کاربران </span></a>
          <ul class="iconbar-mainmenu custom-scrollbar">
            <li class = "iconbar-header"> مدیریت کاربران </li>
            <li> <a href="{{ route('users.create') }}"> ساخت کاربر جدید </a> </li>
            <li> <a href="{{ route('users.index') }}"> همه کاربران </a> </li>
            <li class = "iconbar-header"> رول منیجر </li>
            <li> <a href="{{ route('roles.create') }}"> New Role </a> </li>
            <li> <a href="{{ route('roles.index') }}"> All Roles </a> </li>
          </ul>
        </li>


        <li><a class="bar-icons" href="javascript:void(0)"><i class="fa fa-tasks"></i><span> مدیریت وظایف </span></a>
            <ul class="iconbar-mainmenu custom-scrollbar">
              <li class = "iconbar-header"> مدیریت وظایف </li>
              <li> <a href="{{ route('tasks.create') }}"> ساخت وظیفه جدید </a> </li>
              <li> <a href="{{ route('tasks.index') }}"> همه وظایف </a> </li>

            </ul>
          </li>






      </ul>
    </div>
  </div>
