@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            History Order
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('history_orders.show_fields')
                    <a href="{!! route('historyOrders.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
