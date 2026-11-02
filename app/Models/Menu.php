<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
    
    protected $guarded = ['id'];

    protected $cascadeDeletes = ['subMenus'];

    public function parent()
    {
        return $this->belongsTo(Menu::class);
    }

    public function subMenus()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }
}
