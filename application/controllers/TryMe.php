<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * TryMe Class
 *
 * @author Colan
 */
class TryMe extends CI_Controller {

    function __construct() {
        parent::__construct();
        
         $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('admin/age_groups_model');
        $this->load->model('tryme_model');
    }

    public function index() {
       
        $data['age_groups'] = $this->age_groups_model->get_all_age_groups();
        
        $this->load->view('front/common/header');
        $this->load->view('front/tryme/index',$data);
        $this->load->view('front/tryme/footer');
    }
    
    public function getTryMeVideos()
    {
        $age_group_id = $this->input->post('age_group_id');
        $result = $this->tryme_model->fetchTryMeVideos($age_group_id);
       
        ?>
    <ul>
        <?php
        foreach($result as $slides)
        {
           ?>
            
            <li>
                <img data-toggle="modal" class="tryme_popup" data-target="#myModal" src="<?php echo base_url().$slides['video_thumb']?>" video_url="<?php echo base_url().$slides['content']?>" alt="courosel-img" />
            </li>
            
            <?php
            
        }
        ?>
    </ul>
<?php
        
    }

}
