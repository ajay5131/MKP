@extends('backend.layouts.app_layout')

@section('content')

    <!-- Laravel package configured in config/app.php -->
    @include('flash::message')
    
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo"> <span class="caption-subject bold">Add Translate Label</span> </div>
                </div>
                <div class="portlet-body form">          
                    {{-- <ul class="nav nav-tabs">              
                        <li class="active"> <a href="#Details" data-toggle="tab" aria-expanded="false"> Details </a> </li>
                    </ul> --}}
                    {!! Form::open(array('method' => 'post', 'route' => 'admin.save.language.translate.label', 'class' => 'form', 'files'=>true)) !!}
                    {{-- <div class="tab-content">               --}}
                        {{-- <div class="tab-pane fade active in" id="Details"> --}}
                        @include('backend.langtranslatelabel._form') 
                    {{-- </div>
                    </div> --}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    
@endsection