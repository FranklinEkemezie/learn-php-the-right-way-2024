<?php

declare(strict_types=1);

use App\AllInOneCoffeeMaker;
use App\CappuccinoMaker;
use App\Checkbox;
use App\ClassA;
use App\ClassB;
use App\CoffeeMaker;
use App\CollectionAgency;
use App\DebtCollectionService;
use App\Invoice;
use App\LatteMaker;
use App\Radio;
use App\Rocky;
use App\Text;

require __DIR__ . '/../vendor/autoload.php';

$fields = [
    new Text('textField'),
    new Checkbox('checkboxField'),
    new Radio('radioField')
];

foreach($fields as $field)
{
    echo $field->render() . '<br/>';
}


// 2.11 - Interfaces and Polymorphism

$debtCollectionService = new DebtCollectionService();

// The 'collectDebt()' method exhibits polymorphism
// It can take different object instances as long as they implement
// the method it needs (being objects implementing the same interface)
$debtCollectionService->collectDebt(new Rocky());
$debtCollectionService->collectDebt(new CollectionAgency());

// 2.12 - Magic methods
$invoice = new Invoice();

// The 'Invoice' class does not possess an 'amount' property but with
// magic methods we can always override the default behaviour.

echo 'Amount isset? ', isset($invoice->amount) ? 'Yes' : 'No', '<br/>';

$invoice->amount = 15;

echo 'Amount isset? ', isset($invoice->amount) ? 'Yes' : 'No', '<br/>';

echo $invoice->amount, '<br/>';

unset($invoice->amount);

echo 'Amount isset? ', isset($invoice->amount) ? 'Yes' : 'No', '<br/>';

$invoice->process(56, 'Invoice one');
$invoice->admire(1, 2, 3);

$invoice::myFunc(4, 5, 6);

var_dump($invoice instanceof Stringable);
echo '<br/>';

// Object instance of classes are not callable, but with the
// __invoke() magic method we can override it, and make them callable
// allowing us to define what would happen if they are invoked like functions
$invoice(); echo '<br/>';
echo "Is callable? " , is_callable($invoice) ? "Yes" : "No", "<br/>";

// Finally dump the Invoice object
// __debugInfo() magic method is used to filter what is or is not displayed
var_dump($invoice);
echo '<br/>';

// 2.13 - Late static binding
echo ClassA::getName(), '<br/>';
echo ClassB::getName(), '<br/>';

var_dump(ClassA::make()); echo '<br/>';
var_dump(ClassB::make()); echo '<br/>';


// 2.14 - Traits
$coffeeMaker = new CoffeeMaker();
$coffeeMaker->makeCoffee();
echo '<br/>';

$latteMaker = new LatteMaker();
$latteMaker->makeCoffee();
$latteMaker->makeLatte();
echo '<br/>';

$cappuccinoMaker = new CappuccinoMaker();
$cappuccinoMaker->makeCoffee();
$cappuccinoMaker->makeCappuccino();
echo '<br/>';

$allInOneCoffeeMaker = new AllInOneCoffeeMaker();
$allInOneCoffeeMaker->makeCoffee();

$allInOneCoffeeMaker->setMilkType('milksi'); // refers to the 'CappuccinoTrait' method
$allInOneCoffeeMaker->makeCappuccino();

$allInOneCoffeeMaker->setLatteMilkType('choco');
$allInOneCoffeeMaker->makeLatte(); echo '<br/>';

echo $cappuccinoMaker::class, ' has made ', $cappuccinoMaker::$cappuccinoMade, '<br/>';
echo $allInOneCoffeeMaker::class, ' has made ', $allInOneCoffeeMaker::$cappuccinoMade, '<br/>';
echo '<br/>';

// Let 'AllInOneCoffeeMaker' make some more coffee
$allInOneCoffeeMaker->setMilkType('milksi'); // refers to the 'CappuccinoTrait' method
$allInOneCoffeeMaker->makeCappuccino();

$allInOneCoffeeMaker->setLatteMilkType('choco');
$allInOneCoffeeMaker->makeLatte(); echo '<br/>';


echo $cappuccinoMaker::class, ' has made ', $cappuccinoMaker::$cappuccinoMade, '<br/>';
echo $allInOneCoffeeMaker::class, ' has made ', $allInOneCoffeeMaker::$cappuccinoMade, '<br/>';

echo '<br/>';

// 2.15 - Anonymous Classes
$myObj = new class {

};

// The type hinting available is 'object'
function foo(object $obj) {
    var_dump($obj); echo '<br/>';
    echo 'Name assigned to anonymous function is: ', get_class($obj), '<br/>';
}

foo($myObj);

// Anonymous class could extend a parent class or implement an interface
// an become an instance of that class or interface.
// They can also use traits, extend abstract class and other features normal classes do have.
// You can also create anonymous classes within other classes.
// Anonymous functions are usually used in testing and mocking to create one-off
// classes that are out-of-scope of the current class without having to implement
// autoloading. When used in testing, they usually implement an interface or extend a child class
//  we want to test.
class SomeClassA
{
    public function __construct(public int $x, public int $y)
    {
    
    }

    public function foo(): string
    {
        return 'foo </br>';
    }

    public function bar(): object
    {
        return new class($this) {
            public int $xy;

            public function __construct(SomeClassA $someClassA) {
                echo $someClassA->foo();
                $this->xy = $someClassA->x * $someClassA->y;
            }
        };
    }

    // Anonymous classes can implement an interface, or
    // inherit another class
    public function fooBar(): self
    {
        return new class(
            $this->x,
            $this->y
        ) extends SomeClassA {
            public function __construct(int $a, int $b)
            {
                parent::__construct(
                    $a + $b,
                    $a * $b
                );

                // We can access the parent's 'foo' method since
                // we are inheriting it
                $this->foo();
            }
        };
    }
}

var_dump((new SomeClassA(4, 5))->bar()); echo '<br/>';

$someClassChild = (new SomeClassA(7, 3))->fooBar();
var_dump($someClassChild); echo '<br/>';
var_dump($someClassChild instanceof SomeClassA);
