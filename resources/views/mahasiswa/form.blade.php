<!DOCTYPE html>
@extends('mahasiswa.layout')

@section('content')
<style>
	.img-wrapper {
	width: 140px;
	height:140px;
	background: url('{{ isset($data) && !is_null($data->avatar) ? url($data->avatar) : 'https://placehold.co/140x140?text=AVATAR' }}');
	background-repeat:no-repeat;
	background-size: cover;
	background-position: center;
	}
</style>
<div class="card">
	<div class="card-header">{{ isset($data) ? 'Edit' : 'Tambah' }} Mahasiswa</div>
	<div class="card-body">
		<form id="formCustomer" method="POST" action="{{ isset($data) ? route('mahasiswas.update', ['mahasiswa' => $data->id]) : route('mahasiswas.store') }}">
			@csrf
			<div class="row">
				<div class="col-auto">
					<div id="image-avatar" class="img-wrapper" ></div>
					<input type="file" id="pickPhoto" name="photo" accept="image/jpeg,image/png,image/gif"/>
				</div>
				<div class="col">
					<div class="mb-2">
						<label for="inputNim" class="form-label">Nim</label>
						<input type="number" class="form-control" id="inputNim" name="nim" autocomplete="off" value="{{ $data->nim ?? '' }}" required >
					</div>
					<div class="mb-2">
						<label for="inputName" class="form-label">Nama</label>
						<input type="text" class="form-control" id="inputName" name="name" autocomplete="off" value="{{ $data->name ?? '' }}" required >
					</div>
					<!--Prodi-->
					<div class="mb-3">
						<label class="form-label">Prodi</label>
						<select name="kd_prodi" id="inputProdi" class="form-control">
							<option value="">-- Pilih Prodi --</option>
							@foreach ($prodis as $kd_prodi => $nama_prodi)
							<option value="{{ $kd_prodi }}" {{ old('kd_prodi') == $kd_prodi ? 'selected' : '' }}>
								{{ $nama_prodi }}
							</option>
							@endforeach
						</select>
					</div>
					<div class="mb-2">
						<label for="inputSemester" class="form-label">Semester</label>
						<input type="text" class="form-control" id="inputSemester" name="semester" autocomplete="off" value="{{ $data->semester ?? '' }}" >
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
				
				$(document).on('change', '#pickPhoto', function(e) {
                var file = $(this)[0].files[0];
                var exts = ["image/png", "image/jpg", "image/jpeg"];
                var max  = 1024 * 1024;
                
                //validasi image
                if( !exts.includes(file.type) )
                {
				alert("File must be an image. JPG OR PNG");
				return false;
                }
				
                //validasi image size
                if( file.size >  max)
                {
				alert("File not large than 1 MB");
				return false;
                }
                
				
                if (file) {
				var reader = new FileReader();
				reader.onload = function(e) {
				
				var image = new Image();
				image.src = e.target.result;
				
				image.onload = function() {
				
				$("#image-avatar").css("background-image", "url(" + this.src + ")");
				$("#image-avatar").css("background-position", "center");
				$("#image-avatar").css("background-size", "cover"); 
				$("#image-avatar").css("background-repeat", "no-repeat");
				
				};
				
				}
				reader.readAsDataURL(file);
                } else {
				alert('select a file to see preview');
				$('#pickPhoto').val('');
				$("#image-avatar").css("background", "url('https://placehold.co/140x140?text=AVATAR')");
                }
				});
				
				$("#formCustomer").validate({
                rules : {
				name : "required",
				nim: "required",
				
                },
                messages : {
				name : {
				required : 'Nama harus diisi'
				},
				nim : {
				required : 'Nim harus diisi'
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
				formData.append('name', $('#inputName').val());
				formData.append('nim', $('#inputNim').val());
				formData.append('kd_prodi', $('#inputProdi').val());
				formData.append('semester', $('#inputSemester').val());
				
				// Attach file
				formData.append('photo', $('input[type=file]')[0].files[0]); 
				
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
				window.location.href = '{{ route('mahasiswas.index') }}';
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