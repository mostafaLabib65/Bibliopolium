<table class="table table-responsive" id="authorBooks-table">
    <thead>
        <tr>
            <th>Author Name</th>
            <th>BOOK Id</th>
            <th>BOOK Title</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($authorBooks as $authorBook)
        <tr>
            <td>{!! $authorBook->name !!}</td>
            <td>{!! $authorBook->book_id !!}</td>
            <td>{!! $authorBook->title !!}</td>
            <td>
                {!! Form::open(['route' => ['authorBooks.destroy', $authorBook->book_id, $authorBook->author_id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('authorBooks.show', [$authorBook->book_id, $authorBook->author_id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>