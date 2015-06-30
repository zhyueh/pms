<?php

namespace App\Http\Controllers\Project;

use Illuminate\Http\Request;

use View;
use Input;
use App\Http\Requests;
use App\Http\Controllers\SingleFormController;
use App\Http\Models\Project\Project;
use App\Http\Models\Project\Version;
use App\Http\Models\Session;
use App\Http\Models\Operation;


class ProjectBaseController extends SingleFormController
{
    protected $version;

    public function __construct()
    {

        $this->updateDefault();
        View::share("nav_default_version", $this->version);
        if($this->version)
        {
            View::share("nav_versions", $this->version->project->versions);
        }
        View::share("nav_projects", Project::dict());
        
        $op_create = new Operation(gen_action("getCreate"), "create");
        $op_create->style_type = "primary";
        $op_create->style_icon = "plus";
        View::share("create_btn",$op_create);


        $this->formIndex = 'project.index';
        parent::__construct();
    }

    protected function updateDefault()
    {
        if ((Input::get("version_id", null)  == null) && (Input::get("project_id", null) != null))
        {
            $project_id = $this->inputId("project_id");
            $this->version = Version::where("project_id", $project_id)
                ->orderBy('id', 'desc')->first();
            if ($this->version)
            {
                Session::set("nav_version_id", $this->version->id);
            }
        }
        else
        {
            $this->updateDefaultVersion();
        }
    }

    protected function updateDefaultVersion()
    {
        $version_id = $this->inputId("version_id");
        if ($version_id)
        {
            $this->version = Version::find($version_id);
            Session::set("nav_version_id", $version_id);
        }
        else if ($version_id = Session::getInt("nav_version_id"))
        {
            $this->version = Version::find($version_id);
        }
        else
        {
            $this->version = Version::orderBy("id", "desc")->first();
            Session::set("nav_version_id", $this->version->id);
        }
        
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
