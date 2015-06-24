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
use App\Http\Models\Priority;

use App\Http\Requests;
use App\Http\Controllers\SingleFormController;



class StoryController extends SingleFormController
{
    protected $project_id;

    public function __construct()
    {
        $this->model = 'App\Http\Models\Project\Story';
        $this->fields_show = ['id' ,'story_name', 'project_name', 'version_name', 'status', 'priority_name', 'created'];
        $this->fields_create = ['story_name', 'project_name', 'module_name', 'version_name', 'status', 'priority_name',  'description', 'requirement', 'remark' ];
        $this->fields_edit = ['story_name', 'project_name', 'module_name', 'version_name', 'status', 'priority_name', 'description', 'requirement', 'remark'];

        $this->project_id = intval(Input::get("project_id", "0"));

        $this->fields_enum=[
            'priority_name' =>[
                'field'=>'priority',
                'enum' =>Priority::dict(),
             ],
            'created' =>[
                'field' => 'created_by',
                'enum' => User::dict(),
            ],
            'project_name' => [
                'field' =>'project_id',
                'enum' => Project::dict(),
            ],
            'version_name' => [
                'field' => 'version_id',
                'enum' => Version::dict($this->project_id),
            ],
            'module_name' => [
                'field' => 'module_id',
                'enum' => Module::dict($this->project_id),
            ],
        ];

        parent::__construct();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        return View::make('project.edit_story', ['model'=> new $this->model]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postStore()
    {
        //return json_encode(Input::all());

        $model = new $this->model;
        if($id = Input::get("id")){
            $model = $model->find($id);
        }
        $model->fill(Input::all());
        $model->created_by = Auth::user()->id;
        $model->status = 1;
        $model->save();
        return Redirect::to(action($this->controller . '@getIndex'));
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
        //
        $id = Input::get('id');
        $model = new $this->model;
        $model = $model->find($id);
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
