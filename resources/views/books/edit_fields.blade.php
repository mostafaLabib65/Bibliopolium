<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', 'Price:') !!}
    {!! Form::number('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Category Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category', 'Category:') !!}
    {!! Form::select('category', $categories, $category ?? null, ['class' => 'form-control']) !!}
</div>

<!-- Threshold Field -->
<div class="form-group col-sm-6">
    {!! Form::label('threshold', 'Threshold:') !!}
    {!! Form::number('threshold', null, ['class' => 'form-control']) !!}
</div>


<!-- Threshold Field -->
<div class="form-group col-sm-6">
    {!! Form::label('publisher_id', 'Publisher:') !!}
    {!! Form::select('publisher_id', $publishers, $publisher ?? null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('books.index') !!}" class="btn btn-default">Cancel</a>
</div>
