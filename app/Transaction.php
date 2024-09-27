<?php
declare(strict_types=1);

namespace App;

// DOCBLOCKS are sepcial kinds of comments which give more information
// about our code.
// They are usually used in documenting variables, constants, classes, interfaces,
// functions or methods, etc.
// They are very helpful in generating automatic API documentation for your code
// DOCBLOCKS also used 'tags' to pass specific information about what is being documented

// Annotations are special forms of comments that influence how a code runs.


/**
 * You can use the 'property' and 'method' class to indicate which properties and/or
 * methods a class (or interface, etc.) has. This does not influence the code in anyway,
 * but usually gives hint to auto-completion extensions
 * @property int $x
 * @property float $y
 * @property-read mixed $name This property is read only
 * @property-write mixed $name This property is write only
 * 
 * @method mixed someMethod(string $param1) Specifies that this class has the method
 * @method static someStaticMethod(int $x, $int $y) Specifies that this class has this static method.
 */
class Transaction
{

    /**
     * @var ?Customer Document a variable and its type.
     */
    public ?Customer $customer = null;

    public function __construct(
        private float $amount,
        private string $description
    )
    {
    }

    /**
     * What this function does
     * 
     * @param Customer $customer
     * @param float|int $amount Use the pipe | to indicate a parameter can have any of the data type.
     * 
     * @throws \InvalidArgumentException <- Give of expected exception to be thrown if need be.
     * @return bool
     */
    public function process($customer, $amount)
    {
        // process transaction

        // if failed, return false

        // otherwise, return true
        return true;
    }

    /**
     * 
     * @param Customer[] $arr <- Using the 'param' tag to indicate we expect an array of customers
     * @return void
     */
    public function foo(array $arr)
    {
        /** @var Customer $obj */
        // The '@var' tag helps supplies more information about
        // the '$obj' variable allowing better auto-completion
        foreach($arr as $obj) {
            $obj->paymentProfile;
        }
    }

}