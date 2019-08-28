<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends CI_Controller {

    # http://localhost/phptest/CodeIgniter/practice_20190702/index.php/article/author
	public function author($author = null,$offset = 0)
	{
		session_start();
		$this->load->helper(array('form', 'url'));
		if($author == null){
			show_404("Author not found !");
			return true;
		}
		
		//引入 model
		$this->load->model("UserModel");
		$this->load->model("ArticleModel");
	
		//先查詢使用者是否存在
		$user = $this->UserModel->getUserByAccount($author);
		if($user == null){
			show_404("Author not found !");
		}
		$pageSize = 2;
	
		$this->load->library('pagination');
		#$config['uri_segment'] = 3;
		$config['base_url'] = site_url('/article/author/'.$author.'/');
		#$row = $this->ArticleModel->countArticlesByUserID($user->UserID);
		#echo $row['Account'];
		//取得總數量
		$total_rows = $this->ArticleModel->countArticlesByUserID($user->UserID);


		$config = array(
			#'base_url'          => 'http://[::1]/phptest/CodeIgniter/practice_20190702/index.php/article/author/a1/',
			'base_url'          => site_url('/article/author/'.$author.'/'),
			#'total_rows'        => 200,
			'total_rows'        => $total_rows,
			'per_page'          => $pageSize,
			'num_links'         => 10,
			#'use_page_numbers'  => true,
			#'page_query_string' => false,
			'uri_segment'       => 3,
			#'full_tag_open'     => '<ul class="pagination pull-right">',
			#'full_tag_close'    => '</ul>',
			#'first_link'        => '<<',
			#'first_tag_open'    => '<li>',
			#'first_tag_close'   => '</li>',
			#'last_link'         => '>>',
			#'last_tag_open'     => '<li>',
			#'last_tag_close'    => '</li>',
			#'next_link'         => '>',
			#'next_tag_open'     => '<li>',
			#'next_tag_close'    => '</li>',
			#'prev_link'         => '<',
			#'prev_tag_open'     => '<li>',
			#'prev_tag_close'    => '</li>',
			#'cur_tag_open'      => '<li class="active"><a>',
			#'cur_tag_close'     => '</a></li>',
			#'num_tag_open'      => '<li>',
			#'num_tag_close'     => '</li>'
		);

		$this->pagination->initialize($config);
	
		$results = $this->ArticleModel->getArticlesByUserID($user->UserID,$offset,$pageSize);
	
		#echo $this->pagination->create_links();
		$this->load->view('article_author',
			Array(
			"pageTitle" => "發文系統 - ".$user->Account." 的文章列表",
			"results" => $results,
			"user" => $user,
			"pageLinks" => $this->pagination->create_links()
			)
		);
	}

	public function test(){

		$this->load->library('pagination');
		$this->load->helper('url');

	
		$config = array(
			'base_url'          => 'http://example.com/index.php/test/page/',
			'total_rows'        => 200,
			'per_page'          => 3,
			'num_links'         => 20,
			#'use_page_numbers'  => true,
			#'page_query_string' => false,
			'uri_segment'       => 3,
			#'full_tag_open'     => '<ul class="pagination pull-right">',
			#'full_tag_close'    => '</ul>',
			#'first_link'        => '<<',
			#'first_tag_open'    => '<li>',
			#'first_tag_close'   => '</li>',
			#'last_link'         => '>>',
			#'last_tag_open'     => '<li>',
			#'last_tag_close'    => '</li>',
			#'next_link'         => '>',
			#'next_tag_open'     => '<li>',
			#'next_tag_close'    => '</li>',
			#'prev_link'         => '<',
			#'prev_tag_open'     => '<li>',
			#'prev_tag_close'    => '</li>',
			#'cur_tag_open'      => '<li class="active"><a>',
			#'cur_tag_close'     => '</a></li>',
			#'num_tag_open'      => '<li>',
			#'num_tag_close'     => '</li>'
		);
	
	
		$this->pagination->initialize($config);
		$pagination = $this->pagination->create_links();
		echo $pagination;


	
	}

	public function test2(){

		$this->load->library('email');
		$this->email->from('englam3345678@gmail.com', 'myname');
		$this->email->to("englam3345678@gmail.com");
		$this->email->message("有收到信嗎？");
		$this->email->subject("這是信件標題");
		$this->email->send();


	
	}



    # http://localhost/phptest/CodeIgniter/practice_20190702/index.php/article/post
	public function post(){
		session_start();
		$this->load->helper(array('form', 'url'));

		if (!isset($_SESSION["user"])){//尚未登入時轉到登入頁
			redirect(site_url("/user/login")); //轉回登入頁
			return true;
		}

		$this->load->view('article_post',Array(
			"pageTitle" => "發文系統 - 發表文章"
		));	
	
	}

	public function posting(){
		session_start();
		$this->load->helper(array('form', 'url'));
		if (!isset($_SESSION["user"])){//尚未登入時轉到登入頁
			redirect(site_url("/user/login")); //轉回登入頁
			return true;
		}

		$title = trim($this->input->post("title"));
		$content= trim($this->input->post("content"));
		
		if( $title =="" || $content =="" ){
			$this->load->view('article_post',Array(
				"pageTitle" => "發文系統 - 發表文章",
				"account" => $_SESSION["user"],
				"errorMessage" => "Title or Content shouldn't be empty,please check!" ,
				"title" => $title,
				"content" => $content
			));
			return false;
		}

		$this->load->model("ArticleModel");

		
		$insertID = $this->ArticleModel->insert($_SESSION["user"],$title,$content);  //完成新增動作;  //完成新增動作
		redirect(site_url("article/postSuccess/".$insertID));
	}	


	public function postSuccess($articleID){
		session_start();
		$this->load->helper(array('form', 'url'));
		$this->load->view('article_success',Array(
				"pageTitle" => "發文系統 - 文章發表成功",
				"articleID" => $articleID
		));
	}



	public function view($articleID = null){
		session_start();
		$this->load->helper(array('form', 'url'));
		if($articleID == null){
			show_404("Article not found !");
			return true;
		}

		$this->load->model("ArticleModel");
		//完成取資料動作
		$article = $this->ArticleModel->get($articleID); 

		if($article == null){
			show_404("Article not found !");
			return true;	
		}

		#print_r ($article);
		//更新文章計數
		$this->ArticleModel->updateViews($articleID,$article->Views +1 );

		$this->load->view('article_view',Array(
			//設定網頁標題
			"pageTitle" => "發文系統 - 文章 [".$article->Title."] ", 
			"article" => $article
		));
	}

	public function view_all(){
		session_start();
		$this->load->helper(array('form', 'url'));

		$this->load->model("ArticleModel");
		//完成取資料動作
		$article = $this->ArticleModel->get_all_articles_author(); 


		print_r ($article);

		#$this->load->view('article_view',Array(
			//設定網頁標題
		#	"pageTitle" => "發文系統 - 文章 [".$article->Title."] ", 
		#	"article" => $article
		#));
	}

	# http://localhost/phptest/CodeIgniter/practice_20190702/index.php/article/edit
	public function edit($articleID = null){
		$this->load->helper(array('form', 'url'));
		session_start();
		if (!isset($_SESSION["user"]) || $_SESSION["user"] == null ){
		//沒有登入的，直接送他去登入。
		redirect(site_url("/user/login"));
		return true;
		}
		
		if ( $articleID == null){
			show_404("Article not found !");
			return true;
		}
		
		$this->load->model("ArticleModel");
		//完成取資料動作
		$article = $this->ArticleModel->get($articleID);
		
		if ($article->Author != $_SESSION["user"] ){
			show_404("Article not found !");
			redirect(site_url("/"));
			return true;
		}
		
		$this->load->view(
			'article_edit',Array(
			"pageTitle" => "修改文章 [".$article->Title."]",
			"article" => $article
		));
	}

	public function update(){
		$this->load->helper(array('form', 'url'));
		session_start();
		$articleID = $this->input->post("articleID");
	
		//就算是進行更新動作，該做的檢查還是都不能少
		if (!isset($_SESSION["user"]) || $_SESSION["user"] == null ){
			//沒有登入的，直接送他去登入。
			redirect(site_url("/user/login")); 
			return true;
		}		
	
		if ( $articleID == null){
			show_404("Article not found !");
			return true;
		}
	
		$this->load->model("ArticleModel");
		//完成取資料動作
		$article = $this->ArticleModel->get($articleID);  
	
		if ($article->Author != $_SESSION["user"] ){
			show_404("Article not found !");
			//不是作者又想編輯，顯然是來亂的，送他回首頁。
			redirect(site_url("/")); 
			return true;
		}
	
		$this->ArticleModel->updateArticle(
			$articleID,
			$this->input->post("title"),
			$this->input->post("content")
		);
	
		//更新完後送他回文章檢視頁面
		redirect(site_url("article/view/".$articleID));
	
	}


	public function del($articleID = null){
		$this->load->helper(array('form', 'url'));
		session_start();
		//就算是進行更新動作，該做的檢查還是都不能少
		if (!isset($_SESSION["user"]) || $_SESSION["user"] == null ){
		//沒有登入的，直接送他去登入。
		redirect(site_url("/user/login"));
		return true;
		}
		
		if ( $articleID == null){
		show_404("Article not found !");
		return true;
		}
		
		$this->load->model("ArticleModel");
		//完成取資料動作
		$article = $this->ArticleModel->get($articleID);
		
		if ($article->Author != $_SESSION["user"] ){
			show_404("Article not found !");
			//不是作者又想編輯，顯然是來亂的，送他回首頁。
			redirect(site_url("/"));
			return true;
		}
		
		$this->ArticleModel->del(
			$articleID
		);
		
		//更新完後送他回個人文章頁面
		redirect(site_url("article/author/".$_SESSION["user"]));
	}






}