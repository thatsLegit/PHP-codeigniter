<?php

class Pages extends CI_Controller{
    //Mapping : ciblog/pages/view/... : about, home
    //Mapping : ciblog : home
    //Mapping : ciblog/home : home
    //Mapping : ciblog/about : about
    public function view($page = 'home'){
        if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
            show_404();
        }

        //data is an array containing the title of the page
        //which is just the name of the file with an uppercase
        //first letter.
        $data['title'] = ucfirst($page);
        
        $this->load->view('templates/header');
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer');
    }
}

?>