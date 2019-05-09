@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Active Cart
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        @include('flash::message')

        <div class="content">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="row" style="padding-left: 20px">
                        @include('active_carts.show_fields')
                        <a href="{!! route('activeCarts.index') !!}" class="btn btn-default">Back</a>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="box box-primary">
                <div class="box-body">
                    @include('items.table')
                </div>
            </div>
            <div class="text-center">

            </div>
        </div>

        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::model($activeCart, ['route' => ['activeCarts.checkout', $activeCart->id], 'method' => 'post']) !!}

                    <div class="form-group col-sm-6">
                        {!! Form::label('credit_card', 'Credit Card Number:') !!}
                        {!! Form::text('credit_card', null, ['class' => 'form-control']) !!}
                    </div>
                    <!-- Submit Field -->
                    <div class="form-group col-sm-12">
                        {!! Form::button('<i class="btn btn-primary">Checkout</i>', [
                        'type' => 'submit',
                         'class' => 'btn btn-primary',
                         'onclick' => "return confirm('Are you sure you want to checkout? This action is irreversible.')"]) !!}
                        <a href="{!! route('activeCarts.index') !!}" class="btn btn-default">Cancel</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection