<h2>1.11 - EXPRESSIONS IN PHP</h2>

<?php

// Expressions

// Expression is any piece of syntax that evaluates to
// or returns a value. Conditionals, arithmetic operations, even
// functions etc. can be expressions. Expressions are also
// evaluated in a particular order called
// order of evaluation or precedence

$x = 5;  // here '5' is considered an expression since
// it is evaluated and then assigned to $x

$nl = '<br/>';

?>

<h2>1.12 - PHP OPERATORS 1</h2>

<?php

/* OPERATORS */
// Operators take one or more expressions and results in a single values
// Operators can be unary, binary or ternary if it takes one, two or even three
// expression respectively

// Arithmetic Operators (+ - * / % =)
$x = 10;
$y = 2;

echo 'x + y: ', $x + $y, $nl;
echo 'x * y: ', $x * $y, $nl;
echo 'x (mod y): ', $x % $y, $nl;
echo 'x ^ y: ', $x ** $y, $nl;

// Adding a minus or plus sign to the front of numeric string e.g. -10 casts
// it to an integer.
var_dump(-'10');
echo $nl;
// Dividing by zero throws an error, using 'fdiv()' function does not throw the
// error but returns infinity (INF)
// The mod operator converts each operand to integer, therefore:
// 10.2 % 3.5 is evaluated as 10 % 3 which is 1
// To avoid that, we can use the 'fmod()' function which returns the floating point
// value remainder of that division.
// The modulus depends on the sign of the left hand side operand. First, the numbers
// are evaluated as if they are positive and the sign of the L.H.S operand is
// appended to the result.
// i.e. -10 % 3 gives -1 while 10 % -3 gives 1

echo -10 % -6, $nl;

// Assignment Operator (=, -=, +=, /=, %=, *=, etc.)
// When assignment operation are done, the value to be the assigned
// to the variable is returned
$x = $y = 10;           // returns '10'
$x = ($y = 1) * 2;      // returns '2'

// Arithmetic operation and assignment can be combined to the
// shorthand assignment operator.
// Assignment is done by value i.e. if the value of x is assigned
// to y, and the value of x is re-assigned (changed to) a new value,
// that of y is not affected and does not change
$x *= 5;

$c -= 4; // '$c' is not defined, but it is evaluated as 0

var_dump($c); // prints -4
echo $nl;

// String Operators (., =)
$m = 'Hello ';
$m .= 'World';

var_dump($m);
echo $nl;

// Comparison Operators (== === != !== < > <= >= <=> ?? ?:)
$x = '5';
$y = 5;

echo 'Equal: (Loose): ';
var_dump($x == $y);
echo $nl;  // tries to cast to the same type before comparison
echo 'Equal: (Strict): ';
var_dump($x === $y);
echo $nl; // operands must be equal and of the same type
echo 'Not equal (Loose): ';
var_dump($x != $y);
echo $nl;
echo 'Not equal (Strict): ';
var_dump($x !== $y);
echo $nl; // checks for strict inequality
echo 'Not equal (Loose): ';
var_dump($x <> $y);
echo $nl;   // checks for loose inequality like !=
echo 'Less than:';
var_dump($x < $y);
echo $nl;
echo 'Less than or equal to: ';
var_dump($x <= $y);
echo $nl;
echo 'Greater than:';
var_dump($x > $y);
echo $nl;
echo 'Greater than or equal to: ';
var_dump($x >= $y);
echo $nl;
echo 'Spaceship: ';
var_dump($x <=> $y);
echo $nl; // return 1 if x is greater than y, or
// -1 is x is less than y or 0 if x equal to y
// Prior to PHP 8, in equality operator or the like, if right hand side operator is a string
// it is cast to an integer first and then compared. In PHP 8, both operands
// are cast to a string if the string is not a numeric operand and then compared. If the string is
// numeric, then the string is cast to integer
var_dump(0 == 'Hello');
echo $nl;

// It is advisable and conventional to use strict comparison always
$x = 'Hello World';
$y = strpos($x, 'H');

// ?: is used in place of simple if-else situation. The syntax is:
// condition ? doThisIfConditionTrue : doThisIfConditionFalse
// You can nest the ternary ?: operator using parentheses to group them
// Syntax: condition1 ? doThis1 : (condition2 ? doThis2 : doThis3)
$result = $y === false ? 'H Not Found' : 'H Found at index: ' . $y;
echo $result, $nl;

