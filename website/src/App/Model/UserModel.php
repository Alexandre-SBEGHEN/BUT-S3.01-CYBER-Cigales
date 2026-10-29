<?php

namespace App\Model;

use src\App\Core\init;

use PDOException;
use PDO;

class UserModel
{
    public function create(string $nom, string $prenom, string $email, string $password): bool {
        $pdo = init::getPDO();
        $sql = 'INSERT INTO utilisateur (nom, prenom, mot_de_passe, adresse_mail, date_creation) 
                VALUES (:nom, :prenom, :mot_de_passe, :adresse_mail, NOW())';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue('nom', $nom, PDO::PARAM_STR);
        $stmt->bindValue('prenom', $prenom, PDO::PARAM_STR);
        $stmt->bindValue('mot_de_passe', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
        $stmt->bindValue('adresse_mail', $email, PDO::PARAM_STR);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erreur create utilisateur : ' . $e->getMessage());
            return false;
        }
    }

    public function findEmail(string $email): ?user_model {
        $pdo = init::getPDO();
        $sql = 'SELECT * FROM utilisateur WHERE adresse_mail = :email';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue('email', $email, PDO::PARAM_STR);

        try {
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $this->create_user_objet($result) : null;
        } catch (PDOException $e) {
            error_log('Erreur find_email : ' . $e->getMessage());
            return null;
        }
    }

    public function findId(int $id): ?user_model {
        $pdo = init::getPDO();
        $sql = 'SELECT * FROM utilisateur WHERE utilisateur_id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue('id', $id, PDO::PARAM_INT);

        try {
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $this->create_user_objet($result) : null;
        } catch (PDOException $e) {
            error_log('Erreur find_id : ' . $e->getMessage());
            return null;
        }
    }

    public function changePassword(int $id, string $password): bool {
        $pdo = init::getPDO();
        $sql = 'UPDATE utilisateur SET mot_de_passe = :mot_de_passe WHERE utilisateur_id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue('id', $id, PDO::PARAM_INT);
        $stmt->bindValue('mot_de_passe', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erreur modification mot de passe : ' . $e->getMessage());
            return false;
        }
    }

    public function deleteUser(int $id): bool {
        $pdo = init::getPDO();
        $sql = 'DELETE FROM utilisateur WHERE utilisateur_id = :id';
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