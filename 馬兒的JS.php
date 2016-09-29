<select name="show_num" id="show_num" style="border:0px; font-size:14px; margin:5px;">
  <option value="no">請選擇</option>
  <option value="1">批次上架</option>
  <option value="0">批次下架</option>            
</select>
<input type="button" value="修改" style=" font-size:14px;" onclick="allcheck()"/>

<th>全選<br /><input type="checkbox" onclick="check_all(this,'allid[]')" /></th>

function check_all(obj,cName) 
{ 
    var checkboxs = document.getElementsByName(cName); 
    for(var i=0;i<checkboxs.length;i++){checkboxs[i].checked = obj.checked;} 
} 
//全選函式
function allcheck(){
  var str=''; 
  var DB='question';    //資料庫
  var Field='q_id'; //欄位名稱
  var show=$('#show_num').val();
  if(show=='no'){
    alert("請選擇動作");
    return '';
  }
  $("input[name='allid[]']:checked").each(function(){   
      str+=$(this).val()+';';   
  })   
  if(str==''){
      alert('請選取項目');
      return  '';
  }

  $.ajax({
      url:'/index/oc_data',
      type:'POST',
      data: 'DB='+DB+'&field='+Field+'&id='+str+'&oc='+show,
      dataType: 'text',
      success: function( json ) 
      {
          alert(json);
          window.location.reload();
      }
  });
}


function del_file(title,id){
  if(confirm('確定刪除['+title+']資料?')){
    var DB='banner';    //資料庫
    var Field='b_id'; //欄位名稱
    var File=1;     //如果需要刪圖 調"1"
    var File_Field='pic_url';  //如果FILE為一 需填寫檔案之欄位
    $.ajax({
      url:'/index/del_DB_data',
      type:'POST',
      data: 'DB='+DB+'&field='+Field+'&id='+id+'&file='+File+'&FField='+File_Field,
      dataType: 'text',
      success: function( json ) 
      {
          alert(json);
          window.location.reload();
      }
    });
  }
}