<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Messages extends MY_Controller{

	function __construct(){
		parent::__construct();
		$this->title = "Messages";
        $this->scripts = array("class");	
     	
       $this->layout = 'entries/views/layouts/ursin';
        $this->logged_in_user = get_user_id();
        $this->logged_in_teacher_id = get_teacher_id();

	}

	public function index(){


        $class_where['array_teachers'] = $this->logged_in_teacher_id;
        $data['classes'] = $this->crud_model->get('class',$class_where);

   		if($data['classes'][0]['show_tools'][1] == 1){

        $class_where['array_teachers'] = $this->logged_in_teacher_id;
        $totalcount = $this->crud_model->get('class',$class_where);
        
        $totalsum = 0;
        foreach ($totalcount as $key => $value) {
        	if(!isset($value['allclasmessae'])){
       			$totalsum += count($value['messages4class']);
       		}
        }

        $check_limit = get_count_messages();

		if($check_limit < $totalsum){
			$data['notshowform'] = 'Only '.$check_limit.' messages at a time are possible so that it stays simple. Please delete messages that are no longer needed';
		}else{
			$data['notshowform'] = '';
		}

	}else{
		$data['showbanner'] = 'false';
	}

		//$data['messagesdata'] = $this->get_messages_data('2');
		
		$this->load->view('messages',$data);
	}


	public function manage()
    {
		$userdata = $this->session->userdata("user_session");
    
       	$dataofarray['title'] = $_POST['title'];
       	$dataofarray['date'] = $_POST['date'];
       	$dataofarray['message'] = $_POST['message'];
       	$dataofarray['recipient_identifier'] = $_POST['recipient_identifier'];
       	$dataofarray['teachers_name'] = $this->logged_in_teacher_id;
       	$pushColumn = 'messages4class';
        $class_where['_id'] = new MongoDB\BSON\ObjectID($_POST['class_id']);

		$class_id = $this->crud_model->push('class',$class_where,$pushColumn,array($dataofarray));

   		if($dataofarray['recipient_identifier'] == '0'){

    	    $class = $this->crud_model->get('class');
    	    foreach ($class as $key => $value) {
	    	 	 if(in_array($this->logged_in_teacher_id, $value['array_teachers']) && $value['_id'] != $_POST['class_id'] ){

	    	 	 	$idofclass['_id'] = new MongoDB\BSON\ObjectID($value['_id']);
	    	 	 	$dataofarray['allclasmessae'] = '1';
	    	 	 	$class_id = $this->crud_model->push('class',$idofclass,$pushColumn,array($dataofarray));

	    	 	 }
    		}
        }

        if($_POST['emailsendofall'] == 'mail'){
        	$emailsendofall = $_POST['emailsendofall'];
        
        	$data1[0]['teacher_name'] = $this->session->userdata("user_session")['name'];
        	$data1[0]['title'] = $dataofarray['title'] ;
        	$data1[0]['message'] = $dataofarray['message'];

        	$datamesg['datamessage'] = $data1;
        	$body = $this->load->view('email/message_tamplate',$datamesg, true);
        	
        	$class = $this->crud_model->get('class');
        	
        	$parentemails = '';
        	foreach ($class as $key => $valueofstudent) {
	    	 	 if(in_array($this->logged_in_teacher_id, $valueofstudent['array_teachers']) ){

	    	 	 	foreach ($valueofstudent['array_students'] as $key => $value) {
	    	 	 			$whereofstudent['_id'] = new MongoDB\BSON\ObjectID($value);
	    	 	 			$studentdata = $this->crud_model->get('student',$whereofstudent);
	    	 	 			
	    	 	 			if(!empty($studentdata[0]['parents_email'])){
	    	 	 				$parentemails .= $studentdata[0]['parents_email'][0]['family'].',';
	    	 	 				$parentemails .= $studentdata[0]['parents_email'][0]['mother'].',';
	    	 	 				$parentemails .= $studentdata[0]['parents_email'][0]['father'].',';
	    	 	 			}
	    	 	 	}

	    	 	 }
    		}
			$this->phpmailerlib->message_email_all_parent($parentemails,$body);
        }	
       
        if($class_id){
            $msg = 'Messages Successfully send';
            $response['status'] = true;
            $response['msg'] = $msg;
            $this->session->set_flashdata('success',$msg);
        }else{
            $msg = 'Something Went Wrong';
            $response['status'] = false;
            $response['msg'] = $msg;
            $this->session->set_flashdata('error',$msg);
        }

        redirect('entries/messages');

    }


    public function get_messages_data(){
    	
        $class_where['_id'] = new MongoDB\BSON\ObjectID($_POST['class_id']);
        $firstcollectdata = $this->crud_model->get('class',$class_where);	

        $datacollect['mesagedata'] = $firstcollectdata[0]['messages4class'];
        $datacollect['classname'] = $firstcollectdata[0]['class_name'];
        $datacollect['idofclass'] = $firstcollectdata[0]['_id'];
        $datacollect['connectedclass'] = $firstcollectdata[0]['connectedclass'];

        $response['data'] = $this->load->view('content/message_table', $datacollect, TRUE);
        $response['status'] = TRUE;
        echo json_encode($response);
        exit();
	}



	public function get_all_teacher_data(){
    	
        $class_where['_id'] = new MongoDB\BSON\ObjectID($_POST['class_id']);
        $firstcollectdata = $this->crud_model->get('class',$class_where);	

        $datacollect['mesagedata'] = $firstcollectdata[0]['messages4class'];
        $datacollect['classname'] = $firstcollectdata[0]['class_name'];
        $datacollect['idofclass'] = $firstcollectdata[0]['_id'];
        $datacollect['connectedclass'] = $firstcollectdata[0]['connectedclass'];

        $connteddata = $firstcollectdata[0]['connectedclass'];
        foreach ($connteddata as $key => $value) {

        	$classid['_id'] = new MongoDB\BSON\ObjectID($value);
        	$othermessage = $this->crud_model->get('class',$classid);
        	
        	foreach ($othermessage[0]['messages4class'] as $key => $value) {
        	
        		array_push($value, "othermessage");
        		array_push($datacollect['mesagedata'], $value);
        	}
        }
       	
     
        $response['data'] = $this->load->view('content/message_table', $datacollect, TRUE);
        $response['status'] = TRUE;
        echo json_encode($response);
        exit();
	}


	public function delete()
    {
        $deletearray[0] = array();
        
    	$delete =  $this->crud_model->pull_new('class',new MongoDB\BSON\ObjectID($_POST['id']),'messages4class',json_encode($deletearray));
    	if($delete){
            $msg = 'Messsage Deleted Successfully';
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