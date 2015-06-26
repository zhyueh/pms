<?php

namespace App\Http\Controllers\Project;

use Illuminate\Http\Request;
use Input;
use Redirect;
use View;

use App\Http\Requests;
use App\Http\Controllers\SingleFormController;
use App\Http\Models\Project\StoryComment;

class StoryCommentController extends SingleFormController
{
    public function __construct()
    {
        $this->model = 'App\Http\Models\Project\StoryComment';

        parent::__construct();
    }

    public function postStore()
    {
        $model = new $this->model;
        if($id = Input::get("id")){
            $model = $model->find($id);
        }
        $model->fill(Input::all());
        $model->save();
        //return Redirect::to(action('Project/StoryController@getViewStory').http_build_query(['id'=>$model->story_id]));
        return Redirect::to(action_url('Project\StoryController@getViewStory',['id'=>$model->story_id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function getDestroy()
    {
        //
        $id = Input::get('id');
        $model = (new $this->model)->find($id);
        $story_id = $model->story_id;
        $model->destroy($id);

        //return Redirect::to(action($this->controller . '@getIndex'));
        return Redirect::to(action_url('Project\StoryController@getViewStory', ['id'=>$story_id]));
    }
}
