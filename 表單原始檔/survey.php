<?
class Survey extends MY_Controller {

	public function __construct()//初始化
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->model($this->admin_path.'survey_model');
		$this->load->model($this->admin_path.'auth_model');
		$this->load->helper('form');
		$this->load->helper('date');

	}
	//----------表單列表---------------------------------
	public function report_list(){

		
		$admin_id=1;
		
		$data['url']=$this->admin_path;
	
		$data['com_id']=$com_id;
		
		$survey_data=$this->survey_model->get_survey_data('','','',$admin_id);
		
		foreach($survey_data as $key=>$val){
			$survey_data[$key]['add_time']=$this->time_converter($val['add_time']);	
		}
		$data['data']=$survey_data;
		
		$this->load->view($this->admin_path.'main/header', $data);
		$this ->is_admin();
		$this->load->view($this->admin_path.'survey/report_list', $data);
		$this->load->view($this->admin_path.'main/footer');		
	}
	//----------表單內容---------------------------------
	public function report_info($id=''){
		// if(!$this->auth_model->is_login($this->session->userdata('com_id')) || 
		// 	$this -> session -> userdata('lang_type')=='')//權限
		// {
		// 	$this->meg1($this->admin_path.'/index/logout',$this->lang->line('LoginError')/*'閒置過久，請重新登入'*/);
		// 	return '';
		// }
		// ckeditor 文字編輯器
		$report_path = $this->user_path($this -> report_path, $com_id);
		$this -> create_dir($report_path.'ckfinder_image/');
		$this -> start_session(3600);
		$_SESSION['member_id']     = 1;
		$_SESSION['IsAuthorized']  = true;
		$_SESSION['ckeditor_url']  = str_replace(".", "", $report_path).'ckfinder_image';
		session_write_close();
		// ckeditor 文字編輯器	
		$data['lang_type']=$lang_type=$this -> session -> userdata('lang_type');
			
		if($id){
			$survey_data=$this->survey_model->get_survey_data($id);		//抓取表單資料
			$data['data']=$survey_data;
	
			$item_data=$this->survey_model->get_survey_item_data($id);//抓取表單選項資料
			
			$maxid=$this->survey_model->get_item_max_id($id);
			
			$data['survey_item_amount']=$maxid['maxid']+1;
			
			$data['id']=$id;
			
			$data['item']=$item_data;	
			$data['apptitle']='修改表單';	
			$data['form']=$this->admin_path.'survey/edit_survey';
		}else{
			$data['apptitle']='新增表單';
			$data['form']=$this->admin_path.'survey/add_survey';
		}
			
		$data['url']=$this->admin_path;
		
		$this->load->view($this->admin_path.'main/header', $data);
		$this ->is_admin();
		$this->load->view($this->admin_path.'survey/report_info', $data);
		$this->load->view($this->admin_path.'main/footer');		
	}
	//----------新增表單---------------------------------
	public function add_survey(){
		// if(!$this->auth_model->is_login($this->session->userdata('com_id')) || 
		// 	$this -> session -> userdata('lang_type')=='')//權限
		// {
		// 	$this->meg1($this->admin_path.'/index/logout',$this->lang->line('LoginError')/*'閒置過久，請重新登入'*/);
		// 	return '';
		// }
		
		//20151216-新增功能-語言載入報表
		$lang_type=$this -> session -> userdata('lang_type');
		if($lang_type=='taiwan')
			$lang_id=0;
		elseif($lang_type=='english')
			$lang_id=1;
		elseif($lang_type=='china')
			$lang_id=2;	
		//20151216-新增功能-語言載入報表
		
		$title=$this->input->post('title');
		$content=$this->input->post('content');
		$prompt=$this->input->post('prompt');		
		$finact=$this->input->post('finact');		
		
		
		$required_name=$this->input->post('required_name');
		$required_phone=$this->input->post('required_phone');
		$required_email=$this->input->post('required_email');
		
		//上傳圖片start
		if($_FILES['pic']['name']!='')
		{
			$image_path=$this->user_path($this->survey_pic_path,$com_id);//路徑
			$this->create_dir($image_path);//創建路徑
			$img_name=$this->up_image('pic','640','320',$image_path,'gif|jpg|png');
			$image=$image_path.$img_name['original'];
		}
		
		$com_id   = $this->session->userdata('com_id');
		
		$survey_data=array(
			'com_id' 			=>$com_id,
			'lang_id' 			=>$lang_id,
			'title' 			=>$title,
			'content'			=>$content,
			'pic'				=>$image,
			'prompt' 			=>$prompt,
			'required_name' 	=>$required_name,
			'required_phone'	=>$required_phone,
			'required_email' 	=>$required_email,
			'final_action' 		=>$finact,
			'add_time' 			=>time(),
			'last_time' 		=>time(),
			'is_del'			=>'0',
			'operation'		 	=>'ADD',
		);
		$create_id=$this->survey_model->add_survey($survey_data);
		
		
		//20150512-可變欄位寫入------------------------------------
		//----複數按鈕----------------
		$item=$this->input->post('item');
		$short=0;
		$dobule=0;		//抓取複選之值
		
		if(!empty($item)){			//選單空就不執行
			foreach($item['type'] as $key=>$val){
			if($val==3 ||$val==4|| $val==5){
						
						if(!empty($item['required'])){
							
							if(in_array($item['item_id'][$key],$item['required']))
								$requried=1;
							else
								$requried=0;
						}else
							$requried=0;
						$item_data=array(
							'survey_id'		=> $create_id,
							'item_type'		=> $item['type'][$key],
							'item_title'	=> $item['name'][$key],
							'item_value'	=> $item['content'][$dobule],
							'short_order'	=> $short,
							'is_required'	=> $requried,
							'is_del'		=> '0',
							'add_time'		=> time(),
							'last_time'		=>  time(),
							'operation'		=> 'ADD',				
						);	
						//print_r($item_data);
						$dobule++;
						
					}else{
						
						if(!empty($item['required'])){
							
							if(in_array($item['item_id'][$key],$item['required']))
								$requried=1;
							else
								$requried=0;
						}else
							$requried=0;
							
						$item_data=array(
							'survey_id'		=> $create_id,
							'item_type'		=> $item['type'][$key],
							'item_title'	=> $item['name'][$key],
							'short_order'	=> $short,
							'is_required'	=> $requried,
							'is_del'		=> '0',
							'add_time'		=> time(),
							'last_time'		=>  time(),
							'operation'		=> 'ADD',				
						);	
				}
				$this->survey_model->add_survey_item($item_data);
				$short++;
			}
		}
		$this->meg('report_info/'.$create_id,$this->lang->line('AddSuccess')/*'儲存表單成功'*/);
	}
	public function edit_survey(){
		// if(!$this->auth_model->is_login($this->session->userdata('com_id')) || 
		// 	$this -> session -> userdata('lang_type')=='')//權限
		// {
		// 	$this->meg1($this->admin_path.'/index/logout',$this->lang->line('LoginError')/*'閒置過久，請重新登入'*/);
		// 	return '';
		// }

		$survey_id=$this->input->post('id');
		$title=$this->input->post('title');
		$content=$this->input->post('content');
		$prompt=$this->input->post('prompt');
		$required_name=$this->input->post('required_name');
		$required_phone=$this->input->post('required_phone');
		$required_email=$this->input->post('required_email');
		//20150522-新增功能-填寫完畢後動作----------------------------
		$finact=$this->input->post('finact');
		//20150522-新增功能-填寫完畢後動作----------------------------
		$com_id   = $this->session->userdata('com_id');

		
		$survey_data=array(
			'title' 			=>$title,
			//'lang_id' 			=>$lang_id,
			'content'			=>$content,
			'prompt' 			=>$prompt,
			'required_name' 	=>$required_name,
			'required_phone'	=>$required_phone,
			'required_email' 	=>$required_email,
			'final_action' 		=>$finact,
			'last_time' 		=>time(),
			'operation'			=>'UPDATE',
		);
		
		//上傳圖片start
		if($_FILES['pic']['name']!='')
		{
			$image_path=$this->user_path($this->survey_pic_path,$com_id);//路徑
			$this->create_dir($image_path);//創建路徑
			$img_name=$this->up_image('pic','640','320',$image_path,'gif|jpg|png');
			$image=$image_path.$img_name['original'];
			
			$survey_data+=array(
				'pic'	=> $image
			);
		}
		
		$this->survey_model->edit_survey($survey_data,$survey_id);
		
		//----複數按鈕----------------
		$item=$this->input->post('item');
		$short=0;
		$dobule=0;		//抓取複選之值
		
		$survey_item=$this->survey_model->get_survey_item_data($survey_id,'1');
		
		foreach($survey_item as $val){
			$item_id[]=$val['item_id'];	
		}
		
		
		if(!empty($item)){			//選單空就不執行	
		foreach($item['type'] as $key=>$val){

		
			if(in_array($item['item_id'][$key],$item_id)){				//有先前值就先修改
			
				if($val==3 ||$val==4|| $val==5){
					
					if(!empty($item['required'])){
						if(in_array($item['item_id'][$key],$item['required']))
							$requried=1;
						else
							$requried=0;
					}
					$item_data=array(
						'item_type'		=> $item['type'][$key],
						'item_title'	=> $item['name'][$key],
						'item_value'	=> $item['content'][$dobule],
						'short_order'	=> $short,
						'is_required'	=> $requried,
						'last_time'		=>  time(),
						'operation'		=> 'UPDATE',				
					);	
					$dobule++;
					
				}else{
					
					if(!empty($item['required'])){
						if(in_array($item['item_id'][$key],$item['required']))
							$requried=1;
						else
							$requried=0;
					}
					$item_data=array(
						'item_type'		=> $item['type'][$key],
						'item_title'	=> $item['name'][$key],
						'short_order'	=> $short,
						'is_required'	=> $requried,
						'last_time'		=>  time(),
						'operation'		=> 'UPDATE',				
					);	
					
				//	print_r($item_data);
				}
				//echo $item['item_id'][$short];
				$this->survey_model->edit_survey_item($item_data,$item['item_id'][$short]);
			}else{
							//無先前值就新增
				if($val==3 ||$val==4|| $val==5){
					
					if(!empty($item['required'])){
						
						if(in_array($item['item_id'][$key],$item['required']))
							$requried=1;
						else
							$requried=0;
					}else
						$requried=0;
					$item_data=array(
						'survey_id'		=> $survey_id,
						'item_type'		=> $item['type'][$key],
						'item_title'	=> $item['name'][$key],
						'item_value'	=> $item['content'][$dobule],
						'short_order'	=> $short,
						'is_required'	=> $requried,
						'is_del'		=> '0',
						'add_time'		=> time(),
						'last_time'		=>  time(),
						'operation'		=> 'ADD',				
					);	
					//print_r($item_data);
					$dobule++;
					
				}else{
					
					if(!empty($item['required'])){
						
						if(in_array($item['item_id'][$key],$item['required']))
							$requried=1;
						else
							$requried=0;
					}else
						$requried=0;
						
					$item_data=array(
						'survey_id'		=> $survey_id,
						'item_type'		=> $item['type'][$key],
						'item_title'	=> $item['name'][$key],
						'short_order'	=> $short,
						'is_required'	=> $requried,
						'is_del'		=> '0',
						'add_time'		=> time(),
						'last_time'		=>  time(),
						'operation'		=> 'ADD',				
					);	
					
					//print_r($item_data);
				}
			//	print_r($item_data);
				$this->survey_model->add_survey_item($item_data);
			}
			
			$short++;
		}
	}	
		$this->meg('report_info/'.$survey_id,$this->lang->line('EditOk')/*'修改表單成功'*/);
	}
}
?>