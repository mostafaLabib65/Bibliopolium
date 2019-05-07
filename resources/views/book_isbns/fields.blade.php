<!-- Publisher Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('publisher_id', 'Publisher Id:') !!}
    {!! Form::number('publisher_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Isbn Field -->
<div class="form-group col-sm-6">
    {!! Form::label('isbn', 'Isbn:') !!}
    {!! Form::number('isbn', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('bookIsbns.index') !!}" class="btn btn-default">Cancel</a>
</div>
