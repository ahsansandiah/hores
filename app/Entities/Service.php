<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Service extends Model
{
    protected $table = "additional_services";
    use SoftDeletes;

}