<?php

namespace App\Http\Controllers\Project;

use View;
use Input;
use Redirect;

use Illuminate\Http\Request;

use App\User;
use App\Http\Requests;
use App\Http\Models\Project\Project;
use App\Http\Models\Operation;
use App\Http\Models\Project\Team;

class TeamController extends ProjectBaseController
{
    public function __construct()
    {
        $this->model = 'App\Http\Models\Project\Team';
        $this->fields_show = ['id' ,'team_name', 'project_name', 'updated_at'];
        $this->fields_edit = ['team_name', 'project_name'];
        $this->fields_create = ['team_name', 'project_name'];

        $op_edit = new Operation(gen_action('getEdit'), 'edit');

        $op_member_list =  new Operation(gen_action('getTeamMemberList'), '');
        $op_member_list->name = 'member_list';
        $op_member_list->style_icon= 'th-list';
        $this->operations = [
            $op_edit,
            $op_member_list, 
            new Operation(gen_action('getDestroy'), 'destroy')];


        $projects = Project::get();
        $project_dict = []; 
        foreach ($projects as $project){
            $project_dict[$project->id] = $project->project_name;
        }
        $this->fields_enum=['project_name'=>
            [
                'field'=>'project_id',
                'enum'=>$project_dict,
            ]];
        parent::__construct();
    }

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

    public function getTeamMemberList()
    {
        $team_id = intval(Input::get("id"));
        $team = Team::with('member', 'project')->find($team_id);
        $this->viewShare();
        return View::make('project.teammember', [
            'team' => $team,
        ]);
    }

    public function getDestroyTeamMember()
    {
        $team_id = intval(Input::get("team_id"));
        $user_id = intval(Input::get("user_id"));
        $team = Team::find($team_id);
        $team->member()->detach($user_id);
        
        return Redirect::to(action($this->controller.'@getTeamMemberList')."?".http_build_query(["id"=>$team_id]));

    }

    public function getTeamMember()
    {
        $team_id = intval(Input::get("id"));
        $team = Team::with('member', 'project')->find($team_id);

        $team_members = [];
        foreach( $team->member as $member){
            $team_members[] = $member->id;
        }

        $this->viewShare();
        return View::make('project.add_teammember', [
            'team' => $team,
            'users' => User::whereNotIn('id', $team_members)->get(),
        ]);
        
    }

    public function postTeamMember()
    {
        $team_id = intval(Input::get("team_id"));
        $team = Team::find($team_id);

        $input_data = Input::all();
        while(list($k, $v) = each($input_data))
        {
            if (strpos($k, "user_") === 0)
            {
                $new_user_id = intval(str_replace('user_', '', $k));
                $team->member()->save(User::find($new_user_id));
            }
        }

        return Redirect::to(action($this->controller.'@getTeamMemberList')."?".http_build_query(["id"=>$team_id]));

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
