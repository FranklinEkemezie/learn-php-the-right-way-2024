<?php

declare(strict_types=1);


// Abstract Animal Class
abstract class Animal
{

    protected string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    abstract public function speak();
}

// Dog class inheriting from Animal
class Dog extends Animal
{

    public function speak()
    {
        echo $this->name . " barks";
    }
}

// Cat class inheriting from Animal
class Cat extends Animal
{

    public function speak()
    {
        echo $this->name . " meows";
    }
}

// Animal Shelter interface
interface AnimalShelter
{
    public function adopt(string $name): Animal;
}

// DogShelter class
class DogShelter implements AnimalShelter
{

    public function adopt(string $name): Animal
    {
        return new Dog($name);
    }
}

// CatShelter class
class CatShelter implements AnimalShelter
{

    public function adopt(string $name): Animal
    {
        return new Cat($name);
    }
}

$kitty = (new CatShelter())->adopt('Ricky');
$kitty->speak();
echo PHP_EOL;

$doggy = (new DogShelter())->adopt('Mavrick');
$doggy->speak();
echo PHP_EOL;
