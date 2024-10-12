<?php

declare(strict_types=1);

namespace App\Controllers;

use App\LayoutView;
use App\View;
use PDO;

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

    public function db():View
    {
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=learnphp2024', 'root', '', [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, // set default fetch mode

                // Disable 'PDO emulated prepared statement' feature which allows
                // one to use one parameters multiple times.
                // Without this option, which is TRUE by default, parameters cannot be emulated (can not be used more than once)
                // It is best to disable it by setting it as FALSE as below, since without it:
                // - we get a INT field as integers and not strings
                // - we can use prepared statement in SQL clauses like the LIMIT clause, etc.
                // - performance is also optimised.
                
                PDO::ATTR_EMULATE_PREPARES => false
            ]);

            // $email = $_GET['email'];

            // $query = <<<SQL
            // SELECT * FROM users WHERE email = ?
            // SQL;

            // // $stmt = $db->query($query);

            // // var_dump($stmt->fetchAll());

            // echo $query, '<br/>';

            // // Prepare the statement
            // $stmt = $db->prepare($query);

            // $stmt->execute([$email]);

            // // foreach($db->query($query)->fetchAll(PDO::FETCH_OBJ) as $user) {
            // //     echo '<pre>';
            // //     var_dump($user);
            // //     echo '</pre>';
            // // }

            // foreach($stmt->fetchAll(PDO::FETCH_OBJ) as $user) {
            //     echo '<pre>';
            //     var_dump($user);
            //     echo '</pre>';
            // }

            // $email = 'Gates@Ian.com';
            // $full_name = 'Gates Ian';
            // $is_active = '1';

            // $query =
            // <<<SQL
            //     INSERT INTO users (email, full_name, is_active)
            //     VALUES (:email, :full_name, :is_active);
            // SQL;

            // // Prepare the query
            // $stmt = $db->prepare($query);

            // // Execute
            // $stmt->execute([
            //     'email'     => $email,
            //     'full_name' => $full_name,
            //     'is_active' => $is_active
            // ]);

            // Get the last insert ID
            // $id = $db->lastInsertId();
            $id = 15;

            $query =
            <<<SQL
                SELECT * FROM users WHERE id = :id
            SQL;

            // Prepare the query
            $stmt = $db->prepare($query);

            // Bind the parameters/value
            $stmt->bindValue('id', $id, PDO::PARAM_INT);

            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            echo '<pre>';
            var_dump($user);
            echo '</pre>';
        } catch (\PDOException $e) {
            echo 'Something went wrong!';
            throw new \PDOException( $e->getMessage(), (int) $e->getCode());
        }

        var_dump($db); echo '</br/>';

        return View::make('db')
            ->useLayout(LayoutView::INDEX, ['title' => '2.30 - PHP MySQL']);
    }
}
