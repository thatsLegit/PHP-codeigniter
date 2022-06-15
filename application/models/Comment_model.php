<?php   

    class Comment_model extends CI_Model{
        public function __construct(){
            $this->load->database();
        }

        public function create_comment($post_id){
            $data = array(
                'post_id' => $post_id,
                'name' => $this->input->post('name'),
                'body' => $this->input->post('body'),
                'email' => $this->input->post('email')
            );

            return $this->db->insert('comments', $data);
        }

        public function get_comments($post_id){
            $this->db->order_by('comments.id', 'DESC');
            return $this->db->get_where('comments', array('post_id' => $post_id))
                ->result_array();
        }

    }