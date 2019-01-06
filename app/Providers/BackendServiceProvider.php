<?php
namespace App\Providers;
 
use Illuminate\Support\ServiceProvider;
use Illuminate\Filesystem\Filesystem;
 
class BackendServiceProvider extends ServiceProvider {
        public function register()
	{
                // Repositories
                $fileSystem = new Filesystem(); 
                $repositoryInterfacesPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Repositories' . DIRECTORY_SEPARATOR . 'Interfaces' . DIRECTORY_SEPARATOR;
                $repositoryPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Repositories' . DIRECTORY_SEPARATOR;
                $serviceInterfacesPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Services' . DIRECTORY_SEPARATOR. 'Interfaces' . DIRECTORY_SEPARATOR;
                $servicePath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Services' . DIRECTORY_SEPARATOR;

                if($fileSystem->exists($repositoryInterfacesPath))
                {
                        $repositoryInterfaces = $fileSystem->allFiles($repositoryInterfacesPath);

                        foreach($repositoryInterfaces as $key => $ri)
                        {
                                $interfaceName = $ri->getFileName();
                                $repoName = str_replace('Interface', '', $interfaceName);

                                if($fileSystem->exists($repositoryPath . $repoName))
                                {
                                        $this->app->singleton('App\Repositories\Interfaces\\' . str_replace('.php', '', $interfaceName), 'App\Repositories\\' . str_replace('.php', '', $repoName));
                                }
                        }
                }


                // Services
                if($fileSystem->exists($serviceInterfacesPath))
                {
                        $serviceInterfaces = $fileSystem->allFiles($serviceInterfacesPath);

                        foreach($serviceInterfaces as $key => $ri)
                        {
                                $interfaceName = $ri->getFileName();
                                $serviceName = str_replace('Interface', '', $interfaceName);

                                if($fileSystem->exists($servicePath . $serviceName))
                                {
                                        $this->app->singleton('App\Services\Interfaces\\' . str_replace('.php', '', $interfaceName), 'App\Services\\' . str_replace('.php', '', $serviceName));
                                }
                        }
                }
        }
}