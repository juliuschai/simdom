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

    /**
     * Get data for dropdown options
     * @param bool $keperuntukan true: get keperuntukan options; false: get non-keperuntukan options
     */
    static function getDropdownOptions($keperuntukan)
    {
        return TipeUnit::orderBy('nama')->where('keperuntukan', $keperuntukan)->pluck('nama');
    }

    function units()
    {
        return $this->hasMany('App\Models\Unit', 'tipe_unit_id', 'id');
    }
}
