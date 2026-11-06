<?php

namespace App\Model;

use App\Core\Init;
use PDO;
use PDOException;

class UserModel
{
    /**
     * Crée un nouvel utilisateur.
     */
    public function create(string $lastName, string $firstName, string $mail, string $password): bool {
        $pdo = Init::getPDO();
        $sql = 'INSERT INTO utilisateur (last_name, first_name, password_hash, mail, created_date) 
                VALUES (:last_name, :first_name, :password_hash, :mail, NOW())';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue('last_name', $lastName, PDO::PARAM_STR);
        $stmt->bindValue('first_name', $firstName, PDO::PARAM_STR);
        $stmt->bindValue('password_hash', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
        $stmt->bindValue('mail', $mail, PDO::PARAM_STR);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erreur create utilisateur : ' . $e->getMessage());
            return false;
        }
    }


    public function findBy (string $column, string $value){

        $allowedColumns = ['mail', 'user_id'];

        if (!in_array($column, $allowedColumns, true)) {
            throw new \InvalidArgumentException("Colonne de recherche non autorisée : " . $column);
        }

        $pdo = Init::getPDO();
        $sql = "SELECT * FROM user WHERE $column = :value LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue('value', $value, \PDO::PARAM_STR);


        try {
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ?: null;
        } catch (PDOException $e) {
            error_log('Erreur findBy : ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Recherche un utilisateur par son adresse mail.
     */
    public function findEmail(string $mail): ?array {
        $pdo = Init::getPDO();
        $sql = 'SELECT * FROM utilisateur WHERE mail = :mail';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue('mail', $mail, PDO::PARAM_STR);

        try {
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ?: null;
        } catch (PDOException $e) {
            error_log('Erreur findEmail : ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Recherche un utilisateur par son ID.
     */
    public function findID(int $id): ?array {
        $pdo = Init::getPDO();
        $sql = 'SELECT * FROM utilisateur WHERE user_id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue('id', $id, PDO::PARAM_INT);

        try {
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ?: null;
        } catch (PDOException $e) {
            error_log('Erreur findID : ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Modifie le mot de passe d'un utilisateur.
     */
    public function changePassword(int $id, string $password): bool {
        $pdo = Init::getPDO();
        $sql = 'UPDATE utilisateur SET password_hash = :password_hash WHERE user_id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue('id', $id, PDO::PARAM_INT);
        $stmt->bindValue('password_hash', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erreur modification mot de passe : ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Supprime un utilisateur de la base de données.
     */
    public function deleteUser(int $id): bool {
        $pdo = Init::getPDO();
        $sql = 'DELETE FROM utilisateur WHERE user_id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue('id', $id, PDO::PARAM_INT);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erreur destruction utilisateur : ' . $e->getMessage());
            return false;
        }
    }
}