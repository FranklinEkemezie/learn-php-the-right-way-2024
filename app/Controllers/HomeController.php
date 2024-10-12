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

    public function learnPHPPDO():View|string
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

        $email = 'maya@dung.com';
        $name = 'Maya Dung';
        $isActive = (string) mt_rand(0, 1);
        $amount = rand(1, 10000);

        echo '<pre> <b>Environment  Variables: </b>';
        var_dump($_ENV);
        echo '</pre> <br/>';

        $dsn = <<<DSN
        {$_ENV['DB_DRIVER']}:
        host={$_ENV['DB_HOST']};
        dbname={$_ENV['DB_DATABASE']}
        DSN;

        echo "DSN: ", $dsn, '<br/>';

        $db = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']);

        // Begin a transaction
        $db->beginTransaction();

        try {
            // Prepare new user statement
            $createUserQuery = <<<SQL
            INSERT INTO users (email, full_name, is_active)
            VALUES (?, ?, ?)
            SQL;

            $newUserStmt = $db->prepare($createUserQuery);

            // Prepare new invoice statement
            $createInvoiceQuery = <<<SQL
            INSERT INTO invoices (amount, user_id)
            VALUES (?, ?)
            SQL;

            $newInvoiceStmt = $db->prepare($createInvoiceQuery);

            // Insert new user
            $newUserStmt->execute([$email, $name, $isActive]);

            // Insert new invoice
            $userId = (int) $db->lastInsertId();

            $newInvoiceStmt->execute([$amount, $userId]);

            $db->commit();

        } catch (\PDOException $e) {
            if($db->inTransaction()) {
                $db->rollBack();
            }

            echo 'Something went wrong! <br/>';

            echo $e->getMessage(), '<br/>';
        }

        // Display newly created user
        $fetchUserQuery = <<<SQL
        SELECT
            invoices.id AS invoice_id,
            amount,
            user_id,
            full_name
        FROM invoices
        INNER JOIN users ON user_id = users.id
        WHERE email = ?
        SQL;

        $fetchUserStmt = $db->prepare($fetchUserQuery);

        $fetchUserStmt->execute([$email]);

        $userCreated = $fetchUserStmt->fetch(PDO::FETCH_ASSOC);

        echo '<pre>';
        var_dump($userCreated);
        echo '</pre>';


        return <<<HTML
        <div>
            <h1>PHP Transactions</h1>

            <p>Run multiple queries all and once...</p>
            <p>Rollback if any fails...</p>
            <p>Commmit if all succeeds</p>
        </div>
        HTML;
    }
}
