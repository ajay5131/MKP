@extends('backend.layouts.app_layout')

@section('content')

        @include('flash::message')

        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo"> <i class="icon-settings font-red-sunglo"></i> <span class="caption-subject bold">Edit Language</span> </div>
                    </div>

                    <div class="portlet-body form">          
                        {!! Form::model($detail, array('method' => 'post', 'route' => array('admin.update.language'), 'class' => 'form', 'files'=>true)) !!}

                            {!! Form::hidden('id', $detail->id) !!}            
                        
                            @include('backend.language._form') 
                        
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

@endsection