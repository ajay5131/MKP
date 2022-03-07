@extends('backend.layouts.app_layout')

@section('content')
    <!-- Laravel package configured in config/app.php -->
    @include('flash::message')

    <div class="row">
        <div class="col-md-12"> 
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption"> <i class="icon-info font-dark"></i> <span class="caption-subject font-dark sbold uppercase">List</span> </div>
                    <div class="actions"> <a href="{{ route('admin.add.faq') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Add FAQ</a> </div>
                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        <form method="post" role="form" id="faq-search-form">
                            <table class="table table-striped table-bordered table-hover"  id="faq__table">
                                <thead>
                                    <tr role="row" class="filter">
                                        <td><input type="text" class="form-control" name="question" id="question" autocomplete="off" placeholder="Question"></td>                      
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr role="row" class="heading">                                            
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th>Sort Order</th>
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
            var oTable = $('#faq__table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                searching: false,
                ajax: {
                    url: '{!! route('admin.list.faq') !!}',
                    data: function (d) {
                        d.question = $('input[name=question]').val();
                    }
                }, columns: [
                    {data: 'question', name: 'question'},
                    {data: 'answer', name: 'answer'},
                    {data: 'sort_order', name: 'sort_order'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
            $('#faq-search-form').on('submit', function (e) {
                
                oTable.draw();
                e.preventDefault();
            });
            
            $('#question').on('keyup', function (e) {
                oTable.draw();
                e.preventDefault();
            });
        });

        function deleteRecord(id) {
            if (confirm('Are you sure you want to delete?')) {
                $.post("{{ route('admin.delete.faq') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
                        .done(function (response) {
                            if (response == 'ok') {
                                var table = $('#faq__table').DataTable();
                                table.row('faqDtRow' + id).remove().draw(false);
                            } else {
                                alert('Request Failed!');
                            }
                        });
            }
        }
    </script>

@endpush