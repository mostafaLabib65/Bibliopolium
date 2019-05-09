<table class="table table-responsive" id="bookEditions-table">
    <thead>
        <tr>
            <th>Edition</th>
        <th>Publishing Year</th>
        <th>Publisher Name</th>
        <th>No Of Copies</th>
        <th>Add to Cart</th>
        <th colspan="3">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bookEditions as $bookEdition)
        <tr>
            <td>{!! $bookEdition->title  !!}</td>
            <td>{!! $bookEdition->edition !!}</td>
            <td>{!! $bookEdition->publishing_year !!}</td>
            <td>{!! $bookEdition->name !!}</td>
            <td>{!! $bookEdition->no_of_copies !!}</td>
            <td>
                {!! Form::open(['route' => ['items.store'], 'method' => 'post','id'=>'add_to_cart' , 'data-bookid'=>$bookEdition->book_id, 'data-edition'=>$bookEdition->edition]) !!}
                <div class='btn-group'>
                    {{--<div class="form-group col-sm-1">--}}
                    {!! Form::label('qty', 'Quantity') !!}
                    {!! Form::number('qty', null, ['class' => 'form-control']) !!}
                    {{--</div>--}}
                    {!! Form::button('<i class="glyphicon glyphicon-plus"></i>', ['type' => 'submit', 'class' => 'btn btn-primary btn-xs',]) !!}
                </div>
                {!! Form::close() !!}
            </td>
            <td>
                {!! Form::open(['route' => ['bookEditions.destroy', $bookEdition->book_id,$bookEdition->edition], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('bookEditions.show', [$bookEdition->book_id,$bookEdition->edition]) !!}"
                       class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('bookEditions.edit', [$bookEdition->book_id,$bookEdition->edition]) !!}"
                       class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>


<script>

    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });
    jQuery( document ).ready( function( $ ) {

        $( '#add_to_cart' ).on( 'submit', function(e) {
            e.preventDefault();
            console.log(e.target);

            $.ajax({
                type: "POST",
                url: '/items',
                data:{book_id:this.dataset.bookid,edition:this.dataset.edition,quantity:this[1].value},
                withCredentials:true,
            }).done(function( msg ) {
                alert( 'added to cart!' );
            });

        });
    });
</script>