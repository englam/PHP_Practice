<?php
class Mycart extends CI_Controller {

    public function test()
    {

        $this->load->library('cart');
        #$data = array(
        #    'id'      => 'sku_123ABC',
        #    'qty'     => 1,
        #    'price'   => 39.95,
        #    'name'    => 'T-Shirt',
        #    'options' => array('Size' => 'L', 'Color' => 'Red')
        #);
    
        #$this->cart->insert($data);

        #$session_data = $this->session->all_userdata();
        #echo '<pre>';
        #print_r($session_data);

        $data = array(
            array(
                    'id'      => 'sku_123ABC',
                    'qty'     => 1,
                    'price'   => 39.95,
                    'name'    => 'T-Shirt',
                    'options' => array('Size' => 'L', 'Color' => 'Red')
            ),
            array(
                    'id'      => 'sku_567ZYX',
                    'qty'     => 1,
                    'price'   => 9.95,
                    'name'    => 'Coffee Mug'
            ),
            array(
                    'id'      => 'sku_965QRS',
                    'qty'     => 1,
                    'price'   => 29.95,
                    'name'    => 'Shot Glass'
            )
        );
        
        $this->cart->insert($data);

        $session_data = $this->session->all_userdata();
        echo '<pre>';
        print_r($session_data);

        foreach ($this->cart->contents() as $items)
        {
            echo $items;
        }




    }

    public function cart2()
    {

            $this->load->view('carts/index');

    }


    public function email()
    {
        $this->load->library('email');

        $this->email->from('your@example.com', 'Your Name');
        $this->email->to('someone@example.com');
        $this->email->cc('another@another-example.com');
        $this->email->bcc('them@their-example.com');

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');

        $this->email->send();
    }


}

?>