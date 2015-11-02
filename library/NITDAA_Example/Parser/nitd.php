<?php

class NITDAA_Example_Parser_nitd extends Api_Parser_IParser{
	
	public $content_type = 'text/plain';
	
	public function parse(){
		return serialize($this->_data);
	}
	
}