<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Prodi;

class ProdiController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $table = Prodi::orderBy('created_at', 'DESC')->get();
            return response()->json(['data' => $table]);
        }
        return view('prodi.index');
    }

    public function show($prodi)
    {
        $data = Prodi::findOrFail($prodi);
        return response()->json($data);
    }

    public function create(Request $request)
    {
        return view('prodi.form');
    }

    public function edit($prodi, Request $request)
    {
        $data = Prodi::findOrFail($prodi);
        return view('prodi.form', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kd_prodi' => 'required',
            'nama_prodi' => 'required',
        ],
        [
            'required'  => ':attribute harus diisi',
        ]);
 
        if ($validator->fails()) {

            return response()->json(['success' => false, 'message' => $validator->errors()->first(), 422]);
        }

        $update =  new Prodi;
		$update->kd_prodi = $request->get('kd_prodi');
        $update->nama_prodi = $request->get('nama_prodi');
        $update->save();

        return response()->json(['success' => true, 'message' => 'Data Prodi berhasil ditambahkan']);
    }

    public function update($prodi, Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'kd_prodi' => 'required',
            'nama_prodi' => 'required',
        ],
        [
            'required'  => ':attribute harus diisi',
        ]);
 
        if ($validator->fails()) {

            return response()->json(['success' => false, 'message' => $validator->errors()->first(), 422]);
        }

        $update =  Prodi::findOrFail($prodi);
        $update->kd_prodi = $request->get('kd_prodi');
        $update->nama_prodi = $request->get('nama_prodi');
        $update->save();

        return response()->json(['success' => true, 'message' => 'Data Mahasiswa berhasil diupdate']);
        
    }

    public function destroy($prodi, Request $request)
    {
        Prodi::where('id', $prodi)->delete();

        return response()->json(['success' => true, 'message' => 'Data Prodi berhasil dihapus']);
    }


}
