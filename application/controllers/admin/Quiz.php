<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Quiz Class
 *
 * @author Colan
 */
class Quiz extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('admin/categories_model');
        $this->load->model('admin/age_groups_model');
        $this->load->model('admin/content_model');
        $this->load->model('admin/quiz_model');

        cipl_admin_auth();
    }

    public function index() {}

    // List Quiz
    public function list_quiz() {

        $data['quizes'] = $this->quiz_model->getAllQuiz();

        $this->load->view('admin/common/header');
        $this->load->view('admin/quiz/list', $data);
        $this->load->view('admin/common/footer');
    }

    // Add Quiz
    public function add_quiz() {
         if ($_SERVER['REQUEST_METHOD'] == 'POST') { //allow only the http method is POST
            $config = array(
                array(
                    'field' => 'quiz_title',
                    'label' => 'Quiz Title',
                    'rules' => 'trim|required'
                ),
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
                    'field' => 'age_group_id',
                    'label' => 'Age Group',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'deed',
                    'label' => 'Deed',
                    'rules' => 'trim|numeric|required'
                ),
                array(
                    'field' => 'no_questions',
                    'label' => 'No of Questions',
                    'rules' => 'trim|numeric|required'
                )
            );
            
            $this->session->set_flashdata('quiz_title', $this->input->post('quiz_title'));
            $this->session->set_flashdata('section_id', $this->input->post('section_id'));
            $this->session->set_flashdata('category_id', $this->input->post('category_id'));
            $this->session->set_flashdata('age_group_id', $this->input->post('age_group_id'));
            $this->session->set_flashdata('no_questions', $this->input->post('no_questions'));
            $this->session->set_flashdata('deed', $this->input->post('deed'));
            
            

            $this->form_validation->set_rules($config);
            
            if ($this->form_validation->run() != FALSE) {
               
                $update_array = array(
                    "quiz_title"  => $this->input->post('quiz_title'),
                    "section_id"  => $this->input->post('section_id'),
                    "category_id"  => $this->input->post('category_id'),
                    "age_group_id"  => $this->input->post('age_group_id'),
                    "deed"  => $this->input->post('deed'),
                    "no_questions" => $this->input->post('no_questions'),
                    "created_date"    => date('Y-m-d H:i:s')
                   
                );
                
                $quiz_check = $this->quiz_model->quizCatCheck($update_array);
                
                if($quiz_check == true)
                {
                 $this->quiz_model->addQuiz($update_array);
                 $this->session->set_flashdata('Success', 'Quiz Created Successfully.');
                 redirect('usadmin/quiz', 'refresh');
                }
                else
                {
                 $this->session->set_flashdata('Error', 'Already a Quiz has been created for Selected Category and Age Group.');
                 redirect('usadmin/quiz/add', 'refresh');
                }
                
         
            }
        }
        
         $data['sections'] = $this->categories_model->getAllSections();
        $data['age_groups'] = $this->age_groups_model->get_all_age_groups();
        
        $this->load->view('admin/common/header');
        $this->load->view('admin/quiz/add',$data);
        $this->load->view('admin/common/footer');
    }

    // Edit Quiz
    public function edit_quiz($quiz_id) {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $config = array(
                array(
                    'field' => 'quiz_title',
                    'label' => 'Quiz Title',
                    'rules' => 'trim|required'
                ),
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
                    'field' => 'age_group_id',
                    'label' => 'Age Group',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'deed',
                    'label' => 'Deed',
                    'rules' => 'trim|numeric|required'
                ),
                array(
                    'field' => 'no_questions',
                    'label' => 'No of Questions',
                    'rules' => 'trim|numeric|required'
                )
            );
            
            $this->form_validation->set_rules($config);
            
            if ($this->form_validation->run() != FALSE) {
               
                $update_array = array(
                    "quiz_title"  => $this->input->post('quiz_title'),
                    "section_id"  => $this->input->post('section_id'),
                    "category_id"  => $this->input->post('category_id'),
                    "age_group_id"  => $this->input->post('age_group_id'),
                    "deed"  => $this->input->post('deed'),
                    "no_questions" => $this->input->post('no_questions')
                );
                
                $quiz_check = $this->quiz_model->quizCatCheck($update_array,$quiz_id);
                
                if($quiz_check == true)
                {
                 $this->quiz_model->updateQuiz($update_array,$quiz_id);
                 $this->session->set_flashdata('Success', 'Quiz Updated Successfully.');
                 redirect('usadmin/quiz', 'refresh');
                }
                else
                {
                 $this->session->set_flashdata('Error', 'Already a Quiz has been created for Selected Category and Age Group.');
                 redirect('usadmin/quiz/edit/'.$quiz_id, 'refresh');
                }
         
            }
        }
         $data['sections'] = $this->categories_model->getAllSections();
        $data['age_groups'] = $this->age_groups_model->get_all_age_groups();
        $result = $this->quiz_model->getQuiz($quiz_id);
        $data['quizes'] = $result[0];
        
        $this->load->view('admin/common/header');
        $this->load->view('admin/quiz/edit', $data);
        $this->load->view('admin/common/footer');
    }

    public function delete_quiz($quiz_id)
    {
        $this->quiz_model->deleteQuiz($quiz_id);
        $this->session->set_flashdata('Success', 'Quiz deleted successfully.');
        redirect('usadmin/quiz', 'refresh');
        
    }
    
    // Add Quiz
    public function add_quiz_question($quiz_id) {
         if ($_SERVER['REQUEST_METHOD'] == 'POST') { //allow only the http method is POST
            $config = array(
                array(
                    'field' => 'quiz_question',
                    'label' => 'Question',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'status',
                    'label' => 'Status',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'question_type',
                    'label' => 'Question Type',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'answer',
                    'label' => 'Answer',
                    'rules' => 'trim|required'
                )               
            );
            
            $this->session->set_flashdata('quiz_title', $this->input->post('quiz_title'));
            $this->session->set_flashdata('section_id', $this->input->post('section_id'));
            $this->session->set_flashdata('category_id', $this->input->post('category_id'));
            $this->session->set_flashdata('age_group_id', $this->input->post('age_group_id'));
            $this->session->set_flashdata('no_questions', $this->input->post('no_questions'));
            $this->session->set_flashdata('deed', $this->input->post('deed'));
            
            

            $this->form_validation->set_rules($config);
            
            if ($this->form_validation->run() != FALSE) {
               
                $update_array = array(
                    "quiz_title"  => $this->input->post('quiz_title'),
                    "section_id"  => $this->input->post('section_id'),
                    "category_id"  => $this->input->post('category_id'),
                    "age_group_id"  => $this->input->post('age_group_id'),
                    "deed"  => $this->input->post('deed'),
                    "no_questions" => $this->input->post('no_questions'),
                    "created_date"    => date('Y-m-d H:i:s')
                   
                );
                
                $quiz_check = $this->quiz_model->quizCatCheck($update_array);
                
                if($quiz_check == true)
                {
                 $this->quiz_model->addQuiz($update_array);
                 $this->session->set_flashdata('Success', 'Quiz Created Successfully.');
                 redirect('usadmin/quiz', 'refresh');
                }
                else
                {
                 $this->session->set_flashdata('Error', 'Already a Quiz has been created for Selected Category and Age Group.');
                 redirect('usadmin/quiz/add', 'refresh');
                }
                
         
            }
        }
       
        $this->load->view('admin/common/header');
        $this->load->view('admin/quiz/add_question');
        $this->load->view('admin/common/footer');
    }
        
    
    
    
}