@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Active Order
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($activeOrder, ['route' => ['activeOrders.update', $activeOrder->id], 'method' => 'patch']) !!}

                        @include('active_orders.confirm_fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection