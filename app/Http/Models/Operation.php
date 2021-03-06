<?php

namespace App\Http\Models;

class Operation
{
    public $name;
    public $route;
    public $style_type;
    public $style_icon;

    public function __construct($route, $type)
    {
        $this->route = $route;
        $this->name = $type;

        $this->style_type = "info";

        if ($type == "edit")
        {
            $this->setEdit();
        }
        else if ($type == "destroy")
        {
            $this->setDestroy();
        }
        else if ($type == "copy")
        {
            $this->setCopy();
        }
    }
    public function setCopy()
    {
        $this->name = "copy";
        $this->style_type = "default";
        $this->style_icon = 'copy';

    }
    public function setEdit()
    {
        $this->name = "edit";
        $this->style_type = "primary";
        $this->style_icon = 'edit';
    }

    public function setDestroy()
    {
        $this->name = "destroy";
        $this->style_type = "danger";
        $this->style_icon = 'trash';
    }
}
