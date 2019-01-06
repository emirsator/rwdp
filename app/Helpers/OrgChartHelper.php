<?php

namespace App\Helpers;

use App\Models\Agent;

class OrgChartHelper
{
    static function generateOrgChartStructureFromAgent(Agent $agent)
    {
        return self::processAgent($agent);
    }

    private static function processAgent(Agent $agent)
    {
        $children = array();
        foreach($agent->agents as $key => $child)
        {
            array_push($children, self::processAgent($child));
        }

        $output = array("name" => $agent->full_name, 
        "title" => $agent->agentLevel->name, 
        "children" => $children);

        return $output;
    }
}