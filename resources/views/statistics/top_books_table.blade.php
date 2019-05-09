<table class="table table-responsive" id="statistics-table">
    <thead>
        <tr>
            <th>Book id</th>
            <th>Title</th>
            <th>Sold copies</th>
        </tr>
    </thead>
    <tbody>
    @foreach($statistics as $statistic)
        <tr>
            <td>{!! $statistic->book_id !!} </td>
            <td>{!! $statistic->title !!} </td>
            <td>{!! $statistic->sold_copies !!}</td>

        </tr>
    @endforeach
    </tbody>
</table>