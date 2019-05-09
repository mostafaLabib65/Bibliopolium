<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{!! $bookIsbn->title !!}</p>
</div>

<!-- Publisher Field -->
<div class="form-group">
    {!! Form::label('name', 'Publisher:') !!}
    <p>{!! $bookIsbn->name !!}</p>
</div>

<!-- Isbn Field -->
<div class="form-group">
    {!! Form::label('isbn', 'Isbn:') !!}
    <p>{!! $bookIsbn->isbn !!}</p>
</div>

