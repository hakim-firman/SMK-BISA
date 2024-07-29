<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         if($request->ajax()){


            $data=Student::with('class');
            if($kelas_id=$request->filter){
                $data->where('kelas_id',$kelas_id);
            }
            // dd($data);
            return DataTables::of($data->get())
            ->addIndexColumn()
            ->addColumn('aksi',function($data){
                return view('Siswa.Button')->with('data',$data);

            })
            ->make(true);
         }
         $classes=Kelas::all();
     return view('Siswa.Index',['kelas'=>$classes]);
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
            'Nis' => 'required|unique:students,Nis',
            'name' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
            
        ],[
            'Nis.required' => 'NIS harus diisi!',
            'Nis.unique' => 'NIS sudah terdaftar!',
            'name.required' => 'Nama harus diisi!',
            'kelas_id.required' => 'Kelas harus dipilih!',
            
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }else{
            
            $data = [
                'Nis'=>$request->Nis,
                'name'=>$request->name,
                'kelas_id'=>$request->kelas_id
            ];
       
            Student::create($data);
          
            return response()->json([
                'success' => 'Berhasil Menyimpan data'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student,$id)
    {
        $data=$student->find($id);

        return response()->json(['result'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student,$id)
    {
        $validator = Validator::make($request->all(), [
            'Nis' => 'required',
            'name' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
            
        ],[
            'Nis.required' => 'NIS harus diisi!',
            'Nis.unique' => 'NIS sudah terdaftar!',
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
            $siswa = Student::findOrFail($id);
            $siswa->name=$request->name;
            $siswa->Nis=$request->Nis;
            $siswa->kelas_id=$request->kelas_id;
            $siswa->save();
            return response()->json([
                'success' => 'Berhasil Mengupdate  data '.$siswa->name
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student,$id)
    {
        $data=$student->find($id);
        $data->delete();
        return response()->json([
            'success' => 'Berhasil Menghapus  data '.$data->name
        ]);
    }
}
