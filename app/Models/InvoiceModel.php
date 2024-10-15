<?php

declare(strict_types=1);

namespace App\Models;

use App\Entities\Invoice;
use App\Exception\DbException;

class InvoiceModel extends BaseModel
{
    public function __construct(private Invoice $invoice)
    {
        parent::__construct();
    }

    public function create(int $userId): int
    {
        $query = <<<SQL
        INSERT INTO invoices (amount, user_id)
        VALUES (:amount, :user_id)
        SQL;

        // Prepare statement
        $stmt = $this->db->prepare($query);

        try {
            $stmt->execute([
                'amount'    => $this->invoice->amount,
                'user_id'   => $userId
            ]);
        } catch (\PDOException $e) {
            // Check if the error is due to duplicate entry
            if ((int) $e->getCode() === 23000) {
                throw new DbException('Invoice created previously', (int) $e->getCode());
            }

            throw new DbException($e->getMessage(), (int) $e->getCode());
        }

        return (int) $this->db->lastInsertId();
    }
}