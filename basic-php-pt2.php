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
    echo $i++, $nl;
}
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

    echo $i++, $nl;
}

// Loops can be nested one in another as in if-else statements and the break statement
// can take an extra value to indicate how many levels of loops it should break out from.
// By default, the value is 1 which exists it from the current loop. For example
$i = 0;
while (true) {
    while ($i > 10) {
        break 2; // breaks out of the current loop and the one enclosing it too
    }

    echo $i++, $nl;
}
// The 'continue' statement is used to tell the loop to not exit the loop prematurely
// but to forget about the current loop and go on to the next one.
// The following code prints out odd numbers while iterating from 0 to 10.
//$i = 0;
//while ($i < 15) {
//    if ($i % 2 === 0) {
//        $i++;       // incrementing '$i' here too so we don't run into an infinite loop
//        continue;
//    }
//
//    echo  $i++, $nl;
//}
