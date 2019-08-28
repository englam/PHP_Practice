<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myclass2 {

        public function __construct($params)
        {
                echo "123 <br>";
                echo 'Type: '. $params['type'].'<br>';
                echo 'Color: '. $params['color'].'<br>';
                $this->parameter1  = $params['type'];
        }

        public function some_method($test_data)
        {
            $data = $this->parameter1;
            echo $data;
            echo $test_data;
        }

        public function parameter_test()
        {
            return $this->parameter1;

        }
}

?>