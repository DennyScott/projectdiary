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

    public function getRecentProjects(){
        $sql = "SELECT * 
                FROM projects 
                ORDER BY  updated DESC";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function updateProject($project_id, $user_id){
        $project_id = intval($project_id);
        // $name = strip_tags($name);
        // $name = trim($name);
        $user = intval($user_id);

        $project = $this->getProject($project_id);

        $sql = "UPDATE projects 
                SET updated_by = ?, updated = NOW() 
                WHERE id = ?";
        $query = $this->db->prepare($sql);
        //$query->bindParam(1, $name);
        $query->bindParam(1, $user_id);
        $query->bindParam(2, $project_id);
        $query->execute();
        return true;
    }

    public function getAllProjects(){
        $sql = "SELECT * FROM projects";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

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

    public function addProject($name, $createdBy){
        $name = strip_tags($name);
        $name = trim($name);
        var_dump($createdBy);

        $sql = "INSERT INTO projects (name, created, created_by, updated, updated_by) VALUES (?, NOW(), ?, NOW(), ?)";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $name);
        $query->bindParam(2, $createdBy, PDO::PARAM_INT);
        $query->bindParam(3, $createdBy, PDO::PARAM_INT);

        $query->execute();

    }

    public function deleteProject($project_id){
        $project_id = intval(trim($project_id));

        $sql = "DELETE FROM projects 
        WHERE id = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $project_id);
        $query->execute();
    }
}
