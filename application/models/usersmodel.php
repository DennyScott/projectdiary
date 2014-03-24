<?php

class UsersModel
{
    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
     * Updates a user with the passed password.  Returns true if successful
     * @param  [int]    $password   [The new password for the user]
     * @param  [int]    $user_id    [The id of the user to attach the update to ]
     * @return [boolean]            [true if the update is completed]
     */
    public function updatePassword($user_id, $password){
        $user_id = intval($user_id);
        $password = trim(strip_tags($password));

        $sql = "UPDATE users 
                SET password = ?
                WHERE id = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(2, $user_id);
        $query->bindParam(1, $password);
        $query->execute();
        return true;
    }

    /**
     * Returns all users in the users table
     * @return [array] [All users in the users table]
     */
    public function getAllUsers(){
        $sql = "SELECT id, username FROM users";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    /**
     * Use to get a single user from the users table
     * @param  [int]   $user_id    [The ID of the user to get]
     * @return [array]             [A single element array containing the user]
     */
    public function getUser($user_id){
        $user_id = intval(trim($user_id));
        $sql = "SELECT * 
                FROM users 
                WHERE id = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $user_id);
        $query->execute();
        return $query->fetch();
    }


    /**
     * Adds a new user to the users table
     * @param [string] $username [The new username to add to the table]
     * @param [string] $password [The new password to add to the table]
     * @return [int]             [Returns the new id of the user added]
     */
    public function addUser($username, $password){
        $username = strip_tags($username);
        $username = trim($username);
        $password = strip_tags($password);
        $password = trim($password);

        $sql = "SELECT * 
                FROM users 
                WHERE username = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $username);
        $query->execute();
        $result =$query->fetch();

        if($result !== false){
            return false;
        }

        $sql = "INSERT INTO users (username, password, created, last_logged_in) VALUES (?, ?, NOW(), NOW())";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $username);
        $query->bindParam(2, $password);

        $query->execute();
        $lastID = $this->db->lastInsertId();

        return $lastID;
    }

    /**
     * Deletes a user from the users table
     * @param  [int]  $user_id    [The id of the user to remove from the users table]
     * @return [bool]             [True if the delete was successful]
     */
    public function deleteUser($user_id){
        $user_id = intval(trim($user_id));

        $sql = "DELETE FROM users 
                WHERE id = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $user_id);
        $query->execute();
    }

    public function logIn($username, $password){
        $username = trim(strval(strip_tags($username)));
        $password = trim(strval(strip_tags($password)));
        $sql = "SELECT * 
                FROM users 
                WHERE username = ? AND password = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $username);
        $query->bindParam(2, $password);
        $query->execute();
        $result =$query->fetch();

        if($result === false){
            return $result;
        }
        return intval($result->id);
    }
}
