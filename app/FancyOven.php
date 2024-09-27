<?php

declare(strict_types=1);

namespace App;

class FancyOven
{

    public function __construct(
        // 'FancyOven' class has a 'ToasterPro' functionality but
        // it is not a 'ToasterPro' class
        private ToasterPro $toasterPro
    )
    {

    }

    public function fry()
    {
        // Fry some stuff
    }

    public function toast()
    {
        $this->toasterPro->toast();
    }

    public function toastBagel()
    {
        $this->toasterPro->toastBagel();
    }
}