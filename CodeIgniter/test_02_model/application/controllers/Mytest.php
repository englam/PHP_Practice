<?php
class Mytest extends CI_Controller {

    public function test()
    {

        $this->load->library('myclass');
        $this->myclass->some_method();

        $params = array('type' => 'large', 'color' => 'red');
        $this->load->library('myclass2',$params);
        $this->myclass2->some_method("Load module Test<br>");

        $this->load->library('user');
        echo $this->user->getName();

        echo 'parameter test: '.$this->myclass2->parameter_test().'<br>';

        echo "test";

        $this->load->helper('url');
        $this->load->library('session');
        $this->config->item('base_url');

        # $this ，只能在你的 Controllers、Models、Views 裡面執行，如果你想要在你的類別裡面使用 Codeigniter 類別，你可以參考下面作法
        $CI =& get_instance();
        $CI->load->helper('url');
        $CI->load->library('session');
        $CI->config->item('base_url');

        #$this->load->driver('class_name');
        #$this->load->driver('some_parent');
        #$this->some_parent->child_one->some_method();

        $this->output->enable_profiler(TRUE);
    }

    # cd C:\xampp\htdocs\phptest\CodeIgniter\test_02_model
    # php index.php mytest message
    # php index.php mytest message "John Smith"
    public function message($to = 'World')
        {
                echo "Hello {$to}!".PHP_EOL;
                #echo "Hello World";
        }

    public function calendar()
        {
            $this->load->library('calendar');
            $this->load->helper('url');
            #echo $this->calendar->generate();
            #echo $this->calendar->generate(2006, 6);


            #$data = array(
            #    3  => 'http://example.com/news/article/2006/06/03/',
            #    7  => 'http://example.com/news/article/2006/06/07/',
            #    13 => 'http://example.com/news/article/2006/06/13/',
            #    26 => 'http://example.com/news/article/2006/06/26/'
            #);
        
            #echo $this->calendar->generate(2006, 6, $data);



            #$prefs = array(
            #    'start_day'    => 'saturday',
            #    'month_type'   => 'long',
            #    'day_type'     => 'short'
            #);
            #$this->load->library('calendar', $prefs);
            #echo $this->calendar->generate();

            #$prefs = array(
            #    'show_next_prev'  => TRUE,
            #    'next_prev_url'  => site_url('user/events')
            #);
            #$this->load->library('calendar', $prefs);
            #echo $this->calendar->generate();
            #echo $this->calendar->generate($this->uri->segment(3), $this->uri->segment(4));

            $prefs['template'] = '

            {table_open}<table border="0" cellpadding="0" cellspacing="0">{/table_open}

            {heading_row_start}<tr>{/heading_row_start}

            {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
            {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
            {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

            {heading_row_end}</tr>{/heading_row_end}

            {week_row_start}<tr>{/week_row_start}
            {week_day_cell}<td>{week_day}</td>{/week_day_cell}
            {week_row_end}</tr>{/week_row_end}

            {cal_row_start}<tr>{/cal_row_start}
            {cal_cell_start}<td>{/cal_cell_start}
            {cal_cell_start_today}<td>{/cal_cell_start_today}
            {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}

            {cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
            {cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

            {cal_cell_no_content}{day}{/cal_cell_no_content}
            {cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}

            {cal_cell_blank}&nbsp;{/cal_cell_blank}

            {cal_cell_other}{day}{/cal_cel_other}

            {cal_cell_end}</td>{/cal_cell_end}
            {cal_cell_end_today}</td>{/cal_cell_end_today}
            {cal_cell_end_other}</td>{/cal_cell_end_other}
            {cal_row_end}</tr>{/cal_row_end}

            {table_close}</table>{/table_close}
            ';

            $this->load->library('calendar', $prefs);
            echo $this->calendar->generate();

        }


}

?>