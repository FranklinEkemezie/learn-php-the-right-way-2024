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


// 2.18 - Cloning Object and __clone() magic method

// We can create a new object of a class using the 'new' keyword.
$invoice1 = new Invoice(4, 'Invoice');

// Or, using the 'new static()' keyword as implemented in the function below
$invoice2 = Invoice::make(4, 'Invoice');

// Or, even using an already existing object
$invoice3 = new $invoice1(4, 'Invoice');

// = (assignment operator) does not create a new object, but points to the same object.
$invoice4 = $invoice1;

echo '<pre>';
var_dump($invoice1, $invoice2, $invoice3, $invoice4);
echo '</pre>'; echo '<br/>';

// We can create copies or 'clone' object which have the same properties but are
// different instances of the object stored in different places in the memory
// This can be done using the 'clone' keyword
$invoice1Clone = clone $invoice1;

echo '<pre>';
var_dump($invoice1, $invoice2, $invoice3, $invoice4, $invoice1Clone);
echo '</pre>'; echo '<br/>';

// Check if clone points to the same object
echo 'Clone points to the same object as orginal? ', $invoice1Clone === $invoice1 ? 'Yes' : 'False', '<br/>';

// We cen hook into the 'clone' operation of an object using the __clone() magic method
// and perform some operation e.g. ensuring that the IDs are different.
// Also, notice that the constructor is not called during cloning, otherwise the clone in
// our previous example would have received a different unique ID.
// The __clone() magic method is called after a clone operaiton has been done and we can use 
// it in our example to reassign a new unique ID by simply adding:

/* >>>
    public function __clone()
    {
        $this->id = uniqid('Invoice_');
    }
*/

// 2.19 - Serialization of Objects and Serialize Magic methods
// Serialization is a process of converting an object into string type.
// We can serialize common PHP built-in types: strings, integers, floats, arrays, booleans, but not
// functions (closures). We can also serialise objects.
// Use the 'serialize()' function to serialise a value and 'unserialize()' to 
// unserialize a serialised value, which emits a notice (returning FALSE) if unserialisation
// fails. Unserializing the serialized value FALSE gives false so be sure to check if the original serialized string
// is the same as the serialised value of FALSE to be sure whether it is a FALSE value or an error occurs

echo
    serialize('Hello, World!'), '<br/>',
    serialize(23), '<br/>',
    serialize(23.45), '<br/>',
    serialize(true), '<br/>',
    serialize(false), '<br/>',
    serialize(NULL), '<br/>',
    serialize([1, 2, 3]), '<br/>',
    serialize(['a' => 1, 'b' => 2, 'c' => 3]), '<br/>',
    serialize(new Invoice(23.45, 'Invoice Here'));
echo '<br/>';

// Notice that a serialised string follows some recognizable pattern
// You can serialize values when you want to store them in a database,
// or send them over a network request ideally as strings.

var_dump(
    unserialize('a:3:{s:1:"a";i:1;s:1:"b";i:2;s:1:"c";i:3;}'),
);
echo '<br/>';

// Serialisation of objects, creates deep clone or copy of an object,
// as shown in the example down below:
// However, during cloning, only the data for the properties are retained, you have 
// to have the class definitions to call methods of that object.
$i1 = unserialize(serialize($invoice1));

var_dump($i1); echo '<br/>';
echo $i1 == $invoice1 ? 'Exact copies' : 'Not exact copies', '<br/>',
    $i1 === $invoice1 ? 'Same object' : 'Different objects', '<br/>';
var_dump($i1::make($i1->amount, $i1->description));

// We can change the way objects are serialised or unserialised.
// Previously, we could do this by implementing the 'serialize()' and 'unserialize()'
// methods of the 'Serializable' interface. This is however going to be deprecated soon
// and won't be supported in future versions of PHP
// Instead, we can use one or more of the four magic methods: __sleep(), __wake(),
// __serialize(), and __unserialize().
// -> Both __wake() and __serialize() are called before an object is about to be serialized.
//      The functions have to return an array indicating which properties to serialize. While
//      __wake() requires that the array must be a (numeric) indexed arrya containing the names
//      of the properties of the object to be serialised, __serialise() added later provides more
//      functionality of what to return as an object to be serialised, so we can represent the state
//      of the current object we want to serialize as an associative array

// -> __sleep(), and __unserialize() behave similar to their other counterparts. In __wake() or 
//      __unserialize(), we can specify certain actions we want to take place after unserialization
//      has taken place. However, __unserialize() receives an (associative) array which contains the
//      data (essentially, properties) of the unserialised data.

// Summarily, you could use __sleep() and __wake() magic methods, or more preferrably using 
// _serialize() and __unserialize() magic method. In either case, where __sleep() and _serialize() is used, and
// vice servar, the later ones __serialize() and __unserialize() magic methos take precedence.

$myInvoice = new Invoice(45.11, 'My Invoice I.', '593598590254');

$myInvoiceStr = serialize($myInvoice);

$myInvoiceUnStr = unserialize($myInvoiceStr);

var_dump($myInvoiceStr, $myInvoiceUnStr);