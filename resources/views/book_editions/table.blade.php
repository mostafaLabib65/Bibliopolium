<table class="table table-responsive" id="bookEditions-table">
    <thead>
        <tr>
            <th>Edition</th>
        <th>Publishing Year</th>
        <th>Publisher Id</th>
        <th>No Of Copies</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($bookEditions as $bookEdition)
        <tr>
            <td>{!! $bookEdition->edition !!}</td>
            <td>{!! $bookEdition->publishing_year !!}</td>
            <td>{!! $bookEdition->publisher_id !!}</td>
            <td>{!! $bookEdition->no_of_copies !!}</td>
            <td>
                {!! Form::open(['route' => ['bookEditions.destroy', $bookEdition->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('bookEditions.show', [$bookEdition->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('bookEditions.edit', [$bookEdition->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>