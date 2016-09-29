<img src="data:image/jpg;base64,<?php echo $this->get_base($val['image']);?>" /></td>
<?
	
	
	//20150916 圖片BASE64格式，加速顯示圖片
	function get_base($pic_url){
		$url=base64_encode(file_get_contents($pic_url,'r'));
		return $url;
	}
?>
