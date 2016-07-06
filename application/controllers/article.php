<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {
        
    
    public function __construct(){
        parent::__construct();
        // Permets de connaitre le nom de la classe
        $this->view_folder = strtolower(__CLASS__).'/';
        // Permets de rechercher le dossier img
        $this->picture_path = base_url().'pictures/';
    }   
    
    // Affichage de tout les articles
    public function index(){
        $data = array(
            // On passe ce parametre pour appeler le bon contenu. On automatise avec le nom propre de la classe et de la méthode
            'content' => $this->view_folder.__FUNCTION__,
            'articles'=> $this->sitemodel->get_all(),
            'title' => 'bienvenue sur le boutique maxou'
        );
     
        $this->load->view('template/content',$data);
    }
    
    public function panier(){
        $data = array(
            // On passe ce parametre pour appeler le bon contenu. On automatise avec le nom propre de la classe et de la méthode
            'content' => $this->view_folder.__FUNCTION__,
            'cart'=> $this->cart->contents(),
            'total'=> $this->cart->total(),
            'total_articles'=>$this->cart->total_items(),
            'title' => 'Mon panier'
        );
        
       $this->load->view('template/content',$data);
    }
    
    
    // Fonction d'ajout au panier et redirection vers page panier
    public function add($article_id = null){
        if($article_id == null || !$this->sitemodel->get_one($article_id)){
            redirect("article");
           
        }
        $article = $this->sitemodel->get_one($article_id);
         
        $data = array(
            'id'=>$article->article_id,
            'qty'=>1,
            'price'=>$article->price_amount,
            'name'=> $article->title
         );
        $this->cart->insert($data);
        redirect('article/panier');       
    }
    
    // Affiche un article et le détail
    public function show($article_id = null){
        if($article_id == null || !$this->sitemodel->get_one($article_id)){
            redirect("article");
        }
        
        $article = $this->sitemodel->get_one($article_id);
        
        $data = array(
            // On passe ce parametre pour appeler le bon contenu. On automatise avec le nom propre de la classe et de la méthode
            'content' => $this->view_folder.__FUNCTION__,
            'article'=> $article,
            'title' => $article->title
        );
        $this->load->view('template/content',$data);
        
    }
    
   public function delete($rowid=null)
	{
		if(!$rowid){redirect();exit;}
		$data = array(
			'rowid'=>$rowid,
			'qty'=>0
		);

		$this->cart->update($data);

		if($this->input->is_ajax_request()){
			$response = array(
				'success'=>true,
				'nb_article'=>$this->cart->total_items(),
				'total'=>number_format($this->cart->total(), 2, ',', ' ')
			);
			echo json_encode($response);exit;
		}

		redirect('article/panier');
	}
    
    public function update($rowid = null){
        if(!$rowid ||!$this->input->post('qty') || !is_numeric($this->input->post('qty'))){
            redirect("article");exit;
        }

        $data = array(
            'rowid'=>$rowid,
            'qty'=>$this->input->post('qty')
        );
        
        $this->cart->update($data);
        
        if($this->input->is_ajax_request()){
            $reponse = array(
                'success'=>true,
                'nb_article'=>$this->cart->total_items(),
                'total'=>  number_format($this->cart->total(),2,',',' '),
                'total_for_item'=> number_format($this->input->post('qty')*$this->input->post('price'),2,',',' ')
            );
            
            echo json_encode($reponse);exit;
        }
        
        redirect('article/panier');  
    }

}
