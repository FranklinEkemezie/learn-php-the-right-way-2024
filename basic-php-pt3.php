<?php
declare(strict_types=1);            // Declaring strict types is highly recommended and good practice
?>

<h2>1.21 - PHP FUNCTIONS</h2>

<?php

/** functions */

/*
 * Functions are used to encapsulate block of codes which has specific functionality within it. PHP
 * has lots of built-in functions, but we can define our own.
 * Syntax:
 * function myFunctionName($param1, $param2, $param3, ..., $param-n)
 * {
 *      // block of codes go here
 * }
 *
 * Functions can be created in various other different ways as we shall soon see but this is the usual
 * and most common or primary way. The name of a function (here, 'myFunctionName') can be anything you
 * wish to give it, from single character (say, 'x') to longer (preferably, more descriptive) names. It
 * must not start with numbers (letters or underscores can start the function name), but can contain
 * numbers in it (special characters like $, ?, >, <, spaces, commas, etc.) are not allowed too.
 * $param2, $param2, $param3, ..., $param-n list the parameters the function should take when it is called;
 * it is optional and can be left as an empty parentheses if parameters are not needed.
 * Functions are invoked or called whenever we want to make use of the encapsulated block of code using
 * the function name, a pair of parentheses. If the function has some parameters, they must be specified
 * too in that order.
 * Lastly, function name must be unique i.e. you cannot declare a function twice
 */

$nl = '<br />';

function hello() {
//    echo "Hello World!";
    return "Hello World!";      // 'return' statement is optional used to return a value. If it is not
                                // specified, NULL is returned by default.
}

var_dump(hello());              // Function calls can be done even before they are declared and it works
                                // fine as long the functions is declared already. For example, functions
                                // defined in conditionals must be used after declaration since the function
                                // is defined when the conditionals block of code is run.

function foo() {
    echo  'foo';
    function bar() {
        echo  'bar';
    }
}
// Another scenario is functions defined inside another function as in the above. The functions inside, i.e.
// 'bar' is accessible globally but that is only when foo() at least once must have been called, which declares
// it.
foo(); echo  $nl;
bar(); echo  $nl;

// We can give the return value for a function (if we want to). This gives a hint of what value to expect from the
// function, but it does not enforce it. To make sure functions return the right type, you have to use the 'declare'
// statement with the 'strict_types' directive.
function foo1(): int {
//    return '1';                // If strict type checking is not enabled, this won't throw an error if PHP was
                                // able to cast the value to the actual return type (e.g. trying to return an array
                                // value. With strict type checking enabled, it throws can error nonetheless.
    return  1;
}

var_dump(foo1());

// If your function does not return any value, you can the 'void' keyword as  the type hint; 'return' statement
// can be omitted and the function returns NULL by default, however you can explicitly return NULL in it. Example:
function foo2(): void {
    return;                     // 'return' can be used without any expression.
//  return null;                // 'void' function must not return anything, not even NULL
}

// We can also hint what is called nullable types, i.e. if a function is expected to return some value of some type
// or NULL. To do so, '?' is used before the type as in ?int, ?string.
// In PHP 8, we can return values of more than one data type using the pipe '|' characters. For example: bool|array
// specifies the return type can be a Boolean or an array.
// Lastly, if your function can return any value, you can use 'mixed' as the type hint

?>

<h2>1.22 - PHP FUNCTION PARAMETERS</h2>

<?php

/*
 * FUNCTIONS PARAMETERS
 *
 * Functions as we have seen can take parameters (i.e. set of values it needs from the 'outside') to execute and
 * when the function is called, the values are given and are called 'arguments' to the function in that same
 * order.
 * The parameters can also be type hinted in the same way as the return type
 * function myFunctionName(int $param1, ?bool $param2, string $param3, ..., mixed $param-n) {
 *      // block of code goes here
 * }
 *
 */
function foo3(int $x, int|float $y) {
    return $x * $y;
}

echo foo3(5, 10.0), $nl;

// When a function is called, all the arguments must be specified, if not, an error is thrown. You can give
// default values to a parameter, which is used if a value is not explicitly specified for it. The default
// value must be a scalar (the usual data type: int, float, string bool), arrays but not function calls.
// Parameters with default value must be specified after those without a default value.

// Rather by value (which is essentially making a copy of the value of the variable, we can accept arguments
// by reference, which actually modifies the variable passed to it when modified within the function's block
// of codes. Consider the example below:
function foo4(int|float &$x, int|float $y): int|float {
    if ($x % 2 === 0) {     // x is even?
        $x /= 2;
    }

    return $x * $y;
}

$a = 6.0;
$b = 7;

echo foo4($a, $b), $nl;
var_dump($a, $b);           // '$a' is modified since the function takes a reference to it and modifies it.
echo  $nl;

// Functions which accept any number of variables are called 'variadic functions'.
// This is useful if we want our functions to work on any number of variables given to it.
// This is specified using the '...' token.

function sum(...$numbers): int|float {
    // Now '$numbers' is iterable (something we can iterate over)
    // We can iterate over it using the 'foreach' loop

    // To be precise, '$numbers' is an array
    // we could just pass it over to an array built-in PHP function
    //    array_sum($numbers);
    // and get the same result

    $sum = 0;
    foreach ($numbers as $number) {
        $sum += $number;
    }

    return  $sum;
}

echo sum(4, 1, 2, 5, 6), $nl;

// Even with the '...' token, we can still specify our own parameters
//      function myFunc(bool $a, string $b, int|float ...$others) { ... }
// and when called as in:
//  >>> myFunc(5 == 8, 'Foo', 0, 1.3, 4, 8);
// 'true' is assigned to '$a', 'Foo' to '$b', while the remaining values are captured in the '$others' array.
// Notice, we also type hinted the '$others' parameter list to specify the values that must be integer or float.
// This is an added advantage of the '...' operator over using an array to achieve similar result.

// We can unpack the values from an iterable, like an array using the '...' operator to pass the values in it to
// a function.
// You can also use it to spread the values of one array to another array.
// $arr2 = ['Dog', 'Cat', ...$arr1];

$myNums = [100, 58, 91, 83, 54];

echo  sum(...$myNums), $nl;

// Named arguments allow us to pass the value of an argument based on the name; the argument lists does not need
// to be in any particular order.
// A good use case of named arguments is for specifying the arguments of a function which take a bunch of default
// values. Take the function below for example:
// >>>  function myFunc($a = true, $b = '', $c = '', $d = 0, $e = false, $f = 'Service 1', $g = []) { ... }
// We can call the function as follows:
// >>>  myFunc(false, 'Hello, World!', f: 'Service 8');
// which allows us to jump over the other parameters with default values.
// Without named arguments, the only valid way to do this is by specifying the default values instead thus:
// >>>  myFunc(false, 'Hello, World!', '', 0, false, 'Service 8', []);
// Named arguments can only be passed once. When an argument is passed by position and by named arguments, it results
// in an error.

