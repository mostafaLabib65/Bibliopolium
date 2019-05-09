<!-- User Name Field -->
<div class="form-group">
    {!! Form::label('cart_owner', 'Cart Owner:') !!}
    <p>{!! $activeCart->user_name !!}</p>
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

<!-- No Of Items Field -->
<div class="form-group">
    {!! Form::label('total_price', 'Total Price:') !!}
    <p>{!! $activeCart->total_price !!}</p>
</div>

