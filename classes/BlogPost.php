<?php
/**
 * Description of BlogPost
 *
 * @author Dodo
 */
class BlogPost {
    
    //variables
    private $id;
    private $title;
    private $body;
    private $author;
    private $tags;
    private $timestamp;
    
    
    //methods
    function __construct(
                    $initId=null, 
                    $initTitle=null, 
                    $initBody=null, 
                    $initAuthorId=null, 
                    $initTimestamp=null) {
        
        if(!empty($initId)) {
            $this->id = $initId;
        }
        if(!empty($initTitle)) {
            $this->title = $initTitle;
        }
        if(!empty($initBody)) {
            $this->body = $initBody;
        }
        if(!empty($initTimestamp)) {
            $this->timestamp = $initTimestamp;
        }
        require_once './includes/dbc.php';
        $q = "SELECT email FROM users WHERE user_id = :uid";
	$ps = $pdo->prepare($q);
	$params = array('uid' => $initAuthorId);
	$ps->execute($params);
        if($ps->rowCount() == 1){
            $row = $ps->fetch(PDO::FETCH_NUM);
            $this->author = $row[0];
	} else {
        	//throw something something.. later
	}
        $q = "SELECT tags.* FROM blogposttags 
            LEFT JOIN tags ON blogposttags.tag_id = tags.tag_id 
            WHERE blogposttags.post_id = :pid";
        $ps = $pdo->prepare($q);
	$params = array('pid' => $initId);
	$ps->execute($params);
        $postTags = 'No tags';
        $tags = array();
        $tagsId = array();
        while($row = $ps->fetch(PDO::FETCH_ASSOC)) {
            array_push($tags, $row['name']);
            array_push($tagsId, $row['tag_id']);
        }
        if(sizeof($tags)>0) {
            foreach ($tags as $tag) {
                if($postTags == "No Tags") {
                    $postTags = $tag;
                } else {
                    $postTags = $postTags.", ".$tag;
                }
            }
        }
        $this->tags = $postTags;
        
    }
    
    function AddPost () {
        
    }
    
    function EditPost($postId) {
        
    }
    
    function DeletePost($postId) {
        
    }
    
    function GetPost($postId) {
        
    }
    
    function GetAllPosts() {
        
    }
    
    
}
