<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Invoice;


// 2.16 - Comparing Objects in PHP
$invoice1 = new Invoice(56, 'Invoice 1');
$invoice2 = new Invoice(12, 'Invoice 2');

function compareInvoices(Invoice $invoice1, Invoice $invoice2) {
    echo 'invoice1 == invoice2? ', $invoice1 == $invoice2 ? 'Yes' : 'No', '<br/>';
    echo 'invoice1 === invoice2? ', $invoice1 === $invoice2 ? 'Yes' : 'No', '<br/>';
    echo '<br/>';
}

compareInvoices($invoice1, $invoice2);

// == checks recursively and returns true if both objects have the same values for each property
$invoice1->amount = $invoice2->amount = 30;
$invoice1->description = $invoice2->description = 'An invoice';

compareInvoices($invoice1, $invoice2);

// === returns true if both variables point to the same object.
// This is due to how PHP stores object in memory.
// -> When a variable is created, the name is stored in a symbol table,
// -> The variable is basically a symbol that points to a data structure in memory that
//      stores the info about the value of that variable e.g. the value, type etc. This data
//      structure is called Zend value (or zval, for short).
// -> However, for objects the value is not stored in the 'zval' data structure, rather a pointer
//      to the actual object is stored.
// -> Hence, when one variable is assigned to another variable that stores an object, as shown
//      below, they point to the same object.

$invoice3 = $invoice1; // 'invoice3' points to the same object as 'invoice1'

compareInvoices($invoice1, $invoice3);

// Changing either 'invoice1' or 'invoice3' modifies both object.
// However, objects are still not passed by reference in methods and functions, but by value.
$invoice1->amount = 80;
$invoice3->description = 'Invoice 1 and 3';

var_dump($invoice1, $invoice3); echo '<br/>';

// Since, the == operator checks recursively if objects are linked to create some form of cycle or link,
// it fails. For example, if the Invoice class has a property of the Invoice class, the == operator will
// fails since it moves endlessly from one Invoice object to another.

