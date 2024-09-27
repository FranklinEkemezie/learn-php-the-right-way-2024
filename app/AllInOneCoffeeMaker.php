<?php

declare(strict_types=1);

namespace App;

class AllInOneCoffeeMaker extends CoffeeMaker
{
    // Using a trait is basically copying and pasting the code.
    // It helps prevent unneccesary code duplication and helps in code re-use.

    // Basic syntax to 'use' a trait.
    // use LatteTrait;


    // Use the 'setMilkType' method from 'CappuccinoTrait' instead of that
    // from the 'LatteTrait'
    use CappuccinoTrait {
        CappuccinoTrait::setMilkType insteadof LatteTrait;
    }

    // OR, we could alias the method from 'LatteTrait'
    use LatteTrait {
        LatteTrait::setMilkType as setLatteMilkType;
    }

    // You can change the access modifier level of the method from
    // a trait; although this is not a good practice:
    // use CappuccinoTrait {
    //     CappuccinoTrait::setMilkType as private;
    // }

}