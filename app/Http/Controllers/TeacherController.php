<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){

            $data=Teacher::with('class');
            if($kelas_id=$request->filter){
                $data->where('kelas_id',$kelas_id);
            }
            return DataTables::of($data->get())
            ->addIndexColumn()
            ->addColumn('aksi',function($data){
                return view('Guru.Button')->with('data',$data);
            })
            ->make(true);
         }
         $classes=Kelas::all();
     return view('Guru.Index',['kelas'=>$classes]);
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
           
            'name' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
            
        ],[
            
            'name.required' => 'Nama harus diisi!',
            'kelas_id.required' => 'Kelas harus dipilih!',
            
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }else{
            
            $data = [
                'name'=>$request->name,
                'kelas_id'=>$request->kelas_id
            ];
       
            Teacher::create($data);
          
            return response()->json([
                'success' => 'Berhasil Menyimpan data'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher,$id)
    {
        $data=$teacher->find($id);

        return response()->json(['result'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher,$id)
    {
        $validator = Validator::make($request->all(), [
           
            'name' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
            
        ],[
            'name.required' => 'Nama harus diisi!',
            'kelas_id.required' => 'Kelas harus dipilih!',
            
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }else{
            // $data = [
            //     'Nis'=>$request->Nis,
            //     'name'=>$request->name,
            //     'kelas_id'=>$request->kelas_id
            // ];
            // Kelas::create($data);
            $guru = $teacher->find($id);
            $guru->name=$request->name;
            $guru->kelas_id=$request->kelas_id;
            $guru->save();
            return response()->json([
                'success' => 'Berhasil Mengupdate  data '.$guru->name
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher,$id)
    {
        $data=$teacher->find($id);
        $data->delete();
        return response()->json([
            'success' => 'Berhasil Menghapus  data '.$data->name
        ]);
    }
}
