<?php



/**
 * Description of cPage
 *
 * @author Dodo
 */

class cpage {
    private $title;
    private $content = array();
    
    public function __construct($title) {
        $this->title = $title;
    }

    public function __destruct() {

    }
                
    public function setContent($content) {
        $this->content = $content;
    }
                
    public function render() {
        echo "<H1>{$this->title}</H1>";
	foreach($this->content as $cont){
            echo $cont;
	}
    }
		
}	

