<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- First Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('first_name', 'First Name:') !!}
    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Last Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('last_name', 'Last Name:') !!}
    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Shipping Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('shipping_address', 'Shipping Address:') !!}
    {!! Form::text('shipping_address', null, ['class' => 'form-control']) !!}
</div>

<!-- Phone Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone_number', 'Phone Number:') !!}
    {!! Form::text('phone_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Spent Money Field -->
<div class="form-group col-sm-6">
    {!! Form::label('spent_money', 'Spent Money:') !!}
    {!! Form::number('spent_money', null, ['class' => 'form-control']) !!}
</div>

<!-- Encrypted Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('encrypted_password', 'Encrypted Password:') !!}
    {!! Form::text('encrypted_password', null, ['class' => 'form-control']) !!}
</div>

<!-- Reset Password Token Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reset_password_token', 'Reset Password Token:') !!}
    {!! Form::text('reset_password_token', null, ['class' => 'form-control']) !!}
</div>

<!-- Reset Password Sent At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reset_password_sent_at', 'Reset Password Sent At:') !!}
    {!! Form::date('reset_password_sent_at', null, ['class' => 'form-control','id'=>'reset_password_sent_at']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#reset_password_sent_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Remember Created At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('remember_created_at', 'Remember Created At:') !!}
    {!! Form::date('remember_created_at', null, ['class' => 'form-control','id'=>'remember_created_at']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#remember_created_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Role Field -->
<div class="form-group col-sm-6">
    {!! Form::label('role', 'Role:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('role', 0) !!}
        {!! Form::checkbox('role', '1', null) !!} 1
    </label>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">Cancel</a>
</div>
