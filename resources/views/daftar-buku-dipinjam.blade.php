@php
use App\Helpers\Helper;
@endphp
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
    @foreach ($buku as $item)
    <div class="col">
        <div class="card shadow-sm">
            @php
            $fileUrl=Helper::getSymlinkPath($item->gambar);
            @endphp
            {!! Helper::getFilePreview(
            fileUrl:$fileUrl,
            title:$item->judul,
            imageAttr:"class='img-thumbnail'")
            !!}

            <div class="card-body">
                <p class="h5">{{ $item->judul }}</p>
                <p class="card-text">{{ substr($item->resume,0,100) }}.....</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <a href="{{ url('kembalikan-buku/'.$item->id) }}"
                            class="btn btn-sm btn-outline-secondary">Kembalikan</a>
                        <a href="{{ url('manajemen-buku/'.$item->id) }}"
                            class="btn btn-sm btn-outline-secondary">Detail</a>
                    </div>
                    <small class="text-muted">Stok : {{ $item->tersedia."/".$item->jumlah }}</small>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="row mt-5">
    <div class="col-12">
        {{ $buku->links() }}
    </div>
</div>

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
