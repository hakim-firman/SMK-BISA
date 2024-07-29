<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Http\Requests\StoreKelasRequest;
use App\Http\Requests\UpdateKelasRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){

            $data=Kelas::query()->orderBy('created_at','desc');
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi',function($data){
                return view('kelas.Button')->with('data',$data);

            })
            ->make(true);
        }

        return view('Kelas.Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kelas' => 'required|unique:kelas,name',

        ],[
            'kelas.required'=>'Kelas Harus Diisi!!!',
            'kelas.unique'=>'Kelas tidak boleh sama!!!'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }else{
            $data = [
                'name'=>$request->kelas
            ];
            Kelas::create($data);
            return response()->json([
                'success' => 'Berhasil Menyimpan data'
            ]);
        }
        // return 'Berhasil';
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kelas,$id)
    {
        $data=$kelas->find($id);

        return response()->json(['result'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kelas,$id)
    {
        $validator = Validator::make($request->all(), [
            'kelas' => 'required|unique:kelas,name',

        ],[
            'kelas.required'=>'Kelas Harus Diisi!!!',
            'kelas.unique'=>'Kelas tidak boleh sama!!!'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }else{
            $data = [
                'name'=>$request->kelas
            ];
            // Kelas::create($data);
            $kelas = $kelas->find($id);
            $kelas->name=$request->kelas;
            $kelas->save();
            return response()->json([
                'success' => 'Berhasil Mengupdate  data '.$kelas->name
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas,$id)
    {
        $data=$kelas->find($id);
        $data->delete();
        return response()->json([
            'success' => 'Berhasil Menghapus  data '.$data->name
        ]);
    }
}
