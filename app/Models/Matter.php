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
        'user_id',
        'name',
        'period_id',
        'group_id',
        'max_units'
    ];

    public function period(){
        return $this->hasOne('App\Models\Period', 'id', 'period_id');
    }

    public function students(){
        return $this->hasMany('App\Models\Student','group_id','id');
    }

    public function activities(){
        return $this->hasMany('App\Models\Activity','matter_id','id');
    }

    public function units(){
        return $this->hasMany('App\Models\Unit', 'matter_id','id');
    }

}
