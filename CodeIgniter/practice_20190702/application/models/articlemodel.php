<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ArticleModel extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function insert($author,$title,$content){
        $this->db->insert("article", 
            Array(
            "Author" =>  $author,
            "Title" => $title,
            "Content" => $content,
            "Views" => 0,
        ));     
        return $this->db->insert_id() ; //回傳剛新增的 Article ID
    }   
    
    function get($articleID){
    	//CI 裡面跨資料表結合的寫法
        $this->db->select("article.*,user.account");
        $this->db->from('article');
        $this->db->join('user', 'article.author = user.userID', 'left');
        $this->db->where(Array("articleID" => $articleID));
        $query = $this->db->get();

        if ($query->num_rows() <= 0){
            return null; //無資料時回傳 null
        }

        return $query->row();  //回傳第一筆
    }

    function get_all_articles_author(){
    	//CI 裡面跨資料表結合的寫法
        $this->db->select("article.*,user.account");
        $this->db->from('article');
        $this->db->join('user', 'article.author = user.userID', 'left');
        $query = $this->db->get();

        #$query = $this->db->query("SELECT * FROM `article` WHERE author = 'a1'");

        if ($query->num_rows() <= 0){
            return null; //無資料時回傳 null
        }

        return $query->result(); 
    }

    function countArticlesByUserID($userID){
        $this->db->select("Account");
        $this->db->from('user');
        $this->db->where(Array("UserID" => $userID));
        $query = $this->db->get();
        #return $query->row_array(); 
        $row = $query->row_array();
        $test_name = $row['Account'];

        $this->db->select("count(articleID) as ArticleCount");
        $this->db->from('article');
        $this->db->where(Array("author" => $userID));
        $query = $this->db->get();
        $query = $this->db->query("SELECT * FROM `article` WHERE author = '$test_name'");
        
        if ($query->num_rows() <= 0){
            return null; //無資料時回傳 null
        }

        return $query->num_rows();
    }
        
    function getArticlesByUserID($userID,$offset = 0,$pageSize = 20){
        $this->db->select("article.*,user.Account");
        $this->db->from('article');
        $this->db->join('user', 'article.author = user.userID', 'left');
        $this->db->limit($pageSize,$offset);
        $this->db->order_by("ArticleID","desc");//由大到小排序
        $query = $this->db->get();
        #$query = $this->db->query("SELECT * FROM `article` WHERE author = 'a1'");

        
        return $query->result(); //無資料時回傳 null
    }

    function updateArticle($id,$title,$content){
        $data = array(
        'Title' => $title,
        'Content' => $content
        );
        
        $this->db->where('ArticleID', $id);
        $this->db->update('article', $data);
    }

    function del($id){
        $this->db->delete('article', array('ArticleID' => $id));
    }

    function updateViews($articleID,$views){
        $data = array(
        'views' => $views,
        );
        
        $this->db->where('ArticleID', $articleID);
        $this->db->update('article', $data);
    }


    function getHotArticles($count = 5){
		$this->db->select("article.*,user.Account");
		$this->db->from('article');
		$this->db->join('user', 'article.author = user.userID', 'left');
		$this->db->limit($count, 0);//offset = 0
		$this->db->order_by("Views","desc");//由大到小排序
		$query = $this->db->get();
		
		return $query->result();
	}
		
	function getHotAuthors($count = 5){
        $this->db->select('author,max(views) as views');
        $this->db->from('article');
        $this->db->join('user', 'article.author = user.userID', 'left');
        $this->db->limit($count, 0);//offset = 0
        $this->db->group_by("author");
        $this->db->order_by("max(Views) desc");
        $query = $this->db->get();
        return $query->result();

		# for test
		//根據該作者所有文章裡面，
		//由最大的 views 進行大到小排序
        $this->db->order_by("max(Views) desc");
        
        # select author,max(views) as views from article group by author order by max(Views) desc
        # select author,max(views) as views from article LEFT JOIN `USER` ON `article`.`author` = `user`.`userID` group by author order by max(Views) desc  
        #$query = $this->db->query("select author,max(views) as views from article group by author order by max(Views) desc");
		$query = $this->db->get();
		
		return $query->result();

	}

}