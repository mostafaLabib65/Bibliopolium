<table class="table table-responsive" id="historyOrders-table">
    <thead>
        <tr>
            <th>Book Id</th>
        <th>Quantity</th>
        <th>Order Timestamp</th>
        <th>Status</th>
        <th>History Timestamp</th>
        </tr>
    </thead>
    <tbody>
    @foreach($historyOrders as $historyOrder)
        <tr>
            <td>{!! $historyOrder->book_id !!}</td>
            <td>{!! $historyOrder->quantity !!}</td>
            <td>{!! $historyOrder->order_created_at !!}</td>
            <td>{!! $historyOrder->status !!}</td>
            <td>{!! $historyOrder->created_at !!}</td>

        </tr>
    @endforeach
    </tbody>
</table>