function foo5(int $x, int $y): int {
    if ($x % $y === 0) {        // x divisible by y?
        return  $x / $y;
    }

    return  $x;
}

$x = 6;
$y = 3;

echo foo5(y: $y, x: $x), $nl;

// If an associative array is unpacked in the argument list, the keys are treated as the names of the arguments,
// effectively making them named arguments.
// If the array is indexed, they are passed as positional arguments.
// If the array is associative but also has some items without keys, the items without keys are passed by
// and the ones with keys by name
// Note that if the key does not exist as the name of a parameter, it throws an error.

$arr1 = ['y' => 4, 'x' => 68];
$arr2 = [56, 9, 13];
$arr3 = [18, 'y' => 5];         // Since 18 is passed by position, it is assigned to '$x', and we don't want
                                // to have a key 'x' that will pass it by name which would cause an error.

echo foo5(...$arr1), $nl;       // Same as: foo5(y: 4, x: 68);
echo foo5(...$arr2), $nl;       // Same as: foo5(56, 9);
echo foo5(...$arr3), $nl;       // Same as: foo5(18, y: 5);

?>

<h2>1.23 - PHP VARIABLE SCOPES </h2>

<?php

/*
 * VARIABLE SCOPES
 *
 * Variable scope defines the boundary in which a variable can be accessed. Variables can be in the global or
 * local scope.
 * Variables or functions defined in the global scope can be accessed and modified anywhere in the script as
 * well as in the included files.
 * Variables defined in another function have local scope and can only be accessed within that function.
 * Variables defined in the global scope cannot be accessed inside a function as well. To do that, we could:
 * -> define the variable right there inside the function,
 * -> accept the variable we want to access as a parameter,
 * -> use the 'global' keyword to access it. Thus, to access a global variable $x, we write
 *      >>>     global $x   ;       // tells PHP to look for the variable in the global scope
 *                                  // '$x' can now be accessed or even modified by just saying '$x'.
 * -> lastly, global variables are stored in a PHP built in associative array called $GLOBALS. The name of
 * of the global variable is the key for the corresponding value. To access a global variable, specify the
 * name of the variable as a key:
 *      >>> $GLOBALS['x'];         // access a global variable '$x'
 *      >>> $GLOBALS['z'];         // make a variable '$z' global from inside a function
 *      >>> $GLOBALS['x'] = 12;    // modify a global variable '$x'
 *
 * The best way, nonetheless, is accessing the value of a variable by passing it as a parameter to
 * the function. Accessing global variables directly makes codes harder to think of, organise, less
 * readable and hard to maintain.
 */

$X = 5;

//include  "../path/to/file/my_file.php";       // '$x' can be accessed inside the script
function foo6() {
    global $x;

    $GLOBALS['x'] = 10;                 // $GLOBALS is PHP built-in array and is called a
                                        // super-global. There are many other super-globals in PHP

    $x = 10;

    echo $x, '<br />';
}

foo6();

echo  $x, $nl;


// Variables which have local scope are automatically destroyed when the function returns or stops
// executing. Static variables have local scopes and only exists in the function where they have
// defined but have the ability to retain their values after the function is done executing. To
// declare a variable as 'static', use the 'static' keyword before it when declaring it.
// Consider the code example below:

function getValue() {
    static $value = null;           // the variable '$value' is declared static here, meaning that
                                    // after the function is done executing, it still retains it's
                                    // last value and not destroyed. It still exists in the local
                                    // scope.

    if ($value === null) {
        $value = someVeryExpensiveFunction();           // this function takes time and probably
                                    // resources, we check if '$value' is not null before calling
                                    // the function. '$value' being a static variable should still
                                    // the same value as it was if it already has a value.
    }
    // Some more processing with value

    return $value;
}

function someVeryExpensiveFunction() {
    sleep(2);       // simulate an expensive that takes time

    echo 'Processing <br />';

    return 10;
}

echo  getValue(), $nl;
echo  getValue(), $nl;
echo  getValue(), $nl;          // 'getValue' is called thrice, but the 'expensive' function is
                                // called just once.

?>

<h2>1.24 - VARIABLE, ANONYMOUS AND ARROW FUNCTIONS</h2>

<?php

/*
 * VARIABLE, ANONYMOUS AND ARROW FUNCTIONS
 */

/* Variable functions */
// Functions can be called via a variable whose value is the name of the function.
// If no function with the name exists, it throws an error. You can use the 'is_callable' function
// to determine, by passing a string to it, if the string represents the name of a function, method
// etc. (or anything that can be called or invoked).
// Variable function works for user-defined functions only and not PHP built-in functions.

function mySum(int|float ...$nums): int|float {
    return  array_sum($nums);
}

$x = 'mySum';
//$x = 'isset';

if (is_callable($x))
    echo  $x(5, 6.7, 8.9, 0), $nl;
else
    echo  'Not callable', $nl;


/* Anonymous Functions */
// Anonymous functions also known as lambda functions are functions without a name. They are
// treated as expressions, therefore must end with semicolons. Since they do not have a name to
// access them, they are usually stored in a variable and can be invoked using the name of the
// variable followed by parentheses.
// Anonymous functions can be passed as argument to other functions and can be returned by another
// function. The type hint for a function's parameter expecting to receive a function (or method)
// is 'callable'. Anonymous functions are instances of closures and the type hint 'Closure' keyword
// ('Closure' not 'closure') can be used instead, but it will accept anonymous functions only.

$sumFunc = function (int|float ...$nums,): int|float {
    // Does same thing as the function above
    return  is_callable('mySum') ? mySum(...$nums) : array_sum($nums);
};

echo $sumFunc(8, 9, 10, 11.1), $nl;

// Variables declared in an anonymous function like other functions have local scope but an anonymous
// function has a unique way to access values in the global scope in addition to the usual method
// we've discussed. This is done using the 'use' keyword after the parentheses enclosing the list
// of parameters. The 'use' keyword accesses the value of the function in the global scope by
// reference instead and to get the reference of that variable rather than its value, you use the
// ampersand '&' symbol (as if it were a parameter). Consider the modified version of 'sumFunc'.

$result = 0;

$sumFunc1 = function (int|float ...$nums) use (&$result, $sumFunc) : int|float {
    return $result = $sumFunc(...$nums);
};

echo $sumFunc1(1, 2, 3, 4, 5), $nl;
echo  $result, $nl;


/* Callable type and Callback functions */
// Some functions expect another function as an argument and calls it inside the function.
// Functions which are taken as an argument and called inside another function are called callback
// functions, and many PHP's built-in functions accept functions as callbacks e.g. array_map(), etc.
// The first argument of PHP's built-in array function 'array_map' is a callable (a function or
// method, or basically anything that can be called) and invokes the function for each element of
// the array (the array is passed as the second argument).
// Now, how can we pass a callable as callbacks?
// -> An anonymous function can be passed as callback.
// -> Normal function can also be passed as callback by giving the name of the function as a string

