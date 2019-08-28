<?php 
   class Test extends CI_Controller {
  
        // http://localhost/phptest/CodeIgniter/test_01/index.php/test/index
        public function index(){
            #echo "hello test";
            #$this->load->view('test');

            # load db default
            $this->load->database();

            # *** add user to db
            #$data = array(
            #    'Account' => "testdb1",
            #    'Password' => "testdb2"
            #);
            #$this->db->insert('user', $data);

            # *** update user db
            # UPDATE `user` SET `Account`='aa',`Password`='bb' WHERE `UserID`=14

            #$data = array(
            #    'Account' => "testdb7", 
            #    'Password' => "testdb7"
            #    );

            #$this->db->where('UserID', "14");
            #$this->db->update('user', $data);
            # or
            #$this->db->update('user', $data, array('UserID' => "14"));

            # *** delete user db
            #$this->db->delete('user', array('UserID' => "13"));


            # get db
            $query = $this->db->query('SELECT * FROM `user` WHERE 1');

            foreach ($query->result() as $row)
            {
                    echo $row->Account;
                    echo $row->Password;
                    echo "<br>";
            }
            
            echo 'Total Results: ' . $query->num_rows()."<br>";
            echo 'Total Results: ' . $query->num_fields()."<br>";
            $query->free_result();  // The $query result object will no longer be available

            echo "<br><br><br>";
            echo "DB Seek Test <br>";
            # get db
            $query = $this->db->query('SELECT * FROM `user` WHERE 1');
            $query->data_seek(5);

            foreach ($query->result() as $row)
            {
                    echo $row->Account;
                    echo $row->Password;
                    echo "<br>";
            }
            
            echo "last_query: ".$this->db->last_query()."<br>";
            echo "count_all: ".$this->db->count_all('user')."<br>";
            echo "platform: ".$this->db->platform()."<br>";


            # load db test1
            #$this->load->database('test1');
            #$DB2 = $this->load->database('test1', TRUE);

            
            # get db
            #$query = $this->db->query('SELECT * FROM `test` WHERE 1');
            #$query = $DB2->query('SELECT * FROM `test` WHERE 1');
            #foreach ($query->result() as $row)
            #{
            #        echo $row->test1;
            #        echo $row->test2;
            #        echo $row->test3;
            #        echo "<br>";
            #}
            
            #echo 'Total Results: ' . $query->num_rows();


        }

    // http://localhost/phptest/CodeIgniter/test_01/index.php/test/index1
      public function index1() { 
            $this->load->database();
            #$query = $this->db->get('user',5);
            #$query = $this->db->get('user');

            #$this->db->select('UserID, Account');
            #$query = $this->db->get('user');

            #$this->db->select_min('UserID');
            #$this->db->select_max('UserID');
            #$this->db->select_avg('UserID');
            #$query = $this->db->get('user');

            #$this->db->where('Account', "englam1");
            #$this->db->where('Account !=', "englam1");
            #$query = $this->db->get('user');

            #$array = array('Account' => 'englam1', 'Password' => '12345678');
            #$this->db->where($array);
            #$query = $this->db->get('user');

            #$where = "Account='englam1' AND Password='12345678'";
            #$this->db->where($where);
            #$query = $this->db->get('user');

            #$this->db->like('Account', 'englam');
            #$query = $this->db->get('user');

            #$this->db->group_by("Account");
            #$query = $this->db->get('user');

            #$this->db->order_by('UserID', 'DESC');
            #$this->db->order_by('UserID', 'AESC');
            #$query = $this->db->get('user');

            #$this->db->limit(10);
            #$query = $this->db->get('user');

            #echo $this->db->count_all_results('user').'<br>';
            #echo $this->db->count_all('user').'<br>';
            #$this->db->like('Account', 'englam');
            #$this->db->from('user');
            #echo $this->db->count_all_results().'<br>';

            # SELECT * FROM `user` WHERE Account='englam1'
            $query =$this->db->select('*')->from('user')
                ->group_start()
                        ->where('Account', 'englam1')
                        ->or_group_start()
                                ->where('Account', 'englam2')
                                ->where('Password', '1234567')
                        ->group_end()
                ->group_end()
                #->where('d', 'd')
            ->get();

            foreach ($query->result() as $row)
            {
                echo $row->UserID;
                echo $row->Account;
                #echo $row->Password;
                echo "<br>";
            }


      } 


      public function index2() { 
        $this->load->database();


        $tables = $this->db->list_tables();

        foreach ($tables as $table)
        {
                echo 'Table: '.$table.'<br>';
        }


        if ($this->db->table_exists('user'))
        {
            $this->db->order_by('UserID', 'AESC');
            $query = $this->db->get('user');
            foreach ($query->result() as $row)
            {
                echo $row->UserID;
                echo $row->Account;
                #echo $row->Password;
                echo "<br>";
            }

        }


        $fields = $this->db->list_fields('user');

        foreach ($fields as $field)
        {
            echo 'field: '.$field.'<br>';
        }


        

        if ($this->db->field_exists('Account', 'user'))
        {
            foreach ($fields as $field)
            {
                echo 'field: '.$field.'<br>';
            }
        }




      } 


   } 
?>