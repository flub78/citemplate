<?php
class Library_Metadata_time_type_test extends TestCase {
    public function setUp() {
        $this->resetInstance();
        $this->CI->load->library('type_time');
        $this->CI->load->model('crud_model', 'model');
    }
    
    public function test_time_display() {
        $display = $this->CI->type_time->display_field('', '', 1.0);
        // echo $display;
        $this->assertEquals("01:00", $display, "time display 1.0");
    }

    public function test_time_input() {   
    	$input = $this->CI->type_time->field_input('meta_test1', 'birthday', 1.0);
    	echo $input;
    	$this->assertEquals('<input name="birthday" id="birthday" class="form-control time" value="1" />', $input, "time input 1.0");
    }
    
    public function test_time_rules() {
    	$rules = $this->CI->type_time->rules('', '', 1.0);
    	// echo $display;
    	$this->assertEquals("callback_valid_time", $rules, "time rules");
    }
    
}
