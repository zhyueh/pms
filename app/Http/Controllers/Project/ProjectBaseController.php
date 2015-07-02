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

    protected $filter_list = [];
    protected $select_filter;

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

    public function getIndex()
    {
        $filterKey = Input::get("filter");
        if (array_key_exists($filterKey, $this->filter_list))
        {
            $this->select_filter = $filterKey;
            foreach($this->filter_list[$filterKey] as $k => $filter)
            {
                $this->index_filters[$k] = $filter;
            }
        }

        return parent::getIndex();
    }

    protected function viewShare()
    {
        View::share("filter_list", $this->filter_list);
        View::share("select_filter", $this->select_filter);
        return parent::viewShare();
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
}
