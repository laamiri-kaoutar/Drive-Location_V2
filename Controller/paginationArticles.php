<?php
 require_once '../Model/Article.php';
class pagination {

    // private $total;
    // private $itemsPerPage; 
    // private $nbr_pages;

   
    
    public function __construct() {
        // $this->itemsPerPage=2;
        $article = new Article();
        $this->total =$article ->totalVehicules();
        $this->nbr_pages = intval($this->total/$this->itemsPerPage);
    }

    public function getNbr_pages($itemsPerPage){ 
        $article = new Article();
       $total = $article ->totalArticlesPerTheme();
       return $total/$itemsPerPage;
    }

    function getVehicule($page ,$itemsPerPage , $id){
        $article = new Article();
       return $article ->totalArticlesPerTheme($page ,$itemsPerPage , $id);
    }

}