$arr1 = [1, 2, 3, 4];

$arr2 = array_map(function ($element) {
    return $element * 2;
}, $arr1);                              // passing anonymous function directly as callback

$square = function ($x) {
    return $x ** 2;
};

$arr3 = array_map($square, $arr1);      // passing anonymous function assigned to a variable

function cube($x) {
    return $x ** 3;
}

$arr4 = array_map('cube', $arr1);       // passing a function as a callback

echo '<pre>';

print_r($arr1);
print_r($arr2);
print_r($arr3);

echo  '</pre>';

// Let's modify the 'sumFunc' once again to take a callback.

$sumFunc2 = function (callable $callback, int|float ...$nums): int|float {
    return  $callback(array_sum($nums));
};

echo  $sumFunc2('cube', ...$arr4), $nl;

/* Arrow Functions */
// Arrow functions were introduced in PHP 7.4, and it's a cleaner syntax of an anonymous functions
// with just a few differences. It is useful as an inline callback function as it can be written in
// one line. We can also access global variables within an arrow function without the need of 'use'
// keyword, but the values are mere copies of the global variables and so modifying the variable
// in the arrow function leaves the global variable unchanged. Arrow functions are also single
// expressions, and it returns that single expression; arrays, for example, can span multiple lines
// in the expression as long it just one expression.

$arr2 = array_map(fn($number) => $number * $number, $arr1);

echo '<pre>', print_r($arr2, true), '</pre>';

?>

<h2>1.25 - DATES & TIME ZONES</h2>

<?php

/*
 * How to Work With Dates, Time and Time Zones
 */

/* Date & Time */
// The PHP time() function returns the Unix timestamp which is the number of seconds from the 1st
// day of January, 1970

echo time(), $nl;       // we can perform other mathematical operations here to deduce some other time
                        // in the future or the past

$currentTime = time();
$fiveDaysInFuture = $currentTime + (5 * 24 * 60 * 60);

echo $fiveDaysInFuture, $nl;

// We can use the date() function to make the date much pretty. It takes the format for formatting the
// the date and the second argument is optional which is a timestamp for the date which default to the
// current timestamp if not specified.
// You can always head over to the official PHP documentation page to look up the format characters you
// want to use


echo date('m/d/Y g:ia'), $nl;               // 'g' is 12-hr format of an hour without leading zeros
                                            // 'i' is minutes without leading zeros, 'a' for 'am' or 'pm' 
echo date('D, jS F, Y', $fiveDaysInFuture), $nl;        // prints 'Tue, 17th September, 2024


// By default, all PHP functions for date and time use the default timezone set in the PHP configuration
// file, but you can overwrite that by using PHP built-in 'date_default_timezone_set()' function.
// It is recommended to always use the UTC timezone for easier date and time handlings

echo date_default_timezone_get(), $nl;      // get the default timezone

date_default_timezone_set('America/New_York');

echo date('m/d/Y g:ia'), $nl;               // prints the current time based on the newly set timezone

// We can also get the Unix timestamp for a date using the 'mktime' function by passing the hour, minute,
// second, month, day, year of that date (in that order). The only required parameter is the 'hour', if
// any of the other parameters are ommitted, it uses the default value which is 'null' and it therefore uses
// the current month, year, seconds, etc. You can pass 'null' to any parameters if you want to use the current/
// default value.
// Hint: To avoid passing 'null' for each parameter you want to use the default value, you can just use named
// argument.
echo mktime(5, year: 2023), $nl;
echo date('m/d/y g:ia', mktime(16, month: 10)), $nl;

// We can also get the Unix timestamp from a human-readable string representation of a date using 
// 'strtotime()' function. 

echo strtotime('2022-09-12 11:12:34'), $nl;

// The common thing to do is to pass the timestamp from 'strtotime' to 'date' to get a better formatted human
// readable date
$someDate = strtotime('2022-09-12 11:12:34');
echo date('d/m/y g:ia', $someDate), $nl;

// 'strtotime' can take pretty any understandable date, and even relative dates like 'tomorrow', 'yesterday',
// 'last day of February' etc.
echo date('D, jS F, Y', strtotime('first day of march 2010')), $nl;
echo date('D, jS F, Y', strtotime('second Monday of September')), $nl;

// We can parse a date to get more info about a given date string using 'date_parse' function
$someDate = date('d/m/Y', strtotime('yesterday'));
echo '<pre>';
print_r(date_parse($someDate));
echo '</pre>';

// We can also parse a date using a specific format using a similar function: 'date_parse_from_format'
// Passing the wrong or incompatible format will give error(s) which is also part of the information
// returned by the function.
echo '<pre>';
print_r(date_parse_from_format('Y/m/d', $someDate));
echo '</pre>';

?>

<h2>1.26 - WORKING WITH ARRAYS</h2>

<?php

/* Working with Arrays */

/*
    PHP provides a lot of functions to work with arrays. In this section, we shall go over a few of
    them. You can always visit the official PHP documentation to learn more about a function, its
    parameters and the return values.


 */


function prettyPrintArray($array) {
    echo '<pre>';
    print_r($array);
    echo '</pre>', '<br/>';
}

$arr1 = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5];


// array_chunk: Split elements into chunks of arrays with specified arrays
prettyPrintArray(array_chunk(
    $arr1,         // the array to work on
    2,               // length of each chunk of array
    true                // whether or not to preserve the associative key, default is false
));

$arr1 = ['a', 'b', 'c'];
$arr2 = [10, 15, 20];

// array_combine: Combines two arrays into one. It takes two arrays 
// and uses the first as keys and the second as values. It throws an error if the arrays of different
// length
prettyPrintArray(array_combine(
    $arr1,         // the first array
    $arr2,         // the second array
));

// array_filter: Filters an array based on a give predicate. It takes an array and a callback and iterates
// over the array and for each item in the array, if the callback returns true, the value is included in the
// resulting array

$arr1 = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
prettyPrintArray(array_filter(
    $arr1,                      // the array
    fn($num) => $num % 2 === 0  // the callback (optional). If not specified, the falsy values are filtered out
                                // flag to determine what values are sent to the callback. By default the values of
                                // the array are sent to the callback. You can use 'ARRAY_FILTER_USE_BOTH' 
                                // or 'ARRAY_FILTER_USE_BOTH' to specify that you want the values of the keys or
                                // both key-value to be passed to the callback. If both key-value are passed to the
                                // the value is passed as the first parameter and the key as the second
));

// 'array_values' and 'array_values' are used to return an indexed array containing the keys or the values of the
// input array respectively. 'array_keys' accept additional (optional) arguments.
$arr1 = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5];

prettyPrintArray(array_keys(
    $arr1,      // array to get the keys
    2,           // returns only the keys with the specified value
    false           // determine if strict comparison is used. Default is false, therefore comparison is loose
));

