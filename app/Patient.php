<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //
    protected $table = 'Patients' ; 
    protected $fillable = [
        'patient_username',
        'patient_password'
    ] ; 
}
