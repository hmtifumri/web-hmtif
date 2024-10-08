<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'divisi';

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function images()
    {
        return $this->hasMany(DivisiImage::class);
    }

    public function proker() {
        return $this->hasMany(Proker::class);
    }
}