// ?? is a binary operator which returns the right hand of if the first one does
// not evaluate or is not NULL, else the first one is returned
$x = null;  // some expression that evaluates to NULL or '$x' is not defined.
$y = $x ?? 'hello';

echo $y, $nl;

?>

<h2>1.13 - PHP OPERATORS 2</h2>

<?php

/* OPERATORS */

// Error control operator (@)
$x = @file('foo.txt'); // used to suppress errors that may arise when
// evaluating some expressions. Not advisable to use

// Increment/Decrement Operators (++, --)
$x = 5;

echo $x++, $nl;   // Post-increment: returns '$x' and then increments it
echo $x--, $nl;   // Post-decrement: returns '$x' and then decrements it
echo --$x, $nl;   // Pre-decrement: decrements '$x' and then returns it
echo ++$x, $nl;   // Pre-increment: increments '$x' and then returns it

// Only numbers and strings are not affected by Increment/Decrement operators.
// Incrementing a NULL value results in 1 but not decrementing it
// Incrementing a string value increments it. 'abc' becomes 'abd'


// Logical operators (&& || and or xor)
$x = false;
$y = false;

// Type casting is done during logical operations
var_dump($x && $y);
echo $nl; // TRUE when both expressions 'x' and 'y' are TRUE
var_dump($x || $y);
echo $nl; // TRUE when either expressions 'x' or 'y' is TRUE
var_dump(!$x);
echo $nl;     // Negates the value of the expression 'x'

// and, or, xor have the same meaning as && || ! but the difference is in
// their precedence, which we will be dealt later. && || ! have a higher
// precedence than and or xor
$x = true;
$y = false;

$z = $x && $y;
var_dump($z);
echo $nl;     // '$z' is FALSE

$z = $x and $y;
var_dump($z);
echo $nl;    // '$z' is TRUE

// Lastly here, PHP uses short-circuiting when evaluating Boolean expressions
// Logical || returns TRUE immediately it finds out that the first expression is
// (or evaluates to) TRUE and does not go on to consider the other expression.
// Similarly, Logical && returns FALSE immediately it finds out that the first expression
// is (or evaluates to) FALSE and does not consider the other one.
// Hence, when short-circuiting is done, the other expression on the right is not evaluated,
// and if the right hand expression is a function, it is not called or executed.

// Bitwise Operators (& | ^ ~ << >>)
// Bitwise operators work on each bit of the data
// & gives 1 for a bit only if both bits are 1
// | gives 1 for a bit if any bit is 1
// ^ gives 1 for a bit if only one bit is 1; and 0 if both are 1
// ~ negates/inverts (or flips) the bit
// << shifts the bits to the left by adding to the end zeros the number of times specified
//      by the second operator. Basically, x & y is also the same as x * (2 ** y)
// >> shifts the bits to the right by adding to the start zeros the number of times
//      specified by the second operator and the extra bits fall off
$x = 6;     // 110
$y = 2;     // 010

echo 'AND: ', var_dump($x & $y);
echo $nl;     // (010)
echo 'OR: ', var_dump($x | $y);
echo $nl;      // (110)
echo 'XOR: ', var_dump($x ^ $y);
echo $nl;     // (100)
echo 'NOT: ', var_dump(~$x & $y);
echo $nl;    // (001) & (010) -> (000)
echo 'LEFT SHIFT: ', var_dump($x << $y);
echo $nl;    // 110<<00 -> 11000
echo 'RIGHT SHIFT: ', var_dump($x >> $y);
echo $nl;   // 110 >> 00 = 00,1]10 -> 001

// Bitwise operators cast both operands to integers unless both operands are strings which
// converts each character to the corresponding ASCII values and does the bitwise operation
// Bitwise operators can be applied in encryption, file handling, permission in databases,
// setting certain PHP configurations etc.

// Array Operators (+ == === != <> !==)
$x = ['a', 'b', 'c'];
$y = ['d', 'e', 'f', 'g', 'h'];

$z = $x + $y; // appends all the elements of $y with a different
// index/key as the element in $x. Works similar for associative arrays

echo '<pre>';
print_r($z);
echo '</pre>';

var_dump($x == $y); // returns TRUE if both arrays have the same
// key-value pairs.
echo $nl;

