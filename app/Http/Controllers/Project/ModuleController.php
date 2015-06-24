<?php

namespace App\Http\Controllers\Project;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\SingleFormController;
use App\Http\Models\Project\Project;

class ModuleController extends SingleFormController
{
    public function __construct()
    {
        $this->model = 'App\Http\Models\Project\Module';
        $this->fields_show = ['id' ,'module_name', 'project_name', 'updated_at'];
        $this->fields_edit = ['module_name', 'project_name'];
        $this->fields_create = ['module_name', 'project_name'];


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
