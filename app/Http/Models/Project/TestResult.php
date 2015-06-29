<?php

namespace App\Http\Models\Project;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestResult extends Model
{
    use SoftDeletes;
    //
    
    protected $table = 'test_result';
    protected $fillable = [];

    public function test_plan()
    {
        return $this->belongsTo('App\Http\Models\Project\TestPlan');
    }

    public function test_case()
    {
        return $this->belongsTo('App\Http\Models\Project\TestCase');
    }

    public function scopeSucceed($query)
    {
        return $query->where("success", "1");
    }

    public function scopeFailed($query)
    {
        return $query->where("success", "!=", "1");
    }



}
