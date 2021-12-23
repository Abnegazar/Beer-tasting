<?php
/**
 * an abstract class for controller
 * @author PDL groupe 4
 */
abstract class BaseController
{
    
	protected $title;
	protected $description;
	protected $h1;
	protected $useLayout = true;
    /**
	 * Constructor of the controller
	 */
	public function __construct()
	{
	}
    /**
	 * Provide the controller page title
	 * @return string the title
	 */
	function getTitle()
	{
		return $this->title;
	}
     /**
	 * Provide the controller page description
	 * @return string the description
	 */
	function getDescription()
	{
		return $this->description;
	}
     /**
	 * Provide the controller h1
	 * @return string the h1
	 */
	function getH1()
	{
		return $this->h1;
	}
    /**
	 * Provide if the controller use layout or not
	 * @return boolean the decision
	 */
	function useLayout()
	{
		return $this->useLayout;
	}
    /**
	 * Provide the controller beadCrumbs for all elements
	 * @return string the breadCrumbs
	 */
	function getBreadCrumbs()
	{
		return $this->breadCrumbs;
	}
}