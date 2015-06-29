<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DictModel extends Model
{

    protected $dict_name;
    protected $dict_id;
    protected $dict_condition_field;

    public function dict($id = 0){
        if (isset($this->dict_condition_field) && $id != 0)
        {
            $objs = $this->where($this->dict_condition_field, $id)->get();
        }
        else
        {
            $objs = $this->get();
        }

        return $this->genDict($objs);
    }
    public function genDict($objs)
    {
        $dict = [];
        
        $field_id = isset($this->dict_id) ? $this->dict_id:"id";
        $field_name = isset($this->dict_name) ? $this->dict_name : $this->table."_name";
        foreach ($objs as $obj)
        {
            $dict[$obj->$field_id] = $obj->$field_name;
        }

        return $dict;
    }

}
