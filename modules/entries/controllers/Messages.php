<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Messages extends MY_Controller{

	function __construct(){
		parent::__construct();
		$this->title = "Messages";
        $this->scripts = array("class");	
     	
        $this->logged_in_user = get_user_id();
        $this->logged_in_teacher_id = get_teacher_id();
	}

	public function index(){

		$userdata = $this->session->userdata("user_session");
		$whereuser['user_id'] = $userdata['user_id'];
        $totalcount = $this->crud_model->get('messages4class',$whereuser);
        
        $class_where['array_teachers'] = $this->logged_in_teacher_id;
        $data['classes'] = $this->crud_model->get('class',$class_where);

        $check_limit = get_count_messages();
		if($check_limit <= count($totalcount)){
			$data['notshowform'] = 'Only '.$check_limit.' messages at a time are possible so that it stays simple. Please delete messages that are no longer needed';
		}else{
			$data['notshowform'] = '';
		}

		$data['messagesdata'] = $this->get_messages_data();
		
		$this->load->view('messages',$data);
	}


	public function manage()
    {
       	$userdata = $this->session->userdata("user_session");
       
        $whereuser['user_id'] = $userdata['user_id'];
        $totalcount = $this->crud_model->get('messages4class',$whereuser);
        
        $check_limit = get_count_messages();

        if(count($totalcount) < $check_limit){

		        //insert in class collection
		        $data['title'] = $_POST['title'];
		        $data['message'] = $_POST['message'];
		        $data['date'] = $_POST['date'];
		        $data['class_id'] = $_POST['class_id'];
		        $data['user_id'] = $userdata['user_id'];
		        $data['recipient_identifier'] = $_POST['recipient_identifier'];
		       
		        $class_id = $this->crud_model->insert('messages4class',$data);


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



        }else{
        			$msg = 'Limit Reached';
		            $response['status'] = false;
		            $response['msg'] = $msg;
		            $this->session->set_flashdata('error',$msg);
        }

        redirect('entries/messages');

    }


    public function get_messages_data(){

		$userdata = $this->session->userdata("user_session");
		$whereuser['user_id'] = $userdata['user_id'];
        $data = $this->crud_model->get('messages4class',$whereuser);	

        return 	$data;
	}




}