<?php
 require_once '../Model/Vehicule.php';
class pagination {

    private $total;
    private $itemsPerPage; 
    private $nbr_pages;

   
    
    public function __construct() {
        $this->itemsPerPage=2;
        $vehicule = new Vehicule();
        $this->total =$vehicule ->totalVehicules();
        $this->nbr_pages = intval($this->total/$this->itemsPerPage);
    }

    public function getNbr_pages(){ return $this->nbr_pages ;}


    function getVehicule($page){
        $vehicule = new Vehicule();
       return $vehicule ->vehiculesPerPage($page , $this->itemsPerPage);
    }

}

