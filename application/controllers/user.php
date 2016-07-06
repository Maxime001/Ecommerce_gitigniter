<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
        
    
    public function __construct(){
        parent::__construct();
        $this->user = ($this->sitemodel->is_logged()) ? $this->sitemodel->get_user($this->session->userdata('lastname')) : false;
        
        // Permets de connaitre le nom de la classe
        $this->view_folder = strtolower(__CLASS__).'/';
        // Permets de rechercher le dossier img
        $this->picture_path = base_url().'pictures/';
    }   
    
    // Affichage de tout les articles
    public function index(){
        
        $test = new sitemodel();
        var_dump($test->is_logged());
        
       

}
}