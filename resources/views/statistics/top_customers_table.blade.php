<table class="table table-responsive" id="statistics-table">
    <thead>
        <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>Spent money</th>

        </tr>
    </thead>
    <tbody>
    @foreach($statistics as $statistic)
        <tr>
            <td>{!! $statistic->first_name !!}</td>
            <td>{!! $statistic->last_name !!}</td>
            <td>{!! $statistic->spent_money !!}</td>

        </tr>
    @endforeach
    </tbody>
</table>