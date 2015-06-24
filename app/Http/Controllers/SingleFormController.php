<?php

namespace App\Http\Controllers;

use View;
use Input;
use Route;
use Redirect;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\Operation;

class SingleFormController extends Controller
{
    // 对应的模型
    protected $model;

    // 列表页显示的字段
    protected $fields_show = [];

    // for drop down list 
    protected $fields_enum = [];

    // 编辑页面显示的字段
    protected $fields_edit = [];

    // 创建页面显示的字段
    protected $fields_create = [];

    protected $operations = [];

    public function __construct()
    {
        $route = Route::currentRouteAction();
        list($this->controller, $action) = explode('@', $route);
        $this->controller = str_replace('App\\Http\\Controllers\\', '', $this->controller);
        View::share('controller', $this->controller);

        View::share('action', $action);

        View::share('fields_enum', $this->fields_enum);

        View::share('fields_show', $this->fields_show);

        View::share('fields_edit', $this->fields_edit);

        View::share('fields_create', $this->fields_create);

        if (count($this->operations) == 0)
        {
            $this->operations = [ new Operation("edit"),
                new Operation("destroy"),
                ];
        }
        View::share('operations', $this->operations);

        View::share('input', Input::all());

        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        //
        if(!isset($this->model)){
            return View::make('form.index', [
                'models'=>[],
            ]);
        }
        $model = new $this->model;
        $sort_type = Input::get("sort_type", "");
        $sort_type = $sort_type == "asc" ? "asc" : "desc";

        $sort = Input::get("sort", "id");

        $builder = $model->orderBy($sort, $sort_type);

        $input = Input::all();

        $models = $builder->paginate(15);

        return View::make('form.index', [
            'models' => $models,
            'sort' => $sort,
            'sort_type' => $sort_type,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        //
        return View::make('form.create', ['model'=> new $this->model]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postStore()
    {
        $model = new $this->model;
        if($id = Input::get("id")){
            $model = $model->find($id);
        }
        $model->fill(Input::all());
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
        return $this->getEdit();
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
        return View::make('form.create', ['model'=> $model]);
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
        $model = new $this->model;
        $model->destroy($id);

        return Redirect::to(action($this->controller . '@getIndex'));
    }
}
