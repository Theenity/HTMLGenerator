<?php

/* 
 * Ces classes génèrent du HTML.
 * On utilise ElementDOMComposite pour presque toutes les balises.
 * ElementDOMSimple sont les balises feuilles de l'arbre DOM.
 * @author: Timothée SCHERRER
 */

/**
 * Classe composant
 */
class ElementDOM{
    
    private $nom;
    private $attributs;
    private $estFermante;
    private $parent;

    public function __construct($nom = null, $attributs = null, $estFermante = true, $parent = null) {
	$this->nom = $nom;
	$this->attributs = $attributs;
	$this->estFermante = $estFermante;
	$this->parent = $parent;
	
	// init
	if($parent != null) {
	    $this->parent->ajouter($this);
	}
    }
    
    // Getters
    public function getNom() {
	return $this->nom;
    }	
    protected function getAttributs() {
	return $this->attributs;
    }
    protected function estFermante() {
	return $this->estFermante;
    }
    public function getParent() {
	return $this->parent;
    }
    
    // Setters
    protected function setNom($nom) {
	$this->nom = $nom;
    }	
    protected function setAttributs($attributs) {
	$this->attributs = $attributs;
    }
    protected function setEstFermante($bool) {
	$this->estFermante = $bool;
    }
    protected function setParent($parent) {
	$this->parent = $parent;
    }
    
    /**
     * 
     * @param type $nom
     * @param type $valeur
     */
    protected function ajouterAttribut($nom, $valeur) {
	$this->attributs[$nom] = $valeur;
    }
    
    /**
     * 
     * @return string
     */
    protected function afficherAttributs() {
	$str = '';
	if($this->getAttributs() != null) {
	    foreach($this->getAttributs() as $nom => $valeur) {
		$str .= ' '.$nom.'="'.$valeur.'" ';
	    }
	}
	return $str;
    }
    
}

/**
 * Classe composite
 */
class ElementDOMComposite extends ElementDOM {
    protected $listeElementsDOM;
    
    public function __construct($nom = null, $attributs = null, $parent = null) {
	parent::__construct($nom, $attributs, true);
	// init
	$this->listeElementsDOM = array();
    }
    
    // Getter
    public function getElementsDOM() {
	return $this->listeElementsDOM;
    }
    
    
    public function ajouter(ElementDOM $elementDOM) {
	$elementDOM->setParent($this);
	$this->listeElementsDOM[] = $elementDOM;
    }
    
    public function retirer($elementDOM, $id) {
	// manip d'array
    }
    
    /**
     * Affiche tout l'arbre DOM (jusqu'aux feuilles) à partir de cet élément. Méthode récursive.
     * @param type $niveau
     */
    public function afficherArbreDOM($niveau = 0) {
	echo '<'. $this->getNom() .' '. $this->afficherAttributs() .'>';
	foreach($this->listeElementsDOM as $elementDOM) {
	    if($elementDOM instanceof self) {
		$elementDOM->afficherArbreDOM($niveau+1);
	    } else {
		echo $elementDOM->afficherElement();
	    }
	}
	echo '</'.$this->getNom().'>';
    }
}

/**
 * Classe feuille
 */
class ElementDOMSimple extends ElementDOM {
    protected $contenu;
    
    public function __construct($nom = null, $attributs = null, $parent = null, $estFermante = true) {
	parent::__construct($nom, $attributs, $estFermante, $parent);
    }
    
    // Getter
    public function getContenu() {
	return $this->contenu;
    }
    
    // Setter
    public function setContenu($contenu) {
	$this->contenu = $contenu;
    }
    
    /**
     * Ajoute du contenu textuel à un élément simple
     * @param type $contenu
     */
    public function appendContenu($contenu) {
	$this->contenu .= $contenu;
    }

    /**
     * Affiche l'élément DOM
     */
    public function afficherElement() {
	if($this->estFermante()) {
	    $str = '<'.$this->getNom();
	    $str .= $this->afficherAttributs();
	    $str .= '>'.$this->getContenu().'</'.$this->getNom().'>';
	    echo $str;
	} else {
	    if($this->getNom() == '') {
		echo '';
	    } else {
		echo '</'.$this->getNom().'>';
	    }
	}
    }

    
}

?>