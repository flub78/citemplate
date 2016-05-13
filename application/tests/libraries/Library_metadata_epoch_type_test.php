<?php
class Library_Metadata_epoch_type_test extends TestCase {
    public function setUp() {
        $this->resetInstance();
        $this->CI->load->library('type_epoch');
        $this->CI->load->model('crud_model', 'model');
    }
    
    public function test_epoch_display() {
        $display = $this->CI->type_epoch->display_field('', '', 1.0);
        // echo $display;
        $this->assertEquals("01/01/1970 01:00:01", $display, "epoch display 1.0");
    }

    public function test_epoch_input() {   
    	$input = $this->CI->type_epoch->field_input('meta_test1', 'birthday', 1.0);
    	echo $input;
    	$this->assertEquals('<input name="birthday" id="birthday" class="form-control epoch" value="1" />', $input, "epoch input 1.0");
    }
    
    public function test_epoch_rules() {
    	$rules = $this->CI->type_epoch->rules('', '', 1.0);
    	// echo $display;
    	$this->assertEquals("callback_valid_epoch", $rules, "epoch rules");
    }
    
}
