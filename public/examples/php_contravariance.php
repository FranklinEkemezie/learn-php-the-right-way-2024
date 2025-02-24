<?php

declare(strict_types=1);


// Food class
class Food
{
}

// AnimalFood class
class AnimalFood extends Food
{
}


// Abstract Animal Class
abstract class Animal
{

    protected string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    abstract public function speak();

    public function eat(AnimalFood $food)
    {
        echo $this->name . " eats " . get_class($food);
    }
}

// Dog class inheriting from Animal
class Dog extends Animal
{

    public function speak()
    {
        echo $this->name . " barks";
    }

    public function eat(Food $food)
    {
        echo $this->name . " eats " . get_class($food);
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

$catFood = new AnimalFood();
$kitty->eat($catFood);
echo PHP_EOL;

$doggy = (new DogShelter())->adopt('Mavrick');
$doggy->speak();
echo PHP_EOL;

$banana = new Food();
$doggy->eat($banana);
echo PHP_EOL;
