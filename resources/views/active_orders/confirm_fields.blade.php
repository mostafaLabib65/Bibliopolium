<!-- Book Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>



<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Confirm order', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('activeOrders.index') !!}" class="btn btn-default">Cancel</a>
</div>
