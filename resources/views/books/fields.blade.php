<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Author Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('author_id', 'Author:') !!}
    {!! Form::select('author_id', $authors, $author ?? null, ['class' => 'form-control','name'=>'authors[]','multiple']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', 'Price:') !!}
    {!! Form::number('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Category Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category', 'Category:') !!}
    {!! Form::text('category', null, ['class' => 'form-control']) !!}
</div>

<!-- Threshold Field -->
<div class="form-group col-sm-6">
    {!! Form::label('threshold', 'Threshold:') !!}
    {!! Form::number('threshold', null, ['class' => 'form-control']) !!}
</div>

<!-- No Of Copies Field -->
<div class="form-group col-sm-6">
    {!! Form::label('no_of_copies', 'No Of Copies:') !!}
    {!! Form::number('no_of_copies', null, ['class' => 'form-control']) !!}
</div>

<!-- publisher_id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('publisher_id', 'Publisher ID:') !!}
    {!! Form::select('publisher_id', $publishers, $publisher ?? null, ['class' => 'form-control']) !!}
</div>


<!-- Edition Field -->
<div class="form-group col-sm-6">
    {!! Form::label('publishing_year', 'Publishing year:') !!}
    {!! Form::number('publishing_year', null, ['class' => 'form-control']) !!}
</div>

<!-- Edition Field -->
<div class="form-group col-sm-6">
    {!! Form::label('edition', 'Edition:') !!}
    {!! Form::number('edition', null, ['class' => 'form-control']) !!}
</div>

<!-- ISBN Field -->
<div class="form-group col-sm-6">
    {!! Form::label('isbn', 'ISBN:') !!}
    {!! Form::number('isbn', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('books.index') !!}" class="btn btn-default">Cancel</a>
</div>

<script>
    $(document).ready(function() {
        $('[id=author_id]').select2();
    });

</script>