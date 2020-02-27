<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Calendar extends MY_Controller{

	function __construct(){
		parent::__construct();
		$this->title = "Calendar";
        $this->scripts = array("class");	
     	
        $this->layout = 'entries/views/layouts/ursin_calendar';
        $this->logged_in_user = get_user_id();
        $this->logged_in_teacher_id = get_teacher_id();

	}

	public function index(){

        $dataofallclass = $this->crud_model->get('class');
        foreach ($dataofallclass as $key => $examdata) {
            $class_id['_id'] = new MongoDB\BSON\ObjectID($examdata['_id']);
            if(!empty($examdata['calendar4class'])){
                foreach ($examdata['calendar4class'] as $keyofclndr => $value) {

                        if($value['activity_date'] < date('yy-m-d'))
                        {    
                            $delete =  $this->crud_model->delete_indexof_array('class',$class_id,'calendar4class',$keyofclndr); 
                        }
                }
            }
        } 

        $class_where['array_teachers'] = $this->logged_in_teacher_id;
        $data['classes'] = $this->crud_model->get('class',$class_where);
        if($data['classes'][0]['show_tools'][5] == 1){
           
           

    	}else{
            $data['showbanner'] = 'false';
        }

		 $this->load->view('calendar',$data);
	}


	public function manage()
    {
                $userdata = $this->session->userdata("user_session");
            
                $dataofarray['title'] = $_POST['title'];
                $dataofarray['activity_date'] = $_POST['activity_date'];
                $dataofarray['description'] = $_POST['description'];
                
                $dataofarray['teachers_name'] = $this->logged_in_teacher_id;
                $pushColumn = 'calendar4class';

        if($_POST['publishforall'] == 'publish'){

               $dataforall = $this->crud_model->get('class'); 
               foreach ($dataforall as $key => $valueofcls) {

                  if(count($valueofcls['calendar4class']) <= 200){
                    $class_where['_id'] = new MongoDB\BSON\ObjectID($valueofcls['_id']);
                    $class_id = $this->crud_model->push('class',$class_where,$pushColumn,array($dataofarray));
                  }

               }
                    $msg = 'Calendar successfully created for all classes';
                    $response['status'] = true;
                    $response['msg'] = $msg;
                    $this->session->set_flashdata('success',$msg);
        }else{
       
            $class_where['_id'] = new MongoDB\BSON\ObjectID($_POST['class_id']);
            $data = $this->crud_model->get('class',$class_where);
        
            if(count($data[0]['calendar4class']) <= 200){
        		$class_id = $this->crud_model->push('class',$class_where,$pushColumn,array($dataofarray));
                if($class_id){
                    $msg = 'Calendar Successfully Created';
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
                    $msg = 'Limit Reached. Only 200 entries are possible in calendar';
                    $response['status'] = false;
                    $response['msg'] = $msg;
                    $this->session->set_flashdata('error',$msg);
            }
        }

        redirect('entries/calendar');
    }


    public function get_calendar_data(){
    	
        $class_where['_id'] = new MongoDB\BSON\ObjectID($_POST['class_id']);
        $firstcollectdata = $this->crud_model->get('class',$class_where);	

        $datacollect['mesagedata'] = $firstcollectdata[0]['calendar4class'];
        $datacollect['classname'] = $firstcollectdata[0]['class_name'];
        $datacollect['idofclass'] = $firstcollectdata[0]['_id'];
        $datacollect['connectedclass'] = $firstcollectdata[0]['connectedclass'];

        $response['data'] = $this->load->view('content/calendar_table', $datacollect, TRUE);
        $response['status'] = TRUE;
        echo json_encode($response);
        exit();
	}



	public function get_all_calendar_data(){
    	
        $class_where['_id'] = new MongoDB\BSON\ObjectID($_POST['class_id']);
        $firstcollectdata = $this->crud_model->get('class',$class_where);	

        $datacollect1['mesagedata'] = $firstcollectdata[0]['calendar4class'];
        $datacollect1['classname'] = $firstcollectdata[0]['class_name'];
        $datacollect1['idofclass'] = $firstcollectdata[0]['_id'];
        $datacollect1['connectedclass'] = $firstcollectdata[0]['connectedclass'];

        $connteddata = $firstcollectdata[0]['connectedclass'];
        foreach ($connteddata as $key => $value) {

        	$classid['_id'] = new MongoDB\BSON\ObjectID($value);
        	$othermessage = $this->crud_model->get('class',$classid);
        	
        	foreach ($othermessage[0]['calendar4class'] as $key => $value) {
        	
        		array_push($value, "othermessage");
        		array_push($datacollect1['mesagedata'], $value);
        	}
        }

     
        $response['data'] = $this->load->view('content/calendar_table', $datacollect1, TRUE);
        $response['status'] = TRUE;
        echo json_encode($response);
        exit();
	}


	public function delete()
    {
        $where['_id'] = new MongoDB\BSON\ObjectID($_POST['id']);
        $delete =  $this->crud_model->delete_indexof_array('class',$where,'calendar4class',$_POST['key']);
    	if($delete){
            $msg = 'Calendar Successfully Deleted';
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