<table class="table table-responsive" id="purchaseHistories-table">
    <thead>
        <tr>
            <th>Timestamp</th>
        <th>Total Price</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($purchaseHistories as $purchaseHistory)
        <tr>
            <td>{!! $purchaseHistory->timestamp !!}</td>
            <td>{!! $purchaseHistory->total_price !!}</td>
            <td>
                {!! Form::open(['route' => ['purchaseHistories.destroy', $purchaseHistory->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('purchaseHistories.show', [$purchaseHistory->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('purchaseHistories.edit', [$purchaseHistory->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>