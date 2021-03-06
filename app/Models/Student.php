<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'names',
        'last_names',
        'group_id',
        'email'
    ];

    public function group(){
        return $this->hasOne('App\Models\Group', 'id', 'group_id');
    }

}
