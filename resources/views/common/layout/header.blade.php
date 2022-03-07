
<head>
    <title>MeetKeyPeople - Website</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />


    @if(isset($metas) && !empty($metas)) 
        <meta property="og:url" content="{{$metas['url']}}"/>
        <meta property="og:type" content="{{ !empty($metas['type']) ? $metas['type'] : 'article'}}" />
        <meta property="og:title" content="{{$metas['title']}}" />
        <meta property="og:description" content="{{$metas['description']}}" />
        <meta property="og:image" content="{{$metas['image']}}"/>
    
        <meta property="twitter:domain" content="{{ config('app.app_url') }}">
        <meta property="twitter:url" content="{{$metas['url']}}">
        <meta name="twitter:title" content="{{$metas['title']}}">
        <meta name="twitter:description" content="{{$metas['description']}}">
        <meta name="twitter:image" content="{{$metas['image']}}">
        <meta name="twitter:card" content="{{ !empty($metas['card']) ? $metas['card'] : 'summary'}}">  
    @endif

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/css/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}home/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}home/css/custom.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}home/css/new.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css"  />

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/2.2.9/flatpickr.min.css">

    <link rel='stylesheet' href='{{ asset('/') }}home/css/icono.min.css'>
    <link rel='stylesheet' href='{{ asset('/') }}home/css/jquery.tribute.css'>
    {{-- Additional Css which need to add in specific page --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">


    
    @stack('custom-style')

</head>
<?php 
    $direction = \Session::get('direction');
?>
<body class="{{ empty($direction) ? 'ltr' : ($direction == 0 ? 'ltr' : 'rtl')  }}">
    <div class="loader_block" id="loader">
        <div class="loader"></div>
        <div class="percentage"></div>
    </div>

    @if(!Auth::guard('user')->check()) 
        <header>
            <nav class="navbar navbar-expand-md navbar-light navbar-bg-white">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('/') }}home/images/logo.png">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav ml-auto">
                        @if(Auth::guard('user')->check())
                            <li class="nav-item navItem">
                                <a class="nav-link button" href="{{ route('logout') }}">@lang('messages.logout')</a>
                            </li>
                        @else
                            <li class="nav-item navItem">
                                <a class="nav-link button" href="{{ route('register') }}">@lang('messages.registerbtn')</a>
                            </li>
                            <li class="nav-item navItem">
                                <a class="nav-link button" href="{{ route('login') }}">@lang('messages.loginbtn')</a>
                            </li>
                        @endif
                        <li class="nav-item navItem">
                            <select class="form-select lang-select" id="change_language"  aria-label="Default select example">
                                
                                <?php 
                                    //General is an helper
                                    $languages = General::getActiveLanguage(); 
                                ?>
                                @if(count($languages) > 0) 
                                    @foreach ($languages as $key => $value)
                                        <option value='{{ $value->id }}' {{ (\Session::get('lang_id') == $value->id ? 'selected' : '')}}>{{ $value->language }}</option>  
                                    @endforeach
                                @else 
                                    <option value='en' {{ (App::getLocale() == 'en' ? 'selected' : '')}}>English</option>
                                @endif
                                    
                            </select>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="container text-center">
                <h5 class="home-above-slider-txt">@Lang('messages.slogan')</h5>
            </div>
        </header>
    @else
        <header id="header">
            <nav class="navbar navbar-expand-lg navbar-light" id="search-inputs">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('/') }}home/images/logo-1.png" class="desktop-logo">
                </a>
                <!--  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button> -->
                <div class="collapse navbar-collapse ml-auto" id="navbarSupportedContent">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 text-right mb-15">
                            <a href="{{ route('logout') }}" class="log-out-btn">@lang('messages.logout')</a>
                        </div>
                    </div>
                    <form method="GET" action="{{ route('search') }}" role="search">
                        <div class="row ml-auto" id="search-panel">
                            <div class="col-sm-12 col-md-12 col-lg-4 pr-0 pl-0">
                                <select class="form-select lang-select-1" aria-label="Default select example" name="category" id="category">
                                <option selected>Category</option>
                                <?php $profile = \General::getProfiles(); ?>
                                @foreach ($profile as $key => $value)
                                    <option value="{{$key}}" {{ (\request()->category == $key ? 'selected' : '')}}>{{$value}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-4 pr-0 pl-0">
                                <input class="search-input-control keyword-search" name="keyword" id="keyword" type="text" placeholder="Keyword Search" aria-label="Search" value="{{request()->keyword}}">
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-4 search-control pr-0 pl-0">
                                <span class="in-text">in</span>
                                <input class="search-input-control search-btn-control" name="location" id="location" type="search" placeholder="Location" aria-label="Search" value="{{request()->location}}">
                                <button class="btn search-icon-btn" type="submit">
                                   <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </nav>
            <!-- <nav class="navbar navbar-expand-md navbar-light navbar-bg-white"><a class="navbar-brand" href="#"><img src="assets/images/logo-1.png"></a><div class="collapse navbar-collapse" ><ul class="navbar-nav ml-auto"><li class="nav-item navItem"><a class="nav-link button" href="#">Regsiter</a></li><li class="nav-item navItem"><a class="nav-link button" href="#">Login</a></li><li class="nav-item navItem"><select class="form-select lang-select" aria-label="Default select example"><option selected>English</option><option value="1">French</option></select></li></ul></div></nav> -->
            <nav class="navbar navbar-expand-md navbar-light">
                <div class="">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item navItem">
                            <h5 class="setting-title">@Lang('messages.slogan')</h5>
                        </li>
                    </ul>
                </div>
            </nav>
            <nav class="navbar navbar-expand-md navbar-light navbar-bg-white">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('/') }}home/images/logo-1.png" class="mobile-logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item navItem">
                            <a class="nav-link button" href="#">@lang('messages.home')</a>
                        </li>
                        <li class="nav-item navItem">
                            <a class="nav-link button" href="#">@lang('messages.feed')</a>
                        </li>
                        <li class="nav-item navItem">
                            <div class="dropdown show">
                            <a class="btn dropdown-toggle nav-link button" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> @lang('messages.my_activity') <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#">@lang('messages.notification')</a>
                                <a class="dropdown-item" href="#">@lang('messages.my_agenda')</a>
                            </div>
                            </div>
                        </li>
                        <li class="nav-item navItem">
                            <?php $handle_name = \General::getMainProfileHandleName(Auth::guard('user')->user()->id);?>
                            <?php preg_match('/([a-z]*)@/i', \Request::route()->getActionName(), $matches); ?>
                            
                            <a class="nav-link button {{ $matches[1] == "ProfilesController" ? 'active' : ''}}" href="{{ route('main', $handle_name) }}">@lang('messages.my_profile')</a>
                        </li>
                        <li class="nav-item navItem">
                            <a class="nav-link button" href="{{ route('project.category.list') }}">@lang('messages.my_project')</a>
                        </li>
                        <li class="nav-item navItem">
                            <div class="dropdown show">
                            <a class="btn dropdown-toggle nav-link button" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> @lang('messages.my_key_list') <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('keylist') }}">@lang('messages.key_list')</a>
                                <a class="dropdown-item" href="{{ route('keypeople') }}">@lang('messages.key_people')</a>
                            </div>
                            </div>
                        </li>
                        <li class="nav-item navItem">
                            <a class="nav-link button" href="{{ route('messages.list') }}">@lang('messages.messages')</a>
                        </li>
                        <li class="nav-item navItem">
                            <a class="nav-link button" href="{{ route('setting') }}">@lang('messages.setting')</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
    @endif

    @include('flash::message')

    {!! APFrmErrHelp::showErrorsNotice($errors) !!}
