<?php
return function($container)
{
    $container["GuestEntryController"] = function()
    {
        return new \App\Controllers\GuestEntryController;
    };

    $container["AuthController"] = function()
    {
      return new \App\Controllers\AuthController;
    };

    $container["PagoController"] = function()
    {
      return new \App\Controllers\PagoController;
    };
    
    $container["ClienteController"] = function()
    {
      return new \App\Controllers\ClienteController;
    };

};