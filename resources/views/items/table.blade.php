<table class="table table-responsive" id="items-table">
    <thead>
    <tr>
        <th>Book Title</th>
        <th>Edition</th>
        <th>Quantity</th>
        <th>Book Price</th>
        <th>Total Price</th>
        <th colspan="3">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr>
            <td>{!! $item->book_name !!}</td>
            <td>{!! $item->edition !!}</td>
            <td>{!! $item->quantity !!}</td>
            <td>{!! $item->price !!}</td>
            <td>{!! $item->total_price !!}</td>
            <td>
                {!! Form::open(['route' => ['items.destroy', $item->cart_id,$item->edition,$item->book_id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('items.show', [$item->cart_id,$item->edition,$item->book_id]) !!}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('items.edit', [$item->cart_id,$item->edition,$item->book_id]) !!}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>