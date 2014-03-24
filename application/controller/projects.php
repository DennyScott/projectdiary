<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Projects extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        // load views. within the views we can echo out $songs and $amount_of_songs easily
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
     * PAGE: exampleone
     * This method handles what happens when you move to http://yourproject/home/exampleone
     * The camelCase writing is just for better readability. The method name is case insensitive.
     */
    public function addProject()
    {

        // if we have POST data to create a new song entry
        if (isset($_POST["submit_add_project"])) {
            // load model, perform an action on the model
            $projects_model = $this->loadModel('ProjectsModel');

            //THIS ONE MUST BE CHANGED TO A VALID USER ID
            $projects_model->addProject($_POST["name"], 1);

            header('location: ' . URL . 'projects/index');
        }
    }

        public function deleteProject($project_id){
        // if we have an id of a song that should be deleted
        if (isset($project_id)) {
            // load model, perform an action on the model
            $projects_model = $this->loadModel('ProjectsModel');
            $projects_model->deleteProject($project_id);
        }

        // where to go after song has been deleted
        header('location: ' . URL . 'projects/index');
    }

    public function updateProject($project_id){
        // if we have an id of a song that should be deleted
        if (isset($project_id)) {
            // load model, perform an action on the model
            $projects_model = $this->loadModel('ProjectsModel');
            $projects_model->updateProject($project_id, 1);
        }

        // where to go after song has been deleted
        header('location: ' . URL . 'projects/index');
    }
}