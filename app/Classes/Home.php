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

        // Set session, and update if already set
        $_SESSION['amount'] = ($_SESSION['amount'] ?? 0) + 1;

        // Set cookie

        // you can give an associative array of 'options',
        // setcookie('userName', 'Franklin', []);

        // OR,
        setcookie('userName', 'Franklin', time() + 10);

        echo 'You visited here ' . $_SESSION['amount'] . '<br/>';
        return 'Home <br/> <a href="/invoices/create">Create invoice</a>';
    }
}