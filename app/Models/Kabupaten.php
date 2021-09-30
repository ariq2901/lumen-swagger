<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;

    protected $table = "kabupaten";
    protected $guarded = ['id'];
    protected $perPage = 15;

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }
}
