@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Active Cart
        </h1>
        <a href="{!! route('activeCarts.checkout', [$activeCart->id]) !!}" class='btn btn-default btn-xs'><i
                    class="glyphicon glyphicon-euro"></i> Checkout</a>
    </section>
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
@endsection
