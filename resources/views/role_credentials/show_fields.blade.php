<!-- Role Id Field -->
<div class="form-group">
    {!! Form::label('role_id', 'Role Id:') !!}
    <p>{!! $roleCredential->role_id !!}</p>
</div>

<!-- Role Name Field -->
<div class="form-group">
    {!! Form::label('role_name', 'Role Name:') !!}
    <p>{!! $roleCredential->role_name !!}</p>
</div>

<!-- User Name Field -->
<div class="form-group">
    {!! Form::label('user_name', 'User Name:') !!}
    <p>{!! $roleCredential->user_name !!}</p>
</div>

<!-- Decrypted Password Field -->
<div class="form-group">
    {!! Form::label('decrypted_password', 'Decrypted Password:') !!}
    <p>{!! $roleCredential->decrypted_password !!}</p>
</div>

