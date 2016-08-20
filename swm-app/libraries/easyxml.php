<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Class easyxml.
 * 
 * This class is an abstraction layer between controllers and 
 * XML files. This class has the aim to behave like CodeIgniter 
 * DAO models.
 * 
 * @author Carlos Eduardo da Silva <carlosedasilva@gmail.com>
 * @author Adaptado por Francisco Rodrigo Cunha de Sousa <rodrigofrcs@hotmail.com>
 * @package libraries
 * @link https://github.com/SimpleWebMap/SWM
 * @version 1.0
 * 
 * @todo Make this class generic. The specific data related to 
 * 		 a XML file should be inside models no here. Next versions of 
 * 		 of this class the DAO and VO classes should be inside models 
 *		 folder and this class have to be instantiated inside the model 
 *		 files not directly from controllers.  
 */
class Easyxml {
	
	/**
	 * Constructor
	 * 
	 * Constructor to validate the environment and load the xml file.
	 *
	 * @access	public
	 * @param	mixed $params  path = '/database/db_test.xml'
	 */
	function __construct() {
/*		if ( file_exists ( $params ['path'] )):
			if( extension_loaded('simplexml') ):
				if( is_writable($params ['path']) ):
					$this->path = $params ['path'];
					if( ! $this->xml = simplexml_load_file( $params ['path'], 'SimpleXMLExtended' ) ):
						show_error('Error reading '.basename( $params ['path'] ).' file.');
					endif;
				else:
					show_error('The file '.basename( $params ['path'] ).' is not writable! Check the permissions.');	
				endif;
			else:
				show_error('SimpleXML is not loaded! Check the loaded modules you have: <pre>' . 
							var_export( get_loaded_extensions(), true ) . '</pre>' );	
			endif;
		else:
			show_error('Some featutres of EasyXML wont work, because the XML file does\'t exist! 
						Check the path you informed: ' . $params ['path'] );
		endif;
*/
	}


