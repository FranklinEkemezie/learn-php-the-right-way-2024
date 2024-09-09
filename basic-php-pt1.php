<?php

// 1.0 - INTRO. TO PHP AND OVERVIEW OF THE COURSE

// 1.1 - GETTING STARTED - INSTALLATION AND WEB SERVERS

// 1.2 - BASIC PHP SYNTAX

?>

<h2>1.2 - BASIC PHP SYNTAX</h2>
<!DOCTYPE html>
<html lang="en">
    <body>
        <h1><?php echo 'Hello, World'; ?></h1>
        <p>My first paragraph.</p>

        <?php
            $x = 10;
            $y = 4;

            echo '<p>' . $x . ' + ' . $y . ' = ' . ($x + $y) . '</p>';
        ?>

        <?php
        // Single line comment

        /*
         Multiple line comment
         */

        # Single line comment

        /**
         * DOCS BLOCKS
         */
        ?>

    </body>
</html>

<h2>1.3 - CONSTANTS AND VARIABLES</h2>
<?php
// 1.3 - CONSTANTS AND VARIABLES


// Constants

$firstName = 'Franklin';

$firstName = 'Ifeanyi';

echo $firstName;

//const name = 'value';

if (true) {
    define('STATUS', '5');
}

echo  defined('STATUS');

const nl = '<br/>';

// Magic constant - Values can be changed

echo PHP_VERSION;

echo '<br/>';

echo  __LINE__;


$foo = 'bar';
$$foo = 'baz';

echo  $bar . ', ' . "${$foo}";


?>

<h2>1.4 - DATA TYPES</h2>
<?php

// 1.4 - DATA TYPES
/* Data types & Type Casting */

# - Scalar Types
    # bool - true / false
    $completed = true;
    # int
    $score = 75;
    # float
    $price = 8.99;
    # string
    $greeting = 'Hello, World';

    echo  '<br/>';
    echo $completed . '<br/>';
    echo $score . '<br/>';
    echo $price . '<br/>';
    echo $greeting . '<br/>';

    // Get the type of variable
    echo gettype($price), '<br/>';

    $completed = false;
    var_dump($completed);
    echo '<br/>';
    var_dump($greeting);


# - Compound Types
    # array
    $companies = [1, 2, 3, -4.7, true, 'yes'];

    echo '<br/>';
    var_dump($companies);

    # object
    # callable
    # iterable

# - Special Types
    # resource
    # null

// Type hinting gives a hint of the type a function takes and/or returns
function sum(int $x, int $y) {
    var_dump($x, $y);
    return $x + $y;
}

// Type casting or type coercion occurs when a different type is given in a particular context
echo sum(2, '5');
echo  '<br/>';

// We can cast type i.e. force a variable in one type to another type
$x = (int) '5';

?>

<h2>1.5 - BOOLEAN DATA TYPE</h2>
<?php
/* 1.5 - BOOLEANS */
$isComplete = true;

// The following are falsy values and evaluates to FALSE
// in conditional expressions:
// - integers - 0, -0
// - floats - 0.0, -0.0
// - string - empty string '', or string zero '0'
// - array - empty array []
// - special types NULL also evaluates to false
// Anything else, should evaluate to TRUE

$isComplete = [];

if ($isComplete) {
    // do something
    echo 'success';
} else {
    // do something else
    echo  'fail';
}

?>

<h2>1.6 - INTEGER DATA TYPE</h2>

<?php

/* INTEGERS */
// The number of integers

// The size of integers
echo PHP_INT_SIZE, nl;

$x = 5;
$x = 0x2A;  // hexadecimal
$x = 05;    // octal
$x = 0b110; // binary


echo  $x, nl;

echo  PHP_INT_MAX, nl;

var_dump(PHP_INT_MAX + 1);

/*
 * Boolean TRUE cast 1 while FALSE to 0
 * Floats lose their decimal part when cast to integers
 */
$str1 = '768abc'; // when cast to integer becomes '768'
$str2 = 'abc457'; // when cast to integer becomes '0'

// As of PHP 7.4, we can separate numbers with underscores for
// readability purposes.
$x = 2_000_000_000;

echo  nl;
echo  (int) $str1, ' ', (int) $str2, nl;
var_dump(is_int($x));   // use 'is_int' to check if a variable is an integer
echo nl;
?>

<h2>1.7 - FLOAT DATA TYPE</h2>
<?php
/* FLOATS */

$x = 13.5;
$x = 13.5e-3;        // in exponential form
$x = 13_765_675e3;   // for readability purposes

echo  $x, ' ', nl;
var_dump(is_float($x)); // to check 'float' variable
echo  nl;

// Floats have limited precision since they are stored as binary
// in the computer's memory
$y = (0.1 + 0.7) * 10;      // Actual value - 7.999999999999911118 which rounds down to 7; and rounds up to 8
$z = (0.1 + 0.2) * 10;      // Actual value - 3.000000000000000004 which rounds down to 3; and rounds up to 4

