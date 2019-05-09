<!-- Edition Field -->
<div class="form-group col-sm-6">
    {!! Form::label('edition', 'Edition:') !!}
    {!! Form::number('edition', null, ['class' => 'form-control']) !!}
</div>

<!-- Edition Field -->
<div class="form-group col-sm-6">
    {!! Form::label('book_id', 'Book ID:') !!}
    {!! Form::number('book_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Publishing Year Field -->
<div class="form-group col-sm-6">
    {!! Form::label('publishing_year', 'Publishing year:') !!}
    {!! Form::number('publishing_year', null, ['class' => 'form-control']) !!}
</div>


<!-- Publisher Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('publisher_id', 'Publisher Id:') !!}
    {!! Form::number('publisher_id', null, ['class' => 'form-control']) !!}
</div>

<!-- No Of Copies Field -->
<div class="form-group col-sm-6">
    {!! Form::label('no_of_copies', 'No Of Copies:') !!}
    {!! Form::number('no_of_copies', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('bookEditions.index') !!}" class="btn btn-default">Cancel</a>
</div>
