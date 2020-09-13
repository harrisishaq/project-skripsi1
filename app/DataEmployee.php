<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataEmployee extends Model
{
    protected $table = 'data_employees';
    protected $fillable = ['employeeNumber','lastName','firstName'];
    protected $dates = ['updated_at','created_at'];
}
