<table class="table table-responsive" id="historyOrders-table">
    <thead>
        <tr>
            <th>Book Id</th>
        <th>Quantity</th>
        <th>Order Timestamp</th>
        <th>Status</th>
        <th>History Timestamp</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($historyOrders as $historyOrder)
        <tr>
            <td>{!! $historyOrder->book_id !!}</td>
            <td>{!! $historyOrder->quantity !!}</td>
            <td>{!! $historyOrder->order_timestamp !!}</td>
            <td>{!! $historyOrder->status !!}</td>
            <td>{!! $historyOrder->history_timestamp !!}</td>
            <td>
                {!! Form::open(['route' => ['historyOrders.destroy', $historyOrder->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('historyOrders.show', [$historyOrder->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('historyOrders.edit', [$historyOrder->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>