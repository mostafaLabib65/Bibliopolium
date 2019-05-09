<!-- Order Id Field -->
<div class="form-group">
    {!! Form::label('order_id', 'Order Id:') !!}
    <p>{!! $activeOrder->id !!}</p>
</div>

<!-- Book Id Field -->
<div class="form-group">
    {!! Form::label('book_id', 'Book Id:') !!}
    <p>{!! $activeOrder->book_id !!}</p>
</div>

<!-- Quantity Field -->
<div class="form-group">
    {!! Form::label('quantity', 'Quantity:') !!}
    <p>{!! $activeOrder->quantity !!}</p>
</div>

<!-- Order Timestamp Field -->
<div class="form-group">
    {!! Form::label('order_timestamp', 'Order Timestamp:') !!}
    <p>{!! $activeOrder->created_at !!}</p>
</div>

