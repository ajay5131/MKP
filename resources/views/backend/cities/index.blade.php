@extends('backend.layouts.app_layout')

@section('content')
    <!-- Laravel package configured in config/app.php -->
    @include('flash::message')

    <div class="row">
        <div class="col-md-12"> 
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption"> <i class="icon-info font-dark"></i> <span class="caption-subject font-dark sbold uppercase">List</span> </div>
                    <div class="actions"> <a href="{{ route('admin.add.city') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Add New City</a> </div>
                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        <form method="post" role="form" id="city-search-form">
                            <table class="table table-striped table-bordered table-hover"  id="city__table">
                                <thead>
                                    <tr role="row" class="filter"> 
                                        <td>
                                            {!! Form::select('country_id', ['' => 'Select Country']+$countries, null, array('id'=>'country_id', 'class'=>'form-control select2')) !!} 
                                        </td>
                                        <td>
                                            <span id="generate_state">                 
                                                {!! Form::select('state_id', ['' => 'Select State'], null, array('class'=>'form-control select2', 'id'=>'state_id')) !!}
                                            </span>
                                        </td>
                                        <td><input type="text" class="form-control" name="city" id="city" autocomplete="off" placeholder="City"></td>                      
                                        <td></td>
                                    </tr>
                                    <tr role="row" class="heading">                                            
                                        <th>Country</th>
                                        <th>State</th>
                                        <th>City</th>
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
            var oTable = $('#city__table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                searching: false,
                
                ajax: {
                    url: '{!! route('admin.list.city') !!}',
                    data: function (d) {
                        d.city = $('input[name=city]').val();
                        d.country_id = $('#country_id').val();
                        d.state_id = $('#state_id').val();
                    }
                }, columns: [
                    {data: 'country', name: 'country'},
                    {data: 'state', name: 'state'},
                    {data: 'city', name: 'city'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
            $('#city-search-form').on('submit', function (e) {
                
                oTable.draw();
                e.preventDefault();
            });
            $('#country_id').on('change', function (e) {
                oTable.draw();
                e.preventDefault();
                listStates(0);
            });
            $(document).on('change', '#state_id', function (e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#city').on('keyup', function (e) {
                oTable.draw();
                e.preventDefault();
            });
        });

        function deleteRecord(id) {
            if (confirm('Are you sure you want to delete?')) {
                $.post("{{ route('admin.delete.city') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
                        .done(function (response) {
                            if (response == 'ok') {
                                var table = $('#city__table').DataTable();
                                table.row('cityDtRow' + id).remove().draw(false);
                            } else {
                                alert('Request Failed!');
                            }
                        });
            }
        }

        function listStates(state_id) {
            var country_id = $('#country_id').val();
            if (country_id != ''){
                $.post("{{ route('get.states.by.country') }}", {country_id: country_id, state_id: state_id, _method: 'POST', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    $('#generate_state').html(response);
                    // Initiate select2
                    setTimeout(() => {
                        $('.select2').select2();
                    }, 200);
                });
            }
        }
        
    </script>

@endpush
