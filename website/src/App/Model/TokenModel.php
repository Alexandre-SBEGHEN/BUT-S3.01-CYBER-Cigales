<?php

namespace App\Model;

use App\Core\Init;

use PDOException;
use PDO;

class TokenModel
{
    public function createToken(int $id): string|false {
        $pdo = Init::getPDO();
        $token = bin2hex(random_bytes(16));
        $sql = 'REPLACE INTO token (user_id, token, exp_date) VALUES (:id, :token, DATE_ADD(NOW(), INTERVAL 10 MINUTE))';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue('id', $id, PDO::PARAM_INT);
        $stmt->bindValue('token', $token, PDO::PARAM_STR);

        try {
            $stmt->execute();
            return $token;
        } catch (PDOException $e) {
            error_log('Erreur création token : ' . $e->getMessage());
            return false;
        }
    }

    public function findToken(string $token): ?int {
        $pdo = Init::getPDO();
        $sql = 'SELECT user_id FROM token WHERE token = :token AND exp_date >= NOW()';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue('token', $token, PDO::PARAM_STR);

        try {
            $stmt->execute();
            $id = $stmt->fetchColumn();
            return $id !== false ? (int) $id : null;
        } catch (PDOException $e) {
            error_log('Erreur find_token : ' . $e->getMessage());
            return null;
        }
    }

    public function deleteToken(int $id): bool {
        $pdo = Init::getPDO();
        $sql = 'DELETE FROM token WHERE user_id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue('id', $id, PDO::PARAM_INT);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erreur destruction token : ' . $e->getMessage());
            return false;
        }
    }

}