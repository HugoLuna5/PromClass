<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivitiesStudent extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'matter_id',
        'student_id',
        'points',
        'activity_id'
    ];


    public function activity(){
        return $this->hasOne('App\Models\Activity','id', 'activity_id');
    }

    public function student(){
        return $this->hasOne('App\Models\Student', 'id', 'student_id')->orderBy('last_names', 'asc');;
    }

}
