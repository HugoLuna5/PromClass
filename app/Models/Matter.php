<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matter extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'period_id',
        'group_id',
        'max_units'
    ];

    public function period(){
        return $this->hasOne('App\Models\Period', 'id', 'period_id');
    }

}
