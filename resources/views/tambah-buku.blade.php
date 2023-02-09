@extends('layout.master')
@section('content')
<p class="h1">Tambah Buku</p>
<form id="form-tambah-buku" action="{{ url('manajemen-buku') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="isbn" class="form-label">ISBN</label>
        <input type="text" class="form-control" id="isbn" name="isbn">
        <div class="error-text error-isbn text-danger form-text"></div>
    </div>
    <div class="mb-3">
        <label for="judul" class="form-label">Judul</label>
        <input type="text" class="form-control" id="judul" name="judul">
        <div class="error-text error-judul text-danger form-text"></div>
    </div>
    <div class="mb-3">
        <label for="gambar" class="form-label">Gambar</label>
        <input type="file" class="form-control" id="gambar" name="gambar[]">
        <div class="error-text error-gambar text-danger form-text"></div>
    </div>
    <div class="mb-3">
        <label for="penulis" class="form-label">Penulis</label>
        <input type="text" class="form-control" id="penulis" name="penulis">
        <div class="error-text error-penulis text-danger form-text"></div>
    </div>
    <div class="mb-3">
        <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
        <input type="text" class="form-control" id="tahun_terbit" name="tahun_terbit">
        <div class="error-text error-tahun_terbit text-danger form-text"></div>
    </div>
    <div class="mb-3">
        <label for="penerbit" class="form-label">Penerbit</label>
        <input type="text" class="form-control" id="penerbit" name="penerbit">
        <div class="error-text error-penerbit text-danger form-text"></div>
    </div>
    <div class="mb-3">
        <label for="jumlah" class="form-label">Jumlah</label>
        <input type="text" class="form-control" id="jumlah" name="jumlah">
        <div class="error-text error-jumlah text-danger form-text"></div>
    </div>
    <div class="mb-3">
        <label for="resume" class="form-label">Resume</label>
        <textarea name="resume" id="resume" class="form-control" cols="30" rows="10"></textarea>
        <div class="error-text error-resume text-danger form-text"></div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection

@section('js')
<script>
    $(function(){
        let baseurl=$("#baseurl").data('baseurl')
        // submit form
        $('#form-tambah-buku').on('submit', function (e) {
            e.preventDefault()
            $(".error-text").html("");
            $(".loader").show()
            let url = $("#form-tambah-buku").attr('action')
            let method = $("#form-tambah-buku").attr('method')
            let formData = new FormData($("#form-tambah-buku")[0])

            sendFormData(url, formData, method)
        });
        })
</script>

@endsection
