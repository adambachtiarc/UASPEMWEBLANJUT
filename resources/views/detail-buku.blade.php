@extends('layout.master')
@php
use App\Helpers\Helper;
@endphp
@section('content')
<p class="h1 mb-3">{{ $buku->judul }}</p>

<div class="form-group mb-10 row">
    @php
    $fileUrl=Helper::getSymlinkPath($buku->gambar);
    @endphp
    {!! Helper::getFilePreview($fileUrl,$buku->judul) !!}
</div>
<div class="form-group">
    <label style="font-weight: bold">ISBN</label>
    <div class="form-group col-lg-12 col-md-12 col-sm-12" style="margin: 0;">
        <p class="value-presenter">{!!
            $buku->isbn !!}
        </p>
    </div>
</div>
<div class="form-group">
    <label style="font-weight: bold">Penulis</label>
    <div class="form-group col-lg-12 col-md-12 col-sm-12" style="margin: 0;">
        <p class="value-presenter">{!!
            $buku->penulis !!}
        </p>
    </div>
</div>
<div class="form-group">
    <label style="font-weight: bold">Tahun Terbit</label>
    <div class="form-group col-lg-12 col-md-12 col-sm-12" style="margin: 0;">
        <p class="value-presenter">{!!
            $buku->tahun_terbit !!}
        </p>
    </div>
</div>
<div class="form-group">
    <label style="font-weight: bold">Penerbit</label>
    <div class="form-group col-lg-12 col-md-12 col-sm-12" style="margin: 0;">
        <p class="value-presenter">{!!
            $buku->penerbit !!}
        </p>
    </div>
</div>
<div class="form-group">
    <label style="font-weight: bold">Jumlah</label>
    <div class="form-group col-lg-12 col-md-12 col-sm-12" style="margin: 0;">
        <p class="value-presenter">{!!
            $buku->jumlah !!}
        </p>
    </div>
</div>
<div class="form-group">
    <label style="font-weight: bold">Resume</label>
    <div class="form-group col-lg-12 col-md-12 col-sm-12" style="margin: 0;">
        <p class="value-presenter">{!!
            $buku->resume !!}
        </p>
    </div>
</div>


@endsection

@section('js')
<script src="{{ asset('assets/library/lightbox2-2.11.3/dist/js/lightbox.min.js') }}"></script>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('assets/library/lightbox2-2.11.3/dist/css/lightbox.min.css') }}">
<style>
    .lightbox {
        display: flex;
        flex-direction: column-reverse;
    }

    .lb-data .lb-close {
        top: -50px;
        margin-right: 0px;
    }

    .lb-next {
        opacity: 0.5 !important;
    }

    .lb-next:hover {
        opacity: 1 !important;
    }

    .lb-prev {
        opacity: 0.5 !important;
    }

    .lb-prev:hover {
        opacity: 1 !important;
    }

    .value-presenter {
        vertical-align: middle;
        line-height: 2em;
        padding: 0.5em;
        margin: 0;
        min-height: 3em;
        background: #c0c0c0;
    }
</style>
@endsection
