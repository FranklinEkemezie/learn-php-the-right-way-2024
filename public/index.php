<?php

declare(strict_types=1);

use App\Customer;
use App\Exception\MissingBillingInfoException;
use App\Invoice;

require_once __DIR__ . '/../vendor/autoload.php';

function prettyVarDump(mixed ...$vars)
{
    echo '<pre>';
    var_dump(...$vars);
    echo '</pre>';

    echo '<br/>';
}

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
// The next line will throw an error which is not caught but is handled by the 
// global exception handler which halts the execution of the script even after handling
// the error
// $invoice->process(30);

// 2.21 - DateTime Object

// Creating a new date time object
$dateTime = new DateTime();
prettyVarDump($dateTime);

// We can also set the timezone
$dateTime->setTimezone(new DateTimeZone('Europe/Amsterdam'));
prettyVarDump($dateTime);

// We can also format the date
prettyVarDump($dateTime->format('m/d/Y g:i A'));

// We can set the date (year, month and time) and time (hour, minute, seconds, microseconds)
// We can also use the setTimestamp() method, all of which occassionaly return the 'DateTime' object
$dateTime->setDate(2021, 4, 15)
    ->setTime(14, 56, 13);

prettyVarDump($dateTime);

// Usually, if the month, year and day are separated by a backward slash (/), it is taken to be
// in the American format which is (mm/dd/yy), otherwise using a separator like - or . uses the
// European format.
// We can the 'createFromFormat()' static method to create a date from a particular format given.
// It returns false if the given date does not match the specified format.
// Notice that if the time is not specified in the date, it uses the current time for the time
$date = '2021/08/13';
$dateTime = DateTime::createFromFormat('Y/m/d', $date);
prettyVarDump($dateTime);

$dateTime->setTime(0, 0);   // set time to midnight
prettyVarDump($dateTime);

// Also notice that most datetime object methods have a corresponding procedural functions. For example:
// date_create_from_format() -> DateTime::createFromFormat()
// date_create -> new DateTime()
// date_timezone_set or date_timezone_get -> $someDateTimeObject->setTimezone() or ->getTimezone(), etc.
// Clearly, it is easier to work with the DateTime object in the OOP manner rather than procedurally.

// We can also compare dates using the <, >, ==, ===, <=> comparison operators
// The results of the comparison should be as expected.
// You could also convert the date to timestamp and do the comparisons as timestamps are just integers
$dateTime1 = DateTime::createFromFormat('d/m/Y g:i A', '01/10/2024 9:15 AM');
$dateTime2 = DateTime::createFromFormat('d/m/Y g:i A', '01/10/2024 9:14 AM');

prettyVarDump(
    $dateTime1, $dateTime2,
    $dateTime1 < $dateTime2,
    $dateTime1 > $dateTime2,
    $dateTime1 == $dateTime2,
    $dateTime1 === $dateTime2,
    $dateTime1 <=> $dateTime2
);

// We can also find the difference between one date and another using the 
// 'diff()' method. It returns a DateTime interval object which has interesting
// properties that gives the information about the difference. The year, month, day,
// hour, minute, seconds, microseconds is stored in the y, m, d, h, i, s, f properties.
// There's the 'invert' property which is 0 if the difference ($d2 - $d1) gotten from
// $d1->diff($d2) is positive or 1 if it is a negative difference.

$dateTime1 = DateTime::createFromFormat('d/m/Y g:i A', '01/10/2024 9:15 AM');
$dateTime2 = DateTime::createFromFormat('d/m/Y g:i A', '05/05/2024 8:25 AM');

prettyVarDump($dateTime1->diff($dateTime2));
prettyVarDump($dateTime2->diff($dateTime1));

// We can also format the difference in a readable format using the 'format()' method of
// the DateInterval object. You can visit the PHP official documentation for the available
// format. Also, format characters are to be prefixed by a % sign
echo 'The difference between dateTime1 and dateTime2 is: ',
    $dateTime1->diff($dateTime2)->format('%Y years, %d months, %d days, %H hours, %i minutes and %s seconds'), '<br/>';
