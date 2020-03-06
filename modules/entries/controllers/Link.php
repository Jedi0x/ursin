<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Link extends MY_Controller{

	function __construct(){
		parent::__construct();
		$this->title = "Link";
        $this->scripts = array("class");	
     	
        $this->layout = 'entries/views/layouts/ursin_link';
        $this->logged_in_user = get_user_id();
        $this->logged_in_teacher_id = get_teacher_id();

	}

	public function index(){

        $class_where['array_teachers'] = $this->logged_in_teacher_id;
        $data['classes'] = $this->crud_model->get('class',$class_where);
        if($data['classes'][0]['show_tools'][2] == 1){

        }else{
            $data['showbanner'] = 'false';
        }
        
        
		$this->load->view('link',$data);
	}


	public function manage()
    {

                $dataofarray['title'] = $_POST['title'];
                $dataofarray['url'] = $_POST['url'];
                $dataofarray['category'] = $_POST['category'];
                $dataofarray['description'] = $_POST['description'];
                $dataofarray['icon'] = $_POST['icon'];
                $dataofarray['color'] = $_POST['color'];
                
                $dataofarray['teachers_name'] = $this->logged_in_teacher_id;
                $pushColumn = 'links4class';

        if($_POST['publishforall'] == 'publish'){

                $dataforall = $this->crud_model->get('class'); 
                foreach ($dataforall as $key => $valueofcls) {

                  if(count($valueofcls['links4class']) <= 100){
                    $class_where['_id'] = new MongoDB\BSON\ObjectID($valueofcls['_id']);
                    $class_id = $this->crud_model->push('class',$class_where,$pushColumn,array($dataofarray));
                  }

                }
                $msg = 'Link successfully created for all classes';
                $response['status'] = true;
                $response['msg'] = $msg;
                $this->session->set_flashdata('success',$msg);
        }else{

                $class_where['_id'] = new MongoDB\BSON\ObjectID($_POST['class_id']);
                $data = $this->crud_model->get('class',$class_where);
               
                if(count($data[0]['links4class']) <= 100){
            		$class_id = $this->crud_model->push('class',$class_where,$pushColumn,array($dataofarray));
                    if($class_id){
                        $msg = 'Link Successfully Created';
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
                        $msg = 'Limit Reached. Only 100 entries are possible in links';
                        $response['status'] = false;
                        $response['msg'] = $msg;
                        $this->session->set_flashdata('error',$msg);
                }
        }

        redirect('entries/link');
    }


    public function get_link_data(){
    	
        $class_where['_id'] = new MongoDB\BSON\ObjectID($_POST['class_id']);
        $firstcollectdata = $this->crud_model->get('class',$class_where);	

        $datacollect['mesagedata'] = $firstcollectdata[0]['links4class'];
        $datacollect['classname'] = $firstcollectdata[0]['class_name'];
        $datacollect['idofclass'] = $firstcollectdata[0]['_id'];
        $datacollect['connectedclass'] = $firstcollectdata[0]['connectedclass'];

        $response['data'] = $this->load->view('content/link_table', $datacollect, TRUE);
        $response['status'] = TRUE;
        echo json_encode($response);
        exit();
	}



	public function get_all_link_data(){
    	
        $class_where['_id'] = new MongoDB\BSON\ObjectID($_POST['class_id']);
        $firstcollectdata = $this->crud_model->get('class',$class_where);	

        $datacollect1['mesagedata'] = $firstcollectdata[0]['links4class'];
        $datacollect1['classname'] = $firstcollectdata[0]['class_name'];
        $datacollect1['idofclass'] = $firstcollectdata[0]['_id'];
        $datacollect1['connectedclass'] = $firstcollectdata[0]['connectedclass'];

        $connteddata = $firstcollectdata[0]['connectedclass'];
        foreach ($connteddata as $key => $value) {

        	$classid['_id'] = new MongoDB\BSON\ObjectID($value);
        	$othermessage = $this->crud_model->get('class',$classid);
        	
        	foreach ($othermessage[0]['links4class'] as $key => $value) {
        	
        		array_push($value, "othermessage");
        		array_push($datacollect1['mesagedata'], $value);
        	}
        }

     
        $response['data'] = $this->load->view('content/link_table', $datacollect1, TRUE);
        $response['status'] = TRUE;
        echo json_encode($response);
        exit();
	}


	public function delete()
    {
        $where['_id'] = new MongoDB\BSON\ObjectID($_POST['id']);
        $delete =  $this->crud_model->delete_indexof_array('class',$where,'links4class',$_POST['key']);
    	if($delete){
            $msg = 'Link Successfully Deleted';
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