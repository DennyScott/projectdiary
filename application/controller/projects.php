<?php

class Projects extends Controller
{

    /**
     * [Opens the index page]
     * @return [void] [No Return]
     */

    public function index(){
        require 'application/inc/require_login.php';

        //USED FOR SIDR
        $user_id = $_SESSION["user"];
        $projects_model = $this->loadModel('UserProjectsModel');
        $sideProjs = $projects_model->getUserOwnRecentProjects($user_id);

        $projects = $projects_model->getUserOwnRecentProjectsSubset($user_id,0,3);

        $users_model = $this->loadModel('UsersModel');
        $user = $users_model->getUser($_SESSION["user"]);
        require 'application/views/_templates/logged_header.php';  
        require 'application/views/_templates/logged_navbar.php'; 
        if(isset($_SESSION["user"])){
         require 'application/views/_templates/toolbar.php'; 
        }
        require 'application/views/projects/index.php';
        require 'application/views/_templates/sidr.php'; 
        require 'application/views/_templates/sign-footer.php'; 
    }


    /**
     * Adds a project to the project database.  The name is not passed, instead it is stored in a post variable.
     */
    public function addProject()
    {
        session_start();
        if (isset($_POST["submit_add_project"]) && isset($_SESSION["user"])) {
            $projects_model = $this->loadModel('ProjectsModel');
            $newProjectID = $projects_model->addProject($_POST["name"], 1);
            $userProjects_model = $this->loadModel('UserProjectsModel');
            $userProjects_model->addUserProject($_SESSION["user"], $newProjectID, "Administrator");
        }
        header('location: ' . URL . 'projects/index');
    }

     /**
     * Adds a User to a project to the userproject database.  The name is not passed, instead it is stored in a post variable.
     */
    public function addUserProject()
    {
        session_start();
        if (isset($_POST["submit_add_user_project"]) && isset($_SESSION["user"]) && $_POST["user"]!== "") {
            $userProjects_model = $this->loadModel('UserProjectsModel');
            $user_model = $this->loadModel('UsersModel');
            $user_names = explode(',',$_POST["user"]);

            foreach($user_names as $userName){
            $user = $user_model->getUserByUsername($userName);
            $userProjects_model->addUserProject($user->id, $_POST["selectProject"], "Administrator");
            }
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

    public function userProjects($user_id){
        $userProjects_model = $this->loadModel('UserProjectsModel');
        $userProjects = $userProjects_model->getUserOwnRecentProjectsSubset($user_id, 0, 3);
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