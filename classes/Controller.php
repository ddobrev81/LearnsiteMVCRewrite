<?php

/**
 * Description of Controller
 *
 * @author Dodo
 */

 class Controller {
    
    static public function router($page) {
        switch ($page) {
            case "main":
                include 'apps/main/main.php';
                return $content;
                break;
            
            case "shoutbox":
                include './apps/shoutbox/shoutbox.php';
                return $content;
                break;
            
            case "showquotes":
                include 'apps/quotes/showquotes.php';
                return $content;
                break;
            
            case "addquote":
                include './apps/quotes/addquote.php';
                return $content;
                break;
            
            case "underconstruction":
                include './apps/underconstruction/underconstruction.php';
                return $content;
                break;
            
            case "deleteuser":
                include './apps/users/deleteuser.php';
                return $content;
                break;
            
            case "edituser":
                include './apps/users/edituser.php';
                return $content;
                break;
            
            case "loggedin":
                include './apps/users/loggedin.php';
                return $content;
                break;
            
            case "login":
                include './apps/users/login.php';
                return $content;
                break;
            
            case "logout":
                include './apps/users/logout.php';
                return $content;
                break;
            
            case "changepassword":
                include './apps/users/changepassword.php';
                return $content;
                break;
            
            case "register":
                include './apps/users/register.php';
                return $content;
                break;
            
            case "viewusers":
                include './apps/users/viewusers.php';
                return $content;
                break;

            case "shoutbox2":
                $controller_file = "apps/$page/controller.php";
                require $controller_file;
                switch( $_GET['action'])
                {
                    case 'display':
                    case 'post':
                        $action = $_GET['action'];
                        break;

                    default:
                        $action = "display";
                }

                $controller = new controller_shoutbox2();
                return $controller -> $action();
            
            default:
                include 'apps/main/main.php';
                return $content;
                break;
        }
        
    }
}
