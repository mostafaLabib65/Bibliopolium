@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Role Credential
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($roleCredential, ['route' => ['roleCredentials.update', $roleCredential->id], 'method' => 'patch']) !!}

                        @include('role_credentials.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection