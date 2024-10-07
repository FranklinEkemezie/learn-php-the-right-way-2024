<?php

declare(strict_types=1);

namespace App\Controllers;

class LearnController {


    public function learn(): void
    {
        echo "Learning...";
    }

    public function basic(): void
    {
        // Check if a part is supplied
        $pt = $_GET['pt'] ?? null;

        if (is_null($pt) || ! in_array($pt = (int) $pt, [1, 2, 3])) {
            // Include everything
            echo <<<HTML
            <h1>PHP The Right Way - Basic </h1>
            <ul>
                <li><a href="/learn/basic?pt=1">PHP Basics Part 1</a></li>
                <li><a href="/learn/basic?pt=2">PHP Basics Part 2</a></li>
                <li><a href="/learn/basic?pt=3">PHP Basics Part 3</a></li>
            </ul>
            HTML;

            $basic_pt_heading = function(int $pt): string {
                $nxt_pt = $pt + 1;
                $nxt_pt = $nxt_pt > 3 ?: $nxt_pt;

                return <<<HTML
                <div style="text-align: center;">
                    <h1>Part $pt</h1>
                    <p>Go to <a href="#basic-pt-$nxt_pt">Part $nxt_pt</a></p>
                </div>
                HTML;
            };

            // Include Part 1
            echo $basic_pt_heading(1);
            include DOCUMENT_ROOT . "basic-php-pt1.php";

            // Include Part 2
            echo $basic_pt_heading(2);
            include DOCUMENT_ROOT . "basic-php-pt2.php";
            
            // Include Part 3
            echo $basic_pt_heading(3);
            include DOCUMENT_ROOT . "basic-php-pt3.php";
        }

        // Include the specified part
        echo <<<HTML
        <h1>PHP The Right Way - Basic ($pt)</h1>
        <ul>
            <li><a href="/learn/basic?pt=1">PHP Basics Part 1</a></li>
            <li><a href="/learn/basic?pt=2">PHP Basics Part 2</a></li>
            <li><a href="/learn/basic?pt=3">PHP Basics Part 3</a></li>
        </ul>
        HTML;
        include DOCUMENT_ROOT . "basic-php-pt$pt.php";

    }

    public function intermediate(): void
    {
        // Include the 'intermediate PHP' section
        include DOCUMENT_ROOT . "intermediate-php.php";
    }

    public function advanced(): void
    {
        echo "Advanced PHP series coming soon :)...";
    }

    
}