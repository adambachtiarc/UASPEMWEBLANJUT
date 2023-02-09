@extends('layout.master')
@section('content')
<table class="table" id="table">
    <thead>
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">ISBN</th>
            <th class="text-center">Judul</th>
            <th class="text-center">Penulis</th>
            <th class="text-center">Tahun Terbit</th>
            <th class="text-center">Penerbit</th>
            <th class="text-center">Jumlah</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('assets/library/DataTables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/library/fontawesome-free-5.13.0-web/css/all.css') }}">
@endsection

@section('js')
<script src="{{ asset('assets/library/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/library/fontawesome-free-5.13.0-web/js/all.js') }}"></script>

<script>
    $(function(){
        let baseurl=$("#baseurl").data('baseurl')
        let dataTable = $("#table").DataTable({
            dom: "Blfrtip",
            responsive: true,
            serverSide: true,
            ajax: {
                url: `${baseurl}/manajemen-buku/datatable`
            },
            columns: [{
                data: 'DT_RowIndex',
                orderable: false,
                searchable: false,
                class: "text-center"
            },
            {
                data: 'isbn',
                name: 'isbn'
            },
            {
                data: 'judul',
                name: 'judul'
            },
            {
                data: 'penulis',
                name: 'penulis'
            },
            {
                data: 'tahun_terbit',
                name: 'tahun_terbit',
                class: "text-center"
            },
            {
                data: 'penerbit',
                name: 'penerbit',
                class: "text-left"
            },
            {
                data: 'jumlah',
                name: 'jumlah',
                class: "text-center"
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                class: "text-center"
            },
            ],
            buttons:{
                dom: {
                    button: {
                        tag: 'button',
                        className: ''
                    }
                    },
                    buttons: [
                        {
                            text: 'Tambah Buku',
                            className:"btn btn-success",
                            action: function ( e, dt, node, config ) {
                                window.location.href=`${baseurl}/manajemen-buku/create`
                            }
                        }
                    ],
            },
            order: [
                [0, 'desc']
            ],
            lengthMenu: [
                [10, 20, 50, -1],
                [10, 20, 50, "All"]
            ],
            oLanguage: {
                sLengthMenu: "Show _MENU_"
            },
            responsive: true,
            ordering: true
        })

        $(".dt-buttons").addClass("mb-3 mt-3 float-end").wrap(`<div class="row"></div>`).wrap(`<div class="col-12"></div>`)
        $("#table_filter").addClass("float-start")
        $("#table_length").addClass("float-end")

        $("#table").on("click", ".btn-hapus-buku", function (e) {
            e.preventDefault()
            let id = $(this).data('id')
            Swal.fire({
                title: "Hapus buku ini?",
                html: "",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    let csrf = $("meta[name=csrf-token]").attr("content")

                    $.ajax({
                        url: `${baseurl}/manajemen-buku/${id}`,
                        method: "DELETE",
                        dataType: "JSON",
                        data: {
                            id: id,
                            _token: csrf
                        },
                        success: function (data, status) {
                            if (data.validation != undefined && data.validation?.length != 0) {
                                Swal.fire({
                                    title: "Terjadi kesalahan pada aplikasi!",
                                    html: `<center>Silahkan hubungi developer.</center>`,
                                    icon: "error"
                                });
                                return false
                            }

                            jsonFlasher(data)
                            dataTable.ajax.reload()
                        },
                        error: function (xhr, desc, err) {
                            Swal.fire({
                                title: "Terjadi kesalahan!",
                                html: ``,
                                icon: "error"
                            });

                            console.log("xhr")
                            console.log(xhr)
                            console.log(`desc => ${desc}`)
                            console.log(`err => ${err}`)
                        }
                    })
                }
            })
        })
    })
</script>
@endsection
