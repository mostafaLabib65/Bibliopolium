<!-- Title Field -->
<div class="form-group col-sm-3">
    {!! Form::label('title', 'Title') !!}
    {!! Form::text('title', $params['title'], ['class' => 'form-control']) !!}
</div>

<!-- Author Id Field -->
<div class="form-group col-sm-3">
    {!! Form::label('author', 'Author') !!}
    {!! Form::number('author', $params['author'], ['class' => 'form-control']) !!}
</div>

<!-- No Of Copies Field -->
<div class="form-group col-sm-3">
    {!! Form::label('publisher', 'Publisher') !!}
    {!! Form::number('publisher', $params['publisher'], ['class' => 'form-control']) !!}
</div>

<!-- No Of Copies Field -->
<div class="form-group col-sm-3">
    {!! Form::label('isbn', 'ISBN') !!}
    {!! Form::number('isbn', $params['isbn'], ['class' => 'form-control']) !!}
</div>


<!-- Category Field -->
<div class="form-group col-sm-3">
    {!! Form::label('category', 'Category') !!}
    {!! Form::text('category', $params['category'], ['class' => 'form-control']) !!}
</div>


<!-- Price Field -->
<div class="form-group col-sm-1">
    {!! Form::label('price higher than', 'Price Higher Than') !!}
    {!! Form::number('price_low', $params['price_low'], ['class' => 'form-control']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-1">
    {!! Form::label('price lower than', 'Price Lower Than') !!}
    {!! Form::number('price_high', $params['price_high'], ['class' => 'form-control']) !!}
</div>


<!-- No Of Copies Field -->
<div class="form-group col-sm-1">
    {!! Form::label('no_of_copies more than', 'No Of Copies More Than') !!}
    {!! Form::number('no_of_copies', $params['no_of_copies'], ['class' => 'form-control']) !!}
</div>





<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('books.index') !!}" class="btn btn-default">Clear Search</a>
</div>
