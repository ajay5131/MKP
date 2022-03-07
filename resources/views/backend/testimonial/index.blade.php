@extends('backend.layouts.app_layout')

@section('content')
    <!-- Laravel package configured in config/app.php -->
    @include('flash::message')

    <div class="row">
        <div class="col-md-12"> 
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption"> <i class="icon-info font-dark"></i> <span class="caption-subject font-dark sbold uppercase">List</span> </div>
                    <div class="actions"> <a href="{{ route('admin.add.testimonial') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Add Testimonial</a> </div>
                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        <form method="post" role="form" id="testimonial-search-form">
                            <table class="table table-striped table-bordered table-hover"  id="testimonial__table">
                                <thead>
                                    <tr role="row" class="filter">
                                        <td></td>
                                        <td><input type="text" class="form-control" name="full_name" id="full_name" autocomplete="off" placeholder="Full Name"></td>                      
                                        <td><input type="text" class="form-control" name="profession" id="profession" autocomplete="off" placeholder="Company and designation"></td>                      
                                        <td></td>
                                    </tr>
                                    <tr role="row" class="heading">                                            
                                        <th>Media</th>
                                        <th>Full Name</th>
                                        <th>Company and designation</th>
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
            var oTable = $('#testimonial__table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                searching: false,
                ajax: {
                    url: '{!! route('admin.list.testimonial') !!}',
                    data: function (d) {
                        d.full_name = $('input[name=full_name]').val();
                        d.profession = $('input[name=profession]').val();
                    }
                }, columns: [
                    {data: 'media', name: 'media', orderable: false, searchable: false},
                    {data: 'full_name', name: 'full_name'},
                    {data: 'profession', name: 'profession'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
            $('#testimonial-search-form').on('submit', function (e) {                
                oTable.draw();
                e.preventDefault();
            });
            
            $('#full_name').on('keyup', function (e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#profession').on('keyup', function (e) {
                oTable.draw();
                e.preventDefault();
            });
        });

        function deleteRecord(id) {
            if (confirm('Are you sure you want to delete?')) {
                $.post("{{ route('admin.delete.testimonial') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
                        .done(function (response) {
                            if (response == 'ok') {
                                var table = $('#testimonial__table').DataTable();
                                table.row('testimonialDtRow' + id).remove().draw(false);
                            } else {
                                alert('Request Failed!');
                            }
                        });
            }
        }
    </script>

@endpush