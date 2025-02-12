<?php

namespace App\Controllers;

class GeneratorExampleController
{



    public function index(): string
    {
        $start = 1;
        $end = 10;
        $numbers = $this->lazyRange($start, $end);

//        echo '<pre>';
//        print_r($numbers);
//        echo '</pre>';

//        echo $numbers->current() . '<br/>';
//        $numbers->next();
////
//        echo $numbers->current() . '<br/>';
//        $numbers->next();
////
//        echo $numbers->current() . '<br/>';
//        $numbers->next();
////
//        echo $numbers->current() . '<br/>';
//        $numbers->next();
////
//        echo $numbers->current() . '<br/>';
//        $numbers->next();
////
//        echo $numbers->current() . '<br/>';
//        $numbers->next();
////
//        echo $numbers->current() . '<br/>';
//        $numbers->next();
//
//        echo $numbers->current() . '<br/>';

        foreach ($numbers as $key => $number) {

            echo "$key: $number <br/>";
        }


        return "";
    }

    private function lazyRange(int $start, int $end): \Generator
    {
//        echo "Hello world <br/>";

//        for ($i = $start; $i <= $end; $i++) {
//
//            echo "<br/>";
//
//            yield $start ;
//
//            echo "Hello, world after yield <br/>";
//
//            yield $end;
//
//            echo "<br/>";
//
////            yield $i;
//        }

        for ($i = $start; $i <= $end; $i++) {

            yield $i * 5 => $i;
        }
    }

}