// 'array_map': perform an operation on every item of an array and returns a new array.
// It can also take more than one array in which case the keys are not preserved.
// The callback function is called in parallel for each item and if the array are not of the same length,
// you might get wrong results; usually the shorter ones are padded with (and the values taken as) zeros
$arr1 = ['a' => 1, 'b' => 2, 'c' => 3];
$arr2 = ['d' => 4, 'e' => 5, 'f' => 6];

prettyPrintArray(array_map(
    fn($num1, $num2) => $num1 * $num2, // the callback function or null. When null, a new array is formed from the old one 
    $arr1,
    $arr2
));

// 'array_merge': merges a given number of arrays into one array. When merging, values from arrays with the
// same associative (or string) keys is overwritten by the latter ones; but items with same numeric indexes 
// are preserved and they get new indexes
$arr1 = [0, 1, 2, 3];
$arr2 = ['a' => 5, 'b', 'c' => 6];
$arr3 = ['b', 'c' => 7];

prettyPrintArray(array_merge($arr1, $arr2, $arr3));

// 'array_reduce': used to reduce an array into a single value.
$invoiceItems = [
    ['price' =>  9.99, 'qty' => 3, 'desc' => 'Item 1'],
    ['price' => 29.99, 'qty' => 1, 'desc' => 'Item 2'],
    ['price' =>  1.49, 'qty' => 1, 'desc' => 'Item 3'],
    ['price' => 14.99, 'qty' => 2, 'desc' => 'Item 4'],
    ['price' =>  4.99, 'qty' => 4, 'desc' => 'Item 5']
];

$totalInvoicePrice = array_reduce(
    $invoiceItems,      // array
    fn($sum, $item) => $sum = $item['qty'] * $item['price'], // callback,
    0               // initial value. by default, this is NULL
);

echo $totalInvoicePrice, $nl;

// 'array_search': Searches through an array for a value and returns the key if found
// It is case-sensitive and will return only the first occurrence of that value in the
// array. It will return 'false' if the value is not found. Use strict comparison to compare
// this return value with false, not to confuse the zero index with false.
$arr2 = ['a' => 5, 'b', 'c' => 6];
echo array_search(
    'b',             // the value to search
    $arr2,          // the array
    false           // whether to use strict comparison, default is false which is loose comparison
), $nl;             // prints '0' since the index of 'b' is 0

// If you don't need to know the key, just to be know if the value exists in an array, you can use
// 'in_array' function. It takes the same arguments as 'array_search' treated above
if(in_array('b', $arr2)) {
    echo "Letter 'b' found!", $nl;
}

// There are arrays used to find the difference between arrays. 
// 'array_diff': compares the first array given against the other arrays and returns an array containing the
// elements NOT found in any of the other arrays. The keys are also preserved.
// 'array_diff_assoc': similar to 'array_diff' but returns the elements whose key-value pair
// is NOT found in any of the other arrays. They keys are also preserved.
// 'array_diff_key': similar to 'array_diff' but checks for the keys. It compares the items in the first array
// and returns elements which do not have same keys with any other elements in the other arrays.
$arr1 = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5];
$arr2 = ['d' => 4, 'g' => 5, 'i' => 6, 'j' => 7, 'k' => 6];
$arr3 = ['l' => 3, 'm' => 9, 'n' => 10];

prettyPrintArray(array_diff($arr1, $arr2, $arr3));

prettyPrintArray(array_diff_assoc($arr1, $arr2, $arr3));

prettyPrintArray(array_diff_key($arr1, $arr2, $arr3));

// We also have some bunch of functions for sorting arrays. These functions have common affixes
// like 'k' for sorting by key, 'u' for user-defined sorting functions, 'r' for sorting in reverse
// (i.e. descending order) etc. And they also modify the original array and return a boolean.
$arr1 = ['d' => 3, 'b' => 3, 'c' => 4, 'a' => 2];

echo "<b>Sorting Functions</b>", $nl;
prettyPrintArray($arr1);
asort($arr1);                   // sort the array in ascending order by values
prettyPrintArray($arr1);
arsort($arr1);                   // sort the array in descending order by values
prettyPrintArray($arr1);
ksort($arr1);                   // sort the array in ascending order by keys
prettyPrintArray($arr1);
krsort($arr1);                   // sort the array in descending order by keys
prettyPrintArray($arr1);
usort($arr1, fn($a, $b) => $b <=> $a);      // sorts an array depending on a user-defined function taking 
                                            // two values at the same time. The values returned for each function
                                            // call in each iteration determine how the two values are sorted:
                                            // => less than zero    - $a should go before $b
                                            // => equal to zero     - No ideal order, both are equal
                                            // => greater than zero - $a should go after $b
                                            // user-defined sort functions like 'usort' and 'uksort' (for keys) do not
                                            // preserve the keys unlike the othr ones which do preserve the keys.
prettyPrintArray($arr1);

// We can also destructure the contents of an array directly to a variable using the 'list()' operator.
// 'list()' like 'array()' and many others, are not considered to be functions, rather language constructs.
$arr1 = [1, 2, 3, 4];

list($a, $b, $c, $d) = $arr1;
echo $a, ' ', $b, ' ', $c, ' ', $d, $nl;

// The shorter form of this is using the square bracket syntax
[$e, $f, $g, $h] = $arr1;
echo $e, ' ', $f, ' ', $g, ' ', $h, $nl;

// We can skip vlaues we don't need and even destructur nested array values
$arr1 = [1, 2, [3, 4]];

[$i, , [, $k]] = $arr1;
echo $i, ' ', $k, $nl;

// We can also specify which keys to destructure especially for associative arrays
[1 => $k, 2 => [$l ,]] = $arr1;
echo $k, ' ', $l, $nl;

?>

<h2>1.27 - PHP'S CONFIGURATION FILE (php.ini)</h2>

<?php

/* php.ini & configuration */

/*
    PHP.ini file is the configuration file that includes directives for configuring how PHP behaves.
    Directives are key-value pairs that are used to configure PHP or PHP extensions. Syntax is:
        directive = value
    Directives name are case-sensitive and if PHP can't find the expected directive because it is not
    set or it is mistyped, a default value will be used.
    Driective values can be:
    -> a string, number, a PHP constant (e.g. E_ALL or M_PI),
    -> any of the INI constant (On, Off, True, False, Yes, No and None),
    -> An expression containing only bitwise operators and parentheses (e.g. E_ALL & ~E_NOTICE)
    -> quoted string ("bar"), or
    -> a reference to a previously set variable directive (e.g. ${foo})

    Important things to note when working on the php.ini file:
    -> Text enclosed in square brackets are ignored. For example, at the top of the file, we have:
            [PHP]
        this text is ignored.
    -> Lines starting with semicolon are treated as comments and are ignored. Comments are used for
        documentation purposes to say what the directives.
    -> Empty string can be denoted by simply not writing anythin after the equal sign, or by using the None
        keyword
            foo = None
            foo = 
    -> Constants used as a value which come from a dynamically loaded extension (either a PHP extension or
        a Zend extension), must be used after the line that loads the extension

    You can get an overview of the list of php.ini directive in the PHP official directives which shows the name
    of the directive, default value, changeable (where the ini directive can be changed from) and the changelong.
    Changeable can be INI_USER, INI_PERDIR, INI_SYSTEM or INI_ALL which are INI mode integer constants
        -> INI_USER     - Entry can be set in user scripts (like PHP script using ini_set())
        -> INI_PERDIR   - Entry can be set in 'php.ini', '.htaccess', 'httpd.conf' or '.user.ini'
        -> INI_SYSTEM   - Entry can be set in 'php.ini', 'httpd.conf'
        -> INI_ALL      - Entry can be set anywhere

    Lastly, when you make any changes to the php.ini file, do well to always restart your (Apache or any other)
    server for these changes to be updated.
 */


