<!-- Book Id Field -->
<div class="form-group">
    {!! Form::label('book_id', 'Book Id:') !!}
    <p>{!! $book->id !!}</p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{!! $book->title !!}</p>
</div>

<!-- Author Id Field -->
<div class="form-group">
    {!! Form::label('author_id', 'Author Id:') !!}
    <p>{!! $book->author_id !!}</p>
</div>

<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', 'Price:') !!}
    <p>{!! $book->price !!}</p>
</div>

<!-- Category Field -->
<div class="form-group">
    {!! Form::label('category', 'Category:') !!}
    <p>{!! $book->category !!}</p>
</div>

<!-- Threshold Field -->
<div class="form-group">
    {!! Form::label('threshold', 'Threshold:') !!}
    <p>{!! $book->threshold !!}</p>
</div>

<!-- No Of Copies Field -->
<div class="form-group">
    {!! Form::label('no_of_copies', 'No Of Copies:') !!}
    <p>{!! $book->no_of_copies !!}</p>
</div>
