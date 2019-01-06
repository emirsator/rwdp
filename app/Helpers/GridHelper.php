<?php

namespace App\Helpers;

use App\Models\Condition;
use Lang;

use Nayjest\Grids\Grid;
use Nayjest\Grids\GridConfig;
use Nayjest\Grids\EloquentDataProvider;
use Nayjest\Grids\EloquentDataRow;
use Nayjest\Grids\IdFieldConfig;
use Nayjest\Grids\FieldConfig;
use Nayjest\Grids\FilterConfig;
use Nayjest\Grids\SelectFilterConfig;
use Nayjest\Grids\Components\HtmlTag;
use Nayjest\Grids\Components\ColumnHeadersRow;
use Nayjest\Grids\Components\FiltersRow;
use Nayjest\Grids\Components\OneCellRow;
use Nayjest\Grids\Components\THead;
use Nayjest\Grids\Components\TFoot;
use Nayjest\Grids\Components\Base\RenderableRegistry;

class GridHelper
{
    static function generateGrid($query, $columns, $pageSize=15, $showFilterButton = true)
    {

        $gridConfig = (new GridConfig)
        ->setName('Grid')
        ->setDataProvider(new EloquentDataProvider($query))
        ->setPageSize($pageSize);

        $addFilter = false;

        if (is_array($columns))
        {
            $gridColumns = array();
            foreach($columns as $column)
            {
                if (get_class($column) == "App\Helpers\GridColumn")
                {
                    $fieldConfig = new FieldConfig;

                    $fieldConfig->setName($column->Name)->setLabel($column->Label);

                    if($column->IsSortable)
                    {
                        $fieldConfig->setSortable(true);
                    }

                    if($column->FilterColumnName != "")
                    {
                        $fieldConfig->addFilter(
                            (new FilterConfig)
                            ->setOperator(FilterConfig::OPERATOR_LIKE)
                            ->setName($column->FilterColumnName)
                        );

                        $addFilter = true;
                    }

                    if ($column->Format != "" || $column->Url != ""|| $column->Resource != "")
                    {
                        $fieldConfig->setCallback(function ($val, EloquentDataRow $row) use ($column) {
                            $output = $val;
                            if ($val) 
                            {
                                $output = self::getFormatedValue($column->Format, $val);

                                if ($column->Url != "" && $column->IdColumnName != "")
                                {
                                    $url = $column->Url . "/" . $row->getCellValue($column->IdColumnName);
                                    $output = "<a href=\"{$url}\">{$val}</a>";
                                }

                                if($column->Resource != "")
                                {
                                    $resourceValue = Lang::get($column->Resource . "-" . $val);
                                    if ($resourceValue != "")
                                    {
                                        $output = $resourceValue;
                                    }
                                }
                            }
                            return $output;
                        });
                    }

                    array_push($gridColumns, $fieldConfig);
                }
                
            }

            $gridConfig->setColumns($gridColumns);
        }

        $tHead = (new THead);
        $tHeadComponents = [new ColumnHeadersRow];
        if ($addFilter)
        {
            array_push($tHeadComponents, new FiltersRow);
        }

        if ($showFilterButton)
        {
            $oneCellRow = (new OneCellRow)->setRenderSection(RenderableRegistry::SECTION_END);

            $filterButton = (new HtmlTag)
            ->setContent(Lang::get('label.refresh'))
            ->setTagName('button')
            ->setRenderSection(RenderableRegistry::SECTION_END)
            ->setAttributes([
                'class' => 'btn btn-success btn-sm'
            ]);

            $oneCellRow->setComponents([$filterButton]);
            array_push($tHeadComponents, $oneCellRow);
        }

        $tHead->setComponents($tHeadComponents)
        ->setAttributes([
            'class' => 'header-background color-white'
        ]);

        $gridConfig->setComponents([
            $tHead,
            (new TFoot)
        ]);

        return new Grid(
            $gridConfig
        );
    }

    private static function getFormatedValue($format, $value)
    {
        switch($format)
        {
            case "decimal":
                return FormatHelper::formatDecimal($value);
            case "date":
                return FormatHelper::formatToDate($value);
            default:
                return $value;
        }
    }
}