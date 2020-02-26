<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Exams extends MY_Controller{

	function __construct(){
		parent::__construct();
		$this->title = "Exams";
        $this->scripts = array("class");	
     	
       $this->layout = 'exams/views/layouts/ursin';
        $this->logged_in_user = get_user_id();
        $this->logged_in_teacher_id = get_teacher_id();

	}

	public function index(){

        $class_where['array_teachers'] = $this->logged_in_teacher_id;
        
      
        $data = $this->crud_model->delete_indexof_array('class',$class_where,'exams4class','0');
        echo "<pre>";
        print_r($data);
           
      
         die;

        $dataofallclass = $this->crud_model->get('class');
        foreach ($dataofallclass as $key => $examdata) {
            if(!empty($examdata['exams4class'])){
                foreach ($examdata['exams4class'] as $key => $value) {

                        if($value['exam_date'] < date('yy-m-d'))
                        {
                            

                        }
                }
            }
        } 

        $class_where['array_teachers'] = $this->logged_in_teacher_id;
        $data['classes'] = $this->crud_model->get('class',$class_where);
        if($data['classes'][0]['show_tools'][3] == 1){
           
           

    	}else{
            $data['showbanner'] = 'false';
        }

		 $this->load->view('exams',$data);
	}


	public function manage()
    {
        
        $class_where['_id'] = new MongoDB\BSON\ObjectID($_POST['class_id']);
        $data = $this->crud_model->get('class',$class_where);
    
        if(count($data[0]['exams4class']) <= 100){
    		$userdata = $this->session->userdata("user_session");
        
           	$dataofarray['subject'] = $_POST['subject'];
           	$dataofarray['exam_date'] = $_POST['date'];
           	$dataofarray['description'] = $_POST['message'];
           	$dataofarray['teachers_name'] = $this->logged_in_teacher_id;
           	$pushColumn = 'exams4class';

    		$class_id = $this->crud_model->push('class',$class_where,$pushColumn,array($dataofarray));
            if($class_id){
                $msg = 'Exam Successfully Created';
                $response['status'] = true;
                $response['msg'] = $msg;
                $this->session->set_flashdata('success',$msg);
            }else{
                $msg = 'Something Went Wrong';
                $response['status'] = false;
                $response['msg'] = $msg;
                $this->session->set_flashdata('error',$msg);
            }

        }else{
                $msg = 'Limit Reached. Only 100 entries are possible in exams';
                $response['status'] = false;
                $response['msg'] = $msg;
                $this->session->set_flashdata('error',$msg);
        }

        redirect('exams/Exams');

    }


    public function get_exams_data(){
    	
        $class_where['_id'] = new MongoDB\BSON\ObjectID($_POST['class_id']);
        $firstcollectdata = $this->crud_model->get('class',$class_where);	

        $datacollect['mesagedata'] = $firstcollectdata[0]['exams4class'];
        $datacollect['classname'] = $firstcollectdata[0]['class_name'];
        $datacollect['idofclass'] = $firstcollectdata[0]['_id'];
        $datacollect['connectedclass'] = $firstcollectdata[0]['connectedclass'];

        $response['data'] = $this->load->view('content/exams_table', $datacollect, TRUE);
        $response['status'] = TRUE;
        echo json_encode($response);
        exit();
	}



	public function get_all_exams_data(){
    	
        $class_where['_id'] = new MongoDB\BSON\ObjectID($_POST['class_id']);
        $firstcollectdata = $this->crud_model->get('class',$class_where);	

        $datacollect['mesagedata'] = $firstcollectdata[0]['exams4class'];
        $datacollect['classname'] = $firstcollectdata[0]['class_name'];
        $datacollect['idofclass'] = $firstcollectdata[0]['_id'];
        $datacollect['connectedclass'] = $firstcollectdata[0]['connectedclass'];

        $connteddata = $firstcollectdata[0]['connectedclass'];
        foreach ($connteddata as $key => $value) {

        	$classid['_id'] = new MongoDB\BSON\ObjectID($value);
        	$othermessage = $this->crud_model->get('class',$classid);
        	
        	foreach ($othermessage[0]['exams4class'] as $key => $value) {
        	
        		array_push($value, "othermessage");
        		array_push($datacollect['mesagedata'], $value);
        	}
        }
       	
     
        $response['data'] = $this->load->view('content/exams_table', $datacollect, TRUE);
        $response['status'] = TRUE;
        echo json_encode($response);
        exit();
	}


	public function delete()
    {
        $deletearray[0] = array();
        
    	$delete =  $this->crud_model->pull_new('class',new MongoDB\BSON\ObjectID($_POST['id']),'exams4class',json_encode($deletearray));
    	if($delete){
            $msg = 'Exam Successfully Deleted';
            $response['status'] = true;
            $response['msg'] = $msg;
            $this->session->set_flashdata('success',$msg);
        }else{
            $msg = 'Something Went Wrong';
            $response['status'] = false;
            $response['msg'] = $msg;
            $this->session->set_flashdata('error',$msg);
        }
        echo json_encode($response);
        exit();
    }




}