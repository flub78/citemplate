<?php
class Library_Metadata_currency_type_test extends TestCase {
    public function setUp() {
        $this->resetInstance();
        $this->CI->load->library('type_currency');
        $this->CI->load->model('crud_model', 'model');
    }
    
    public function test_currency_display() {
        $display = $this->CI->type_currency->display_field('', '', 1.0);
        // echo $display;
        $this->assertEquals("01:00", $display, "Currency display 1.0");
    }

    public function test_currency_input() {   
    	$input = $this->CI->type_currency->field_input('meta_test1', 'price', 1.0);
    	echo $input;
    	$this->assertEquals('<input type="currency" name="price" id="price" class="form-control currency" value="1" />', $input, "Currency input 1.0");
    }
    
    public function test_currency_rules() {
    	$rules = $this->CI->type_currency->rules('', '', 1.0);
    	// echo $display;
    	$this->assertEquals("callback_valid_currency", $rules, "Currency rules");
    }
    
}
