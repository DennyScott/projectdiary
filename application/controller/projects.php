<?php

class Projects extends Controller
{

    /**
     * [Opens the index page]
     * @return [void] [No Return]
     */
    public function index()
    {

        $projects_model = $this->loadModel('ProjectsModel');
        $projects = $projects_model->getRecentProjects();
        require 'application/views/_templates/logged_header.php';  
        require 'application/views/_templates/logged_navbar.php'; 
        require 'application/views/_templates/toolbar.php'; 
        require 'application/views/projects/index.php';
        require 'application/views/_templates/sidr.php'; 
        require 'application/views/_templates/sign-footer.php'; 
    }


    /**
     * Adds a project to the project database.  The name is not passed, instead it is stored in a post variable.
     */
    public function addProject()
    {
        if (isset($_POST["submit_add_project"])) {
            $projects_model = $this->loadModel('ProjectsModel');
            $newProjectID = $projects_model->addProject($_POST["name"], 1);
            //TODO: NEED TO CREATE USERPROJECT LINK HERE!!!!
        }
        header('location: ' . URL . 'projects/index');
    }

    /**
     * Deletes project from the projects table.  Be sure to have the id of the project at the end of the url i.e. .../id
     * @param  [int] $project_id [The id of the project to delete]
     * @return [void]             [No return]
     */
    public function deleteProject($project_id){
        if (isset($project_id)) {
            $projects_model = $this->loadModel('ProjectsModel');
            $projects_model->deleteProject($project_id);
        }
        header('location: ' . URL . 'projects/index');
    }

    /**
     * [Requires a project id and name.  The name is if you would like to set a new name for 
     * the project.  URL must be .../id/name at the end.]
     * @param  [int] $project_id [The ID of the project to update]
     * @return [void]             [No Return]
     */
    public function updateProject($project_id){
        if (isset($project_id)) {
            $projects_model = $this->loadModel('ProjectsModel');
            $projects_model->updateProject($project_id, 1);
        }
        header('location: ' . URL . 'projects/index');
    }

    public function addUserProject($project_id){
        $userProjects_model = $this->loadModel('UserProjectsModel');
        $userProjects_model->addUserProject(1, $project_id, "Administrator");
    }

    public function userProjects($user_id){
        $userProjects_model = $this->loadModel('UserProjectsModel');
        $userProjects = $userProjects_model->getUserOwnRecentProjectsSubset($user_id, 0, 2);
        echo '<pre>';
        var_dump($userProjects);
        exit;
    }

    public function addToUser($username){
        $users_model = $this->loadModel('UsersModel');
        $users_model->addUser($username, "passW");
    }

    public function logIn($username){
        $users_model = $this->loadModel('UsersModel');
        $userId = $users_model->logIn($username, "passW");
    }
}