<!-- Order Id Field -->
<div class="form-group">
    {!! Form::label('order_id', 'Order Id:') !!}
    <p>{!! $historyOrder->order_id !!}</p>
</div>

<!-- Book Id Field -->
<div class="form-group">
    {!! Form::label('book_id', 'Book Id:') !!}
    <p>{!! $historyOrder->book_id !!}</p>
</div>

<!-- Quantity Field -->
<div class="form-group">
    {!! Form::label('quantity', 'Quantity:') !!}
    <p>{!! $historyOrder->quantity !!}</p>
</div>

<!-- Order Timestamp Field -->
<div class="form-group">
    {!! Form::label('order_timestamp', 'Order Timestamp:') !!}
    <p>{!! $historyOrder->order_timestamp !!}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{!! $historyOrder->status !!}</p>
</div>

<!-- History Timestamp Field -->
<div class="form-group">
    {!! Form::label('history_timestamp', 'History Timestamp:') !!}
    <p>{!! $historyOrder->history_timestamp !!}</p>
</div>

