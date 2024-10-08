<?php

declare(strict_types=1);

namespace App\Classes;

class Invoice
{
    public function index(): string
    {
        // Unset the session
        unset($_SESSION['amount']);

        // Remove the cookie - set it to a time in the past
        setcookie('userName', '', time() - 10);

        return 'Invoices';
    }

    public function create(): string
    {
        return <<<FORM
            <form action="/invoices/create" method="post">
                <label>Amount</label>
                <input name="amount" type="text" />
            </form>
        FORM;

    }

    public function store(): string
    {
        return "Creating invoice for {$_POST['amount']}";
    }
}