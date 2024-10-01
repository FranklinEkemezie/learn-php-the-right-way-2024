<?php

declare(strict_types=1);

use App\Customer;
use App\Exception\MissingBillingInfoException;
use App\Invoice;

require_once __DIR__ . '/../vendor/autoload.php';

$invoice = new Invoice(new Customer());

try {
    $invoice->process(-25);
} catch (MissingBillingInfoException $e) {
    // Handle the error here
    echo $e->getMessage(), ' ', $e->getFile(), ':' . $e->getLine(), '<br/>';
} catch (\InvalidArgumentException $e) {
    echo 'Invalid argument exception. <br/>';
} catch (MissingBillingInfoException|\InvalidArgumentException $e) {
    // Handle more than one form of exception in the same way.
} catch (\Exception) {
    // Catch any form of exception thrown.
} finally {
    echo 'Finally block is reached! <br/>';
}

function foo() {
    echo 'Foo is called </br>';
    return false;
}
function processInvoice(Invoice $invoice, float $amount): int|bool {
    try {
        $invoice->process($amount);
    } catch (\InvalidArgumentException|MissingBillingInfoException $e) {
        echo $e->getMessage(), '<br/>';
        // The 'return' statement here is reached but the value is not returned
        // from here since the 'finally' function has a return statement too
        return foo(); 
    } finally {
        echo 'Finally block was reached <br/>';

        // This is returned.
        return -1;
    }
}

var_dump(processInvoice($invoice, 25)); echo '<br/>';


// We can also set up a global exception handler.
// When exception are thrown, it bubbles up the call stack until a place where it is
// caught, and if it is not caught it checks if there is a global exception handler and 
// uses it to handle the error, if no global exception handler is set, it results in a fatal error.
set_exception_handler(function(\Throwable $e) {
    echo $e->getMessage(), '<br/>';
});

// Some invalid operation
$invoice->process(30);