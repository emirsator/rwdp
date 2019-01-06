<?php

namespace App\Helpers;

class GridColumn
{
    public $Name;
    public $Label;
    public $Format;
    public $Url;
    public $IdColumnName;
    public $Resource;
    public $IsSortable;
    public $FilterColumnName;
    public $DefaultValue;

    function __construct($name, $label, $format = "", $url = "", $idColumnName = "")
    {
        $this->Name = $name;
        $this->Label = $label;
        $this->Format = $format;
        $this->Url = $url;
        $this->IdColumnName = $idColumnName;
    }
}