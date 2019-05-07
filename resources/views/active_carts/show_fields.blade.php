<!-- User Name Field -->
<div class="form-group">
    {!! Form::label('user_name', 'User Name:') !!}
    <p>{!! $activeCart->user_name !!}</p>
</div>

<!-- Cart Id Field -->
<div class="form-group">
    {!! Form::label('cart_id', 'Cart Id:') !!}
    <p>{!! $activeCart->cart_id !!}</p>
</div>

<!-- Timestamp Field -->
<div class="form-group">
    {!! Form::label('timestamp', 'Timestamp:') !!}
    <p>{!! $activeCart->timestamp !!}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{!! $activeCart->status !!}</p>
</div>

<!-- No Of Items Field -->
<div class="form-group">
    {!! Form::label('no_of_items', 'No Of Items:') !!}
    <p>{!! $activeCart->no_of_items !!}</p>
</div>

