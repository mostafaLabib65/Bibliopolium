@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Book Isbn
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('book_isbns.show_fields')
                    <a href="{!! route('bookIsbns.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
