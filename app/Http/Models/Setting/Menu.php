<?php

namespace App\Http\Models\Setting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    //
    use SoftDeletes;

    protected $table = "menu";
    protected $fillable = ['name', 'action', 'parent_menu_id', 'display_order'];

    public function parentMenu(){
        return $this->hasOne(Menu, 'id', 'parent_menu_id');
    }

    public function scopeOfParent($query, $id){
        return $query->where("parent_menu_id", $id);
    }
}
