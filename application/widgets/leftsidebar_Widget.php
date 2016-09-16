<?php echo "dfdf"; exit;
class Leftsidebar_Widget extends Widget { 
    public function run() { 
        //print_r($this->session->userdata);
       $data['test'] ='this is test';
		
        $this->render('leftsidebar_vwidget', $data);
    }
    
}
?>
