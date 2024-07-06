<?php
namespace FeatherWeight\Route;

use Core\Route\RouteRequest;

Interface RouteInterface{
    public function createRoutes(RouteRegister $route);
}