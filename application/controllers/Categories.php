<?php
    class Categories extends CI_Controller{

        public function index(){

            $data['title'] = 'Categories';
            $data['categories'] = $this->category_model->get_categories();

            $this->load->view('templates/header');
			$this->load->view('categories/index', $data);
			$this->load->view('templates/footer');
        }
        
        public function create(){
            //check login
            if(!$this->session->userdata('logged_in')){
            redirect('users/login');
            }

            $data['title'] = 'Create category';

            $this->form_validation->set_rules('name', 'Name', 'required'); 

            if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('categories/create', $data);
				$this->load->view('templates/footer');
			} else {
                $this->category_model->create_category();
                
                //session message
            $this->session->set_flashdata('category_created', 
            'Your category has been created');

				redirect('categories');
			}
        }

        public function delete($id){
            //check login
            if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            }
    
            $this->category_model->delete_category($id);
    
            //session message
            $this->session->set_flashdata('category_deleted', 
            'The category has been deleted');
    
            redirect('categories');
        }

        public function posts($id){

            $data['title'] = $this->category_model->get_category($id)->name;
			$data['posts'] = $this->post_model->get_posts_by_category($id);

            //We are using the posts/index view because after all 
            //we just display some posts
            //But instead of fetching all of them, we just pass in
            //the data we want by categories
			$this->load->view('templates/header');
			$this->load->view('posts/index', $data);
			$this->load->view('templates/footer');

        }
    }

?>