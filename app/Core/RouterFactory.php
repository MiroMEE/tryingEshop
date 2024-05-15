<?php

declare(strict_types=1);

namespace App\Core;

use Nette;
use Nette\Application\Routers\RouteList;
use Nette\Routing\Route;


final class RouterFactory
{
	use Nette\StaticClass;

	public static function createRouter(): RouteList
	{
		$router = new RouteList();
		$router->addRoute('<presenter>/<action>[/<id>]', 'Home:default');

        $router[] = new Route('products/<presenter>/<action>',[
            'Products' => 'default'
        ]);
        $router[] = new Route('register/<presenter>/<action>',[
            'Register' => 'default',
        ]);
		return $router;
	}
}