// Use 'ini_get()' and 'ini_set()' to get or set a PHP directive at runtime. Note that not all directives can be
// set dynamically at runtime.

var_dump(ini_get('error_reporting')); echo $nl;       // what type of error to flag (i.e. report) or ignore
var_dump(ini_get('display_errors')); echo $nl;        // whether or not to display errors
var_dump(ini_get('error_log')); echo $nl;             // where errors should be logged in to

ini_set('error_reporting', E_ALL);      // set to flag or report all types on the screen
ini_set('display_errors', 1);           // set to display errors on the screen


$arr = [1];
echo $arr[3], $nl;

// => 'post_max_size' determines the the maximum size of data that can be posted in a request

// => 'max_execution_time' sets the number of seconds a script can run before it is timed out.

// Uncommenting the lines below causes the script to reach its maximum execution time thereby
// throwing a 'timeout' error
// ini_set('max_execution_time', 3);
// sleep(5);       // pauses the script execution for 5 seconds

// => 'memory_limit' sets the maximum amount of memory  a script can consume while executing.

// Uncommenting the lines below runs a loop that consumes more memory that a single script is
// allowed to consume as specified in the php.ini file.
// $string = "x";
// for ($i = 0; $i < 1000; $i++) {
//     $string .= $string;
// }

// echo $string;

// => 'file_upload' disables or enables file uploads in PHP applications

// => 'upload_tmp_dir' indicates where the tmp (temporary) files is stored during file uploads

// => 'upload_max_filesize' indicates the maximum size of file to be uploaded at a time

// => 'date.timezone' specifies the default timezone to be use
echo ini_get('date.timezone'), $nl;

// => 'include_path' specifies where the 'require', 'include', etc. should look for files by default if not specified

?>

<h2>1.28 - ERROR HANDLING</h2>

<l?php

/* ERROR HANDLING

    There are different errors that can result during execution of scripts: syntax errors, fatal errors,
    parse errors, notices, warning and so on. Some errors halt executino of scripts e.g fatal error (errors that the PHP interpreter)
    can not recover from while some others do not e.g. warnings.

    We can set which type of error should PHP care about to report them from the php.ini configuration file.
    Another way is to explicitly use the 'error_reporting()' function which can take values 0, E_ALL, E_WARNING, or their combination
    using bitwise operators. For example: E_ALL & ~E_WARNING reports all kinds of error except warnings.
    It is recommended to use E_ALL for both production and development so that bugs are easier to identify. You should, however to hide those
    errors during production using the 'display_errors' directive.
    Error related constants include:
        E_ERROR, E_WARNING, E_PARSE, E_NOTICE, E_STRICT, E_DEPRECATED,
        E_USER_ERROR, E_USER_WARNING, E_USER_NOTICE, E_STRICT, E_USER_DEPRECATED,
        E_ALL, and so on 
    These error constants define different error levels. You can use one or more of these to set certain error directives e.g. error_reporting
    in the php.ini file

    All E_USER_* are similar to their counter parts but are used to identify errors which are trigged manually using the PHP
    trigger_error() function.
 */

// Decide which kind of errors should be reported using 'error_reporting()' function
error_reporting(E_ALL);

// Manually trigger error using 'trigger_error()' function. It takes the error message and the error level (any of the E_USER_*).
// trigger_error("Example fatal error", E_USER_ERROR);       // Stops executing script
trigger_error("Example warning error", E_USER_WARNING);

// The 'display_errors' directive sets whether errors should be displayed or not. You should turn it on in developmemnt but
// you should not in production to avoid displaying sensitive information to the user. Errors are also logged so you can see what
// went wrong in the error log file as specified.
// You can use 'error_log()' to manually log error into the error log file

// Lastly, we can handle errors when they occur and perform certain actions.
// This is done using the 'set_error_handler()' function. It takes a callback error handler function that handles the errors;
// and the error level the error handler should handle. Whenever an error occurs, the error type, error message,
// the file in which the error occured, the line where the error occurs is passed as argument to the error handler function in that order.

function errorHandler(
    int $type,
    string $msg,
    ?string $file = null,
    ?int $line = null
) {
    // Do something here like final cleanup, to handle the error.
    // Ideally, there is no need to print out the error message.
    echo 'Trying to handle error => ' . $type . ': ' . $msg . ' on line ' . $line;

    // You can also exit the script if need be
    // exit;
}

// Set the error handle.
// The error level set here will report the error for the error handler callback function to handle
// not withstanding the value set in the php.ini or using 'ini_set()' or 'error_reporting()' function
set_error_handler('errorHandler', E_ALL);

echo $someUndefinedVariable;

// Use the 'restore_error_handler' function to restore the previous error handle callback function
// restore_error_handler()

// Later, we shall review how to handle error the object-oriented way as opposed to the above described
// procedural style. Then, we shall introduce the concept of Exceptions, what they are and what to do with
// them.

?>

<h2>1.29 - BASIC APACHE WEBSERVER CONFIGURATION & VIRTUAL HOSTS</h2>

<?php

/* APACHE CONFIGURATION */

