<?php

use Illuminate\Filesystem\Filesystem;

$fileSystem = new Filesystem(); 

$routePath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'web-routes' . DIRECTORY_SEPARATOR;
if($fileSystem->exists($routePath))
{
        $routes = $fileSystem->allFiles($routePath);

        foreach($routes as $key => $route)
        {
                $name = $route->getFileName();

                if($fileSystem->exists($routePath . $name))
                {
                        require_once $routePath . $name;
                }
        }
}