<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

class Twitterapi extends CI_Controller {

 
  public function __construct() {
     parent::__construct();
       $this->load->library('session');
       $this->load->library('Twitteroauth');
       $this->load->helper('url');
       $this->load->model('auth_model');
       
    }

 
    public function index($provider) { 
 
    	 $this->load->helper('url_helper');
         
         $twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET);
         $request_token = $twitteroauth->getRequestToken(base_url().'twitterapi/getTwitterData');
         $_SESSION['oauth_token'] = $request_token['oauth_token'];
         $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
         $url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
         header('Location: ' . $url);
 
		}
    function getTwitterData()
    {
  
              if (!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])) {
                  // We've got everything we need
              $twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
                  // Let's request the access token
              $access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
                  // Save it in a session var
              $_SESSION['access_token'] = $access_token;
                   // Let's get the user's info
                 //$user_info = $twitteroauth->get('account/verify_credentials');
              $user_info = $twitteroauth->get('account/verify_credentials',array('include_email'=>'true'));
     
 
           if (isset($user_info->error)) {
          
             redirect('login', 'refresh');
                 } 
           else 
               {
               
               $checkParent = $this->auth_model->check_parent_exists($user_info->email);
                 // echo $user_info->screen_name; exit;
               
                if(count($checkParent)<=0) {
                     $profile_image = '';
                     $image_name = base64_encode($user_info->screen_name);
                     $filename = $image_name.'_'.md5(rand(1000000,1000000000)).'.jpg';
                     $profile_image = 'assets/userImages/'.$filename;
        
                     $url = $user_info->profile_image_url; 
                     file_put_contents($profile_image, file_get_contents($url));
 
                     $parent_image = '';
                     if (file_exists($profile_image))  {
                     $parent_image = $profile_image;
                     }

    

          $data = array(
            "email_id" => $user_info->email,
            "password" => md5("temp1234"),
            "gender" => 'male',
            "uname" => $user_info->screen_name,
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
          $checkParent = $this->auth_model->check_parent_exists($user_info->email);
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

        redirect('dashboard', 'refresh');
             }

           }
       }  
}
    

