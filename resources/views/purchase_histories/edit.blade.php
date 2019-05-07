@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Purchase History
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($purchaseHistory, ['route' => ['purchaseHistories.update', $purchaseHistory->id], 'method' => 'patch']) !!}

                        @include('purchase_histories.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection