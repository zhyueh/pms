<?php

namespace App\Http\Controllers\Project;

use Illuminate\Http\Request;

use View;
use App\Http\Requests;
use App\Http\Controllers\SingleFormController;
use App\Http\Models\Project\Project;

class VersionController extends ProjectBaseController
{
    public function __construct()
    {
        $this->model = 'App\Http\Models\Project\Version';
        $this->fields_show = ['id' ,'version_name', 'project_name', 'updated_at'];
        $this->fields_edit = ['version_name', 'project_name'];
        $this->fields_create = ['version_name', 'project_name'];

        $projects = Project::get();
        $project_dict = []; 
        foreach ($projects as $project ){
            $project_dict[$project->id] = $project->project_name;
        }
        $this->fields_enum=['project_name'=>
            [
                'field'=>'project_id',
                'enum'=>$project_dict,
            ]];
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {

        if ($this->version)
        {
            $this->index_filters["project_id"] = [
                "type"=>'eq',
                "value"=>$this->version->project_id
            ];
        }

        View::share("hide_nav_version", 1);
        return parent::getIndex();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
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
        //
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
