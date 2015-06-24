<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use Input;
use Redirect;
use App\Http\Requests;
use App\Http\Controllers\SingleFormController;

class UserController extends SingleFormController
{
    public function __construct()
    {
        $this->model = 'App\User';
        $this->fields_show = ['id' ,'name', 'email', 'updated_at'];
        $this->fields_edit = ['name', 'email', 'password'];
        $this->fields_create = ['name', 'email', 'password'];

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
        $model = new $this->model;
        if($id = Input::get("id")){
            $model = $model->find($id);
        }
        $model->name = Input::get("name");
        $model->email = Input::get("email");
        $model->password = bcrypt(Input::get("password"));
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
