<table class="table table-responsive" id="activeCarts-table">
    <thead>
    <tr>
        <th>User Name</th>
        <th>Status</th>
        <th>No Of Items</th>
        <th>Total Price</th>
        <th colspan="3">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($activeCarts as $activeCart)
        <tr>
            <td>{!! $activeCart->user_name !!}</td>
            <td>{!! $activeCart->status !!}</td>
            <td>{!! $activeCart->no_of_items !!}</td>
            <td>{!! $activeCart->total_price ?? 0 !!}</td>
            <td>
                {!! Form::open(['route' => ['activeCarts.destroy', $activeCart->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('activeCarts.show', [$activeCart->id]) !!}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('activeCarts.edit', [$activeCart->id]) !!}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-edit"></i></a>
                    <a href="{!! route('activeCarts.checkout', [$activeCart->id]) !!}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-euro"></i></a>

                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>