// === does strict equality comparison on the values and also
// checks if they are in the same order.

// The other operators != (which is same as <>) and !== will
// work as expected

// The other operators yet to be discussed are:
// - Execution Operators (``)
// - Type Operators (instanceof)
// - Null-safe Operator - PHP8 (?)

// This will be treated later in the course.

?>

<h2>1.14 - OPERATOR PRECEDENCE & ASSOCIATIVITY</h2>

<?php

/* Operator Precedence & Associativity */
// Operators have precedence, which is the order in which they are evaluated.
// The PHP documentation provides an Operation Precedence table that list
// PHP operators and their corresponding precedence (Search 'PHP Operator Precedence' for more info)
// Operators which appear towards the top have higher precedence than those which
// appear towards the bottom. Operators in the same line have the same precedence.
// The table also shows their associativity which determines how they are grouped for
// evaluation. Associativity is only relevant for binary (and ternary) operator as we shall soon see.

// Notes:
// - Generally, arithmetic operators have higher precedence relative to assignment operator
$x = 5 + 3 * 5;     // everything else is evaluated first before it is assigned to '$x'

// * / % have higher precedence relative to their counterparts + - .
echo $x, $nl;       // prints '20' (* is done first, then addition)

// You can use parentheses to decide which one is evaluated first
$x = (5 + 3) * 5;   // $x = 40 (+ is evaluated first then *)

// Associativity defines how these operators are grouped when the operators are of the same precedence
// Associativity can be: left or right associativity. Some other operators do not have associativity.
// Left associativity - operator/operands are grouped from left to right.
// Right associativity - operator/operands are grouped from right to left.
$x = $y = 3;        // This evaluates as $x = ($y = 3) since '=' has right associativity
// Thus, 5 is assigned to y returning 3 which is then assigned to x

$x = 5;
$y = 2;
$z = 10;

$result = $x / $y * $z; // This evaluates as ($x / $y) * $z. Since the two operators / * have the
//  same precedence, and their associativity is left, the operation is grouped from left to right.
// Hence, $result is assigned the value 25
echo $result, $nl;

// Operators that do not have associativity cannot be used next to each other as in above. That is,
// $result = $x < $y < $z; is not a valid expression. However, it is acceptable if at least one of them
// have different precedence in the table e.g. $result = $x < $y == $z; will work fine.
$result = $x < $y == $z;

var_dump($result);
echo $nl;

$x = true;
$y = false;
$z = true;

var_dump($x && !$y);
echo $nl;  // prints 'TRUE'. Logical ! has a higher precedence to &&
var_dump($x && $y || $z);
echo $nl;      // prints 'TRUE'. Logical && has a higher precedence to ||

// Logical ! && || have a higher precedence than Logical 'and' 'xor' 'or' (in that order)
// NB: Even the assignment operators (=, +=, etc.) have higher precedence than logical 'and' 'xor' 'or'.
// They are literally the last in the table and have the lowest precedence relative to all other operators.
$z = $x and $y;     // Here, the value of '$x' which is 'true' is assigned to '$z' which is also returned
// The returned value 'true' is then compared with '$y' to give false which is just returned
// but not assigned to any variable. Hence, the value of $z is TRUE

var_dump($z);

// In conclusion, the use of parentheses is highly encourage to highlight which operation is evaluated first.

?>

<h2>1.15 - CONDITIONAL STATEMENTS - IF/ELSE</h2>

<?php

/* Control Structures (if / else / elseif / else if) */
// Control structures allows you to decide how your blocks of codes are executed.
// Blocks of codes are series of expressions (ending in semicolons) which are grouped by braces
// One common control structures is the conditional if, if/else, ... statements.

// Syntax:
//if (condition) {
//    do evaluate this
//}

// The condition can be variables or expressions (which are evaluated) and treated as boolean expressions.

$score = 95;

if ($score > 90) {
    echo 'A', $nl;
}

// If one is to be executed, the curly braces can be omitted and can be shortened to just:
// if ($score > 90) echo 'A', $nl;
// OR
// if ($score > 90)
//  echo 'A', $nl;
// The curly braces are nonetheless recommended as it makes the code more readable.

// We can add an else block to decide what happens if the condition fails
$score = 85;
if ($score > 90) {
    echo 'A', $nl;
} else {
    echo 'F', $nl;
}

// We can also add multiple conditions if possible
$score = 64;

