<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RelasiController extends Controller
{
    public function index(Request $request)
    {
         if($request->ajax()){

        $data = Student::with(['Class.teachers']);
        if($kelas_id=$request->filter){
            $data->where('kelas_id',$kelas_id);
        }


        $result = $data->get()->map(function($siswa) {
            return [
                'id'=>$siswa->id,
                'name' => $siswa->name,
                'NIS' => $siswa->Nis,
                'NamaKelas' => $siswa->class->name,
                'NamaGuru' => $siswa->class->teachers->pluck('name')->implode(', ')
            ];
        });
            return DataTables::of($result)
            ->addIndexColumn()
            ->make(true);
         }
         $classes=Kelas::all();
     return view('Relasi.Index',['kelas'=>$classes]);
    }
}
