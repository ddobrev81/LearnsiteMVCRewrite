<?php //class declarations

class cpage {
		private $title;
		private $content = array();

		public function __construct($title) {
			$this->title = $title;
		}

		public function __destruct() {

		}

		public function render() {
			echo "<H1>{$this->title}</H1>";
			foreach($this->content as $cont){
				echo $cont;
			}
		}

		public function setContent($content) {
				$this->content = $content;
		}
	}	

class csite {
	private $headers;
	private $footers;
	private $page;

	public function __construct() {
		$this->headers = array();
		$this->footers = array();
	}

	public function __destruct() {

	}

	public function render() {
		foreach ($this->headers as $header) {
			include $header;
		}

		$this->page->render();

		foreach ($this->footers as $footer) {
			include $footer;
		}
	}

	public function addHeader($file) {
		$this->headers[] = $file;
	}

	public function addFooter($file) {
		$this->footers[] = $file;
	}

	public function setPage(cpage $page) {
		$this->page = $page;
	}

}

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
            
            case "showquote":
                include './apps/quotes/showquotes.php';
                return $content;
                break;
            
            case "addquote":
                include './apps/quotes/addquotes.php';
                return $content;
                break;
            
            case "underconstruction":
                include './apps/undercontruction/undercontruction.php';
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
            
            default:
                //something something
                break;
        }
        
    }
}

?>