/*
    We might need to configure our apache server from time to time to adjust to our needs. We can do this via
    the Apache configuration file. You can easily access it from the XAMPP Control Panel (if you are using Apache
    configured on XAMPP). The name of the file is 'httpd.conf' usually located in 'C:\xampp\apache\conf' for a
    Windows machine. The default location for the config file is in '/usr/local/apache2/conf'

    In the 'C:\xampp\apache' directory, you can also find the 'logs' folder which holds the different logs file.
    As usual, you can easily open it from the XAMPP Control Panel. Inside the folder, you'll commonly find the
    followinf log files: 'error.log', 'access.log' and a few others if you are using XAMPP. Otherwise, the default
    location for the log files in: '/var/log/httpd'

    Apache Configuration file (httpd.conf)
    This file contains the configuration directives that gives the Apache server its instructions.
    Each configuration directives must be set in one line and lines starting with a hash '#' symbol
    is treated as a comment, hence ignored.

    In the Apache configuration file, we can set directives to configure:
        -> server root:
            >>> Server Root "C:/xampp/apache"
        -> default port that Apache listens to:
            >>> Listen 80
        -> load modules:
            >>> LoadModule path_to/module.so
        -> Include directives conditionally if some module is present.
            >>> <IfModule some_module>
                    # include the directives

                </IfModule>
        -> server admin and server name
            >>> ServerAdmin postmaster@locahost
            >>> ServerName localhost:80
        -> set scope directive section: set some directives for specific directory. If directory is not
            is specified, it applies to all the directory
            >>> <Directory />
                    AllowOverride none
                    Require all denied
                </Directory>
            >>> <Directory "C:/xampp/htdocs">
                    AllowOverride all
                </Directory>
        -> document root: where the web page files reside.
            >>> DocumentRoot "C:/xampp/htdocs"
        -> default error log file
            >>> ErrorLog "logs/error.log"
        -> include other configuration files, for easy organization
            >>> Include conf/extra/path/to/config/file.conf
        One important config file included is: the virtual host config file found in:
            conf/extra/httpd-vhosts.conf

    Virtual Hosting allows us to run multiple websites on a single server. The websites can be
    IP based i.e. where each website is served from a different IP address or name-based when it is
    served from the same IP but different names. Virtual hosting allows us to make use of name-based
    virtual hosting. We can set 'Virtual Host'-specific directory to apply some directives to a particular
    host/website on the server. The directive looks like this:
        <VirtualHost *:80>
            ServerAdmin webmaster@dummy-host.example.com
            DocumentRoot "C:/xampp/htdocs/dummy-host.example.com"
            ServerName dummy-host.example.com
            ServerAlias www.dummy-host.example.com
            ErrorLog "logs/dummy-host.example.com-error.log"
            CustomLog "logs/dummy-host.example.com-access.log" common
        </VirtualHost>
    Now, 'localhost' points to the the directory defined by 'DocumentRoot' directory.
    We can however, host other sites using similar virtual host directives and adjusting the
    Directives as we need. To able to tell the machine to to point the host/server defined in the
    'ServerRoot' directory, we have to point our local machine IP to the host. This is done in the
    host file and for Windows the file is located at: 'C:\Windows\System32\drivers\etc' directory.
    By adding:
        >>> 127.0.0.1 www.dummy-host.example.com
    We can go to the browser, type 'www.dummy-host.example.com' and this points to our
    site. With this, we can have different hosts listening to the same port without conflicting.

    .HTACCESS Files
    .htaccess files also known as distributed configuration files are used to set directive specific to
    a directory and its subdirectories. They are read on every request, thus changes in this files are effected
    immediately, with no need of restarting the Apache server. Within the .htaccess files, we can set directives
    to determine how our sites accept requests and how to handle (route) them. Note that not all directives can be
    set in the .htaccess file. This is defined in the 'AllowOverride' directive of the <Directory> specific directive.
    It is highly recommended not to use use .htaccess file unless you need to since they are read on every requests
    which can significantly affect the server's performance. Any directive that can be put in the .htacess file can
    also be put in the main configuration file and scoped to a specific directory using the <Directory> section scope.
    However, they can come in handy in cases where you don't have root access to the server or the server's main
    configuration file (e.g. in shared host providers). Rather, they let you use .htaccess file to overwrite some 
    directives to suit your needs. Otherwise, it is recommended to go on and put your configuration in the main config
    file or in another config file and then include it. You could also turn off the 'AllowOverride' directive by setting
    it to None. That way, the server does not even attempt to look for it.
    
        One common use case of .htaccess file is in rewriting URLs and perform pattern matching using regular expressions
    to make URLS pretty and user-friendly. It is also common to route (i.e. send) all the request coming to a server to the
    'index.php' file in the site's root directory. And from there, we can decide which pages to display. This is called
    routing. To do this, we use the 'mod_rewrite' module and we check if it is available using the 'IfModule'
    A typical .htaccess may look like this:
        >>> <IfModule mod_rewrite.c>
                # Turn on the rewrite engine to enable us rewrite URLs
                RewriteEngine On

                # Serve static files e.g. css, js files or directories as they are.
                # No need for index.php to process them
                RewriteCond %{REQUEST_FILENAME} !-d
                RewriteCond %{REQUEST_FILENAME} !-f

                # Send every incoming requests to our index.php file
                RewriteRule * index.php [L]
            </IfModule>
    Now, we can now parse the URL and include the necessary files.
    We can set this directive in the main configuration, or a separate configuration file to 
    include it in the main configuration file, or in the virtual host directive for a specific site.
    We will only need to modify the RewriteRule line to:
        >>> RewriteRule * /index.php [L]
    with /index.php specifying that the file is in the root folder.
    NB: Do well to restart the Apache server by manually stopping and starting it each time you make any
    changes to the 'httpd.conf' Apache configuration file.

 */

?>

<h4>Apache Configuration</h4>

<p>
    We might need to configure our apache server from time to time to adjust to our needs. We can do this via
    the Apache configuration file. You can easily access it from the XAMPP Control Panel (if you are using Apache
    configured on XAMPP). The name of the file is <strong><code>httpd.conf</code></strong> usually located in
    <strong><code>C:\xampp\apache\conf</code></strong> for a Windows machine. The default location for the config
    file is in <strong><code>/usr/local/apache2/conf</code></strong>

    In the <strong><code>C:\xampp\apache</code></strong> directory, you can also find the <strong><code>logs</code></strong>
    folder which holds the different logs file. As usual, you can easily open it from the XAMPP Control Panel.
    Inside the folder, you'll commonly find the following log files: <strong><code>error.log</code></strong>,
    <strong><code>access.log</code></strong> and a few others if you are using XAMPP. Otherwise, the default location 
    for the log files in: <strong><code>/var/log/httpd</code></strong>
</p>

<h4>Apache Configuration file (httpd.conf)</h4>

<p>
    This file contains the configuration directives that gives the Apache server its instructions.
    Each configuration directives must be set in one line and lines starting with a hash '#' symbol
    is treated as a comment, hence ignored.
</p>

<li>
    In the Apache configuration file, we can set directives to configure:

    <li>
        server root: <br>
            <code>>>> Server Root "C:/xampp/apache"</code>
    </li>
    <li>
        default port that Apache listens to: <br>
            <code>>>> Listen 80</code>
    </li>
    <li>
        load modules: <br>
            <code>>>> LoadModule path_to/module.so</code>
    </li>
    <li>
        Include directives conditionally if some module is present. <br>
<pre>
>>> &lt;IfModule some_module &gt;
        # include the directives
    &lt;/IfModule &gt;
</pre>
    </li>
    <li>
        server admin and server name: <br>
            <code>>> ServerAdmin postmaster@locahost</code>
            <code>>>> ServerName localhost:80</code>
    </li>
    <li>
        set scope directive section: set some directives for specific directory. If directory is not
            is specified, it applies to all the directory. <br>
<pre>
>>> &lt;Directory /&gt;
    AllowOverride none
    Require all denied
    &lt;/Directory&gt;
