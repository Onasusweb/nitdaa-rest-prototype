<?php
/**
 *  nitdaa custom parser : JSON format
 */
class NITDAA_Example_Parser_nitdaa extends Api_Parser_IParser {

    /**
     * Content type
     * @var string
     */
    public $content_type = "application/json";

    /**
     * Parse to Json
     * 
     * @return string
     */
    public function parse() {
        if (isset($this->params['cb']) && !empty($this->params['cb'])) {
            return $this->params['cb'] . '(' . json_encode($this->_data) . ')';
        }
        return json_encode($this->_data);
    }

}

?>
