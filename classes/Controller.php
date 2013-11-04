<?php

/**
 * Description of Controller
 *
 * @author Dodo
 */

 class Controller {
    
    static public function router($page) {
        switch ($page) {
            /**
             * Might as well not repeat ourselves.
             * This isn't insecure because $page can't be anything else than
             * what's in this list
             **/
            case "main":
            case "shoutbox":
            case "showquotes":
            case "addquote":
            case "underconstruction":
            case "main":
                include "apps/$page/$page.php";
                return $content;
            
            case "shoutbox":
                include './apps/shoutbox/shoutbox.php';
                return $content;
            
            case "showquotes":
                include 'apps/quotes/showquotes.php';
                return $content;
            
            case "addquote":
                include './apps/quotes/addquote.php';
                return $content;
            
            case "underconstruction":
                include './apps/underconstruction/underconstruction.php';
                return $content;
            
            case "deleteuser":
                include './apps/users/deleteuser.php';
                return $content;
            
            case "edituser":
                include './apps/users/edituser.php';
                return $content;
            
            case "loggedin":
                include './apps/users/loggedin.php';
                return $content;
            
            case "login":
                include './apps/users/login.php';
                return $content;
            
            case "logout":
                include './apps/users/logout.php';
                return $content;
            
            case "changepassword":
                include './apps/users/changepassword.php';
                return $content;
            
            case "register":
                include './apps/users/register.php';
                return $content;
            
            case "viewusers":
                include './apps/users/viewusers.php';
                return $content;
                break;

            case "shoutbox2":
                require "apps/$page/controller.php";
                $controller_class = "controller_" . $page;
                $controller = new $controller_class();

                /**
                 * You can also do this, but some people question the security of it
                 **/

                 /**
                  * controller::index is the default action. make sure it exists.
                  **/
                 $action = ( isset($_GET['action']) ) ? $_GET['action'] : "index";

                 /**
                  * if $action exists (eg, is a method of the controller)
                  **/
                 if( !is_callable([$controller, $action]))
                 {
                     /**
                      * Throw some error page here
                      **/
                      return array("");
                 }

                 return $controller -> $action();
            
            default:
                include 'apps/main/main.php';
                return $content;
        }
        
    }
}
