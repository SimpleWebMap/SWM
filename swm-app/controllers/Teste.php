<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teste extends CI_Controller {

	/**
	 * Constructor
	 *
	 */
	public function __construct(){
		parent::__construct();
		initialize_dashboard();

		//be_logged();

	}


	public function index()
	{


    //print_r($xml->user);
    //print_r($file);
		
		$params = array('path' => 'swm-app/database/users.xml');
		$this->load->library('easyxml',$params); 			# Loading the library with the xml file path.
		
		//echo $this->easyxml->get_num_elements();				# Returning the number of elements.
		echo '<pre>';
		$resss = $this->easyxml->get_by_child('users', 'user', 'name', 'Fillipe');
		print_r($resss);

		echo $resss['id'];
		echo $resss->name;
		
		
		echo '---------------';
		// Verifying if the child "author" in the path "/catalog/book/author" exists or not.
		if( $childs = $this->easyxml->child_exists('users', 'user') ) 
		{
			echo "<br><br>The child exists.<br><pre>";
			print_r($childs);
			echo "</pre><hr>";
		}
		else 
		{
			echo "The child does not exists.";
		}
		
		// Verifying if the value "id" in the path "/catalog/book" exists or not.
		if( $value = $this->easyxml->attribute_value_exists('users', 'user','id','0') ) 
		{
				
			echo "<br><br>The value exists.<br><pre>";
			print_r($value);
			echo "</pre><hr>";
		}
		else 
		{
			echo "The value does not exists.";
		}
		
		// Removing a node based on its attribute value.
		#$this->easyxml->removeNodeByAttrib('users', 'user','id','3'); # Uncomment to delete the node.
		
		// Inserting new book
		$bk['name']		= "Filipe";
		$bk['email']		= "filipe@f.com";
		$bk['pass']		= "000000";
		
		#$bk_last_id = $this->easyxml->insert($bk, 'users', 'user');			 # Uncomment to insert a new book.
		#echo "<br>" . $bk_last_id . "<br>";
				
		// UPDATING BOOK
		$bk['name']			= "Vitóriaxxx";								 # BOOK ID
		$bk['pass']		= "vida";
		$bk['email']		= "victoria@vic.comxxx";
		$bk['tel']		= "8899999999";
		
		$bk_id = $this->easyxml->update($bk, 'users', 'user', 'id', '2');				 # Uncomment to update a book.
		#echo "<br>";
		#print_r($bk_id);
		#echo "<br>";
		
		
		
		
		
	}
	
	
	

}