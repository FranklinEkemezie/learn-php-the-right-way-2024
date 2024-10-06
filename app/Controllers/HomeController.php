<?php

declare(strict_types=1);

namespace App\Controllers;

use App\LayoutView;
use App\View;

class HomeController
{
    public function index(): View
    {
        return View::make('index', array_merge(['foo' => 'bar'], $_GET))
            ->useLayout(LayoutView::INDEX, ['title' => 'Home | Welcome']);
    }

    public function upload(): View
    {
        $receipt_fileId     = uniqid('Invoice_Receipt_');
        $receipt_extension  = pathinfo(STORAGE_DIR . '/receipts/' . $_FILES['receipt']['name'][0])['extension'];
        $receipt_filename   = "$receipt_fileId.$receipt_extension";
        $receipt_filepath   = STORAGE_DIR . "/receipts/$receipt_filename";
        $upload_filepath    = $_FILES['receipt']['tmp_name'][0];

        if(! move_uploaded_file($upload_filepath, $receipt_filepath)) {
            throw new \Exception('An error occurred uploading file.');
        }

        return View::make('upload', compact('receipt_filename', 'receipt_filepath'))
            ->useLayout(LayoutView::INDEX, ['title' => 'Home | Upload']);
    }
}