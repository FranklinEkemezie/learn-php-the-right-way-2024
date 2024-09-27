<?php

declare(strict_types=1);

namespace App;

// Some class to demonstrate some PHP magic constants

class Invoice
{
    // Some properties (just for __debugInfo() magic method illustration...see the last method)
    private float $total;
    private int $id  = 1;
    private string $accountNumber = '50376873576305';

    private array $data = [];

    // __get is called when trying to get some non-existing
    // property or inaccessible property
    public function __get($name)
    {
        if(key_exists($name, $this->data))
            return $this->data[$name];

        return null;
    }

    // __set is called when trying to set some non-existing property
    // or inaccessible property
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    // __isset is called when
    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    // __unset is called when trying to unset some non-existing property
    // or inaccessible property
    public function __unset($name)
    {
        if(key_exists($name, $this->data))
            unset($this->data[$name]);
        
    }

    protected function process(float $amount, string $description)
    {
        var_dump($amount, $description);
        echo "<br/>";
    }

    // __call is called when trying to call some non-existing property
    // or inaccessible property
    public function __call(string $method, array $args)
    {
        if(method_exists($this, $method)) {
            echo "Calling $method method from ", $this::class, " <br/>";
            call_user_func_array([$this, $method], $args);
        }
        else {
            echo "Method does not exist. :( <br />";
        }

    }

    public static function __callStatic(string $method, array $args)
    {
        var_dump($method, $args);
        echo "<br/>";
    }

    public function __toString(): string
    {
        return 'Hello';
    }

    // __invoke is called when an object instance is invoked or called
    // as a method. For example:
    // $invoice = new Inovice();
    // $invoice();      // object instance is called like a function or instance
    // Specifying the '__invoke()' function makes the object instance callable, i.e.
    // it returns `true` when the object is passed to the `is_callable()` function.
    public function __invoke()
    {
        var_dump('Invoked');
    }

    // __debugInfo() is called when an object is to be displayed on the screen typically
    // using `var_dump()`. By default, all properties (both private, protected and public)
    // are displayed; we could override that using this method, maybe in a case we want to 
    // hide sensitive information. The magic method should return NULL if no properties
    // should be displayed, or an (associative) array containing the key-value pairs; the keys
    // being the property to display and the value what should be displayed

    public function __debugInfo(): ?array
    {
        return [
            'id' => $this->id,
            'accountNumber' => substr($this->accountNumber, 0, 4) . "****" . substr($this->accountNumber, -4)
        ];
    }

}