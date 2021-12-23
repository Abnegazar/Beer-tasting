  <?php
  /**
 * an interface for controller
 * @author PDL groupe 4
 */
	interface Controller
	{
		/** Constructor to initialize controller */
		function __construct();
        /**
		 * Provide the controller page content
		 * @return content the content
		 */
		function render();
		/**
		 * Provide the controller page title
		 * @return string the description
		 */
		function getTitle();
		/**
		 * Provide the controller page description
		 * @return string the description
		 */
		function getDescription();
		/**
		 * Provide the controller page h1
		 * @return string the description
		 */
		function getH1();
		/**
	      * Provide if the controller use layout or not
	      * @return boolean the decision
	    */
		function useLayout();
		/**
		 * Provide the controller page breadCrumbs
		 * @return string the description
		 */
		function getBreadCrumbs();
	}