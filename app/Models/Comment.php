<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
    
    protected $guarded = ['id'];

    protected $cascadeDeletes = ['answers'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo($this, 'parent_id');
    }

    public function answers()
    {
        return $this->hasMany($this, 'parent_id');
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 2);
    }
}
