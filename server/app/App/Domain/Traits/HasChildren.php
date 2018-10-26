<?php

namespace App\App\Domain\Traits;
use Illuminate\Database\Eloquent\Builder;

trait HasChildren
{
    public function scopeParents(Builder $builder)
    {
        $builder->whereNull('parent_id');
    }
    public function children()
    {
        return $this->hasMany(static::class,'parent_id','id');
    }

}