	public function xml($path){
		$xml = FALSE;
		if ( file_exists ( $path )):
			if( extension_loaded('simplexml') ):
				if( is_writable($path) ):
					if( ! $xml = simplexml_load_file( $path ) ):
						show_error('Error reading '.basename( $path ).' file.');
					endif;
				else:
					show_error('The file '.basename( $path ).' is not writable! Check the permissions.');	
				endif;
			else:
				show_error('SimpleXML is not loaded! Check the loaded modules you have: <pre>' . 
							var_export( get_loaded_extensions(), true ) . '</pre>' );
			endif;
		else:
			show_error('Some featutres of EasyXML wont work, because the XML file does\'t exist! 
						Check the path you informed: ' . $path );
		endif;
		return $xml;
	}
	
	
	/**
	 * Get Num Elements
	 * 
	 * Return the number of nodes in XML file.
	 * 
	 * @access public
	 * @return int The number of elements.
	 * 
	 * @example $this->easyxml->get_num_elements();
	 */
	public function get_num_elements($path) {
		$count = 0;

		foreach ( $this->xml($path) as $node ):
			$count ++;
		endforeach;

		return $count;
	}


	public function get_by_child( $path, $child1, $child2, $child3, $value ){
		$result = FALSE;
		$nodename = '/'.$child1.'/'.$child2;
		$res = $this->xml($path)->xpath($nodename);

		foreach ($res as $key => $obj):
			foreach ($obj as $k => $v):
				if($k = $child3 && $v == $value):
					$result = $obj;
				endif;
			endforeach;
		endforeach;

		if($result != FALSE):
			return $result; 
		else:
			return FALSE;
		endif;
	}
	
	
	
	/**
	 * Child Exists
	 * 
	 * Check if a particular child exists in the xml file.
	 * 
	 * @access public
	 * @param  string $child1	Name of the child node.
	 * @param  string $child2	Name of the subchild node.
	 * 
	 * @return mixed				If true return the number of childs or else return false.
	 * 
	 * @example $this->easyxml->child_exists('/user/user/name');
	 */
	public function child_exists( $path, $child1, $child2 ) {
		$nodename = '/'.$child1.'/'.$child2;
		$result = $this->xml($path)->xpath($nodename);

		return count( $result ) ? $result : false; 
	}
	
	
	
	/**
	 * Attribute Value Exists
	 * 
	 * Check if a certain value of an attribute exists in XML file.
	 * 
	 * @access public
	 * @param  string $child1	Name of the child node.
	 * @param  string $child2	Name of the subchild node.
	 * @param string $attribute		Name of  the value.
	 * @param string $atribvalue	Value of the attribute.
	 * 
	 * @return mixed				If true return the number of values or else return false.
	 * 
	 * @example $this->easyxml->attribute_value_exists('users', 'user','id','25');
	 */
	public function attribute_value_exists( $path, $child1, $child2, $attribute, $atribvalue ) {
		$nodename = '/'.$child1.'/'.$child2;
		$xpath_val	= "//".$nodename."[@".$attribute."='".$atribvalue."']";
		$res		= $this->xml($path)->xpath( $xpath_val );
		
		return count( $res ) ? $res : false;
	}
	
	
	
	/**
	 * Remove Node By Attribute
	 * 
	 * Remove a node from xml file by its attribute.
	 * 
	 * @access public
	 * @param  string $child1	Name of the child node.
	 * @param  string $child2	Name of the subchild node.
	 * @param string $attribute	Name of the value.
	 * @param string $value		Value of the attribute.
	 * 
	 * @return boolean TRUE: Delete success. FALSE: Delete errror.
	 * 
	 * @example $this->easyxml->removeNodeByAttrib('users/user','id','1');
	 */
	public function removeNodeByAttrib( $path, $child1, $child2, $attribute, $value ) {
		$xml = $this->xml($path);

		$nodename = '/'.$child1.'/'.$child2;
		$xpath_val	= "//".$nodename."[@".$attribute."='".$value."']";
		$res		= $xml->xpath( $xpath_val );

		print_r($res);

		if( count( $res ) ):
			$xpath_val	= "//".$nodename."[@".$attribute."='".$value."']";
			$res		= $xml->xpath($xpath_val);
			
			foreach( $res as $key => $node ):
				foreach( $node->attributes() as $attrib => $val ):
					if( ($attrib == $attribute) && ($val == $value) ):
						$oNode = dom_import_simplexml( $node );
					endif;
				endforeach;
			endforeach;
			$oNode->parentNode->removeChild( $oNode );
			$this->saveXMLIndented( $xml, $path );
			return TRUE;
		else:
			return FALSE;
		endif;
	}
	
	
	
	/**
	 * Force conversion from ISO8859-1 to UTF-8.
	 * 
	 * It's a problem for non-english websites/systems to handle XML in
	 * other languages. So this method tries to give a hand converting 
	 * texts in iso8859-1 to UTF-8.
	 * 
	 * @access private
	 * @param  string $text The text to be converted.
	 * 
	 * @return string	The string in UTF-8 encode.
	 * 
	 * @example $content = $this->forceIso8859toUTF8( $content );
	 */
	private function forceIso8859toUTF8( $text ) {
		return iconv( "ISO-8859-1", "UTF-8//TRANSLIT", $text );
	}
	
	
	
	/**
	 * Get Max Attribute
	 *
	 * Returns the maximum value of an attribute.
	 *
	 * @access private
	 * @param  string $child1	Name of the child node.
	 * @param  string $child2	Name of the subchild node.
	 * @param string $attribute		Name of  the attribute.
	 *
	 * @return mixed				The maximum value of an attribute.
	 * 
	 * @example $this->get_max_attribute('usersr', 'user','id');
	 */
	private function get_max_attribute( $path, $child1, $child2, $attribute) {
		$nodename = '/'.$child1.'/'.$child2;
		$xpath_val	= "//".$nodename."[@".$attribute."]";
		$res		= $this->xml($path)->xpath( $xpath_val );
		
		foreach( $res as $key => $node ):
			foreach( $node->attributes() as $attrib => $val ):
				if( ($attrib == $attribute) ):
					$arr[] = preg_replace("/[^0-9]/","", $val);
				endif;
			endforeach;
		endforeach;

		return max($arr);
	}
	
	
	/**
	 * Insert 
	 * 
	 * Inserts a new item node in xml file.
	 * 
	 * @param	array $data item information.
	 * @param  string $child1	Name of the child node.
	 * @param  string $child2	Name of the subchild node.
	 * @return	int 		The Id of inserted item.
	 * 
	 * @example $this->easyxml->insert_item($arrayChildNodes);
	 */
	public function insert( $path, $data, $child1, $child2 ) {
		$nodename = '/'.$child1.'/'.$child2;
		$xml        = $this->xml($path);
		$item		= $xml->addChild($child2);
		$last_id	= $this->get_max_attribute($path, $child1, $child2,'id') + 1;
		$last_id	= $last_id;
		
		$item->addAttribute('id', $last_id);
		
		foreach($data as $key => $value):
			$item->addChild($key,$value);
		endforeach;
		
		$this->saveXMLIndented( $xml, $path );
				
		return $last_id; #returning last id
	}
	
	
	
	/**
	 * Update item
	 * 
	 * Update a item node.
	 * 
	 * @param	array 	$data	item information, including its Id.
	 * @param  string $child1	Name of the child node.
	 * @param  string $child2	Name of the subchild node.
	 * @param string $attribute	Name of the value.
	 * @param string $value		Value of the attribute.
	 * @return	boolean 		TRUE: Success. FALSE: Error.
	 * 
	 * @example $this->easyxml->update_item($arrayChildNodes);
	 */
	public function update( $path, $data, $child1, $child2, $attribute, $value ) {
		$xml = $this->xml($path);
		$nodename = '/'.$child1.'/'.$child2;
		$xpath_val	= "//".$nodename."[@".$attribute."='".$value."']";
		$res		= $xml->xpath( $xpath_val );
		if( $res ):
			foreach ($data as $key => $value):
				eval('$res[0]->'.$key.'			= "'.$value.'";');
			endforeach;
			
			$this->saveXMLIndented( $xml,$path );
			
			return TRUE;
		else:
			return FALSE;
		endif;
	}
	
	
	
	/**
	 * Ensures UTF-8
	 * 
	 * Method to ensure if a string is in UTF-8.
	 * 
	 * @param	string $string	A text to be verified.
	 * @return	string 			The text in UTF-8.
	 */
	private function ensureUTF8($string){
		$encoding = mb_detect_encoding($string);
		
		if($encoding != 'UTF-8'):
	 		return iconv($encoding, 'UTF-8//TRANSLIT', $string);
		else:
	 		return $string;
		endif;
	}	

	/**
	 * Add CData
	 * 
	 * Adds Cdata in XML, useful if your string contains HTML tags.
	 * 
	 * @param string $cdata_text String containing html tags.
	 * 
	 * @example $my_child = $item->addChild ( 'foo' );
	 * 			$my_child->addCData( '<strong><u>Hello World!!</u></strong>' );
	 */
	public function addCData($cdata_text) {
		$node = dom_import_simplexml ( $this );
		$no = $node->ownerDocument;
		
		$node->appendChild ( $no->createCDATASection ( $cdata_text ) );
	}
	
	/**
	 * Saves a XML Indented file.
	 * 
	 * Saves an indented XML file.
	 * 
	 * @param object $xml	XML object.
	 * @param string $path	XML path in file system.
	 * 
	 * @example $this->xml->saveXMLIndented( $this->xml,$this->path );
	 */	
	public function saveXMLIndented( $xml, $path = "" ) {
		$doc = new DOMDocument ( '1.0' );
		
		$doc->preserveWhiteSpace = false;
		$doc->loadXML ( $xml->asXML() );
		$doc->formatOutput = true;
		
		if( $path == "" ):
			echo $doc->saveXML();
		else:
			file_put_contents( $path, $doc->saveXML());
		endif;
	}

} // end_class

