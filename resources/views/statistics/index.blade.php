@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Top 10 selling books</h1>
        <h1 class="pull-right">
        </h1>
        <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px"
           href="{!! route('statistics.report_top_books') !!}">Download</a>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('statistics.top_books_table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
    <section class="content-header">
        <h1 class="pull-left">Top 5 customers</h1>
        <h1 class="pull-right">
        </h1>
        <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px"
           href="{!! route('statistics.report_top_customers') !!}">Download</a>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('statistics.top_customers_table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
    <section class="content-header">
        <h1 class="pull-left">Total sales for books</h1>
        <h1 class="pull-right">
        </h1>
        <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px"
           href="{!! route('statistics.report_top_sales') !!}">Download</a>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('statistics.sales_table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

