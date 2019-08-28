<?php
class News_model extends CI_Model {

        # INSERT INTO `news`(`id`, `title`, `slug`, `text`) VALUES (Null,'Write Like You Talk','false','Here\'s a simple trick for getting more people to read what you write: write in spoken language. Something comes over most people when they start writing. They write in a different language than they\'d use if they were talking to a friend. The sentence structure and even the words are different. No one uses \"pen\" as a verb in spoken English. You\'d feel like an idiot using \"pen\" instead of \"write\" in a conversation with a friend.')
        public function __construct()
        {
                $this->load->database();
        }


        public function get_news($slug = FALSE)
        {
                if ($slug === FALSE)
                {
                        $query = $this->db->get('news');
                        return $query->result_array();
                }
        
                $query = $this->db->get_where('news', array('slug' => $slug));
                return $query->row_array();
        }

        public function set_news()
        {
                # load library for url_title
                $this->load->helper('url');
                
                # url_title ------------library , to convert "space" to "-" 
                $slug = url_title($this->input->post('title'), 'dash', TRUE);

                $data = array(
                        'title' => $this->input->post('title'),
                        'slug' => $slug,
                        'text' => $this->input->post('text')
                );

                return $this->db->insert('news', $data);
        }

}

?>