>>> &lt;Directory "C:/xampp/htdocs"&gt;
    AllowOverride all
    &lt;/Directory&gt;
</pre>
    <li>
        document root: where the web page files reside. <br>
            <code>>>> DocumentRoot "C:/xampp/htdocs"</code>
    </li>
    <li>
        default error log file. <br>
            <code>>>> ErrorLog "logs/error.log"</code>
    </li>
    <li>
        include other configuration files, for easy organization. <br>
            <code>>>> Include conf/extra/path/to/config/file.conf</code>
    </li>
        One important config file included is: the virtual host config file found in:
            <strong><code>conf/extra/httpd-vhosts.conf</code></strong>
</ul>

<h4>Virtual Hosting</h4>

<p>
Virtual Hosting allows us to run multiple websites on a single server. The websites can be
    IP based i.e. where each website is served from a different IP address or name-based when it is
    served from the same IP but different names. Virtual hosting allows us to make use of name-based
    virtual hosting. We can set 'Virtual Host'-specific directory to apply some directives to a particular
    host/website on the server. The directive looks like this:
    <pre>
    &lt;VirtualHost *:80&gt;
        ServerAdmin webmaster@dummy-host.example.com
        DocumentRoot "C:/xampp/htdocs/dummy-host.example.com"
        ServerName dummy-host.example.com
        ServerAlias www.dummy-host.example.com
        ErrorLog "logs/dummy-host.example.com-error.log"
        CustomLog "logs/dummy-host.example.com-access.log" common
    &lt;/VirtualHost&gt;
    </pre>

    Now, 'localhost' points to the the directory defined by 'DocumentRoot' directory.
    We can however, host other sites using similar virtual host directives and adjusting the
    Directives as we need. To able to tell the machine to to point the host/server defined in the
    'ServerRoot' directory, we have to point our local machine IP to the host. This is done in the
    host file and for Windows the file is located at: 'C:\Windows\System32\drivers\etc' directory.
    By adding: <br>
        <code>>>> 127.0.0.1 www.dummy-host.example.com</code> <br>
    We can go to the browser, type <i>www.dummy-host.example.com</i> and this points to our
    site. With this, we can have different hosts listening to the same port without conflicting.

</p>

<h4>.htacess file</h4>

<p>
    .htaccess files also known as <strong><i>distributed configuration files</i></strong> are used to set directive specific to
    a directory and its subdirectories. They are read on every request, thus changes in this files are effected
    immediately, with no need of restarting the Apache server. Within the .htaccess files, we can set directives
    to determine how our sites accept requests and how to handle (route) them. Note that not all directives can be
    set in the .htaccess file. This is defined in the <code>AllowOverride</code> directive of the <code>&lt;Directory&gt;</code> specific directive.
    It is highly recommended not to use .htaccess file unless you need to since they are read on every requests
    which can significantly affect the server's performance. Any directive that can be put in the .htacess file can
    also be put in the main configuration file and scoped to a specific directory using the <code>&lt;Directory&gt;</code> section scope.
    However, they can come in handy in cases where you don't have root access to the server or the server's main
    configuration file (e.g. in shared host providers). Rather, they let you use .htaccess file to overwrite some 
    directives to suit your needs. Otherwise, it is recommended to go on and put your configuration in the main config
    file or in another config file and then include it. You could also turn off the <code>AllowOverride</code> directive by setting
    it to None. That way, the server does not even attempt to look for it.
    
    <br>

        One common use case of .htaccess file is in rewriting URLs and perform pattern matching using regular expressions
    to make URLS <i>pretty</i> and user-friendly. It is also common to route (i.e. send) all the request coming to a server to the
    <code>index.php</code> file in the site's root directory. And from there, we can decide which pages to display. This is called
    <strong>routing</strong>. To do this, we use the <code>mod_rewrite</code> module and we check if it is available using <code>IfModule</code>.
    A typical .htaccess may look like this:
<pre>
>>> &lt;IfModule mod_rewrite.c&gt;
        # Turn on the rewrite engine to enable us rewrite URLs
        RewriteEngine On

        # Serve static files e.g. css, js files or directories as they are.
        # No need for index.php to process them
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteCond %{REQUEST_FILENAME} !-f

        # Send every incoming requests to our index.php file
        RewriteRule . index.php [L]
    &lt;/IfModule&gt;

</pre>

    Now, we can now parse the URL and include the necessary files.
    We can set this directive in the main configuration, or a separate configuration file to 
    include it in the main configuration file, or in the virtual host directive for a specific site.
    We will only need to modify the <code>RewriteRule</code> line to: <br>
    <code>>>> RewriteRule * /index.php [L]</code> <br>
    with <code>/index.php</code> specifying that the file is in the root folder.

    <br>

    NB: Do well to restart the Apache server by manually stopping and starting it each time you make any
    changes to the <code>httpd.conf</code> Apache configuration file.

</p>


<h2>1.30 - FILESYSTEM IN PHP</h2>

<?php

/*
    FILESYSTEM IN PHP

    PHP provides some functions that allows us to work with the file system on the server. With
    these functions we can create, edit, modify files or directories.
 */

// scandir() - lists all the files and directories within the given path
$dir = scandir(__DIR__);    // __DIR_ is a magic constant that always refers to the current
                            // directory of the script being executed
prettyPrintArray($dir);     // . refers to the current directory
                            // .. refers to the parent directory
$nl;

// is_file() - checks if a given argument is a file.
// is_dir() - checks if a given argument is a directory

var_dump(is_file($dir[count($dir) - 1])); echo $nl;
var_dump(is_dir($dir[0])); echo $nl;

// mkdir() and rmdir() - are used to create and remove a directory respectively

mkdir("folder_foo");
prettyPrintArray(scandir(__DIR__));
rmdir("folder_foo");    // 'folder_foo' must be an empty directory

// You can also create directory recursively.
mkdir("foo/bar", recursive: true);
prettyPrintArray(scandir(__DIR__));
rmdir("foo/bar");       // removes 'bar' directory located in 'foo'
rmdir("foo");           // removes 'foo' directory

// We cah check if a file exists using the file_exists() function
if (file_exists("README.md")) {
    echo filesize("README.md"), $nl; // return the size of the file in bytes
} else {
    echo "File not found <br/>";  
}

// For performance, PHP caches the return value of some filesystem functions.
// E.g. the return 'filesize' function above is cached and subsequent calls to
// that function with the same argument just returns that value even if changes
// have been made to that file.
// To demonstrate this, we will create a file, print the size and and write into
// it and then print the size of the file
file_put_contents("foo.txt", "Hello, world!");  // writes into a file, creates it if
        // does not exists yet, and overwrites the contents of the file by default.

echo "Filesize: ", filesize("foo.txt"), $nl;      // Print the size of the file

file_put_contents("foo.txt", "Hello, World. 
    Lorem ipsum dolor, sit amet consectetur adipisicing elitLorem ipsum dolor, 
    sit amet consectetur adipisicing elit"
);                                  // Write into the file, with a bigger content

