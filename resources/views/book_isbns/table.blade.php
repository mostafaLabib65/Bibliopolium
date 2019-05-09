<table class="table table-responsive" id="bookIsbns-table">
    <thead>
        <tr>
            <th>Title</th>
            <th>Publisher</th>
        <th>Isbn</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($bookIsbns as $bookIsbn)
        <tr>
            <td>{!! $bookIsbn->title !!}</td>
            <td>{!! $bookIsbn->name !!}</td>
            <td>{!! $bookIsbn->isbn !!}</td>
            <td>
                {!! Form::open(['route' => ['bookIsbns.destroy', $bookIsbn->book_id, $bookIsbn->publisher_id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('bookIsbns.show', [$bookIsbn->book_id, $bookIsbn->publisher_id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('bookIsbns.edit', [$bookIsbn->book_id, $bookIsbn->publisher_id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>