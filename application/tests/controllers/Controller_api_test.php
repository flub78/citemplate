<?php
/**
 * Part of CI PHPUnit Test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

require_once(APPPATH . '/third_party/Requests.php');

// Next, make sure Requests can load internal classes
Requests::register_autoloader();

class Controller_Api_test extends TestCase
{
	public function test_return_from_ajax_methods()
	{
		$this->resetInstance();
		$this->CI->load->library('Ion_auth');
		$this->CI->ion_auth->login('admin', 'admin', true);

		// when using the following line, it brakes the phpunit test suite ???
// 		$output = $this->request('GET', ['Api', 'user_get']);
// 		$this->assertContains('iTotalRecords', $output);
// 		$this->assertNotContains('A PHP Error was encountered', $output);

		// echo "APPATH = " . APPPATH . "\n";
		// APPATH = /home/frederic/git/citemplate/application/
		
		$url = 'http://httpbin.org/get';
		$base_url = base_url();		# http://localhost/citemplate/
		$url = $base_url . "index.php/api/user";
		
		// the API interface is not a rel REST interfaceLllllllllllllllllllllllllllllllllllllllllll
		
		$request = Requests::get($url, array('Accept' => 'application/json'));
		// var_dump($request->body);
		if ($request->success) {
			$json = json_decode($request->body, true);
// 			var_dump($json); exit;
			$total = $json['iTotalRecords'];
			$this->assertEquals($total, 10, "10 users");
			$this->assertEquals($json['iTotalDisplayRecords'], 102, "iTotalDisplayRecords");
		}
		
	}

	public function test_unknown_method_returns_404()
	{
		$this->request('GET', ['Api', 'method_not_exist']);
		$this->assertResponseCode(404);
	}
	
	public function test_json_support_methods()
	{
 		$this->ajaxRequest('GET', ['Api', 'test_user_get']);
	}

}
