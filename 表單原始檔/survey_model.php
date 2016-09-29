<?php
class Survey_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	//-抓取表單資料-
	public function get_survey_data($id=FALSE,$page=0,$limit='',$admin_id='',$api=''){
		$sql='select * from survey';
		$sql.=' where 1=1';
		
		if($admin_id!='')
			$sql.=' and admin_id='.$admin_id;

		if ($id == FALSE)//列表
		{	
			$page=($page=='')?0:$page;
			if($limit !='')
			{
				$sql.='  LIMIT '.$page .', '.$limit;
			}
		
			$query = $this->db->query($sql);
			$list=$query->result_array();
			return $list;
		}
		$sql.=' and survey_id='.$id;
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	
	//-新增表單資料-
	public function add_survey($data){		
		$this->db->insert('survey', $data);//新增資料
		return $this->db->insert_id();//回傳id
	}
	//修改表單資料
	public function edit_survey($data,$id){
		$this->db->where('survey_id', $id);
		return $this->db->update('survey', $data); 
	}
	//-刪除表單資料-
	public function del_survey($id){
		$data=array(
			'is_del' 	=> '1',
			'last_time'	=>	time(),
			'operation'	=> 'DELETE'
		);
				
		$this->db->where('survey_id', $id);
		return $this->db->update('survey', $data); 
	}
	
	
	//-抓取表單資料-
	public function get_survey_item_data($id,$order='',$api=''){
		$sql='select * from survey_item';
		$sql.=' where 1=1';
		$sql.=' and survey_id='.$id;
		
	
		if($order=='')
			$sql.=' order by short_order';
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	//-新增表單選項資料-
	public function add_survey_item($data){		
		$this->db->insert('survey_item', $data);//新增資料
		return $this->db->insert_id();//回傳id
	}
	
	//-修改表單選項資料-
	public function edit_survey_item($data,$id){		
		$this->db->where('item_id', $id);
		return $this->db->update('survey_item', $data); 
	}
	//-刪除表單選項資料-
	public function del_survey_item($id){
		$data=array(
			'is_del' 	=> '1',
			'last_time'	=>	time(),
			'operation'	=> 'DELETE'
		);
				
		$this->db->where('item_id', $id);
		return $this->db->update('survey_item', $data); 
	}
	//---抓取表單答案資料-------------------
	public function get_survey_answer_title($id){
		$sql='select * from survey_answer_title';
		$sql.=' where 1=1';
		$sql.=' and survey_id='.$id;

		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	//-新增表單固定欄位答案-----
	public function add_survey_answer_title($data){
		$this->db->insert('survey_answer_title', $data);//新增資料
		return $this->db->insert_id();//回傳id
	}
	
	//---抓取表單答案資料-------------------
	public function get_item_answer($id){
		$sql='select * from survey_item_answer';
		$sql.=' where 1=1';
		$sql.=' and satitle_id='.$id;

		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	//-新增表單答案資料-----
	public function add_answer_item($data){
		$this->db->insert('survey_item_answer', $data);//新增資料
		return $this->db->insert_id();//回傳id
	}
	public function get_item_max_id($id){
		$sql='select max(item_id) as maxid from survey_item_answer';
		$sql.=' where 1=1';
		$sql.=' and survey_id='.$id;

		$query = $this->db->query($sql);
		return $query->row_array();
	}
}