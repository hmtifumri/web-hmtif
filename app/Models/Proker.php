<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proker extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    public function prokerImages()
    {
        return $this->hasMany(ProkerImages::class);
    }
}
