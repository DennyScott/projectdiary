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
    {
        // load views. within the views we can echo out $songs and $amount_of_songs easily
        require 'application/views/_templates/logged_header.php';
        require 'application/views/_templates/logged_navbar.php';
        require 'application/views/_templates/toolbar.php';
        require 'application/views/diary/index.php';
        require 'application/views/_templates/sidr.php';
        require 'application/views/_templates/sign-footer.php';
    }
}