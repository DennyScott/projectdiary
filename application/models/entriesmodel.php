<?php

class EntriesModel
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
     * Returns all recent entries for a project in the most recent ordering
     * @return [array] [an array of all entries for a project in the ording of most recently updated first]
     */
    public function getRecentEntriesForProject($project_id){
        $sql = "SELECT * 
                FROM entries 
                WHERE project_id = ?
                ORDER BY  updated DESC";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $project_id);
        $query->execute();
        return $query->fetchAll();
    }
    /**
     * Updates an entry with the passed parameters.  Returns true if successful
     * @param  [int]    $entry_id   [The ID of the entry to update]
     * @param  [int]    $user_id    [The id of the user to attach the update to ]
     * @param  [int]    $data       [The data that will be updated in the table]
     * @return [boolean]            [true if the update is completed]
     */
    public function updateEntry($entry_id, $user_id, $data, $name){
        $entry_id = intval($entry_id);
        $user_id = intval($user_id);
        $data = trim(strip_tags($data));
        $name = trim(strip_tags($name));;

        $sql = "UPDATE entries 
                SET updated_by = ?, updated = NOW(), data = ?, name = ?
                WHERE id = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $user_id);
        $query->bindParam(2, $data);
        $query->bindParam(3, $name);
        $query->bindParam(4, $entry_id);
        $query->execute();
        return true;
    }

    /**
     * Returns all entries in the entries table
     * @return [array] [All entries in the entries table]
     */
    public function getAllEntries(){
        $sql = "SELECT * FROM entries";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    /**
     * Use to get a single entry from the entries table
     * @param  [int]   $entries_id [The ID of the entry to get]
     * @return [array]             [A single element array containing the entry]
     */
    public function getEntry($entry_id){
        $entry_id = intval(trim($entry_id));
        $sql = "SELECT * 
                FROM entries 
                WHERE id = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $entry_id);
        $query->execute();
        return $query->fetch();
    }

    /**
     * Adds an entry into the entries table.
     * @param [int]    $project_id [The projects ID the entry belongs to]
     * @param [string] $data       [The text data of the entry]
     * @param [int]    $user_id    [The id of the user]
     * @param [string] $name       [The name of the Entry]
     * @return [int]               [The id of the new entry]
     */

    public function addEntry($project_id, $data, $user_id, $name){
        $project_id = intval(trim($project_id));
        $user_id = intval(trim($user_id));
        $data = trim(strip_tags($data));
        $name = trim(strip_tags($name));

        $sql = "INSERT INTO projects (project_id, data, created, created_by, updated, updated_by, name) VALUES (?, ?, NOW(), ?, NOW(), ?, ?)";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $project_id);
        $query->bindParam(2, $data);
        $query->bindParam(3, $user_id, PDO::PARAM_INT);
        $query->bindParam(4, $user_id, PDO::PARAM_INT);
        $query->bindParam(5, $name);

        $query->execute();
        $lastID = $this->db->lastInsertId();

        return $lastID;
    }

    /**
     * Deletes a entry from the entries table
     * @param  [int]  $entry_id   [The id of the entry to remove from the entries table]
     * @return [bool]             [True if the delete was successful]
     */
    public function deleteEntry($entry_id){
        $entry_id = intval(trim($entry_id));
        $sql = "DELETE FROM entries 
        WHERE id = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $entry_id);
        $query->execute();
    }
}
