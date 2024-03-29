<!-- Book Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('book_id', 'Book Id:') !!}
    {!! Form::number('book_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Quantity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantity', 'Quantity:') !!}
    {!! Form::number('quantity', null, ['class' => 'form-control']) !!}
</div>

<!-- Order Timestamp Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order_timestamp', 'Order Timestamp:') !!}
    {!! Form::date('order_timestamp', null, ['class' => 'form-control','id'=>'order_timestamp']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#order_timestamp').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::number('status', null, ['class' => 'form-control']) !!}
</div>

<!-- History Timestamp Field -->
<div class="form-group col-sm-6">
    {!! Form::label('history_timestamp', 'History Timestamp:') !!}
    {!! Form::date('history_timestamp', null, ['class' => 'form-control','id'=>'history_timestamp']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#history_timestamp').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('historyOrders.index') !!}" class="btn btn-default">Cancel</a>
</div>
