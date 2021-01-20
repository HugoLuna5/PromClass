<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'matter_id',
        'max_points'
    ];


    public function activities(){
        return $this->hasMany('App\Models\Activity', 'unit_id', 'id');
    }

}
