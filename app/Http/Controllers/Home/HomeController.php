<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\SingleFormController;
use App\Http\Models\Project\DevPlan;
use App\Http\Models\Project\Bug;
use App\Http\Models\Project\Version;

class HomeController extends SingleFormController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getIndex()
    {
        $versions = Version::with("test_cases", "project")->orderBy('id', 'desc')->take(5)->get();
        foreach($versions as $version)
        {
            $version->updateBugs();
            $version->updateDevplans();
        }

        $DevPlans = DevPlan::where("owner_id", $this->userId())
            ->whereNull('complete_at')
            ->where('plan_start_at', '<', date('Y-m-d H:i:s'))
            ->orderBy('priority', 'desc')
            ->take(10)->get();

        $Bugs = Bug::where("owner_id", $this->userId())
            ->whereNull('fix_time')
            ->orderBy('priority', 'desc')
            ->take(10)->get();

        return $this->viewMake('dashboard', [
            'versions'=>$versions,
            'bugs' =>$Bugs,
            'plans'=>$DevPlans,
        ]);
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
