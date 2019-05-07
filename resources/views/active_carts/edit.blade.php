@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Active Cart
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($activeCart, ['route' => ['activeCarts.update', $activeCart->id], 'method' => 'patch']) !!}

                        @include('active_carts.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection