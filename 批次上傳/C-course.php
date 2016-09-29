<?php
class Course extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper('date');
		$this -> load -> helper('form');
		
		$this->load->model($this->admin_path.'auth_model');

		@session_start();
		$this->load->model('MyModel/mymodel');
		$this->load->library('mylib/useful');
		$this->load->library('mylib/comment');
	}

	//活動相簿
	public function sketch_photo($did){
		//頭尾、基本設定
		$this->useful->backconfig();

		//分頁程式 start
		$data['ToPage']=$Topage=!empty($_POST['ToPage'])?$_POST['ToPage']:1;
		//分頁程式 end
		
		//分頁程式
		$qpage=$this->useful->SetPage('sketch_photo','');
		$dbdata=$this->mymodel->select_page_form('sketch_photo',$qpage['result'],'*',array('SID'=>$did),'d_sort');
		
		$data['page']=$this->useful->get_page($qpage);
		$data['SID']=$did;
		$data['dbdata']=$dbdata;

		$this->load->view('admin_sys/sketch/sketch_photo',$data);
	}

	//特殊處理資料增修刪
	public function sketch_data_AED($deldb=''){
		@session_start();
		$this->load->library('/mylib/CheckInput');
		$check=new CheckInput;		

		if(!empty($deldb)){
			
			foreach ($_POST['delete'] as $key => $value) {
				$this->mymodel->delete_where($deldb,array('d_id'=>$value));
			}

			$this->useful->AlertPage($this->admin_path.'course/sketch_photo/'.$_POST['d_id'].'','刪除成功');
			return '';
		}
		
		$dbname='sketch_photo';
		$fileid='d_id';

		foreach ($_POST['sort'] as $key => $value) {
			$this->mymodel->update_set($dbname,$fileid,$value,array('d_sort'=>$key));	
		}
		
		$msg='修改成功';
		$this->useful->AlertPage($this->admin_path.'course/sketch_photo/'.$_POST['d_id'].'',$msg);		
	}
}