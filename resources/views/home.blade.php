@extends('layouts.principal')

@section('contenido')
    <div class="row">
        <div class="col-md-2 sidebar">
           @include('layouts.sidebar');
        </div>
        <div class="col-md-8">
            @yield('contenido-seg')
        </div>
    </div>
@endsection
