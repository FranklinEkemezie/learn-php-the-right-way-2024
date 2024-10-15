<?php

declare(strict_types=1);

namespace App\Models;

use App\Entities\User;
use App\Exception\DbException;

class UserModel extends BaseModel
{

    public function __construct(private User $user)
    {
        parent::__construct();
    }

    public function create(): int
    {
        $query = <<<SQL
        INSERT INTO users (full_name, email)
        VALUES (:full_name, :email)
        SQL;

        // Prepare statement
        $stmt = $this->db->prepare($query);

        try {
            $stmt->execute([
                'full_name' => $this->user->fullName,
                'email'     => $this->user->email
            ]);
        } catch (\PDOException $e) {
            // Check if it is a duplicate entry error
            if ($e->getCode() === 23000) {
                throw new DbException('User already registered', (int) $e->getCode());
            }

            throw new DbException($e->getMessage(), (int) $e->getCode());
        }

        return (int) $this->db->lastInsertId();
    }
}