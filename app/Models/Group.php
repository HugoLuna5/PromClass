<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'period_id',
        'name',
    ];

    public function students(){
        return $this->hasMany('App\Models\Student','group_id','id');
    }

    public function period(){
        return $this->hasOne('App\Models\Period','id', 'period_id');
    }


}
