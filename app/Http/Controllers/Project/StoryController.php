<?php

namespace App\Http\Controllers\Project;

use Input;
use Auth;
use App\User;
use Redirect;
use View;

use Illuminate\Http\Request;

use App\Http\Models\Project\Project;
use App\Http\Models\Project\Module;
use App\Http\Models\Project\Version;
use App\Http\Models\Project\Story;
use App\Http\Models\Project\Team;
use App\Http\Models\Project\StoryComment;
use App\Http\Models\Operation;
use App\Http\Models\Priority;
use App\Http\Models\Setting\Enum;

use App\Http\Requests;
use App\Http\Controllers\SingleFormController;



class StoryController extends ProjectBaseController
{
    protected $project_id;

    public function __construct()
    {
        $this->model = 'App\Http\Models\Project\Story';
        $this->fields_show = ['id' ,'story_name', 'project_name', 'version_name', 'status_name', 'priority_name'];
        $this->fields_edit = ['story_name', 'project_name', 'module_name', 'version_name', 'status_name', 'priority_name', 'description', 'requirement', 'remark'];

        $story_id = intval(Input::get("id"));
        if ($story_id > 0)
        {
            $this->project_id = Story::find($story_id)->project_id;
        }
        else
        {
            $this->project_id = intval(Input::get("project_id", "0"));
        }

        $user_dict = User::dict();
        $this->add_enum_dict('created', 'created_by', $user_dict);
        $this->add_enum_dict('updated', 'updated_by', $user_dict);
        $this->add_enum_dict('project_name', 'project_id', Project::dict());
        $this->add_enum_dict('version_name', 'version_id', Version::dict($this->project_id));
        $this->add_enum_dict('module_name', 'module_id', Module::dict($this->project_id));
        $this->add_enum_dict('status_name', 'status', Enum::dict('story.status'));
        $this->add_enum_dict('team_name', 'team_id', (new Team)->dict($this->project_id));
        $this->add_enum('work_hour', 'work_hour', "work_hour");
        $this->add_enum('priority_name', 'priority', "story.priority");

        $op_edit = new Operation(gen_action("getEdit"), 'edit');
        $op_edit->style_type = 'default';

        $op_member_list =  new Operation(gen_action('getViewStory'), '');
        $op_member_list->name = 'view_story';
        $op_member_list->style_icon = 'zoom-in';
        $this->operations = [$op_edit, 
            $op_member_list,
            new Operation(gen_action('getDestroy'), 'destroy'),
        ];


        $this->search_field = "story_name";
        parent::__construct();
    }

    public function getIndex()
    {
        $this->filter_list = [
            'my'=>["created_by"=>["type"=>'eq', 'value'=>Auth::user()->id]],
        ];

        if ($this->version)
        {
            $this->index_filters["version_id"] = [
                "type"=>"eq", 
                "value"=>$this->version->id
            ];
        }

        return parent::getIndex();
    }

    public function getViewStory()
    {
        $id = intval(Input::get("id"));
        $comment_id = intval(Input::get("comment_id"));
        if ($comment_id < 1)
        {
            $comment = new StoryComment;
        }
        else
        {
            $comment = StoryComment::find($comment_id);
        }

        $model = Story::with('comments')->find($id);
        $project = Project::find($model->project_id);

        return $this->viewMake('project.view_story', 
            [
                'model'=>$model,
                'project'=>$project,
                'comments'=>$model->comments,
                'new_comment'=> $comment,
            ]);
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        return $this->viewMake('project.edit_story', ['model'=> new $this->model]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    /*
    public function postStore()
    {
        return json_encode(Input::all());

        $model = new $this->model;
        if($id = Input::get("id")){
            $model = $model->find($id);
        }
        $model->fill(Input::all());
        $model->status = 1;
        $model->save();
        return Redirect::to(action($this->controller . '@getIndex'));
    }*/


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
        //
        $id = Input::get('id');
        $model = new $this->model;
        $model = $model->find($id);
        $this->viewShare();
        return View::make('project.edit_story', ['model'=> $model]);
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
