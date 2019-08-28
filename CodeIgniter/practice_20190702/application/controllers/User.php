<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

    #http://localhost/phptest/CodeIgniter/practice_20190702/index.php/user/register
	public function register()
	{
        $this->load->helper(array('form', 'url'));
		$this->load->view('register',Array("pageTitle" => "發文系統 - 會員註冊"));
	}

	#public function login(){
		#$this->load->view('login');	
    #}
    
    public function registering(){
        $this->load->helper(array('form', 'url'));
        #$account = $this->input->get("account");
        $account = $this->input->post("account");
		$password= $this->input->post("password");
        $passwordrt= $this->input->post("passwordrt");

        # trim 的意思是去掉首尾空白，避免這些空白造成的誤判
        if( trim($password) =="" || trim($account) =="" )
        {
            
			$this->load->view('register',Array(
				"errorMessage1" => "Account or Password shouldn't be empty,please check!" ,
				"account" => $account
			));
			return false;
        }
        
        if( $password != $passwordrt ){
			//如果不一致，我們讀取 register view，
			//但將 $account 跟錯誤訊息帶入作為處理
			$this->load->view('register',Array(
				"errorMessage2" => "Password doesn't match re-type password,please check yout input!" ,
				"account" => $account
			));
			return false;
		}
        
        #echo $account;
        
        $this->load->model("UserModel");
        
        # 如果有值 代表account 已經有存在
        if($this->UserModel->checkUserExist(trim($account))){ //檢查帳號是否重複
            $this->load->view('register',Array(
                "errorMessage3" => "This account is already in used." ,
                "account" => $account
            ));
            return false;
        }
        
        $this->UserModel->insert(trim($account),trim($password));  //完成新增動作

        $this->load->view('register_success',
        Array("account" => $account,
              "pageTitle" => "發文系統 - 會員註冊成功",));	
    }
    

    public function login(){
        $this->load->helper(array('form', 'url'));
		session_start();
		if(isset($_SESSION["user"]) && $_SESSION["user"] != null){ //已經登入的話直接回首頁
			redirect(site_url("/")); //轉回首頁
            return true;
		}

		$this->load->view(
			"login",
			Array( "pageTitle" => "發文系統 - 會員登入"	)
		);
    }
    

    public function logining(){
        $this->load->helper(array('form', 'url'));
        #$this->load->library('session');
		session_start();
		if(isset($_SESSION["user"]) && $_SESSION["user"] != null){ //已經登入的話直接回首頁
			redirect(site_url("/")); //轉回首頁
			return true;
		}

		$account = trim($this->input->post("account"));
		$password = trim($this->input->post("password"));

		$this->load->model("UserModel");
        #$user = $this->UserModel->getUser($account,$password);
        #print_r( $user['Account']);
        $user = $this->UserModel->getUser($account,$password)['Account'];
        #echo $user;

		if($user == null){
			$this->load->view(
				"login",
				Array( "pageTitle" => "發文系統 - 會員登入"	,
					"account" => $account,
					"errorMessage4" => "使用者或密碼錯誤"
				)
			);		
			return true;
		}

        $_SESSION["user"] = $user;
        #$name = $this->session->userdata('name');
        #print_r($this->session->all_userdata());
		redirect(site_url("/")); //轉回首頁
	}

    public function logout(){
        $this->load->helper(array('form', 'url'));
		session_start();
		session_destroy();
		redirect(site_url("/user/login")); //轉回登入頁
    }
    

    public function sessiontest(){
        #http://[::1]/phptest/CodeIgniter/practice_20190702/index.php/user/sessiontest
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $_SESSION["user"] = "123";
        #echo $_SESSION["user"];
        $newdata = array(
            'username'  => 'johndoe',
            'email'     => 'johndoe@some-site.com',
            'logged_in' => TRUE
        );

        $this->session->set_userdata($newdata);
        echo "user test: ".$this->session->userdata('user')."<br>";
        echo "username test: ".$this->session->userdata('username')."<br>";

        print_r($this->session->all_userdata());

        $this->session->unset_userdata('username');
        echo "username test: ".$this->session->userdata('username')."<br>";

        # do not work
        #$array_items = array('username' => '', 'email' => '', 'logged_in' => '');
        #$this->session->unset_userdata($array_items);
        echo "email test: ".$this->session->userdata('email')."<br>";

        # work
        #$this->session->sess_destroy();
        echo "email test: ".$this->session->userdata('email')."<br>";
        
    }

    public function sessiontest1(){
        # test session page
        #http://[::1]/phptest/CodeIgniter/practice_20190702/index.php/user/sessiontest1
        $this->load->library('session');
        
        if(isset($_SESSION["email"]))
        {
        echo "email test: ".$_SESSION["email"]."<br>";
        }

    }


    public function sessiontest2(){
        #http://[::1]/phptest/CodeIgniter/practice_20190702/index.php/user/sessiontest2

        session_start();
        $_SESSION["user"] = "123";
        echo "user test: ".$_SESSION["user"]."<br>";

        session_destroy();
        #echo "user test: ".$_SESSION["user"]."<br>";

    }

    public function sessiontest3(){
        # test session page
        #http://[::1]/phptest/CodeIgniter/practice_20190702/index.php/user/sessiontest3
        session_start();

        if(isset($_SESSION["user"]))
        {
        echo "user test: ".$_SESSION["user"]."<br>";
        }

    }

    public function test(){
        $this->load->helper(array('form', 'url'));
		session_start();

		$this->load->view(
			"test"
		);
    }


}

?>