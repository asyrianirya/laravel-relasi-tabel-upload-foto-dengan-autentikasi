<!DOCTYPE html>
@extends('mahasiswa.layout')

@section('content')
    <div class="card">
        <div class="card-header">Data Mahasiswa</div>
        <div class="card-body">
            <a href="{{ route('mahasiswas.create') }}" class="btn btn-primary mb-2">Tambah Data</a>
            <table id="table" class="table table-striped" style="width:100%">
                <thead class="table-active">
                    <tr>
                        <th>NO</th>
                        <th>AVATAR</th>
						<th>NIM</th>
                        <th>NAMA</th>
						<th>KODE PRODI</th>
						<th>SEMESTER</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function(e) {

            initDataTable();

            $(document).on('click', '.delete', function(e) { 

                let deleteUrl = $(this).attr('data-url');
                Swal.fire({
                    icon: 'info',
                    title: 'Anda yakin?',
                    text: 'Tindakan ini bisa mengakibatkan data hilang secara permanen',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus sekarang',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {

                        let formData = new FormData();
                            formData.append('_token', `{{ csrf_token() }}`);
                            formData.append('_method', 'DELETE');

                        $.ajax({
                            url : deleteUrl,
                            method: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            beforeSend: function () {
                                //function here ...
                                $('button').prop('disabled', true);
                            },
                            success: function(response) {
                                $('button').prop('disabled', false);
                                console.log(response);
                                if( response.success == true )
                                {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: response.message
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            initDataTable();
                                        }
                                    })
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                
                                $('button').prop('disabled', false);
                                console.log('Message: ' + textStatus + ' , HTTP: ' + errorThrown );
                            },
                        })
                    }
                })

                return false;
            })

            async function initDataTable()
            {
                $('#table').DataTable({
                    processing: true,
                    serverSide: false,
                    ajax: "{{ route('mahasiswas.index') }}",
                    destroy: true,
                    language: {
                        searchPlaceholder: "Masukkan keywords disni ...",
                        emptyTable: "Data kosong"
                    },
                    columns: [
                        {data: 'id', name: 'id', render : function ( data, type, row, meta ) {
                            return meta.row+1;
                        }},
                        {data: 'avatar', name: 'avatar', render : function ( data, type, row, meta ) {
                            return '<img src="'+ ( data != null ? '{{ url('/') }}/' + data  : 'https://placehold.co/64x64?text=AVATAR' ) +'" class="rounded-circle" alt="'+ row.name +'" width="64"/>';
                        }},
						{data: 'nim', name: 'nim'},
                        {data: 'name', name: 'name'},
						{data: 'kd_prodi', name: 'kd_prodi'},
						{data: 'semester', name: 'semester'},
                        {data: 'id', name: 'action', orderable: false, render: function( data, type, row, meta) {
                            let btnAction = '<a class="btn btn-default edit" href="{{ url('mahasiswas') }}/'+ data +'/edit"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path><path d="M16 5l3 3"></path></svg>&nbsp;Edit</a>';
                                btnAction += '<button class="btn btn-danger delete" data-url="{{ url('mahasiswas') }}/'+ data +'"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M4 7h16"></path><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path><path d="M10 12l4 4m0 -4l-4 4"></path></svg>&nbsp;Hapus</button>';
                            return '<div class="btn-group" >'+ btnAction +'</div>';
                        }},
                    ],
                    columnDefs: [
                        { "width": "5%", "targets": 0 },
                        { "width": "10%", "targets": 1 },
                        { "width": "15%", "targets": 2 },
                        { "width": "12%", "targets": 4 },
                    ],
                });
            }
        })
    </script>
@endsection