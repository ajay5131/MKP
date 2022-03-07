<div class="top-menu">
    <ul class="nav navbar-nav pull-right">
        <li class="dropdown dropdown-user"> <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> 
            <span class="username username-hide-on-mobile"> 
                {{ (null !== (Auth::guard('admin')->user()) && isset(Auth::guard('admin')->user()->full_name)) ? Auth::guard('admin')->user()->full_name : '' }} 
            </span> 
            <i class="fa fa-angle-down"></i> </a>
            <ul class="dropdown-menu dropdown-menu-default">
                {{-- <li> <a href="#"> <i class="icon-user"></i> My Profile </a> </li> --}}
                <li> <a href="{{ route('admin.logout') }}"> <i class="icon-key"></i> Log Out </a> </li>
                <li class="divider"> </li>
            </ul>
        </li>
        {{-- <li class="dropdown dropdown-quick-sidebar-toggler">
            <a href="{{ route('admin.logout') }}" class="dropdown-toggle">
                <i class="icon-logout"></i>
            </a>
        </li> --}}
    </ul>
</div>
