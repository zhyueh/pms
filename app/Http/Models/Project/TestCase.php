<?php

namespace App\Http\Models\Project;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Models\DictModel;

class TestCase extends DictModel
{
    use SoftDeletes;
    //
    //
    protected $dict_name="test_case_name";
    protected $dict_id = "id";
    
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

    public function bugs()
    {
        return $this->hasMany('App\Http\Models\Project\Bug');
    }
}
