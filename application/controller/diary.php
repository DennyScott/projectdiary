<?php
 /**
 * Class Diary
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Diary extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {   session_start();

    //     require 'application/views/_templates/logged_header.php';
    //     require 'application/views/_templates/logged_navbar.php';
    //     if(isset($_SESSION["user"])){
    //     require 'application/views/_templates/toolbar.php';
    // }
    //     require 'application/views/diary/index.php';
    //     require 'application/views/_templates/sidr.php';
    //     require 'application/views/_templates/sign-footer.php';
        header('location: ' . URL . 'projects');

    }

    public function projectDiary($project_id){
        session_start();
        $user_id = $_SESSION["user"];
        $projects_model = $this->loadModel('UserProjectsModel');
        $sideProjs = $projects_model->getUserOwnRecentProjects($user_id);

        $entries_model = $this->loadModel('EntriesModel');
        $entries = $entries_model->getRecentEntriesForProject($project_id);
        require 'application/views/_templates/logged_header.php';
        require 'application/views/_templates/logged_navbar.php';
        if(isset($_SESSION["user"])){
        require 'application/views/_templates/toolbar.php';
        }
        require 'application/views/diary/index.php';
        require 'application/views/_templates/sidr.php';
        require 'application/views/_templates/sign-footer.php';
    }

    public function addEntry(){
        session_start();
        if (isset($_POST["submit_add_entry"]) && isset($_SESSION["user"])) {
            $entries_model = $this->loadModel('EntriesModel');
            $entryID = $entries_model->addEntry($_POST["storeID"],$_POST["inputEntryData"], $_SESSION["user"],$_POST["inputEntryTitle"]);
            header('location: ' . URL . 'projectDiary/' . $_POST["storeID"]);
        }  
        header('location: ' . URL . 'projects');
    }
}