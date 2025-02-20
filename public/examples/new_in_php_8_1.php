<?php

declare(strict_types=1);



function sum(float ...$num): float
{
    return array_sum($num);
}

//Previous syntax
//$closure = Closure::fromCallable('sum');

//First-class callable syntax
$closure = sum(...);

var_dump($closure);
var_dump($closure(2, 3, 5));

exit();

$list = ['a', 'b', 'c'];
$notList = [1 => 'a', 'b', 'c'];

var_dump(array_is_list($list));
var_dump(array_is_list($notList));
echo PHP_EOL;

$listFiltered = array_filter($list, fn(string $value) => $value !== 'b');

var_dump($listFiltered);
var_dump(array_is_list($listFiltered));
echo PHP_EOL;

$listFilteredModified = array_values($listFiltered);

var_dump($listFilteredModified);
var_dump(array_is_list($listFilteredModified));

echo PHP_EOL;

exit();

function foo(): never
{
    echo "This function's return type is 'never'" . PHP_EOL;
    exit();
}

foo();


// Pure intersection type demo

interface Payable
{
    public function pay();
}


interface Syncable
{
    public function sync();
}


class MyService
{

    public function __construct(
        private Syncable&Payable $entity
    )
    {

    }

    public function handle()
    {
        $this->entity->pay();
        $this->entity->sync();
    }
}


class SyncablePayableEntity implements Syncable, Payable
{

    public function pay()
    {
        echo  "Paying something..." . PHP_EOL;
    }

    public function sync()
    {
        echo "Syncing payment..." . PHP_EOL;
    }

}


$myService = new MyService(new SyncablePayableEntity());
$myService->handle();

exit();


// Readonly properties

class Address
{

    public function __construct(
        public readonly string $street,
        public readonly string $city,
        public readonly string $state,
        public readonly string $postalCode,
        public readonly  string $country='US'
    ) {

    }
}

$address = new Address(
    '123 Main Str.',
    'New York',
    'NY',
    '100011',
    'US'
);

//$address->street = 'abc';

echo $address->street . PHP_EOL;


// Enumerations

enum PaymentStatus: int
{

    case PAID = 1;
    case VOID = 2;
    case DECLINE = 3;

    public function text(): string
    {
        return match ($this) {
            self::PAID => 'Paid',
            self::VOID => 'Void',
            self::DECLINE => 'Decline'
        };
    }

}

var_dump(PaymentStatus::PAID->text());
var_dump(PaymentStatus::PAID->value);

// you can type your functions or methods to accept only
// a specific set of values
function printStatus(PaymentStatus $status): void
{
    echo "Status: {$status->name}";
}

printStatus(PaymentStatus::DECLINE);
//printStatus(1); // does not work

exit();

// Array unpacking with strings

$array1 = ['a' => 1, 2, 3];
$array2 = [4, 'b' => 5, 6];

$array3 = [...$array1, ...$array2];

print_r($array3);


