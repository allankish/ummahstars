<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fblogin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		// Load library and url helper
		$this->load->library('facebook');
		$this->load->helper('url');
		$this->load->model('auth_model');
	}

	// ------------------------------------------------------------------------

	/**
	 * Index page
	 */
	public function index()
	{
		//$this->load->view('front/examples/start');
		$this->web_login();
		//redirect('fblogin/web_login', 'refresh');
	}

	// ------------------------------------------------------------------------

	/**
	 * Web redirect login example page
	 */
	public function web_login()
	{
		$data['user'] = array();

		// Check if user is logged in
		if ($this->facebook->is_authenticated())
		{
			// User logged in, get user details
			$user = $this->facebook->request('get', '/me?fields=id,name,email,gender');
			if (!isset($user['error']))
			{
				$data['user'] = $user;
			}

		}
		//$this->load->view('front/login/loading');
		// display view
		//$this->load->view('front/examples/web', $data);

 		if ( ! $this->facebook->is_authenticated()) {

			redirect($this->facebook->login_url(), 'refresh');

		 } else {

					//print_r($user);

					$checkParent = $this->auth_model->check_parent_exists($user['email']);
					if(count($user)>0)
					{

						if(count($checkParent)<=0) {

							$profile_image = '';
							$image_name = base64_encode($user['name']);
							$filename = $image_name.'_'.md5(rand(1000000,1000000000)).'.jpg';
							$profile_image = 'assets/userImages/'.$filename;
							$url = 'https://graph.facebook.com/'.$user['id'].'/picture?type=large';
							file_put_contents($profile_image, file_get_contents($url));

							$parent_image = '';
							if (file_exists($profile_image)) {
								$parent_image = $profile_image;
							}

							$data = array(
								"email_id" => $user['email'],
								"password" => md5("temp1234"),
								"gender" => $user['gender'],
								"uname" => $user['name'],
								"profile_image" => $parent_image,
								"user_role" => '2',
								"age" => '0',
								"age_group" => '0',
								"parent_id" => '0',
								"logged_in" => '0',
								"status" => '0',
								"created_on" => date('Y-m-d H:i:s'),
								"child_mode" => 'false',
								"parent_type" => 'active',
								"child_allowed" => '4'
							);
							$result = $this->auth_model->add_parent($data);
							$checkParent = $this->auth_model->check_parent_exists($user['email']);
						}
						$user_details = $checkParent;

						$user_array = array(
							"user_details"      => array(
								"user_id"           => $user_details['user_id'],
								"email_id"          => $user_details['email_id'],
								"uname"             => $user_details['uname'],
								"gender"            => $user_details['gender'],
								"profile_image"     => $user_details['profile_image'],
								"child_mode"        => $user_details['child_mode']
							),
							"user_auth"         => true
						);

						//print_r($user_array); exit;
						// Update last login date in database
						$this->auth_model->update_last_login($user_details['user_id']);

						$this->session->set_userdata($user_array);

						//redirect('dashboard', 'refresh');
						redirect('add_child', 'refresh'); exit;

					}
					else
					{
						  redirect('login', 'refresh');
					}

				}

	}

	// ------------------------------------------------------------------------

	/**
	 * JS SDK login example
	 */
	public function js_login()
	{
		// Load view
		$this->load->view('front/examples/js');
	}

	// ------------------------------------------------------------------------

	/**
	 * AJAX request method for positing to facebook feed
	 */
	public function post()
	{
		header('Content-Type: application/json');

		$result = $this->facebook->request(
			'post',
			'/me/feed',
			['message' => $this->input->post('message')]
		);

		echo json_encode($result);
	}

	// ------------------------------------------------------------------------

	/**
	 * Logout for web redirect example
	 *
	 * @return  [type]  [description]
	 */
	public function logout()
	{
		$this->facebook->destroy_session();
		redirect('login', redirect);
	}
}
