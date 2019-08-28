<?php

class Form extends CI_Controller {

        # http://localhost/phptest/CodeIgniter/test_03_form/index.php/form/
        public function index()
        {
                $this->load->helper(array('form', 'url'));

                $this->load->library('form_validation');

                $this->form_validation->set_rules('username', 'Test_Username', 'required');
                $this->form_validation->set_rules('password', 'Test_Password', 'required',array('required' => 'You must provide a %s.'));
                $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required');

                if ($this->form_validation->run() == FALSE)
                {
                        $this->load->view('myform');
                }
                else
                {
                        $this->load->view('formsuccess');
                }
        }
}

?>