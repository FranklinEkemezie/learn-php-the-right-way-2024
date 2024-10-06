<?php

declare(strict_types=1);

namespace App\Classes;

class Home 
{
    public function index_(): string
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

        echo '<pre>';
        print_r($_COOKIE);
        echo '</pre>';

        return 'Home <br/> <a href="/invoices/create">Create invoice</a>';
    }

    public function index(): string
    {
        return <<<FORM
            <form action="/upload" method="post" enctype="multipart/form-data">
                <input type="file" name="receipt" /> <br/>
                <input type="file" name="receipt" multiple /> <br/>
                <button type="submit">Upload</button>
            </form>
        FORM;
    }

    public function upload(): string
    {
        echo '<pre>';

        var_dump($_FILES);
        // var_dump(pathinfo($_FILES['receipt']['tmp_name']));

        echo '</pre>';

        // $filePath = STORAGE_DIR . $_FILES['receipt']['name'];

        // move_uploaded_file($_FILES['receipt']['tmp_name'], $filePath);

        // echo '<pre>';
        // var_dump(pathinfo($filePath));
        // echo '</pre>';

        return "";
    }
}