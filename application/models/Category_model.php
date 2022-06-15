<?php

    class Category_model extends CI_Model{
        public function __construct(){
            $this->load->database();
        }

        public function create_category(){
            $data = array(
                'name' => $this->input->post('name'),
                'user_id' => $this->session->userdata('user_id')
            );

            return $this->db->insert('categories', $data);
        }

        public function get_categories(){
            $this->db->order_by('name');
            return $this->db->get('categories')->result_array();
        }

        public function get_category($id){
			return $this->db->get_where('categories', array('id' => $id))->row();
		}

        public function delete_category($id){
            $this->db->where('id', $id);
            $this->db->delete('categories');
            return true;
        }

    }
?>