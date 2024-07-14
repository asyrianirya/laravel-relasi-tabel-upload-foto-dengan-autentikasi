<!DOCTYPE html>
@extends('prodi.layout')

@section('content')
    <div class="card">
        <div class="card-header">{{ isset($data) ? 'Edit' : 'Tambah' }} Prodi</div>
        <div class="card-body">
            <form id="formCustomer" method="POST" action="{{ isset($data) ? route('prodis.update', ['prodi' => $data->id]) : route('prodis.store') }}">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="mb-2">
                            <label for="inputKD_PRODI" class="form-label">Kode Prodi</label>
                            <input type="text" class="form-control" id="inputKD_PRODI" name="kd_prodi" autocomplete="off" value="{{ $data->kd_prodi ?? '' }}" required >
                        </div>
                        <div class="mb-2">
                            <label for="inputName" class="form-label">Nama Prodi</label>
                            <input type="text" class="form-control" id="inputName" name="nama_prodi" autocomplete="off" value="{{ $data->nama_prodi ?? '' }}" required >
                        </div>
                        <div class="mb-2">
                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function(e) {

            $("#formCustomer").validate({
                rules : {
                    nama_prodi : "required",
                    kd_prodi: "required",
					
                },
                messages : {
                    nama_prodi : {
                        required : 'Nama Prodi harus diisi'
                    },
                    kd_prodi : {
                        required : 'Kode Prodi harus diisi'
                    }
                },
                errorPlacement: function(label, element) {
                    label.addClass('mt-2 invalid-feedback');
                    label.insertAfter(element);
                    $(element).removeClass('is-invalid')
                },
                highlight: function(element, errorClass) {
                    $(element).addClass('is-invalid')
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                    $(element).addClass('is-valid');
                },
                submitHandler: function(form) {
                    
                    let formData = new FormData();
                        formData.append('_token', `{{ csrf_token() }}`);
                        formData.append('kd_prodi', $('#inputKD_PRODI').val());
						formData.append('nama_prodi', $('#inputName').val());
                         
                    $.ajax({
                        url : $(form).attr('action'),
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
                                        window.location.href = '{{ route('prodis.index') }}';
                                    }
                                })
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            
                            $('button').prop('disabled', false);
                            console.log('Message: ' + textStatus + ' , HTTP: ' + errorThrown );
                        },
                    })

                    return false;
                }
            });
        })
    </script>
@endsection