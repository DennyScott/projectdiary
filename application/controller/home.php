<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Home extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        // load views. within the views we can echo out $songs and $amount_of_songs easily
        $projects_model = $this->loadModel('ProjectsModel');
        $projects = $projects_model->getAllProjects();
        require 'application/views/_templates/header.php';
        require 'application/views/_templates/navbar.php';
        require 'application/views/home/index.php';
        require 'application/views/_templates/footer.php';
    }

    /**
     * PAGE: exampleone
     * This method handles what happens when you move to http://yourproject/home/exampleone
     * The camelCase writing is just for better readability. The method name is case insensitive.
     */
    public function signin()
    {
        // load views. within the views we can echo out $songs and $amount_of_songs easily
        require 'application/views/_templates/header.php';
        require 'application/views/_templates/navbar.php';
        require 'application/views/home/signin.php';
        require 'application/views/_templates/sign-footer.php';
    }

    /**
     * PAGE: exampletwo
     * This method handles what happens when you move to http://yourproject/home/exampletwo
     * The camelCase writing is just for better readability. The method name is case insensitive.
     */
    public function signup()
    {
        // load views. within the views we can echo out $songs and $amount_of_songs easily
        require 'application/views/_templates/header.php';
        require 'application/views/_templates/navbar.php';
        require 'application/views/home/signup.php';
        require 'application/views/_templates/sign-footer.php';
    }

    /**
     * Adds a project to the project database.  The name is not passed, instead it is stored in a post variable.
     */
    public function addUser()
    {
        if (isset($_POST["submit_add_user"])) {
            $users_model = $this->loadModel('UsersModel');
            $userID = $users_model->addUser($_POST["username"], $_POST["password"]);

            if($userID){
                session_start();
                $_SESSION['user']=$userID;
                header('location: ' . URL . 'projects');
                exit;
            }

        }

        header('location: ' . URL . 'home/signup');
    }

    /**
     * Adds a project to the project database.  The name is not passed, instead it is stored in a post variable.
     */
    public function logIn()
    {
        if (isset($_POST["login_user"])) {
            $users_model = $this->loadModel('UsersModel');
            $userID = $users_model->logIn($_POST["username"], $_POST["password"]);
            if($userID !== false){
                session_start();
                $_SESSION['user']=$userID;
                header('location: ' . URL . 'projects/index');
                exit;
            }

        }
        header('location: ' . URL . 'home/signin');
    }

    /**
     * Adds a project to the project database.  The name is not passed, instead it is stored in a post variable.
     */
    public function signout()
    {
        session_start();
        if(isset($_SESSION['user']))
          unset($_SESSION['user']);
      header('location: ' . URL . 'home/');
  }
}
