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
        echo "<pre>";
        var_dump($projects);
        exit;
        require 'application/views/_templates/header.php';
        require 'application/views/home/index.php';
        require 'application/views/_templates/footer.php';
    }

    /**
     * PAGE: exampleone
     * This method handles what happens when you move to http://yourproject/home/exampleone
     * The camelCase writing is just for better readability. The method name is case insensitive.
     */
    public function exampleOne()
    {
        // load views. within the views we can echo out $songs and $amount_of_songs easily
        require 'application/views/_templates/header.php';
        require 'application/views/home/example_one.php';
        require 'application/views/_templates/footer.php';
    }

    /**
     * PAGE: exampletwo
     * This method handles what happens when you move to http://yourproject/home/exampletwo
     * The camelCase writing is just for better readability. The method name is case insensitive.
     */
    public function exampleTwo()
    {
        // load views. within the views we can echo out $songs and $amount_of_songs easily
        require 'application/views/_templates/header.php';
        require 'application/views/home/example_two.php';
        require 'application/views/_templates/footer.php';
    }

    public function hello(){
        echo "you made it to hello!";
    }
}
