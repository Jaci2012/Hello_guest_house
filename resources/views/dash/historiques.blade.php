@extends('base')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Historiques /</span> Listes</h4>
@if (session('success'))
    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
@endif

<div id='calendar'></div>
@endsection


