@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Book Isbn
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($bookIsbn, ['route' => ['bookIsbns.update', $bookIsbn->book_id, $bookIsbn->publisher_id], 'method' => 'patch']) !!}

                        @include('book_isbns.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection