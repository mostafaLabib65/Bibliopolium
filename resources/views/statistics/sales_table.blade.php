<table class="table table-responsive" id="statistics-table">
    <thead>
        <tr>
            <th>Book ID</th>
            <th>Total sales $</th>
        </tr>
    </thead>
    <tbody>
    @foreach($total_sales as $total_sale)
        <tr>
            <td>{!! $total_sale->id !!}</td>
            <td>{!! $total_sale->total_price !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>