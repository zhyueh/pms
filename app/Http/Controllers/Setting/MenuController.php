<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;

use App\Http\Models\Setting\Menu;
use App\Http\Requests;
use App\Http\Controllers\SingleFormController;

class MenuController extends SingleFormController
{
    public function __construct()
    {
        $this->model = 'App\Http\Models\Setting\Menu';
        $this->fields_show = ['id' ,'name', 'action', 'parent_menu', 'updated_at'];
        $this->fields_edit = ['name', 'action', 'parent_menu', 'display_order'];
        $this->fields_create = ['name', 'action', 'parent_menu', 'display_order'];


        $menu = new Menu;
        $parent_menus = $menu->where("parent_menu_id", 0)->get();
        $parent_menu_dict = []; 
        $parent_menu_dict[0] = '-';
        foreach ($parent_menus as $parent_menu){
            $parent_menu_dict[$parent_menu->id] = $parent_menu->name;
        }
        $this->fields_enum=['parent_menu'=>
            [
                'field'=>'parent_menu_id',
                'enum'=>$parent_menu_dict,
            ]];

        
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex(){
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
