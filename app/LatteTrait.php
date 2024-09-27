<?php

declare(strict_types=1);

namespace App;

trait LatteTrait
{
    protected string $latteMilkType = 'cowbell';

    public function makeLatte()
    {
        echo self::class, ' is making latte with ', $this->latteMilkType, '... <br/>';
    }

    public function setMilkType(string $milkType) {
        $this->latteMilkType = $milkType;

        return $this;
    }

    // Traits have other features like:
    // -> Traits allows us to share features instead of copying and pasting
    // -> A class can 'use' multiple traits and a trait can also use other traits.
    // -> When there is a method collision between methods defined in a class, a parent class and
    //      the trait, the precedence is: Class Method > Trait Method > Parent Class Method
    // -> A fatal error will occur if a class attempts to use multiple traits that have the same
    //      method name. You can resolve which method to use with the 'insteadof' keyword or you
    //      could also alias conflicting methods so that it can be referred using the new name done
    //      using the 'as' keyword.
    // -> The visibility or access level of a method from traits can be modified when using
    //      the trait, although this is not recommended.
    // -> The __CLASS__ magic constant when used in a trait always refers to the class using
    //      that trait (much like self::class).
    // -> Traits can contain 'abstract' methods and do not need to be declared 'abstract'.
    // -> Methods declared as 'final' can be overriden by the class using it
    // -> Traits can also contain properties, however, the signature of that property
    //      should always be the same if the class using the trait wants to redefine it.
    // -> Static properties defined in a trait belongs individually to the class using the 
    //      trait (in constrast to inheritance). 

}