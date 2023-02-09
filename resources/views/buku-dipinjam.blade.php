@extends('layout.master')
@section('content')

<div class="album pb-5 bg-light">
    <div class="container">
        <p class="h1 mb-3">Buku Dipinjam</p>

        @include('daftar-buku-dipinjam')
    </div>
</div>
@endsection
