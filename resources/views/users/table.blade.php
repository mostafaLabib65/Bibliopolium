<table class="table table-responsive" id="users-table">
    <thead>
        <tr>
            <th>Email</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Shipping Address</th>
        <th>Phone Number</th>
        <th>Spent Money</th>
        <th>Encrypted Password</th>
        <th>Reset Password Token</th>
        <th>Reset Password Sent At</th>
        <th>Remember Created At</th>
        <th>Role</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{!! $user->email !!}</td>
            <td>{!! $user->first_name !!}</td>
            <td>{!! $user->last_name !!}</td>
            <td>{!! $user->shipping_address !!}</td>
            <td>{!! $user->phone_number !!}</td>
            <td>{!! $user->spent_money !!}</td>
            <td>{!! $user->encrypted_password !!}</td>
            <td>{!! $user->reset_password_token !!}</td>
            <td>{!! $user->reset_password_sent_at !!}</td>
            <td>{!! $user->remember_created_at !!}</td>
            <td>{!! $user->role !!}</td>
            <td>
                {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('users.show', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('users.edit', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>