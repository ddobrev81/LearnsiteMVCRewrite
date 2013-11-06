<?php

/**
 * Description of Controller
 *
 * @author Dodo
 */

 class Controller {
     
     private $cContent = array();
     
     function __construct($page) {
         switch ($page) {
            case "main":
                include 'apps/main/main.php';
                break;
            
            case "shoutbox":
                include './apps/shoutbox/shoutbox.php';
                break;
            
            case "showquotes":
                include 'apps/quotes/showquotes.php';
                break;
            
            case "addquote":
                include './apps/quotes/addquote.php';
                break;
            
            case "underconstruction":
                include './apps/underconstruction/underconstruction.php';
                break;
            
            case "deleteuser":
                include './apps/users/deleteuser.php';
                break;
            
            case "edituser":
                include './apps/users/edituser.php';
                break;
            
            case "loggedin":
                include './apps/users/loggedin.php';
                break;
            
            case "login":
                include './apps/users/login.php';
                break;
            
            case "logout":
                include './apps/users/logout.php';
                break;
            
            case "changepassword":
                include './apps/users/changepassword.php';
                break;
            
            case "register":
                include './apps/users/register.php';
                break;
            
            case "viewusers":
                include './apps/users/viewusers.php';
                break;
            
            default:
                include 'apps/main/main.php';
                break;
        }
        
    }
     


     static public function getContent() {
     
         return $this->cContent;
     }
        
   
}
