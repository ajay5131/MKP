@extends('backend.layouts.app_layout')

@section('content')

    <!-- Laravel package configured in config/app.php -->
    @include('flash::message')
    
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo"> <span class="caption-subject bold">Add News</span> </div>
                </div>
                <div class="portlet-body form">          
                    {!! Form::open(array('method' => 'post', 'route' => 'admin.save.news', 'class' => 'form', 'files'=>true)) !!}
                        @include('backend.news._form') 
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    
@endsection