<!-- Role Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('role_name', 'Role Name:') !!}
    {!! Form::text('role_name', null, ['class' => 'form-control']) !!}
</div>

<!-- User Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_name', 'User Name:') !!}
    {!! Form::text('user_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Decrypted Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('decrypted_password', 'Decrypted Password:') !!}
    {!! Form::text('decrypted_password', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('roleCredentials.index') !!}" class="btn btn-default">Cancel</a>
</div>
