<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Validator;
	use Illuminate\Support\Str;
	use App\Models\Prodi;
	use App\Models\Matkul;
	
	class MatkulController extends Controller
	{
		public function index(Request $request)
		{
			if($request->ajax()){
				$table = Matkul::orderBy('created_at', 'DESC')->get();
				return response()->json(['data' => $table]);
			}
			return view('matkul.index');
		}
		
		public function show($matkul)
		{
			$data = Matkul::findOrFail($matkul);
			return response()->json($data);
		}
		
		public function create(Request $request)
		{
			//return view('matkul.form');
			$prodis = Prodi::orderBy('kd_prodi', 'asc')->get()->pluck('nama_prodi','kd_prodi');
			return response(view('matkul.form', compact('prodis')));
		}
		
		public function edit($matkul, Request $request)
		{
			$data = matkul::findOrFail($matkul);
			$prodis = Prodi::orderBy('kd_prodi', 'asc')->get()->pluck('nama_prodi','kd_prodi');
			return view('matkul.form', compact('data','prodis'));
		}
		
		public function store(Request $request)
		{
			$validator = Validator::make($request->all(), [
            'kd_mk' => 'required',
			'semester' => 'required',
			'nama_matkul' => 'required',
			'kd_prodi' => [
            'required', 
			function ($attribute, $value, $fail) {
                $prodiExists = Prodi::where('kd_prodi', $value)->exists();
                if (!$prodiExists) {
                    $fail('Kode prodi tidak valid.');
				}
			},
			],
			],
			[
            'required'  => ':attribute harus diisi',
			]);
			
			if ($validator->fails()) {
				
				return response()->json(['success' => false, 'message' => $validator->errors()->first(), 422]);
			}
			
			$update =  new Matkul;
			$update->kd_mk = $request->get('kd_mk');
			$update->kd_prodi = $request->get('kd_prodi');
			$update->semester = $request->get('semester');
			$update->nama_matkul = $request->get('nama_matkul');
			$update->save();
			
			return response()->json(['success' => true, 'message' => 'Data Matkul berhasil ditambahkan']);
		}
		
		public function update($matkul, Request $request)
		{
			
			$validator = Validator::make($request->all(), [
			'kd_mk' => 'required',
			'kd_prodi' => 'required',
			'semester' => 'required',
			'nama_matkul' => 'required',
			],
			[
			'required'  => ':attribute harus diisi',
			]);
			
			if ($validator->fails()) {
				
				return response()->json(['success' => false, 'message' => $validator->errors()->first(), 422]);
			}
			
			$update =  Matkul::findOrFail($matkul);
			$update->kd_mk = $request->get('kd_mk');
			$update->kd_prodi = $request->get('kd_prodi');
			$update->semester = $request->get('semester');
			$update->nama_matkul = $request->get('nama_matkul');
			$update->save();
			
			return response()->json(['success' => true, 'message' => 'Data mahasiswa berhasil diupdate']);
			
		}
		
		public function destroy($matkul, Request $request)
		{
			Matkul::where('id', $matkul)->delete();
			
			return response()->json(['success' => true, 'message' => 'Data mahasiswa berhasil dihapus']);
		}
		
		
	}