// 'floor()' rounds down a floating point; while 'ceil()' rounds up
echo 'Floor - ', floor($y), '; ', 'Ceil - ', ceil($y), '; ', (float) $y, nl;
echo 'Floor - ', floor($z), '; ', 'Ceil - ', ceil($z), '; ', (float) $z, nl;

// Be careful when comparing float numbers with equality
$x = 0.23;
$y = 1 - 0.77;

var_dump($x, $y);
echo  nl;

if ($x == $y) {
    echo  'Equal', nl;
} else {
    echo  'Not equal', nl;
}

// When in valid operation are done, it results in NAN (which means 'Not A Number')
// The number Infinity means INF which is the result of overflowing the
// max. of a float
echo  NAN, ' ', INF, ' ', PHP_FLOAT_MAX * 2, nl;

// Use 'is_nan()' and 'is_infinite()' to check if a number
// is not a number and is infinity (i.e. the PHP INF)
// Do not use equality operator to do so
// Opposite of 'is_infinite()' is 'is_finite()'

var_dump(is_infinite($x), is_finite(PHP_FLOAT_MAX * 2), is_nan(log(-1)));
echo  nl;

// Casting variables of other float variables could be:
// via 'floatval()' and or usual '(float)' casting operator
// As usual, casting '25.5a' would result to the float 25.5
// while, casting 'abc45' would result to zero
$x = 3;

var_dump($x, (float) $x, floatval($x));
echo  nl;

?>


<h2>1.8 - STRING DATA TYPE</h2>
<?php
/* STRINGS */

$firstName = "Ifeanyi";
$lastName = "Ekemezie";

// we can interpolate (i.e. insert variables) within double quotes
$fullName = "{$firstName} $lastName";

echo  $fullName, nl;

// '.' is the concatenation operator to join two strings together
$str = "Nice to meet you!";
$greeting = "Hello, " . $fullName . ". " . $str;

echo  $greeting, nl;

// Indexing into a string: Strings are zero-indexed.
// Negative indexes index from the back.
$initials = "{$firstName[0]}.{$lastName[0]}.";

echo $initials, ' ', $lastName[-1], nl;

// 'HEREDOC' AND 'NOWDOC' are two different syntaxes used to write
// multiline and/or complex strings. Double or single quotes can be used
// within them without need of escaping them. Line breaks, tabs and HTML
// tags are given as they are.

// 'HEREDOC' -
// Treats string as if it were enclosed in double quotes - i.e.
// we can insert variables which is used to format the strings.
$text = <<<TEXT
Line 1
Line 2
Line 3
My full name is <b>$fullName</b> and initials is "$initials"
TEXT;       // 'TEXT' is an identifier and can be anything you wish as
            // long it begins and terminates the string. Anything else,
            // is treated as it is, the new lines are maintained too

echo nl2br($text), nl;  // 'nl2br()' converts new line characters ('\n')
                        // to HTML break character (<br/>)

// 'NOWDOC' -
// Variables are not recognized in it and are not parsed like in single quotes.
// The beginning identifier is enclosed in single quotes
$text = <<<'TEXT'
Line 1
Line 2
<b>Full name</b>: '$fullName'
TEXT;

echo  nl2br($text), nl;


?>

<h2>1.9 - NULL DATA TYPE</h2>

<?php

// NULL

// NULL is a special data type represented by NULL. A variable can be NULL when:
// - it is assigned the PHP constant NULL value
// - it is not defined yet, or
// - it has been unset

// - NULL constant
$myNullVar = NULL;
$myNullVar = null;

echo $myNullVar, nl;    // when NULL is cast to string, it gives an empty string
var_dump($myNullVar);
echo  nl;

var_dump(is_null($myNullVar));  // use 'is_null()' to check if a variable is NULL
var_dump($myNullVar === NULL);  // or, ===
echo  nl;


// - UNDEFINED VARIABLE
var_dump('Is variable $q not set? ', is_null($q));

// - UNSET VARIABLE
$a = 123;

unset($a);      // variable '$a' is unset (i.e. destroyed)

var_dump(is_null($a));

// NULL can be cast to different data types. When cast to:
// - string -> empty string ""
// - int/float -> int/float 0
// - boolean -> false
// - array -> empty array []

?>

<h2>1.10 - ARRAY DATA TYPE</h2>

<?php

// ARRAYS

// Arrays are list of values. In PHP, arrays can be of any data type.

$programmingLanguages = ['PHP', 'C', 'Python', 'JavaScript'];
// One can also write it using 'array' keyword
// $programmingLanguages = array('PHP', 'C', 'Python', 'JavaScript');

// Arrays are indexed starting from 0. However, -ve indexes are not allowed
// Indexing out of range is not allowed, and throws a warning.
echo 'The first programming languages in our list: ', $programmingLanguages[0], nl;

// Use 'isset()' to check if an item exists at a given index
echo 'Does index 3 exists? ';
var_dump(isset($programmingLanguages[4]));      // note that for an array of
                                    // length 'n', the last element is 'n - 1'
