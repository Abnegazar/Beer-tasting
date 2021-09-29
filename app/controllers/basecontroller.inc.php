<?php
abstract class BaseController{
	public function __construct(){
		
	}
	protected $title;
	protected $description;
	protected $h1;

    protected $breadCrumbs = array();
 
	function getTitle(){
		return $this->title;
	}

	function getDescription(){
		return $this->description;
	}

	function getH1(){
		return $this->h1;
	}

}