if ($score > 90) {
    echo 'A';
    if ($score > 95) echo '+';
    echo $nl;
} elseif ($score > 80) {
    echo 'B', $nl;
} elseif ($score > 70) {
    echo 'C', $nl;
} elseif ($score > 60) {
    echo 'D', $nl;
} else {
    echo 'F', $nl;
}

// We can use the 'else if' keyword (with spaces in between) to replace 'elseif'
// although there is a slight difference when embedding the if-else conditions in HTML.
// The 'elseif' is the conventional way anyway.
// If else statements can also be nested too i.e. having one if-else statements in one another.
// However, deep nesting of if-else statements is not advisable.

// In other to embed HTML, we can break up if-else statement as shown below.
// However, this is not advisable as it is not readable.
?>

<?php if ($score > 90) {
    ?>
    <strong>A</strong>
<?php } elseif ($score > 80) {
    ?>
    <strong>B</strong>
<?php } elseif ($score > 70) {
    ?>
    <strong>C</strong>
<?php } else {
    ?>
    <strong>F</strong>
<?php }

echo $nl;
?>

<?php
// PHP, however provides a better syntax to do this
?>

<?php $score = 85; ?>

<?php if ($score > 90): ?>
    <strong>A</strong>
<?php elseif ($score > 80): ?>
    <strong>B</strong>
<?php elseif ($score > 70): ?>
    <strong>C</strong>
<?php elseif ($score > 60): ?>
    <strong>D</strong>
<?php else: ?>
    <strong style="color: red">F</strong>
<?php endif; ?>

<?php
echo $nl;

// Note that in the syntax above, 'elseif' is used not 'else if'.

?>

<h2>1.16 - LOOPS - BREAK AND CONTINUE STATEMENTS</h2>

<?php

// Loops are used to execute statements multiple times. PHP supports 'while', 'do-while',
// 'for' and 'foreach' loops.

// while loops
// Syntax:
// while (condition) {
//    run the following codes here
// }
// Runs the block of codes continuously as long the condition is met
$i = 0;         // our 'counter' variable.
while ($i < 10) {
    echo $i++, ', ';
}
echo $nl;
// Incrementing the '$i' counter ensures that the loop eventually stops. If not we
// run into an infinite loop which continues the execute that block of code (print
// the current value of '$i' forever. If the $i is initially is some value greater
// than zero, the loop will not start and the block of codes is not executed.

// Another way to initiate infinite loops is by using TRUE as the condition literally.
// However, a break-out condition is usually implemented to prevent the loop from
// running infinitely.
// 'break' statement allows us to break/exit a loop prematurely (i.e. before it finishes)
// Hence, the code below will have the same effect as the one above
$i = 0;
while (true) {
    if ($i > 10) {
        break;
    }

    echo $i++, ', ';
}
echo $nl;
// Loops can be nested one in another as in if-else statements and the break statement
// can take an extra value to indicate how many levels of loops it should break out from.
// By default, the value is 1 which exists it from the current loop. For example
$i = 0;
while (true) {
    while ($i > 10) {
        break 2; // breaks out of the current loop and the one enclosing it too
    }

    echo $i++, ', ';
}
echo $nl;
// The 'continue' statement is used to tell the loop to NOT exit the loop prematurely
// but to forget about the current loop and go on to the next one.
// Similar to the break statement, it can take an argument to indicate how many
// nested loops you can 'continue'.
// The following code prints out odd numbers while iterating from 0 to 10.
$i = 0;
while ($i < 15) {
    if ($i % 2 === 0) {
        $i++;       // incrementing '$i' here too, so we don't run into an infinite loop
        continue;
    }

    echo  $i++, ', ';
}
echo $nl;

// An alternative syntax to the above while loop usually used in embedding pieces
// of PHP into HTML is:
$i = 0;
while ($i < 15):
    if ($i % 2 == 0) {
        echo  $i++, ', ';
        continue;
    }

    $i++;

endwhile;
echo  $nl;

// DO WHILE loop
// 'DO WHILE' loop is similar to the 'while' loop but guarantees that
// the statements or block of codes in the loop will run once (even if the condition is
// not satisfied), before it goes on to check/access the condition.
$i = 25;
do {
    // This block of code must run once, even if $i is not less than 15
    echo $i++, ', ';
} while ($i < 15);
echo $nl;

