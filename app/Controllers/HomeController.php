<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Entities\Invoice;
use App\Entities\User;
use App\Models\InvoiceModel;
use App\Models\SignupModel;
use App\Models\UserModel;
use App\View;

class HomeController
{
    public function index(): View
    {
        $viewPath = $_GET['viewPath'] ?? '';
        $params = array_merge(['foo' => 'bar'], $_GET, compact('viewPath'));

        return View::make('index', $params, 'Home | Welcome');
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

    public function learnPHPPDO(): View|string
    {
        // Go to HomeController2.31.php:75 for the full implementation

        return <<<HTML
        <div>
            <h1>This is PDO</h1>

            <p>PDO is a PHP extension that allows you to work with databases</p>
            <p>Unlike, <code>mysqli</code> extension, you can work with many other databases,
                apart from MySQL. It also provides some other cool features - OOP, named parameters etc.</p>
        </div>
        HTML;
    }

    public function sqlTransaction(): View|string
    {
        // Go to HomeController2.31.php:181 for the full implementations

        return <<<HTML
        <div>
            <h1>PHP Transactions</h1>

            <p>Run multiple queries all and once...</p>
            <p>Rollback if any fails...</p>
            <p>Commmit if all succeeds</p>
        </div>
        HTML;
    }

    public function signup(): View
    {
        return View::make('signup/form', [
            'fullname_name'         => 'fullname',
            'email_name'            => 'email',
            'invoice_amount_name'   => 'amount'
        ], 'Signup');
    }

    public function createUser(): View|string
    {
        $fullName   = $_POST['fullname'] ?? null;
        $email      = $_POST['email'] ?? null;
        $amount     = (int) $_POST['amount'] ?? 0;

        if (! ($fullName && $email && $amount)) {
            throw new \InvalidArgumentException('Invalid form inputs');
        }

        $invoiceId = uniqid('Invoice_' . time());

        // Create entities
        $user = new User($fullName, $email);
        $invoice = new Invoice($invoiceId, $amount);

        // Signup user
        $userCreatedId = (new SignupModel())
            ->signup(new UserModel($user), new InvoiceModel($invoice));

        return <<<HTML
        <div style="text-align: center;">
            <p>User with ID: $userCreatedId created successfully!</p>

            <a href="/">Go To Home</a>
        </div>
        HTML;

    }
}