<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'matter_id',
        'period_id',
        'unit_id',
        'name',
        'date_created',
        'points'
    ];

    public function unit(){
        return $this->hasOne('App\Models\Unit', 'id','unit_id');
    }

    public function activities(){
        return $this->hasMany('App\Models\ActivitiesStudent', 'activity_id', 'id');
    }



}
