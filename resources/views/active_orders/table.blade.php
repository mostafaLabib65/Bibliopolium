<table class="table table-responsive" id="activeOrders-table">
    <thead>
        <tr>
            <th>Book Id</th>
        <th>Quantity</th>
        <th>Order Timestamp</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($activeOrders as $activeOrder)
        <tr>
            <td>{!! $activeOrder->book_id !!}</td>
            <td>{!! $activeOrder->quantity !!}</td>
            <td>{!! $activeOrder->created_at !!}</td>
            <td>
                {!! Form::open(['route' => ['activeOrders.destroy', $activeOrder->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('activeOrders.show', [$activeOrder->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('activeOrders.edit', [$activeOrder->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-erase"></i></a>
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>