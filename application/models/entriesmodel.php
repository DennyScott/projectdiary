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
    public function updateEntry($entry_id, $user_id, $data){
        $entry_id = intval($entry_id);
        $user_id = intval($user_id);
        $data = trim(strip_tags($data));;

        $sql = "UPDATE entries 
                SET updated_by = ?, updated = NOW(), data = ? 
                WHERE id = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $user_id);
        $query->bindParam(2, $data);
        $query->bindParam(3, $entry_id);
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
     * Adds an entry to the entry table
     * @param [string] $name      [The name of the new project to add to the projects table]
     * @param [int] $createdBy    [The id of the user who created this project]
     * @return [int]              [The int id of the new project record]
     */
    public function addEntry($name, $createdBy){
        $name = strip_tags($name);
        $name = trim($name);

        $sql = "INSERT INTO projects (name, created, created_by, updated, updated_by) VALUES (?, NOW(), ?, NOW(), ?)";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $name);
        $query->bindParam(2, $createdBy, PDO::PARAM_INT);
        $query->bindParam(3, $createdBy, PDO::PARAM_INT);

        $query->execute();
        $lastID = $this->db->lastInsertId();

        return $lastID;
    }

    /**
     * Deletes a project from the projects table
     * @param  [int]  $project_id [The id of the project to remove from the projects table]
     * @return [bool]             [True if the delete was successful]
     */
    public function deleteProject($project_id){
        $project_id = intval(trim($project_id));

        $sql = "DELETE FROM projects 
        WHERE id = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $project_id);
        $query->execute();
    }
}
