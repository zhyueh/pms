<?php

namespace App\Http\Controllers\Project;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\SingleFormController;
use App\Http\Models\Project\Story;
use App\Http\Models\Project\TestCase;

class TestCaseController extends SingleFormController
{
    public function __construct()
    {
        $this->model = 'App\Http\Models\Project\TestCase';
        $this->fields_show = ['id', 'test_case_name' ,'story_name', 'updated_at'];
        $this->fields_edit = [
            'test_case_name',
            'test_case_type',
            'story_name',
            'precondition',
            'test_step',
            'test_sequence',
            'remark',
        ];

        $this->formCreate = 'project.edit_testcase';
        $this->add_enum("test_sequence");
        parent::__construct();
    }

    public function getIndex()
    {
        $this->add_raw_enum_dict("story_name", "story_id", Story::all());
        return parent::getIndex();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        $story_id = $this->inputId("story_id");
        if($story_id)
        {
            $storys = [Story::find($story_id)];
            $this->share('story', $storys[0]);

        }
        else
        {
            $storys = Story::all();
        }

        $this->add_raw_enum_dict("story_name", "story_id", $storys);
        $this->add_enum("test_case_type");

        return parent::getCreate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postStore()
    {
        //
        return parent::postStore();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getShow()
    {
        //
        return parent::getShow();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit()
    {
        $id = $this->inputId("id");
        $test_case = TestCase::find($id);

        $this->add_raw_enum_dict("story_name", "story_id", [$test_case->story]);
        $this->add_enum("test_case_type");
        $story = $test_case->story;
        $project = $story->project;

        $this->share('story', $story);
        $this->share('story_comments', $story->comments);

        $this->add_raw_enum_dict('team_name', 'team_id', $project->teams, "id", "team_name");

        return parent::getEdit();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function postUpdate()
    {
        //
        return parent::postUpdate();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function postDestroy()
    {
        //
        return parent::postDestroy();
    }
}
