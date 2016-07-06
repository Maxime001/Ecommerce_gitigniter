<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class sitemodel extends CI_Model {
        
   
        
    public function __construct(){
        parent::__construct();
    }

    public function get_all(){
        $q = $this->db->select('*')->from('articles')
                ->join('prices','price_article_id = articles.article_id','left')
                ->join('images','images.image_article_id = articles.article_id','left')
                ->order_by('articles.article_id','desc')
                ->get();

			//var_dump($q->result());	
                if($q->num_rows()>0){
                    foreach($q->result() as $row){
                        $data[] = $row;
                    }
                    return $data;
                }
    }
    
    public function get_one($article_id){
        $q = $this->db->select('*')->from('articles')
        -> where('articles.article_id',$article_id)
        ->join('prices','price_article_id = articles.article_id','left')
        ->join('images','images.image_article_id = articles.article_id','left')
        ->order_by('articles.article_id','desc')
        ->get();
        if($q->num_rows()>0){
            return $q->row();
        }
    }
    
    public function signup($data){
        $this->db->insert('users',$data);
        return true;
    }
    
    public function login($email,$password){
        $q = $this->db->get_where('users',array('email'=>$email,'password'=>$password));
        if($q->num_rows()>0){
            $row = $q->row();
            $session = array('lastname'=>$row->lastname,'logged'=>true);
            $this->session->set_userdata($session);
            return true;
        }
        else{
            return false;
        }
    }
    
    public function is_logged(){
       
        return $this->session->userdata('lastname') && $this->session->userdata('logged');
    }
    
    public function get_countries(){
        $q = $this->db->get('countries');
        if($q->num_rows()>0){
            foreach($q->result() as $row){
                $data[] = $row;
            }
            return $data;
        }
    }
    
    public function get_user($param){
        if(is_numeric($param)){
            $this->db->where('u.user_id',$param);
        }
        else{
            $this->db->where('u.lastname',$param);
        }
        
        $q = $this->db->select('*')->from('users u')
                ->join('countries c','u.user_country_id == c.country_id')
                ->get();
        
        if($q->num_rows()>0){
            return $q->row();
        }
    }
}