// FOR Loop
// 'FOR' loop takes three expressions separated by semicolons. The first is executed once;
// The second specifies the condition which is evaluated for each iteration checking whether
// the loop should go on or terminate. And the third one is run at the end of every iteration
// usually to increment the loop.
for ($i = 0; $i < 15; $i++) {
    echo  $i, ', ';
}
echo $nl;

// Any of three statements is not required and can be omitted.
// The code below initiates an infinite loop.
// for (; ; ) {
//      // some codes go here...    ;
// }

// The three statements do not need to be just one expression. It can be more expression
// separated by commas.
for (
        $i = 0, $len = strlen("Hello");
        print $i, $i < 10;      // the last expression determines if the loop should continue.
                                // the 'print' function is called first before evaluating the conditions.
        $i++
);
echo $nl;

// FOR loop is commonly used to iterate over strings or array.
// You use 'strlen' function to get the length of a string, and
// 'count' function to get the number of items in an array.
// NB: This can also be achieved with a 'while' or 'do-while' loop.
$text = "Hello, World!";
for ($i = 0; $i < strlen($text); $i++) {
    echo $text[$i], $nl;
}

// The code below is a better to achieve the same result, taking performance issues
// into consideration. In the code below, we prevent calling the function 'strlen' multiple
// time which literally gives the same result each time.
// It is generally best practice to avoid running expensive function calls multiple times
// as long they do not change over time. In loops, function calls are kept at a minimum by
// creating a variable holding the value which can be used multiple times without requesting
// for the value each time.
for ($i = 0, $length = strlen($text); $i < $len; $i++)
    echo $text[$i], $nl;

// FOREACH loop
// 'FOREACH' loop is used to iterate over the items of an array or objects
$programmingLanguage = ['php', 'java', 'c++', 'go', 'rust'];

foreach ($programmingLanguage as $language) {
    echo  $language, $nl;
}

// On every iteration, the current item is assigned to the '$language' variable
// which is accessible inside the loop. We can also access the key if we wish to
// by replacing '$language' with '$key => $language' and the '$key' variables is the
// key of the current item. For indexed array, the key is numeric, for associative, it
// would be some strings which is the key for that current item.
// The '&' sign is not required, and it basically gives the current item (as usual) but not
// by value but by reference, and once we modify it inside the for loop, the original
// array is changed.
foreach ($programmingLanguage as $index => $language) { // here we used index, it's up to you!
    echo  $index + 1, '. ', $language, $nl;
    $language = 'php';
}
print_r($programmingLanguage); // the original array is modified
echo  $language, $nl;   // the '$language' variable is not destroyed (i.e. still accessible) even after the loop
                        // with its value as the last value it had before leaving the loop. This could,
                        // unfortunately, be a source of bugs if it is used unintentionally here.
                        // This is not just for passing by reference, although this can be more dangerous as
                        // modifying it anywhere affects the original array as it still references
                        // the last element in the array.
// A quick fix to that might be to destroy the variable yourself immediately after the loop using
// the 'unset' function passing the variable to the function

// The code below uses the 'foreach' loop to iterate over the items of an associative
// array:
$user = [
    'name' => 'Franklin',
    'email' => 'franklynpeter2006@gmail.com',
    'skills' => ['php', 'c', 'javascript']
];

foreach ($user as $key => $value) {
    echo $key . ': ';

    if (is_array($value)) {
        foreach ($value as $skill) {
            echo  $skill . ' - ';
        }
    } else {
        echo $value . $nl;
    }
}

// Similar to the others we've seen, there is another syntax for the 'foreach' loop
// commonly used in embedding PHP in HTML. This also works for the 'for' loop too.
//foreach (condition):
//    some code goes here
//endforeach;

?>

<h2>1.17 - PHP SWITCH STATEMENT</h2>

<?php

// PHP Switch Statement

// SWITCH statement allows us to write more compact if-else statements.
// Snytax:
//switch (expression) {
//    case option1:
//        do something if option1 matches expression
//        break;
//
//    case option2:
//        do something if option2 matches expression
//        break;
//
//    ...
//
//    case option-n:
//        do something if option-n matches expression;
//        break;
//
//    default:
//        do this if other options from 1, 2, ..., n do not match expression;
//        break;
//}

