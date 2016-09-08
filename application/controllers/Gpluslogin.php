<?php defined('BASEPATH') OR exit('No direct script access allowed');
class gpluslogin extends CI_Controller
{
  function __construct() {
    parent::__construct();
    // Load user model
    $this->load->model('auth_model');
  }

  public function index(){
    // Include the google api php libraries
    include_once APPPATH."libraries/google-api-php-client/Google_Client.php";
    include_once APPPATH."libraries/google-api-php-client/contrib/Google_Oauth2Service.php";

    // Google Project API Credentials
    $clientId = '484592646869-u1il3g901fc8tvn1av73g136c4iq6uvi.apps.googleusercontent.com';
    $clientSecret = 'xgXNfzZfq72rw7mBDMBokgjd';
    $redirectUrl = base_url();

    // Google Client Configuration
    $gClient = new Google_Client();
    $gClient->setApplicationName('Login to codexworld.com');
    $gClient->setClientId($clientId);
    $gClient->setClientSecret($clientSecret);
    $gClient->setRedirectUri($redirectUrl);
    $google_oauthV2 = new Google_Oauth2Service($gClient);

    if (isset($_REQUEST['code'])) {
      $gClient->authenticate();
      $this->session->set_userdata('token', $gClient->getAccessToken());
      //redirect($redirectUrl);
    }

    $token = $this->session->userdata('token');
    if (!empty($token)) {
      $gClient->setAccessToken($token);
    }

    /*$userProfile = $google_oauthV2->userinfo->get();
    print_r($userProfile); exit;*/
    if ($gClient->getAccessToken()) {
      $userProfile = $google_oauthV2->userinfo->get();
      // Preparing data for database insertion
      //$userData['oauth_provider'] = 'google';
      //$userData['oauth_uid'] = $userProfile['id'];
      $user['name'] = $userProfile['given_name']." ".$userProfile['family_name'];
      $user['email'] = $userProfile['email'];
      $user['gender'] = $userProfile['gender'];
      //$userData['locale'] = $userProfile['locale'];
      //$userData['profile_url'] = $userProfile['link'];
      $user['picture_url'] = $userProfile['picture'];
      /*echo "<pre>";
      print_r($user); exit;*/
      // Insert or update user data
      /*$userID = $this->user->checkUser($userData);
      if(!empty($userID)){
          $data['userData'] = $userData;
          $this->session->set_userdata('userData',$userData);
      } else {
         $data['userData'] = array();
      }*/

      $checkParent = $this->auth_model->check_parent_exists($user['email']);
      if(count($user)>0)
      {

        if(count($checkParent)<=0) {

          $profile_image = '';
          $image_name = base64_encode($user['name']);
          $filename = $image_name.'_'.md5(rand(1000000,1000000000)).'.jpg';
          $profile_image = 'assets/userImages/'.$filename;
          $url = $user['picture_url'];
          file_put_contents($profile_image, file_get_contents($url));

          $parent_image = '';
          if (file_exists($profile_image)) {
            $parent_image = $profile_image;
          }

          if($user['gender']=='')
          {
            $user['gender'] = 'male';
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

        //print_r($user_details); exit;

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

        redirect('dashboard', 'refresh');

      }
      else
      {
        redirect('login', 'refresh');
      }


    } else {
      //$data['authUrl'] = $gClient->createAuthUrl();
      redirect($gClient->createAuthUrl(), 'refresh');
    }
    //$this->load->view('user_authentication/index',$data);
  }

  public function logout() {
    $this->session->unset_userdata('token');
    $this->session->unset_userdata('userData');
    $this->session->sess_destroy();
    //redirect('/user_authentication');
    redirect('login', 'refresh');
  }
}
