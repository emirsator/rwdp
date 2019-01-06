<?php

namespace App\Helpers;

use App\Lang;

use App\Models\User;
use App\Models\Role;

use Nayjest\Grids\Grid;
use Nayjest\Grids\GridConfig;
use Nayjest\Grids\EloquentDataProvider;
use Nayjest\Grids\EloquentDataRow;
use Nayjest\Grids\IdFieldConfig;
use Nayjest\Grids\FieldConfig;
use Nayjest\Grids\FilterConfig;
use Nayjest\Grids\Components\THead;
use Nayjest\Grids\Components\TFoot;
use Nayjest\Grids\Components\Pager;
use Nayjest\Grids\Components\OneCellRow;
use Nayjest\Grids\Components\ColumnHeadersRow;

class UserHelper
{
    static function generateGridWithUserRoles($userId)
    {
        $query = Role::whereHas('users', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        });

        return new Grid(
            (new GridConfig)
                # Grids name used as html id, caching key, filtering GET params prefix, etc
                # If not specified, unique value based on file name & line of code will be generated
                ->setName('Users')
                # See all supported data providers in sources
                ->setDataProvider(new EloquentDataProvider($query))

                ->setPageSize(5)
                # Setup table columns
                ->setColumns([
                    (new FieldConfig)
                    ->setName('name')
                    ->setLabel(\Lang::get('label.name'))
                    ,
                    (new FieldConfig)
                    ->setName('created_at')
                    ->setLabel(\Lang::get('label.created-at'))
                    ,
                ])
                ->setComponents([
                    (new THead)
                        ->setComponents([
                            (new ColumnHeadersRow)
                        ])
                        ->setAttributes([
                            'class' => 'header-background color-white'
                        ]),
                    (new TFoot)
                    ])
        );
    }
}