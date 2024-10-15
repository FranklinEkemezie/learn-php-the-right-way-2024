<?php

declare(strict_types=1);

namespace App\Models;

use App\Exception\DbException;

class SignupModel extends BaseModel
{

    public function signup(UserModel $userModel, InvoiceModel $invoiceModel): int
    {
        
        try {
            // Begin transaction
            $this->db->beginTransaction();

            // Create new user
            $userCreatedId = $userModel->create();

            // Create Invoice
            $invoiceModel->create($userCreatedId);

            $this->db->commit();

            return $userCreatedId;
        } 
        catch (\Exception $e) {
            $this->db->rollBack();

            throw new DbException($e->getMessage(), (int) $e->getCode());
        }


    }
}