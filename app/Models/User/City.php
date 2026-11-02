<?php

namespace App\Models\User;

use App\Models\Province;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;
    
    protected $guarded = ['id'];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
