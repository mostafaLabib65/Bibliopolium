<table class="table table-responsive" id="statistics-table">
    <thead>
        <tr>
            <th>Book id</th>
            <th>Title</th>
            <th>Sold copies</th>
        </tr>
    </thead>
    <tbody>
    @foreach($top_books as $top_book)
        <tr>
            <td>{!! $top_book->book_id !!} </td>
            <td>{!! $top_book->title !!} </td>
            <td>{!! $top_book->sold_copies !!}</td>

        </tr>
    @endforeach
    </tbody>
</table>