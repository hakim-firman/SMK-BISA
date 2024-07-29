<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $guarded =['id'];
    public function class()
    {
        return $this->belongsTo(Kelas::class,'kelas_id');
    }
}
