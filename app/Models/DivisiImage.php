<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivisiImage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'divisi-image';

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }
}