echo "Filesize: ", filesize("foo.txt"), $nl;      // Print the size of the file once again

// Notice that the file is the same value. To get the updated file size, we will have to
// clear the cache using 'clearstatcache()' function.

clearstatcache();

echo "Filesize: ", filesize("foo.txt"), $nl;    // Print the updated filesize now

// We can open a php file and perform certain actions, like writing, reading the contents
// modifying the contents etc.
// To open a file, you use the 'fopen()' function. This functions takes the filename,
// the mode you wish to open it in (can be read "r" mode, write "w" mode, append "w" mode, etc).
// And it returns a 'resource' type or false if the file is not found emitting an error
// You can also specify a URL to open a remote file somewhere on another server but that
// won't always work especially if it is disabled by that server.

$file = fopen("foo.txt", "r");
$nonExistingFile = @fopen("non-existing-file.txt", "r");  // the error control @ operator is
            // is used to suppress the warning so the 'fopen' returns false without emitting 
            // warning. This is NOT advisable anyways. It is better to check if the file exists
            // before opening the file using the 'file_exists()' function.
var_dump($nonExistingFile); echo $nl;

var_dump($file); echo $nl;

// Read the file line by line using 'fgets()' function assigning it to the
// $line variable. 'fgets()' takes a second argument specifying the length
// in bytes of data to read from the opened file; if not specified, it continues
// reading till the end of the line and then returns it. It returns false when
// an error occurs 
// It is common to use the 'fgets()' in the while loop comparing the return value
// to false using the strict comparison '!==' or '===' (incase the content of the
// file happens to be 'falsy' i.e. becomes false when casted to boolean).
while (($line = fgets($file)) !== false) {
    echo $line, $nl;
}

// CSV (Comma-Separated Values) are common file formats and PHP provides a function to parse
// them. As the name implies, the data in the file are separated by commas. We can use 
// 'fgetcsv()' to get the content of a CSV file in a similar way to 'fgets()' but returns the data
// read parsed into an array.

// Let's rewrite the content of our foo.txt to a CSV
file_put_contents("foo.txt", "Name, Age, Country
John, 25, Canada
David, 46, Libya
Celine, 38, Ghana
");

// Close the previously opened file to avoid resources usage
fclose($file);

// Now read the the file
$file = fopen("foo.txt", "r");
while (($line = fgetcsv($file)) !== false) {
    var_dump($line); echo $nl;
}

fclose($file);      // close file

// 'file_get_contents()' is a similar function to 'file_put_contents()'.
// It is used to get all the content of a file as a string and can be
// stored in a variable.
// It takes other optional arguments apart from the filename which is
// required, like the 'length' of data in bytes to read or 'offset' to
// indicate where to start reading a file.
// You can specify a URL as the filename to get the content of a remote
// file, though that won't always work. A better way to get contents of a
// a remote file by making HTTP requests is by using a library called
// 'curl' as we shall see later.
$content = file_get_contents("foo.txt");
echo "<pre>", $content, "</pre>", $nl;

// Hint: 'file_put_contents()' and 'file_get_contents()' are similar in
// that they are a combination of up to three filesystem functions. While
// 'file_put_contents()' performs 'fopen()', 'fwrite()' and 'fclose()' once,
// 'file_get_contents()' performs 'fopen()', 'fread()' and 'fclose()' all at once.

// If the filename passed to 'file_put_contents()' does not exists, it creates
// a new one and writes the value into it overwriting the original content by default.
// To append instead, you have to specify it using the third argument. The third argument
// is a 'flag' specifying how the file should be opened and written into. To append you can
// use the constant 'FILE_APPEND' flag.

// We can copy a file into another one using the 'copy()' function.
copy("foo.txt", "bar.txt");     // 'bar.txt' does not exist, it creates the file. If it
            // exists, the content of the file is overwritten instead.
prettyPrintArray(scandir(__DIR__)); echo $nl;

// Instead of copying, we can move (in other words, rename) one file to another file. Similar
// to 'copy()', 'rename()' creates the file if it does not exists and overwrites the content if
// it exists. 'rename()', however deletes the original file and this can be used on directories
rename("bar.txt", "foo2.txt");
prettyPrintArray(scandir(__DIR__)); echo $nl; // 'bar.txt' has been moved and is no longer there.

// We can get the infos about a file or directory using the 'pathinfo()' function.
prettyPrintArray(pathinfo(__DIR__)); echo $nl;
prettyPrintArray(pathinfo("foo2.txt")); echo $nl;

// Lastly to delete a file, you use the 'unlink()' function.
unlink("foo.txt");
unlink("foo2.txt");

prettyPrintArray(scandir(__DIR__)); echo $nl; // our directory is back to normal

?>

<h2>1.31 - MINI EXCERCISE OVERVIEW PROJECT</h2>

<?php

/*
    The Part 1 of the course has come to an end
    
    To put into practice what we have learnt so far, we will build a 
    simple mini project using the concepts we have learnt.

    The project is a simple budgeting/expense tracking application. Since we don't have 
    the complete concepts to build all the features, we will begin with the simple concepts
    using all the tools and concepts we have learnt so far and then improve on it as we
    progress through the course.

    To start, we will implement a simple file parser that reas one or muliple CSV files
    and extracts the transaction data from them.

    Visit https://github.com/ggelashvili/learnphptherightway-project/tree/1.31 to get an overview
    of the project
 */
?>

<div>
    <p>The Part 1 of the course has come to an end.</p>
    
    <p>To put into practice what we have learnt so far, we will build a 
    simple mini project using the concepts we have learnt.</p>

    <p>The project is a simple budgeting/expense tracking application. Since we don't have 
    the complete concepts to build all the features, we will begin with the simple concepts
    using all the tools and concepts we have learnt so far and then improve on it as we
    progress through the course.</p>

    <p>To start, we will implement a simple file parser that reas one or muliple CSV files
    and extracts the transaction data from them.</p>

    <p>Visit <a href="https://github.com/ggelashvili/learnphptherightway-project/tree/1.31">
    https://github.com/ggelashvili/learnphptherightway-project/tree/1.31
    </a> to get an overview of the project.
</p>
</div>


<h2>1.32 - BUILDING SMALL PART OF THE APP WITH PROCEDURAL PHP</h2>

<div>
    <p>The project to build is an expense tracker.</p>

    <p>And one of the first feature we shall add is the file parser which parses the
    transcation file in CSV format and stores the data in array and possibly displaying 
    the content in basic HTML.</p>

    <p>As we go on, we shall implement other features of the application when we must have
    add more tools to toolkit.</p>

    <p>Visit <a href="https://github.com/ggelashvili/learnphptherightway-project/tree/1.31">
    https://github.com/ggelashvili/learnphptherightway-project/tree/1.31
    </a> to get an overview of the project.</p>

    <p>And go to <a href="http://project.learnphp2024.local/" target="_blank">projectname.local</a> to view the project</a></p>


</div>