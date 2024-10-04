<?php

declare(strict_types=1);

namespace App\Classes;

class Home 
{
    public function index(): string
    {
        echo '<pre>';
        var_dump($_GET);
        var_dump($_POST);
        echo '</pre>';

        return 'Home <br/> <a href="/invoices/create">Create invoice</a>';
    }
}