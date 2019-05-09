<table class="table table-responsive" id="statistics-table">
    <thead>
        <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>Spent money</th>

        </tr>
    </thead>
    <tbody>
    @foreach($top_customers as $top_customer)
        <tr>
            <td>{!! $top_customer->first_name !!}</td>
            <td>{!! $top_customer->last_name !!}</td>
            <td>{!! $top_customer->spent_money !!}</td>

        </tr>
    @endforeach
    </tbody>
</table>