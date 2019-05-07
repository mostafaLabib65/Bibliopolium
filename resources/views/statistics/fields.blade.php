<!-- Sold Copies Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sold_copies', 'Sold Copies:') !!}
    {!! Form::number('sold_copies', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('statistics.index') !!}" class="btn btn-default">Cancel</a>
</div>
