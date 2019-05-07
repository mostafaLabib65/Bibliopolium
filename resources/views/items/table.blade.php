<table class="table table-responsive" id="items-table">
    <thead>
        <tr>
            <th>Book Id</th>
        <th>Quantity</th>
        <th>Edition</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr>
            <td>{!! $item->book_id !!}</td>
            <td>{!! $item->quantity !!}</td>
            <td>{!! $item->edition !!}</td>
            <td>
                {!! Form::open(['route' => ['items.destroy', $item->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('items.show', [$item->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('items.edit', [$item->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>