<table class="table table-responsive" id="roleCredentials-table">
    <thead>
        <tr>
            <th>Role Name</th>
        <th>User Name</th>
        <th>Decrypted Password</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($roleCredentials as $roleCredential)
        <tr>
            <td>{!! $roleCredential->role_name !!}</td>
            <td>{!! $roleCredential->user_name !!}</td>
            <td>{!! $roleCredential->decrypted_password !!}</td>
            <td>
                {!! Form::open(['route' => ['roleCredentials.destroy', $roleCredential->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('roleCredentials.show', [$roleCredential->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('roleCredentials.edit', [$roleCredential->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>