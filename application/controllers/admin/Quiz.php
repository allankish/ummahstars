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
                
                $quiz_check = $this->quiz_model->quizCatCheck($update_array,$quiz_id); // One quiz only can be created for a category and for one age group
                
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
    
    // Add Question
    public function add_quiz_question($quiz_id) {
         if ($_SERVER['REQUEST_METHOD'] == 'POST') { //allow only the http method is POST
            $config = array(
                array(
                    'field' => 'question',
                    'label' => 'Question',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'status',
                    'label' => 'Status',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'answer',
                    'label' => 'Answer',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'option1',
                    'label' => 'Option1',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'option2',
                    'label' => 'Option2',
                    'rules' => 'trim|required'
                ) 
                
            );
            
            $this->session->set_flashdata('question', $this->input->post('question'));
            
            

            $this->form_validation->set_rules($config);
            
            if ($this->form_validation->run() != FALSE) {
                
                
                $total_options = $this->input->post('total_options');
                $options = array();
                $indi = 0;
                for($i=1;$i<=$total_options;$i++)
                {
                   
                   if(trim($this->input->post('option'.$i))!="")
                   {
                   $options[$indi]['option_label'] = $this->input->post('option'.$i);
                   $options[$indi]['option_value'] = 'option'.$i;
                   $indi++;
                   }
                  
                    
                }
                
                $options_ser = serialize($options);
               
                $update_array = array(
                    "question"  => $this->input->post('question'),
                    "quiz_id" => $quiz_id,
                    "options"  => $options_ser,
                    "answer"  => $this->input->post('answer'),
                    "status"  => $this->input->post('status'),
                    "question_type"  => 'single',
                    "created_on"    => date('Y-m-d H:i:s')
                   
                );
                
               
                 $this->quiz_model->addQuestion($update_array);
                 $this->session->set_flashdata('Success', 'Question Added Successfully.');
                 redirect('usadmin/quiz/question/list/'.$quiz_id, 'refresh');
                }
                
                
         
            
        }
        
        $data['quiz_details'] = $this->quiz_model->getQuiz($quiz_id);
       
        $this->load->view('admin/common/header');
        $this->load->view('admin/quiz/add_question',$data);
        $this->load->view('admin/common/footer');
    }
    
    // Edit Question
    
    public function edit_quiz_question($quiz_id,$question_id) {
         if ($_SERVER['REQUEST_METHOD'] == 'POST') { //allow only the http method is POST
            $config = array(
                array(
                    'field' => 'question',
                    'label' => 'Question',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'status',
                    'label' => 'Status',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'answer',
                    'label' => 'Answer',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'option1',
                    'label' => 'Option1',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'option2',
                    'label' => 'Option2',
                    'rules' => 'trim|required'
                ) 
                
            );
            
            $this->session->set_flashdata('question', $this->input->post('question'));
            
            

            $this->form_validation->set_rules($config);
            
            if ($this->form_validation->run() != FALSE) {
                
                
                $total_options = $this->input->post('total_options');
                $options = array();
                $indi = 0;
                for($i=1;$i<=$total_options;$i++)
                {
                   
                   if(trim($this->input->post('option'.$i))!="")
                   {
                   $options[$indi]['option_label'] = $this->input->post('option'.$i);
                   $options[$indi]['option_value'] = 'option'.$i;
                   $indi++;
                   }
                  
                    
                }
                
                $options_ser = serialize($options);
               
                $update_array = array(
                    "question"  => $this->input->post('question'),
                    "options"  => $options_ser,
                    "answer"  => $this->input->post('answer'),
                    "status"  => $this->input->post('status')
                );
                
               
                 $this->quiz_model->updateQuestion($update_array,$question_id);
                 $this->session->set_flashdata('Success', 'Question Modified Successfully.');
                 redirect('usadmin/quiz/question/list/'.$quiz_id, 'refresh');
                }
                
        }
        
        $data['quiz_details'] = $this->quiz_model->getQuiz($quiz_id);
        $data['question_details'] = $this->quiz_model->getQuestion($question_id);
       
        $this->load->view('admin/common/header');
        $this->load->view('admin/quiz/edit_question',$data);
        $this->load->view('admin/common/footer');
    }
        
    
     // List Questions
    public function list_quiz_question($quiz_id) {

        $data['questions'] = $this->quiz_model->getAllQuestion($quiz_id);
        $data['quiz_details'] = $this->quiz_model->getQuiz($quiz_id);
        
       
        $this->load->view('admin/common/header');
        $this->load->view('admin/quiz/list_question', $data);
        $this->load->view('admin/common/footer');
    }
    
    public function delete_question($quiz_id,$question_id)
    {
     
        $this->quiz_model->deleteQuestion($question_id);
        $this->session->set_flashdata('Success', 'Question deleted successfully.');
        redirect('usadmin/quiz/question/list/'.$quiz_id, 'refresh');
        
    }
    
    
    
}