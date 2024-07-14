<!DOCTYPE html>
@extends('matkul.layout')

@section('content')
<div class="card">
	<div class="card-header">{{ isset($data) ? 'Edit' : 'Tambah' }} Matakuliah</div>
	<div class="card-body">
		<form id="formCustomer" method="POST" action="{{ isset($data) ? route('matkuls.update', ['matkul' => $data->id]) : route('matkuls.store') }}">
			@csrf
			<div class="row">
				<div class="col">
					<div class="mb-2">
						<label for="inputKD_MK" class="form-label">KD_MK</label>
						<input type="text" class="form-control" id="inputKD_MK" name="kd_mk" autocomplete="off" value="{{ $data->kd_mk ?? '' }}" required >
					</div>
					<!--Prodi-->
					<div class="mb-3">
						<label class="form-label">Prodi</label>
						<select name="kd_prodi"  id="inputProdi" class="form-control">
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
						<input type="text" class="form-control" id="inputSemester" name="semester" autocomplete="off" value="{{ $data->semester ?? '' }}" required>
					</div>
					<div class="mb-2">
						<label for="inputMatkul" class="form-label">Nama Matakuliah</label>
						<input type="text" class="form-control" id="inputMatkul" name="nama_matkul" autocomplete="off" value="{{ $data->nama_matkul ?? '' }}" >
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
				name : "required",
				kd_mk: "required",
				
			},
			messages : {
				name : {
					required : 'Nama harus diisi'
				},
				kd_mk : {
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
				formData.append('nama_matkul', $('#inputName').val());
				formData.append('kd_mk', $('#inputKD_MK').val());
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