// Switch evaluates the expression and checks if it matches the options given one after
// the other. Once it finds one, it executes it and more importantly if the break statement
// is not used to break out of the statement, it goes on to execute the remaining blocks (even up to
// the 'default' block) for other conditions even if they do not match the expression. This behaviour
// may be desirable in certain scenarios if you want the same block of code to run for the same options
// or scenario. Also, the switch statement uses loose equality to match, thus type casting is done when
// checking for a match. The 'default' block is not mandatory and can be omitted but it must be the last
// block if it used.

$paymentStatus = 'paid';

switch ($paymentStatus) {
    case 'paid':
        echo "Paid";
        break;

    case 'rejected':
    case 'decline':     // Leveraging 'switch' fall-through mechanism
        echo  'Payment Declined';
        break;

    case 'pending':
        echo 'Pending Payment';
        break;

    default:
        echo 'Unknown Payment Status';
}
echo  $nl;

// The switch statement is generally better when matching a single expression against
// a different number of options. The expression is also evaluated once.
// The 'break' statement only breaks out of the switch statement. If you have loop enclosing
// the switch statement, and you wish to break out of the loop too, you will have to specify that
// inside the loop or add an extra argument to the break when used in the switch which tells it
// the number of levels to break out from.
// In the switch statement, the 'continue' keyword works the same way as 'break' and PHP will throw
// a warning when you use it.

?>


<h2>1.18 - 1.18 - PHP MATCH EXPRESSION</h2>

<?php
// MATCH expression

// The 'match' expression was introduced in PHP 8 and is similar to the
// 'switch' statement. It takes an expression, evaluates it and matches
// it with some key-value pairs. If a 'key' matches the expression, the
// 'value' which is an expression is evaluated and the return value of
// evaluating such expression is returned. Hence, a 'match' expression
// can be assigned to a value.
// => The 'match' expression does not use fall-through, the value found is
// returned immediately, therefore, there is no need for a 'break'. If,
// we however want the same value to returned for different conditions,
// you can do this by separating the keys with commas.
// => A default fallback is not necessarily required for a 'match' expression.
// However, the 'match' expression is exhaustive meaning that the 'expression'
// must find a match in the keys specified and if it doesn't, it throws
// a fatal error. Thus, it can be necessary to have a default return value
// to be used. This is done using 'default' as the key and with the corresponding
// expression as 'value'.
// => The 'match' expression uses 'STRICT COMPARISON' when matching for values.
// Syntax:
//match (expression) {
//    key1 => value1;
//    key2 => value2;
//    key3 => value3;
//    ...
//    key-n => value-n;
//    default => default-value-expression;
//}

// The code above does something similar as in the last example
// implemented using the 'match' expression.
$paymentStatus = 7;

$paymentStatusDisplay = match ($paymentStatus) {
    1 => "Paid",
    2,3 => "Payment Declined",  // return this when '$paymentStatus' is either 2 or 3
    0 => "Pending Payment",
    default => "Unknown Payment Status"
};
echo 'The return value of the <i>match</i> expression is: ', $paymentStatusDisplay, $nl;

// The 'keys' and 'values' can be simple expressions as above or even more
// complex expressions. The expressions for the 'keys' are evaluated and
// matched against the given 'expression' and the evaluation of the expression
// for the 'value' is returned. The limitation of this is that you can't easily have
// multiple lines of codes as in the switch statement.


?>

<h2>1.19 - PHP RETURN, DECLARE & GOTO STATEMENTS</h2>

<?php

/* return / declare / goto */

/*
 * RETURN
 *
 * The return statement when used inside the function stops the execution of that function
 * and returns a value which can be assigned to a variable, or used as an argument to another
 * function call.
 * When used in the global scope, i.e. outside a function, it stops/terminates the execution
 * of the current script. You can also specify an expression to be returned when it is used in
 * the global scope, and if no value is specified, the default is NULL.
 *
 */


/*
 * DECLARE
 *
 * The 'declare' statement is used to set execution directives. Three directives that can be declared
 * using the 'declare' statement are the: ticks, encoding and strict_types
 *
 * declare - ticks
 * Some statements are tickable while others are not. This means, that while the parser is evaluating
 * the expressions one after the other, some statements cause a tick (or an event) and are said to
 * be tickable while some others are not. Generally, conditions expressions and argument expressions
 * are not tickable. The 'declare - ticks' syntax below:
 *
 *  >>> declare(ticks=N);
 *
 * tells the parser to cause a tick (event) for every N-low level tickable statements
 * when executing the codes below it. 'N' must be a literal; constants and variables are not allowed
 * to be used as 'N' as directives are handled during compilation.
 * The 'register_tick_function' function is used to register an event handler that is called anytime
 * a tick is caused.
 *
 * Consider the code below:
 */
