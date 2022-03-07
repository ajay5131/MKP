<div class="page-sidebar navbar-collapse collapse">
	<ul class="page-sidebar-menu page-header-fixed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
		<li class="sidebar-toggler-wrapper hide">
			<div class="sidebar-toggler"> </div>
		</li>
		<li class="sidebar-search-wrapper">
		</li>
		<li class="nav-item start active"> 
            <a href="{{ route('admin.dashboard') }}" class="nav-link"> <i class="icon-home"></i> <span class="title">Dashboard</span> </a> 
        </li>
    		
        {{-- @include('admin/shared/side_bars/admin_user') --}}

		<li class="heading">
			<h3 class="uppercase">Admin Users</h3>
		</li>

		<li class="nav-item  "> <a href="javascript:;" class="nav-link nav-toggle"> <i class="fa fa-user" aria-hidden="true"></i> <span class="title">Admin Users</span> <span class="arrow"></span> </a>
			<ul class="sub-menu">		
				<li class="nav-item  "> <a href="{{ route('admin.user') }}" class="nav-link "> <span class="title">List Admin User</span> </a> </li>
				<li class="nav-item  "> <a href="{{ route('admin.add.user') }}" class="nav-link "> <span class="title">Add Admin User</span> </a> </li>
			</ul>		
		</li>

		<li class="heading">
			<h3 class="uppercase">Modules</h3>
		</li>
		
		<li class="nav-item">
        	<a href="{{ route('user.profiles') }}" class="nav-link nav-toggle">
        		<i class="fa fa-users"></i>
        		<span class="title">User Profiles</span>
        	</a>
        </li>

		<li class="nav-item">
        	<a href="{{ route('admin.slider') }}" class="nav-link nav-toggle">
        		<i class="fa fa-camera"></i>
        		<span class="title">Slider</span>
        	</a>
        </li>
		<li class="nav-item">
        	<a href="{{ route('admin.news') }}" class="nav-link nav-toggle">
        		<i class="fa fa-newspaper-o"></i>
        		<span class="title">News</span>
        	</a>
        </li>
		
		<li class="nav-item  "> <a href="javascript:;" class="nav-link nav-toggle"> <i class="fa fa-users" aria-hidden="true"></i> <span class="title">Meet Our Team</span> <span class="arrow"></span> </a>
			<ul class="sub-menu">		
				<li class="nav-item  "> <a href="{{ route('admin.team') }}" class="nav-link "> <span class="title">List Team</span> </a> </li>
				<li class="nav-item  "> <a href="{{ route('admin.add.team') }}" class="nav-link "> <span class="title">Add Team</span> </a> </li>
				<li class="nav-item  "> <a href="{{ route('admin.sort.team') }}" class="nav-link "> <span class="title">Sort Team</span> </a> </li>		
			</ul>		
		</li>

		<li class="nav-item">
        	<a href="{{ route('admin.testimonial') }}" class="nav-link nav-toggle">
        		<i class="fa fa-list"></i>
        		<span class="title">Testimonial</span>
        	</a>
        </li>

		<li class="nav-item  "> <a href="javascript:;" class="nav-link nav-toggle"> <i class="fa fa-list" aria-hidden="true"></i> <span class="title">FAQ</span> <span class="arrow"></span> </a>
			<ul class="sub-menu">		
				<li class="nav-item  "> <a href="{{ route('admin.faq') }}" class="nav-link "> <span class="title">List FAQ</span> </a> </li>
				<li class="nav-item  "> <a href="{{ route('admin.add.faq') }}" class="nav-link "> <span class="title">Add FAQ</span> </a> </li>
				<li class="nav-item  "> <a href="{{ route('admin.sort.faq') }}" class="nav-link "> <span class="title">Sort FAQ</span> </a> </li>		
			</ul>		
		</li>


		<li class="nav-item">
        	<a href="{{ route('admin.pagecontent') }}" class="nav-link nav-toggle">
        		<i class="fa fa-list-alt"></i>
        		<span class="title">Page Content</span>
        	</a>
        </li>

		
		{{-- @include('admin/shared/side_bars/project')

		@include('admin/shared/side_bars/job')

        @include('admin/shared/side_bars/company')

        @include('admin/shared/side_bars/site_user')

        @include('admin/shared/side_bars/cms')

        @include('admin/shared/side_bars/seo')

        @include('admin/shared/side_bars/faq')

        @include('admin/shared/side_bars/video')

        @include('admin/shared/side_bars/testimonial') --}}

        {{-- <li class="nav-item">
        	<a href="#" class="nav-link nav-toggle">
        		<i class="icon-briefcase"></i>
        		<span class="title">Notify</span>
        	</a>
        </li>
        <li class="nav-item">
        	<a href="#" class="nav-link nav-toggle">
        		<i class="icon-briefcase"></i>
        		<span class="title">Terms and Conditions</span>
        	</a>
        </li>
		<li class="nav-item">
        	<a href="#" class="nav-link nav-toggle">
        		<i class="icon-briefcase"></i>
        		<span class="title">Privacy Policy</span>
        	</a>
        </li>
        <li class="nav-item">
        	<a href="#" class="nav-link nav-toggle">
        		<i class="icon-briefcase"></i>
        		<span class="title">Terms of Service</span>
        	</a>
        </li> --}}

		{{-- @include('admin/shared/side_bars/news')
		@include('admin/shared/side_bars/team_sidebar') --}}

		<li class="heading">
			<h3 class="uppercase">Translation</h3>
		</li>		

		<li class="nav-item">
        	<a href="{{ route('admin.language') }}" class="nav-link nav-toggle">
        		<i class="fa fa-language"></i>
        		<span class="title">Manage Language</span>
        	</a>
        </li>
		<li class="nav-item">
        	<a href="{{ route('admin.language.translate') }}" class="nav-link nav-toggle">
        		<i class="fa fa-language"></i>
        		<span class="title">Language Translate</span>
        	</a>
        </li>

		{{-- @include('admin/shared/side_bars/language') --}}

		<li class="heading">
			<h3 class="uppercase">Manage Location</h3>
		</li>

		<li class="nav-item  "> <a href="javascript:;" class="nav-link nav-toggle"> <i class="fa fa-globe" aria-hidden="true"></i> <span class="title">Countries</span> <span class="arrow"></span> </a>
			<ul class="sub-menu">		
				<li class="nav-item  "> <a href="{{ route('admin.country') }}" class="nav-link "> <span class="title">List Countries</span> </a> </li>
				<li class="nav-item  "> <a href="{{ route('admin.add.country') }}" class="nav-link "> <span class="title">Add Country</span> </a> </li>		
			</ul>		
		</li>
		
		<li class="nav-item  "> <a href="javascript:;" class="nav-link nav-toggle"> <i class="fa fa-globe" aria-hidden="true"></i> <span class="title">States</span> <span class="arrow"></span> </a>
			<ul class="sub-menu">		
				<li class="nav-item  "> <a href="{{ route('admin.state') }}" class="nav-link "> <span class="title">List State</span> </a> </li>
				<li class="nav-item  "> <a href="{{ route('admin.add.state') }}" class="nav-link "> <span class="title">Add State</span> </a> </li>		
			</ul>		
		</li>
		
		<li class="nav-item  "> <a href="javascript:;" class="nav-link nav-toggle"> <i class="fa fa-globe" aria-hidden="true"></i> <span class="title">Cities</span> <span class="arrow"></span> </a>
			<ul class="sub-menu">
				<li class="nav-item  "> <a href="{{ route('admin.city') }}" class="nav-link "> <span class="title">List City</span> </a> </li>
				<li class="nav-item  "> <a href="{{ route('admin.add.city') }}" class="nav-link "> <span class="title">Add City</span> </a> </li>
			</ul>		
		</li>

		{{-- @include('admin/shared/side_bars/country')

		@include('admin/shared/side_bars/country_detail')

		@include('admin/shared/side_bars/state')

		@include('admin/shared/side_bars/city')
 --}}
		<li class="heading">
			<h3 class="uppercase">User Packages</h3>
		</li>

		{{-- @include('admin/shared/side_bars/package') --}}

        <li class="heading">
			<h3 class="uppercase">Job Attributes</h3>
		</li>

		{{-- @include('admin/shared/side_bars/language_level')

		@include('admin/shared/side_bars/career_level')

		@include('admin/shared/side_bars/functional_area')

		@include('admin/shared/side_bars/gender') 

		@include('admin/shared/side_bars/industry') 

		@include('admin/shared/side_bars/job_experience') 

		@include('admin/shared/side_bars/job_skill') 

		@include('admin/shared/side_bars/job_type') 

		@include('admin/shared/side_bars/job_shift') 

		@include('admin/shared/side_bars/degree_level') 

		@include('admin/shared/side_bars/degree_type') 

		@include('admin/shared/side_bars/major_subject')  

		@include('admin/shared/side_bars/result_type')

		@include('admin/shared/side_bars/marital_status')

		@include('admin/shared/side_bars/ownership_type') 

		@include('admin/shared/side_bars/salary_period')  --}}

		<li class="heading">
			<h3 class="uppercase">Manage</h3>
		</li>		 

		{{-- @include('admin/shared/side_bars/site_setting')         --}}
	</ul>
</div>



