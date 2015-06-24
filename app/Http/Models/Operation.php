<?php

namespace App\Http\Models;

class Operation
{

    public function __construct($type)
    {
        $this->btnType = "info";
        if ($type == "edit")
        {
            $this->setEdit();
        }
        else if ($type == "destroy")
        {
            $this->setDestroy();
        }
    }
    public function setEdit()
    {
        $this->name = "Edit";
        $this->type = "edit";
        $this->action = "Edit";
    }

    public function setDestroy()
    {
        $this->name = "Destroy";
        $this->type = "trash";
        $this->action = "Destroy";
    }
}
