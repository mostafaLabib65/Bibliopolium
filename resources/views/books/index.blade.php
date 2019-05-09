@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Books</h1>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px"
               href="{!! route('books.create') !!}">Add New</a>
        </h1>
    </section>

    <section class="content-header">
        <div class="content">
            <div class="box model-box">
                <h3 class="pull-left"> Search</h3>
                <div class="clearfix"></div>

                {!! Form::open(['route' => ['books.index'], 'method' => 'get']) !!}
                @include('books.search_fields')
                {!! Form::close() !!}
                <div class="clearfix"></div>

            </div>
        </div>
    </section>


    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('books.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

