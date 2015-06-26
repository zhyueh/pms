<?php

namespace App\Http\Models\Project;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestCase extends Model
{
    use SoftDeletes;
    //
    
    protected $table = 'test_case';
    protected $fillable = [
        'test_case_name',
        'test_case_type',
        'story_id',
        'precondition',
        'test_step',
        'test_sequence',
        'remark',
    ];

    public function story()
    {
        return $this->belongsTo('App\Http\Models\Project\Story');
    }

}