echo 'The number of days b/w the two dates: ',
    $dateTime1->diff($dateTime2)->format('%R%a days'), '<br/>';

// We can create our own DateInterval() object which can be used to add or subtract some date to
// a DateTime object. The 'DateInterval' constructor method accepts the period as a format string which
// should start with 'P'. The available format for the period designators can be gotten from the PHP
// documentation.
$interval = new DateInterval('P1M');

$from   = new DateTime();
$to     = $from->add($interval);  // add a period of 1 month

echo 'From: ', $from->format('d/m/Y'), ' To: ', $to->format('d/m/Y'), '<br/>';

// Notice that the 'from' DateTime object is also modifed when adding date
// To prevent this, you can 'clone' the 'from' object before modifying it, thus:
$from   = new DateTime();
$to     = (clone $from)->add($interval);  // add a period of 1 month

echo 'From: ', $from->format('d/m/Y'), ' To: ', $to->format('d/m/Y'), '<br/>';

// We can also subtract some date interval
$to     = $to->sub($interval);        // substract a period of 1 month

echo 'Now at: ', $to->format('d/m/Y'), '<br/>';

// If the 'invert' property of the DateInterval object is set to 1, the 'add()' and
// 'sub()' methods switch functionality
$interval->invert = 1;

echo 'From: ', $from->format('d/m/Y'), ' Add (inverted interval) ',
    'To: ', (clone $from)->add($interval)->format('d/m/Y'), '<br/>';

$interval->invert = 0;              // reset the 'invert' property

// Another way to prevent modifying the actual DateTime object is by using the
// 'DateTimeImmutable' class. It has similar functionality as the DateTime object but
// it stores in an immutable manner and returns a new DateTimeImmutable object after 
// any modification is done.
// So, every time you modify a DateTimeImmutable object using the usual setDate(), add(),
// setTimezone(), etc. methods, be sure to assign it to a variable
$from   = new DateTimeImmutable();
$to     = $from->add($interval);

echo 'From: ', $from->format('d/m/Y'), ' To: ', $to->format('d/m/Y'), '<br/>';

// One more date-time related functionality is provided by the DatePeriod, which allows us 
// to go over (iterate) the date or time between two dates step by step.
// There are varying form for the arguments the constructor takes.
$date1 = new DateTime('05/01/2024');
$date2 = new DateTime('05/31/2024');
$period = new DatePeriod(
    $date1,                         # the start date
    new DateInterval('P3D'),        # the interval to use to step over the date
    ($date2)                        # the end date (excluded)
        ->modify('+1 day')              # modifying the end date to include the end date
);

// We can iterate over the DatePeriod object
echo 'Count from ', $date1->format('d/m/Y'), ' to ', $date2->format('d/m/Y');
foreach($period as $date) {
    // Get each date between 'start date' and 'end date'
    // with a 3-day interval
    echo $date->format('m/d/Y'), '<br/>';
}
echo '<br/>';

// The DatePeriod can also be created using the following arguments for the constructor:
// 'start date', 'end date', 'recursion' - how many step to take to get to the final date,
// optionally 'options' to specify some other options you want to use.
$period = new DatePeriod(
    $date1,                             # the start date
    new DateInterval('P2D'),            # the number of intervals to use
    5,                                  # no. of steps to take
    DatePeriod::EXCLUDE_START_DATE      # options to exclude the start date
);

echo 'Count 5 2-day intervals starting from ', $date1->format('d/m/Y'), ' excluding the first day<br/>';
foreach($period as $date) {
    // Get each date from 'start date' to 'end date'
    // with just five steps (or iterations)
    // excluding the 'start date'
    echo $date->format('m/d/Y'), '<br/>';
}

// Carbon is a nice wrapper around the 'DateTime' object that provides easy handling
// of date and time. Laravel uses the Carbon functionality in the framework.
// You can check it out and the documentation on how to get started.
