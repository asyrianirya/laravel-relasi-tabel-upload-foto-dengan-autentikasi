<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Validator;
	use Illuminate\Support\Str;
	use App\Models\Mahasiswa;
	use App\Models\Prodi;
	
	class MahasiswaController extends Controller
	{
		public function index(Request $request)
		{
			if($request->ajax()){
				$table = Mahasiswa::orderBy('id', 'DESC')->get();
				return response()->json(['data' => $table]);
			}
			return view('mahasiswa.index');
		}
		
		public function show($mahasiswa)
		{
			$data = Mahasiswa::findOrFail($mahasiswa);
			return response()->json($data);
		}
		
		public function create(Request $request)
		{
			//return view('mahasiswa.form');
			$prodis = Prodi::orderBy('kd_prodi', 'asc')->get()->pluck('nama_prodi','kd_prodi');
			return response(view('mahasiswa.form', compact('prodis')));
		}
		
		public function edit($mahasiswa, Request $request)
		{
			$data = Mahasiswa::findOrFail($mahasiswa);
			$prodis = Prodi::orderBy('kd_prodi', 'asc')->get()->pluck('nama_prodi','kd_prodi');
			return view('mahasiswa.form', compact('data','prodis'));
		}
		
		public function store(Request $request)
		{
			$validator = Validator::make($request->all(), [
            'name' => 'required',
            'nim' => 'required',
			],
		[
		'required'  => ':attribute harus diisi',
        ]);
		
        if ($validator->fails()) {
		
		return response()->json(['success' => false, 'message' => $validator->errors()->first(), 422]);
        }
		
        $update =  new Mahasiswa;
        $update->name = $request->get('name');
        $update->nim = $request->get('nim');
		$update->kd_prodi = $request->get('kd_prodi');
		$update->semester = $request->get('semester');
        $update->save();
		
        if($request->file('photo')){
		$file= $request->file('photo');
		if( in_array($file->getMimeType(), ['image/jpeg', 'image/png', 'image/gif']) ) //validate image
		{
		$filename= date('YmdHis')."_". Str::slug($update->name) . "." . $file->getClientOriginalExtension();
		$file->move(public_path('avatars'), $filename);
		
		Mahasiswa::where('id', $update->id)->update([ 'avatar' => "avatars/". $filename ]);
		}
		
        }
		
        return response()->json(['success' => true, 'message' => 'Data Mahasiswa berhasil ditambahkan']);
		}
		
		public function update($mahasiswa, Request $request)
		{
        
        $validator = Validator::make($request->all(), [
		'name' => 'required',
		'nim' => 'required',
        ],
        [
		'required'  => ':attribute harus diisi',
        ]);
		
        if ($validator->fails()) {
		
		return response()->json(['success' => false, 'message' => $validator->errors()->first(), 422]);
        }
		
        $update =  Mahasiswa::findOrFail($mahasiswa);
        $update->name = $request->get('name');
        $update->nim = $request->get('nim');
		$update->kd_prodi = $request->get('kd_prodi');
		$update->semester = $request->get('semester');
        $update->save();
		
        if($request->file('photo')){
		$file= $request->file('photo');
		if( in_array($file->getMimeType(), ['image/jpeg', 'image/png', 'image/gif']) ) //validate image
		{
		$filename= date('YmdHis')."_". Str::slug($update->name) . "." . $file->getClientOriginalExtension();
		$file->move(public_path('avatars'), $filename);
		
		Mahasiswa::where('id', $mahasiswa)->update([ 'avatar' => "avatars/". $filename ]);
		}
		
        }
		
        return response()->json(['success' => true, 'message' => 'Data mahasiswa berhasil diupdate']);
        
		}
		
		public function destroy($mahasiswa, Request $request)
		{
        Mahasiswa::where('id', $mahasiswa)->delete();
		
        return response()->json(['success' => true, 'message' => 'Data mahasiswa berhasil dihapus']);
		}
		
		
		}
				