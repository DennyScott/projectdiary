<?php

class ProjectsModel
{
    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
     * Returns all projects in the most recent ordering
     * @return [array] [an array of all projects in the ording of most recently updated first]
     */
    public function getRecentProjects(){
        $sql = "SELECT * 
                FROM projects 
                ORDER BY  updated DESC";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    /**
     * Updates a project with the passed parameters.  Returns true if successful
     * @param  [int]    $project_id [The ID of the project to update]
     * @param  [int]    $user_id    [The id of the user to attach the update to ]
     * @return [boolean]            [true if the update is completed]
     */
    public function updateProject($project_id, $user_id){
        $project_id = intval($project_id);
        $user_id = intval($user_id);
        $project = $this->getProject($project_id);

        $sql = "UPDATE projects 
                SET updated_by = ?, updated = NOW() 
                WHERE id = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $user_id);
        $query->bindParam(2, $project_id);
        $query->execute();
        return true;
    }

    /**
     * Updates a project with the passed parameters.  Returns true if successful
     * @param  [int]    $project_id [The ID of the project to update]
     * @param  [string] $name       [The new name to call the project.]
     * @param  [int]    $user_id    [The id of the user to attach the update to ]
     * @return [boolean]            [true if the update is completed]
     */
    public function updateProjectName($project_id, $name, $user_id){
        $project_id = intval($project_id);
         $name = strip_tags($name);
         $name = trim($name);
        $user = intval($user_id);

        $project = $this->getProject($project_id);

        $sql = "UPDATE projects 
                SET name = ?, updated_by = ?, updated = NOW() 
                WHERE id = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $name);
        $query->bindParam(2, $user_id);
        $query->bindParam(3, $project_id);
        $query->execute();
        return true;
    }

    /**
     * Returns all projects in the projects table
     * @return [array] [All projects in the projects table]
     */
    public function getAllProjects(){
        $sql = "SELECT * FROM projects";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    /**
     * Use to get a single project from the projects table
     * @param  [int]   $project_id [The ID of the project to get]
     * @return [array]             [A single element array containing the project]
     */
    public function getProject($project_id){
        $project_id = intval(trim($project_id));
        $sql = "SELECT * 
                FROM projects 
                WHERE id = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $project_id);
        $query->execute();
        return $query->fetch();
    }

    /**
     * Adds a project to the project table
     * @param [string] $name      [The name of the new project to add to the projects table]
     * @param [int] $createdBy    [The id of the user who created this project]
     * @return [int]              [The int id of the new project record]
     */
    public function addProject($name, $createdBy){
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
