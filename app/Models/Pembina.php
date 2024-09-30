<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembina extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'pembina';

    public function periode() {
        return $this->belongsTo(Periode::class, 'periode_id');
    }
}
