<table class="table table-responsive" id="publishers-table">
    <thead>
        <tr>
            <th>Name</th>
        <th>Address</th>
        <th>Phone Number</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($publishers as $publisher)
        <tr>
            <td>{!! $publisher->name !!}</td>
            <td>{!! $publisher->address !!}</td>
            <td>{!! $publisher->phone_number !!}</td>
            <td>
                {!! Form::open(['route' => ['publishers.destroy', $publisher->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('publishers.show', [$publisher->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('books.index', ['publisher'=>$publisher->name]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open">See publisher's books</i></a>
                    <a href="{!! route('publishers.edit', [$publisher->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>