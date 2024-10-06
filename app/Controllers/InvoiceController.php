<?php

declare(strict_types=1);

namespace App\Controllers;

use App\LayoutView;
use App\View;

class InvoiceController
{
    public function index(): View
    {
        return View::make('invoices/index')->useLayout(layoutView::INDEX, ['title' => 'Invoice | Your Invoices']);
    }

    public function create(): View
    {
        return View::make('invoices/create')
            ->useLayout(LayoutView::INDEX, ['title' => 'Invoice | Create Invoice']);
    }

    public function store(): View
    {
        $amount = $_POST['amount'] ?? null;

        if (is_null($amount) || empty($amount)) {
            throw new \Exception('Amount not found!');
        }

        $invoiceId = uniqid('Invoice_');
        $date = date('y-m-d h:i:s a');
        
        return View::make('invoices/store', compact('amount', 'date', 'invoiceId'))
            ->useLayout(LayoutView::INDEX, ['title' => 'Invoices | Created Invoice Success']);

    }
}