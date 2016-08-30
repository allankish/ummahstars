<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Content Class
 *
 * @author Colan
 */
class Content extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('admin/categories_model');
        $this->load->model('admin/age_groups_model');
        $this->load->model('admin/content_model');
        

        cipl_admin_auth();
    }

    public function index() {
        
    }

    // List Section

    public function list_content() {

        $data['contents'] = $this->content_model->getContentList();

        $this->load->view('admin/common/header');
        $this->load->view('admin/content/list', $data);
        $this->load->view('admin/common/footer');
    }

    // Add Section 
    public function add_content() {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { //allow only the http method is POST
            $config = array(
                array(
                    'field' => 'section_id',
                    'label' => 'Section Name',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'category_id',
                    'label' => 'Category Name',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'content_type',
                    'label' => 'Content Type',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'template',
                    'label' => 'Template',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'age_group_id',
                    'label' => 'Age Group',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'sort_order',
                    'label' => 'Sort Order',
                    'rules' => 'trim|is_natural_no_zero|required'
                )
            );
            
            $video_url = '';
            
            if($this->input->post('content_type') == 'video')
            $this->form_validation->set_rules('video_file', 'Video Content', 'callback_video_upload');

            $this->form_validation->set_rules($config);
            
            if ($this->form_validation->run() != FALSE) {
                
                if(isset($this->upload_data['file']['file_name']))
                {
                $video_url = 'assets/contentVideos/'.$this->upload_data['file']['file_name'];
                }
                
                $update_array = array(
                    "section_id"  => $this->input->post('section_id'),
                    "category_id"  => $this->input->post('category_id'),
                    "content_type"  => $this->input->post('content_type'),
                    "template" => $this->input->post('template'),
                    "content"  => $this->input->post('content'),
                    "video_url" => $video_url,
                    "age_group_id"  => $this->input->post('age_group_id'),
                    "sort_order"    => $this->input->post("sort_order"),
                    "created_date"    => date('Y-m-d H:i:s')
                   
                );
                
                 $this->content_model->addContent($update_array);
                 $this->session->set_flashdata('Success', 'Content added successfully.');
                 redirect('usadmin/content', 'refresh');
         
            }
        }
        
        
        $data['templates'] = $this->getTemplateFiles();
        $data['sections'] = $this->categories_model->getAllSections();
        $data['age_groups'] = $this->age_groups_model->get_all_age_groups();
        
        $this->load->view('admin/common/header');
        $this->load->view('admin/content/add',$data);
        $this->load->view('admin/common/footer');
    }
    
     public function edit_content($content_id) {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { //allow only the http method is POST
            $config = array(
                array(
                    'field' => 'section_id',
                    'label' => 'Section Name',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'category_id',
                    'label' => 'Category Name',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'content_type',
                    'label' => 'Content Type',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'age_group_id',
                    'label' => 'Age Group',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'sort_order',
                    'label' => 'Sort Order',
                    'rules' => 'trim|is_natural_no_zero|required'
                )
            );
            
            
             $video_url = $this->input->post('video_url_val');
             $content = $this->input->post('content');
            
            if($this->input->post('content_type') == 'video')
            {
            $this->form_validation->set_rules('video_file', 'Video Content', 'callback_video_upload');
            $content = "";
            }
            
            if($this->input->post('content_type') == 'text')
            {
            $video_url = "";
            }
            
            $this->form_validation->set_rules($config);
            
            if ($this->form_validation->run() != FALSE) {
                
                 if(isset($this->upload_data['file']['file_name']))
                {
                $video_url = 'assets/contentVideos/'.$this->upload_data['file']['file_name'];
                }

                $update_array = array(
                    "section_id"  => $this->input->post('section_id'),
                    "category_id"  => $this->input->post('category_id'),
                    "content_type"  => $this->input->post('content_type'),
                    "content"  => $content,
                    "video_url" => $video_url,
                    "age_group_id"  => $this->input->post('age_group_id'),
                    "sort_order"    => $this->input->post("sort_order"),
                    "created_date"    => date('Y-m-d H:i:s')
                   
                );
                
                 $this->content_model->updateContent($update_array,$content_id);
                 $this->session->set_flashdata('Success', 'Content updated successfully.');
                 redirect('usadmin/content', 'refresh');
         
            }
        }
        
        
        $data['sections'] = $this->categories_model->getAllSections();
        $data['age_groups'] = $this->age_groups_model->get_all_age_groups();
        $data['content'] = $this->content_model->getContentById($content_id);
        $data['content_cats'] = $this->categories_model->getCategoriesbySection($data['content'][0]['section_id']);
        
        $this->load->view('admin/common/header');
        $this->load->view('admin/content/edit',$data);
        $this->load->view('admin/common/footer');
    }

  
    
    public function get_categories_ajax()
    {
        
        $section_id = $this->input->post('section_id');
        $cats['categories'] = $this->categories_model->getCategoriesbySection($section_id);
        echo json_encode($cats);
        
    }
    
    public function delete_content($content_id)
    {
        $this->content_model->deleteContent($content_id);
        $this->session->set_flashdata('Success', 'Content deleted successfully.');
        redirect('usadmin/content', 'refresh');
        
    }
    
    
    function video_upload(){
	  if($_FILES['video_file']['size'] != 0){
		$upload_dir = './assets/contentVideos';
		if (!is_dir($upload_dir)) {
		     mkdir($upload_dir);
		}	
		$config['upload_path']   = $upload_dir;
		$config['allowed_types'] = 'mp4';
		$config['file_name']     = 'content_vid_'.time().md5(rand());
		$config['overwrite']     = true;
		

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('video_file')){
			$this->form_validation->set_message('video_upload', $this->upload->display_errors());
			return false;
		}	
		else{
			$this->upload_data['file'] =  $this->upload->data();
			return true;
		}	
	}	
	else{
		$this->form_validation->set_message('video_upload', "No file selected");
		return false;
	}
    }
    
    public function getTemplateFiles()
    {
        
        $files = glob('./application/views/front/content-templates/*.php');
        
        $templates = array();
        $indi = 0;
        foreach($files as $fname) 
        {
        $indi++;
        preg_match( '|Template Name:(.*)$|mi', file_get_contents( $fname ), $header );
        
        $templates[$indi]['temp_path'] = $fname;
        $templates[$indi]['temp_name'] = $header[1];
        }
        
        return $templates;
    }
    
}