<?php

namespace App\Models\Scopes;

trait Filter
{

    public function scopeFilterStatus($query, $filter)
    {

        if(in_array($filter,self::STATUS)){
            return $query->where('status',$filter);
        }

        return $query;
    }
}
