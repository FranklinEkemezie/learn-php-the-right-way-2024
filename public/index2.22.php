<?php

use App\Invoice;
use App\InvoiceCollection;

require_once __DIR__ . '/../vendor/autoload.php';

// 2.22 - Iterators and Iterable type
$invoiceCollection = new InvoiceCollection([
    new Invoice(34.56),
    new Invoice(12),
    new Invoice(99.99)
]);

/** @var Invoice $invoice */
foreach($invoiceCollection as $invoice) {
    echo $invoice->id . ' - ' . $invoice->amount . '<br/><br/>';
}