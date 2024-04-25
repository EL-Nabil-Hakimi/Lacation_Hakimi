<?php

namespace App\Console\Commands;

use App\Models\PermissionsName;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;

class ChargeRoute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ChargeRoute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        
        $routeCollection = Route::getRoutes();

        $allRouteNames = [];

        foreach ($routeCollection as $route) {
            $routeName = $route->getName();
            if ($routeName && !in_array($routeName, ['sanctum.csrf-cookie', 'ignition.healthCheck', 'ignition.executeSolution', 'ignition.updateConfig']) && strpos($routeName, 'manager.') === 0) {
                $allRouteNames[] = $routeName;
            }
        }

        PermissionsName::truncate();

            foreach($allRouteNames as $routeName) {

                     PermissionsName::create([
                        'name' => $routeName                          
                ]);
            };
        }
    }
