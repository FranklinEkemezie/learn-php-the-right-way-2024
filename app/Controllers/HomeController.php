<?php

declare(strict_types=1);

namespace App\Controllers;

use App\LayoutView;
use App\View;

class HomeController
{
    public function index(): View
    {
        $viewPath = $_GET['viewPath'] ?? '';
        $params = array_merge(['foo' => 'bar'], $_GET, compact('viewPath'));

        return View::make('index', $params)
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

        // Redirect to the download page to download the file
        header("Location: /download?f=$receipt_filename");

        // and, exit to ensure code below does not run
        exit;

        // return View::make('upload', compact('receipt_filename', 'receipt_filepath'))
            // ->useLayout(LayoutView::INDEX, ['title' => 'Home | Upload']);
    }

    public function download(): View
    {
        // Check if the file is passed and is available
        if (! isset($_GET['f'])) {
            // Go to home page
            header('Location: /');
        }

        $download_filename = STORAGE_DIR . 'receipts/' . $_GET['f'];

        // Check if the file passed exists
        if (! file_exists($download_filename)) {
            // Go to home page
            header('Location: /');
        }

        $mime_type = mime_content_type($download_filename);
        if($mime_type === false) {
            // Go to the home page
            header('Location: /');
        }

        $filename = uniqid('Receipt_download_') . "." . pathinfo($download_filename)['extension'];

        header("Content-Type: $mime_type");
        header("Content-Disposition: attachment;filename=$filename");

        readfile($download_filename);
        exit;
    }
}
