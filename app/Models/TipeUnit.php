<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TipeUnit extends Model
{
    /**
     * id
     * nama
     */
    public $timestamps = false;
    
    static function getDomainTemplateOptions()
    {
        return TipeUnit::select([DB::Raw('MIN(id) as min_id'), 'domain_template'])
            ->groupBy('domain_template')
            ->orderBy('min_id')
            ->pluck('domain_template');
    }

    static function getDropdownOptions()
    {
        return TipeUnit::orderBy('nama')->pluck('nama');
    }

    function units()
    {
        return $this->hasMany('App\Models\Unit', 'tipe_unit_id', 'id');
    }
}