echo  nl;

// Modify elements at a given index
$programmingLanguages[3] = 'Java';

var_dump($programmingLanguages);    // print the elements of the array
echo  nl;
print_r($programmingLanguages);    // print the elements of the array
echo nl;
// Using <pre> HTML tag to make it look pretty
echo '<pre>';
print_r($programmingLanguages);
echo '</pre>';

// Add an element to an array
$programmingLanguages[] = 'Ruby';

echo '<pre>';
print_r($programmingLanguages);
echo '</pre>';

// We can also get the same result using the 'array_push()' function.
// It takes the array we want to add (or push) the element into - by
// reference (i.e. modifies the array itself) and any number of values
// we want to push
array_push($programmingLanguages, 'Flutter', 'Rust', 'R');

echo '<pre>';
print_r($programmingLanguages);
echo '</pre>';

// Indexes of an array are actually keys. By default, the keys are integers,
// but we can name them. Arrays with named keys are called associative arrays.
// The keys for associative arrays is a string.

$programmingLanguages = [
    'php' => '8.0',
    'python' => '3.9'
];

$programmingLanguages['go'] = '1.15';

$newLang = 'react';
$programmingLanguages[$newLang] = '11';

echo '<pre>';
print_r($programmingLanguages);
echo '</pre>';

// Arrays can take different data types as values:
// string, integer, floats booleans, and even other arrays.
// Arrays containing arrays form multidimensional arrays.


$programmingLanguages = [
    'php' => [
        'creator' => 'Rasmus Lerdorf',
        'extension' => '.php',
        'website' => 'www.php.net',
        'isOpenSource' => true,
        'versions' => [
            ['version' => 8, 'releaseDate' => 'Nov 26, 2020'],
            ['version' => 8, 'releaseDate' => 'Nov 28, 2019']
        ]
    ],
    'python' => [
        'creator' => 'Guido Van Rossum',
        'extension' => '.py',
        'website' => 'www.python.org',
        'isOpenSource' => true,
        'versions' => [
            ['version' => 3.9, 'releaseDate' => 'Oct 5, 2020'],
            ['version' => 3.8, 'releaseDate' => 'Oct 14, 2019']
        ]
    ]
];

echo '<pre>';
print_r($programmingLanguages);
echo '</pre>';

// Accessing multi-dimensional arrays
echo  'Python website: ', $programmingLanguages['python']['website'], nl;
echo  'PHP 1st release: ', $programmingLanguages['php']['versions'][0]['releaseDate'], nl;

// It is important to be careful when accessing data in multidimensional arrays
// using named keys. When the named key is not found, it results in NULL and if
// we go on to use that to maybe access an inner array using a named key, it would fail
// since it is trying to get the named index from NULL.

// When elements of an (associative) array have the same key, the value of the
// element that comes last overwrites the other values.
// Also, keys of an array should be integers (as in indexed) or strings (as in associative).
// In other situations, PHP might try to do some casting
$arr = [true => 'a', 1 => 'a', '1' => 'c', 1.8 => 'd', NULL => 'e'];
echo '<pre>';
print_r($arr);
echo  '</pre>';

// In the array above, the Boolean 'true' is cast to integer 1, the next
// element with key 1 overwrites that of key 'true' which has been cast to 1;
// Next, float '1.8' is cast to integer as 1 which in turns overwrites all
// the others too.
// NULL are cast to empty strings when used as strings and can be
// accessed as so: $arr[''].

// Also, indexes are assigned automatically when not specified. The index
// of an element is the one more than the largest index so far in the array
// Consider this: Here, the index of 'e' is 51
$arr = ['a', 'b', 'l1' => 'c', 50 => 'd', 'e', 'f'];
echo '<pre>';
print_r($arr);
echo  '</pre>';

echo array_pop($arr), nl; // removes the last element and returns it

echo '<pre>';
print_r($arr);
echo  '</pre>';


echo array_shift($arr), nl; // removes the first element and returns it
// the elements of the array are also re-indexed if the key is numerical

echo '<pre>';
print_r($arr);
echo  '</pre>';

unset($arr[1]); // destroys the item at the specified index; if the index is not
// specified i.e. unset(arr[i]), the whole array is destroyed and becomes undefined.
// 'unset()' can take multiple arguments of variables to unset. It does not
// return any value neither does it re-indexes the array.

echo '<pre>';
print_r($arr);
echo  '</pre>';

// Casting an integer, float or a string to an array creates an array with the
// variable as the first element of the array. Casting NULL creates an empty array
var_dump((array) 5, (array) "hello", (array) null);
echo  nl;

$arr = ['a' => 5, 'b' => 3, 'c' => 1, 'd' => null];
// Use 'array_key_exists()' checks if the key exists and is not null
var_dump(array_key_exists('d', $arr));

// While 'isset()' can be used to determine if the key exists and is not null
var_dump(isset($arr['d']));

print  nl;
