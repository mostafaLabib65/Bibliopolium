<!-- User Name Field -->
<div class="form-group">
    {!! Form::label('user_name', 'User Name:') !!}
    <p>{!! $purchaseHistory->user_name !!}</p>
</div>

<!-- Timestamp Field -->
<div class="form-group">
    {!! Form::label('timestamp', 'Timestamp:') !!}
    <p>{!! $purchaseHistory->timestamp !!}</p>
</div>

<!-- Total Price Field -->
<div class="form-group">
    {!! Form::label('total_price', 'Total Price:') !!}
    <p>{!! $purchaseHistory->total_price !!}</p>
</div>

