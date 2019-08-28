<?php
class Pages extends CI_Controller {

    public function view($page = 'home')
    {
            # http://localhost/phptest/CodeIgniter/test_01/index.php/Pages/view
            if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
            {
                    // Whoops, we don't have a page for that!
                    show_404();
            }

            echo $page;
    
            $data['title'] = ucfirst($page); // Capitalize the first letter
            $data['englam'] = "englam";
            #$this->load->view('templates/header', $data);
            #$this->load->view('pages/'.$page, $data);
            #$this->load->view('templates/footer', $data);
            $this->load->view('templates/header', $data);
            $this->load->view('pages/'.$page);
            $this->load->view('templates/footer', $data);
    }
}

?>