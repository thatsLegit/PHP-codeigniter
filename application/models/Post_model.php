<?php
class Post_model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }

    public function get_posts($slug=FALSE, $limit=FALSE, $offset=FALSE){
        if($limit){
            $this->db->limit($limit, $offset);
        }

        if($slug === FALSE){
            $this->db->order_by('posts.id', 'DESC');
            //select * 
            //from categories where 
            //categories.id = posts.category_id
            $this->db->join('categories', 'categories.id = posts.category_id');
            return $this->db->get('posts')->result_array();		
        }

        //get * from posts where slug = $slug
        return $this->db->get_where('posts', array('slug' => $slug))->row_array();
    }

    public function get_posts_by_category($id){
        //select *
        //from categories, posts
        //where categories.id = posts.category_id
        //and category_id = $id
        //order by posts.id DESC;
        $this->db->order_by('posts.id', 'DESC');
        $this->db->join('categories', 'categories.id = posts.category_id');
        return $this->db->get_where('posts', array('category_id' => $id))->result_array();
    }


    public function create_post($post_image){
        $slug = url_title($this->input->post('title'));

        $data = array(
            'title' => $this->input->post('title'),
            'slug' => $slug,
            'body' => $this->input->post('body'),
            'category_id' => $this->input->post('category_id'),
            'post_image' => $post_image,
            //with the session infos we can know who wrote the post
            'user_id' => $this->session->userdata('user_id') 
        );

        return $this->db->insert('posts', $data);
    }

    public function delete_post($id){
        $image_file_name = $this->db->select('post_image')->get_where('posts', array('id' => $id))->row()->post_image;
		$cwd = getcwd(); // save the current working directory
		$image_file_path = $cwd."\\assets\\images\\posts\\";
		chdir($image_file_path);
		unlink($image_file_name);
		chdir($cwd); // Restore the previous working directory
		$this->db->where('id', $id);
		$this->db->delete('posts');
		return true;
    }

    public function update_post(){
        $slug = url_title($this->input->post('title'));

        $data = array(
            'title' => $this->input->post('title'),
            'slug' => $slug,
            'body' => $this->input->post('body')
        );
        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('posts', $data);
    }

    public function get_categories(){
        $this->db->order_by('name');
        return $this->db->get('categories')->result_array();
    }
}

?>