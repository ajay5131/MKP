@extends('backend.layouts.app_layout')

@section('content')
    <!-- Laravel package configured in config/app.php -->
    @include('flash::message')

    <div class="row">
        <div class="col-md-12"> 
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption"> <i class="icon-info font-dark"></i> <span class="caption-subject font-dark sbold uppercase">List</span> </div>
                    {{-- <div class="actions"> <a href="{{ route('admin.add.language.translate') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Add New Translate</a> </div> --}}
                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        <form method="post" role="form" id="table-search-form">
                            <table class="table table-striped table-bordered table-hover"  id="table__id">
                                <thead>
                                    <tr role="row" class="filter"> 
                                        <td>
                                            {!! Form::select('label_id', ['' => 'Select Label']+$labels, null, array('id'=>'label_id', 'class'=>'form-control select2')) !!} 
                                        </td>
                                        <td><input type="text" class="form-control" name="title" id="title" autocomplete="off" placeholder="Title"></td>                      
                                        <td></td>
                                    </tr>
                                    <tr role="row" class="heading">                                            
                                        <th>Label</th>
                                        <th>Title</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('custom-script')

    <script>
        $(function () {
            var oTable = $('#table__id').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                searching: false,
                ajax: {
                    url: '{!! route('admin.list.language.translate') !!}',
                    data: function (d) {
                        d.title = $('input[name=title]').val();
                        d.label_id = $('#label_id').val();
                    }
                }, columns: [
                    {data: 'lang_label', name: 'lang_label'},
                    {data: 'value', name: 'value'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
            $('#table-search-form').on('submit', function (e) {
                
                oTable.draw();
                e.preventDefault();
            });
            $('#label_id').on('change', function (e) {
                oTable.draw();
                e.preventDefault();
                listStates(0);
            });
            $('#title').on('keyup', function (e) {
                oTable.draw();
                e.preventDefault();
            });
        });

        
    </script>

@endpush
