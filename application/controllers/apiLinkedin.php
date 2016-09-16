<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ApiLinkedin extends CI_Controller {
	
    /**
     * this class is developed by psukralia with the help of linkedin api and  some user guide founded on internet
     * there is no need any type of license to use it and there is no issue to reclaim it
     * it is purly open source and free to use
  	 *
  	 *
  	 *
     * @return void Returns nothing
     */
 
     
    public function __construct() {
        parent::__construct();
       

		    $this->load->library("session");
                    $this->load->library("linkedinlib");
                    $this->load->model('auth_model');
                   
		 
    }

    /**
     * Home page of this site
     * 
     * 
     * @return void Returns nothing
     */
    public function index() { //echo base_url()."apiLinkedin/receiver"; exit;
      
       $client = new oauth_client_class;
//echo $linkedinApiKey."hh"; exit;
                $client->debug = false;
                $client->debug_http = true;
                $client->redirect_uri = base_url().'apilinkedin';

                $client->client_id = '754kmcsa6h6zlk';
                $application_line = __LINE__;
                $client->client_secret = 'aH6TzszY1XF66nvJ';

                if (strlen($client->client_id) == 0 || strlen($client->client_secret) == 0)
                  die('Please go to LinkedIn Apps page https://www.linkedin.com/secure/developer?newapp= , '.
                                        'create an application, and in the line '.$application_line.
                                        ' set the client_id to Consumer key and client_secret with Consumer secret. '.
                                        'The Callback URL must be '.$client->redirect_uri).' Make sure you enable the '.
                                        'necessary permissions to execute the API calls your application needs.';

/* API permissions
 */
                    $client->scope = 'r_basicprofile r_emailaddress';
                    if (($success = $client->Initialize())) {
                      if (($success = $client->Process())) {
                        if (strlen($client->authorization_error)) {
                          $client->error = $client->authorization_error;
                          $success = false;
                        } elseif (strlen($client->access_token)) {
                          $success = $client->CallAPI(
                                                            'http://api.linkedin.com/v1/people/~:(id,email-address,first-name,last-name,location,picture-url,public-profile-url,formatted-name)', 
                                                            'GET', array(
                                                                    'format'=>'json'
                                                            ), array('FailOnAccessError'=>true), $user);
                        }
                      }
                      $success = $client->Finalize($success);
                    }
if($success){

      $checkParent = $this->auth_model->check_parent_exists($user->emailAddress);
      if(count($user)>0)
      {

      if(count($checkParent)<=0) {

          $profile_image = '';
          $image_name = base64_encode($user->firstName);
          $filename = $image_name.'_'.md5(rand(1000000,1000000000)).'.jpg';
          $profile_image = 'assets/userImages/'.$filename;
        
            $url = $user->pictureUrl; 
          file_put_contents($profile_image, file_get_contents($url));
 
          $parent_image = '';
          if (file_exists($profile_image)) {
            $parent_image = $profile_image;
          }

          if($user->gender=='')
          {
            $user->gender = 'male';
          }

          $data = array(
            "email_id" => $user->emailAddress,
            "password" => md5("temp1234"),
            "gender" => $user->gender,
            "uname" => $user->firstName,
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
          $checkParent = $this->auth_model->check_parent_exists($user->emailAddress);
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
        else{
             redirect('login', 'refresh');
        }
    }
  public function logout() {
   
    $this->session->unset_userdata('userData');
    $this->session->sess_destroy();
    //redirect('/user_authentication');
    redirect('login', 'refresh');
  }


}
