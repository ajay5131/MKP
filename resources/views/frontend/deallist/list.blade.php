<div class="table-responsive-sm">
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th scope="col">@lang('messages.date')</th>
                <th scope="col">@lang('messages.type_of_deal')</th>
                <th scope="col">@lang('messages.name')</th>
                <th scope="col">@lang('messages.status')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($deallist as $key => $value)
                <tr>
                    <td scope="row">{{ date('d/m/Y', strtotime($value->created_at)) }} <br>{{ date('h:i A', strtotime($value->created_at)) }}</td>
                    <td>{{ empty($value->deal_type) ? '-' : $value->deal_type }}</td>
                    <td>{{ $value->getSenderName('full_name') }}</td>
                    <td><?php echo $value->getStatus() ?></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>