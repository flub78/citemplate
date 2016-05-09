<?php
class Library_Metadata_date_type_test extends TestCase {
    public function setUp() {
        $this->resetInstance();
        $this->CI->load->library('type_date');
        $this->CI->load->model('crud_model', 'model');
    }
    
    public function test_date_display() {
        $display = $this->CI->type_date->display_field('', '', 1.0);
        // echo $display;
        $this->assertEquals("01/01/1970", $display, "date display 1.0");
    }

    public function test_date_input() {   
    	$input = $this->CI->type_date->field_input('meta_test1', 'birthday', 1.0);
    	echo $input;
    	$this->assertEquals('<input name="birthday" id="birthday" class="form-control date" value="1" />', $input, "date input 1.0");
    }
    
    public function test_date_rules() {
    	$rules = $this->CI->type_date->rules('', '', 1.0);
    	// echo $display;
    	$this->assertEquals("callback_valid_date", $rules, "date rules");
    }
    
}