// declare - ticks
function onTick() {
    echo  'Tick <br />';
}

register_tick_function('onTick');

declare(ticks=1);
//declare(ticks=3);

$i = 0;         // Causes a tick
$length = 10;   // Causes a tick

echo  $nl;      // Causes a tick

while ($i < $length) {
    echo  $i++ . '<br />';      // Causes a tick
}

unregister_tick_function('onTick'); // unregister tick


// From the code above, when it runs, we can see that a tick is caused just before the expression is
// evaluated.
// 'Tick' directive has few but very important use cases especially in profiling and bench marking
// your codes for optimization


/*
 * declare - encoding
 * This directive is used to specify the encoding of a script. This directive is barely used too like
 * the 'declare - ticks' directive.
 *
 * Syntax:
 *
 * >>> declare(encoding='...');
 *
 * where ... is the encoding value.
 */



/*
 * declare - strict_types
 * This is the most commonly used directive. It is used to turn strict type checking on or off.
 * PHP by default does not check type strictly but rather coerces a value into the suitable type
 * in the given situation. When strict type checking is enabled, it ensures that the correct type
 * is assigned to the suitable type, else a TypeError is thrown.
 * The 'declare - strict types' must be the first statement in a file where it is used and only
 * applies to that file; files included are not considered. Type hinting is used with the strict
 * type checking to give a hint of what type of variable a function and the function call is not
 * expected to provide arguments to the functions of the same type.
 *
 * Syntax:
 *
 * >>> declare(strict_types=1);
 *
 * // A function declared with type hinting
 * int function sum(int $x, int $y) {
 *      return $x + $y;
 * }
 */

?>

<h2>1.20 - INCLUDE AND  REQUIRE</h2>

<?php

/* require / require_once / include / include_once */

// To easily organise our code, we will have to split our codes into different files and be able
// to include them when needed. To include files, PHP provides the: require, require_once, include,
// include_once statement.
//
// Syntax:
// >>> include <file-path>;
// >>> include_once <file-path>;
// >>> require <file-path>;
// >>> require_once <file-path>;
//
// The difference between 'include' (or 'include_once') and 'require' or ('require_once') is that
// 'include' throws a warning when the file is not found but goes on to continue the execution of
// the remaining part of the script while 'require' throws a 'fatal error' and stops the execution
// of that script.
// When the file path is not specified, the files are looked up from the default directory set in
// the php.ini configuration file.in the 'include_path' section.
// 'include_once' and 'require_once' includes the file only once when it has not been included for
// the first time.
// An extra note is that 'include', ..., etc. return FALSE on failure and 1 on success unless you
// add a return statement in the included file in which case the value returned is also returned.
// The value returned can also be assigned to a variable, manipulated and combine like/with other
// PHP expressions too.

// >>> $result = include "../path/to/file/my_file.php";

// Variables and functions included from other scripts can be accessed, modified and possibly
// destroyed too. One good use case of include is to include functionality that we want to access
// from different files. Another use case is including parts of a web page (e.g. header or footer) that repeated or do not
// necessary change to avoid unnecessary copy-pasting and code duplication.
// Files which return a value in the global scope can come in handy when working with configuration
// files. When these files are included, the values returned by the script is returned and can be
// assigned to a variable.
// Another use case of file includes is to get the contents of the file without printing them. This
// is done using the output (buffer) control functions: 'ob_start()', 'ob_get_clean()', etc.
// Consider the code example below:

ob_start();                     // start output buffering, items to be printed on the screen are now
                                // stored in the buffer temporarily
include "./basic-php-pt1.php";  // include the file. By default, display the content of the file to
                                // the screen, but the content is stored in the buffer and not printed
$basic_php_pt1_content = ob_get_clean();    // get the content of the buffer and assign to a variable.

echo "<h3>Including another file:</h3> <br/>";
echo '<div style="color: grey; border: 1px solid grey">';

var_dump($basic_php_pt1_content);

echo  "</div> $nl";
echo  "THE END! ):", $nl;