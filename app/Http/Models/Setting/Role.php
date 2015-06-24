<?php

namespace App\Http\Models\Setting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    //
    use SoftDeletes;

    protected $table = 'role';

    protected $fillable = ['name'];
}
