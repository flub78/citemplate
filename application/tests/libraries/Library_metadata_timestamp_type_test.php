<?php
class Library_Metadata_timestamp_type_test extends TestCase {
    public function setUp() {
        $this->resetInstance();
        $this->CI->load->library('type_timestamp');
        $this->CI->load->model('crud_model', 'model');
    }
    
    public function test_timestamp_display() {
        $display = $this->CI->type_timestamp->display_field('', '', 1.0);
        // echo $display;
        $this->assertEquals("01/01/1970 01:00", $display, "timestamp display 1.0");
    }

    public function test_timestamp_input() {   
    	$input = $this->CI->type_timestamp->field_input('meta_test1', 'birthday', 1.0);
    	echo $input;
    	$this->assertEquals('<input name="birthday" id="birthday" class="form-control timestamp" value="1" />', $input, "timestamp input 1.0");
    }
    
    public function test_timestamp_rules() {
    	$rules = $this->CI->type_timestamp->rules('', '', 1.0);
    	// echo $display;
    	$this->assertEquals("callback_valid_timestamp", $rules, "timestamp rules");
    }
    
}
