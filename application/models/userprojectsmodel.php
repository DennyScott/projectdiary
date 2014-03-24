<?php

class UserProjectsModel
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
     * Updates the role of the user in the bridge userprojects table
     * @param  [int]    $project_id [The id of the project to update the role on]
     * @param  [int]    $user_id    [this id of the user to update the role on]
     * @param  [string] $role       [The new role of the user]
     * @return [boolean]            [true if all was successful]
     */
    public function updateRole($project_id, $user_id, $role){
        $project_id = intval($project_id);
        $user_id = intval($user_id);
        $role = trim(strip_tags($role));

        $sql = "UPDATE user_projects 
                SET role = ?
                WHERE project_id = ? AND user_id = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $role);
        $query->bindParam(2, $project_id);
        $query->bindParam(3, $user_id);
        $query->execute();
        return true;
    }

    /**
     * Returns all projects the user is attached to
     * @param  [int] $user_id [The id of the user]
     * @return [array]        [An array of all projects the user is attached to]
     */
    public function getUserOwnProjects($user_id){
        $user_id = intval(trim($user_id));
        $sql = "SELECT * 
                FROM user_projects 
                WHERE user_id = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $user_id);
        $query->execute();
        $all = $query->fetchAll(PDO::FETCH_ASSOC);

        $results = array();
        require_once("projectsmodel.php");
        $projects_model = new ProjectsModel($this->db);
        foreach ($all as $record) {
            $found = $projects_model->getProject($record["project_id"]);
            $results[] = $found;
        }

        return $results;
    }

    /**
     * Use to find a section of the recent projects.  This will use your user id to go through projects
     * and list them out to the user for however elements there is in $positionStart to $positionEnd.
     * @param  [int] $user_id       [The id of the user]
     * @param  [int] $positionStart [The number start position]
     * @param  [int] $positionEnd   [The number end position]
     * @return [array]              [The results of the query]
     */
    public function getUserOwnRecentProjectsSubset($user_id, $positionStart, $positionEnd){
       
        $user_id = intval(trim($user_id));
        $offset = intval($positionStart);
        $rows = intval($positionEnd) - intval($positionStart);
        $sql = "SELECT * 
                FROM user_projects 
                WHERE user_id = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $user_id);
        $query->execute();
        $all = $query->fetchAll(PDO::FETCH_ASSOC);

        $found = "";
        foreach ($all as $record) {
            if($found != ""){
                $found =  $found . ", ";
            }
                $found = $found . strval($record["project_id"]);
        }

        $sql = "SELECT * 
                FROM projects 
                WHERE id IN (" . $found . ")
                ORDER BY updated
                LIMIT ?, ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $offset, PDO::PARAM_INT);
        $query->bindParam(2, $rows, PDO::PARAM_INT);
        $query->execute();

        $results = $query->fetchAll();

        return $results;
    }

    /**
     * Returns the count of all user own projects
     * @param  [int] $user_id [The id of the user]
     * @return [int]          [The number of found records]
     */
    public function getUserOwnProjectsCount($user_id){
        $user_id = intval(trim($user_id));
        $sql = "SELECT * 
                FROM user_projects 
                WHERE user_id = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $user_id);
        $query->execute();
        $all = $query->fetchAll(PDO::FETCH_ASSOC);

        return count($all);
    }

    /**
     * Returns all user_projects in the user_projects table
     * @return [array] [All user_project links in the user_projects table]
     */
    public function getAllUserProjects(){
        $sql = "SELECT * FROM user_projects";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    /**
     * Gets a single userProject from the user_project table
     * @param  [int] $project_id [the id of the project]
     * @param  [int] $user_id    [the id of the user]
     * @return [array]           [The single user_project record]
     */
    public function getUserProject($project_id, $user_id){
        $project_id = intval(trim($project_id));
        $user_id = intval(trim($user_id));
        $sql = "SELECT * 
                FROM user_projects 
                WHERE project_id = ? AND user_id = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $project_id);
        $query->bindParam(2, $user_id);
        $query->execute();
        return $query->fetch();
    }

    /**
     * Adds a userProject to the user_project table
     * @param [int]    $user_id    [the id of the user to add to the table]
     * @param [int]    $project_id [the id of the project to add to the table]
     * @param [string] $role       [The role of the user in the project]
     */
    public function addUserProject($user_id, $project_id, $role){
        $role = trim(strip_tags($role));
        $user_id = intval(trim($user_id));
        $project_id = intval(trim($project_id));

        $sql = "INSERT INTO user_projects (user_id, project_id, role, joined) VALUES (?, ?, ?, NOW())";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $user_id, PDO::PARAM_INT);
        $query->bindParam(2, $project_id, PDO::PARAM_INT);
        $query->bindParam(3, $role);

        $query->execute();
        $lastID = $this->db->lastInsertId();

        return $lastID;
    }

    /**
     * Deletes a user project from the user_project table
     * @param  [int] $user_id    [The id of the user in the user project]
     * @param  [int] $project_id [The id of the project in the user project]
     * @return [void]             [no Return]
     */
    public function deleteUserProject($user_id, $project_id){
        $project_id = intval(trim($project_id));
        $user_id = intval(trim($user_id));

        $sql = "DELETE FROM user_projects 
        WHERE user_id = ? AND project_id = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $user_id);
        $query->bindParam(2, $project_id);
        $query->execute();
    }

    /**
     * Deletes all userProjects with the given userID
     * @param  [int] $user_id [The id of the user to delete]
     * @return [void]          [No return]
     */
    public function deleteUserFromUserProject($user_id){
        $user_id = intval(trim($user_id));

        $sql = "DELETE FROM user_projects 
        WHERE user_id = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $user_id);
        $query->execute();
    }

        /**
     * Deletes all userProjects with the given project_id
     * @param  [int] $project_id [The id of the project to delete]
     * @return [void]          [No return]
     */
    public function deleteProjectFromUserProject($project_id){
        $project_id = intval(trim($project_id));

        $sql = "DELETE FROM user_projects 
        WHERE project_id = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $project_id);
        $query->execute();
    }
}
