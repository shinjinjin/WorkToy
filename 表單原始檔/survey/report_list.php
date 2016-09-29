  <div class="content-all">
    <div class="content-title" >
      <div class="content-ti-title">表單列表</div>
      <div class="content-ti-menu">
   		<ul>
          <li><a href="<?=$url?>survey/report_info">新增表單</a></li>	
          <li>
          	<a href="/index/survey_list/<?=$com_id?>" target="_blank">
            	前台表單列表
            </a>
          </li>	
        </ul>
      </div>
    </div>
    <div class="clear"></div>
    <!--內容之搜尋-->

    
    <!--內容之內容-->
    <div class="content-content">
      <div class="product-table">
        <table border="0" cellspacing="0" cellpadding="0" class="content-table" style="width:100%;">
          <tr>
          	<th>標題</th>
            <th>發佈時間</th>
            <th>修改</th>
            <th>預覽</th>
            <th>報表結果</th>
            <th>刪除</th>
          </tr>
          <? 
		  	foreach($data as $val){
		  ?>
          <tr class="E7E7E7">
           	<td><?=$val['title']?></td>
            <td><?=$val['add_time']?></td>
            <td><a href="<?=$url?>survey/report_info/<?=$val['survey_id'] ?>" ><img src="/images/menu/ico-modify-a.png" name="icn_trash" width="16" height="14" border="0"></a></td>
            <td><a href="#" onclick="javascript:window.open('<?=$s_url.$val['survey_id']?>', '', config='scrollbars=1,outerWidth=300,innerWidth=300,height=640,width=360,left=900,scrollbar=yes')"><img src="/images/menu/ico-searcha-a.png" name="icn_trash" width="16" height="14" border="0"></a></td>
            <td><a href="#" onclick="javascript:window.open('<?=$re_url.$val['survey_id']?>', '',' left=0,top=0,width='+ (screen.availWidth - 10) +',height='+ (screen.availHeight-50) +',scrollbars,resizable=yes,toolbar=no')"><img src="/images/menu/ico-searcha-a.png" name="icn_trash" width="16" height="14" border="0"></a></td>
        	<td><a href="#" onclick="del_app(<?=$val['survey_id']?>)"><img src="/images/menu/icn_trash-a.png" name="icn_trash" width="16" height="14" border="0"></a></td>
			</tr>

		<? } ?>
          
        </table>
        <!--頁碼 一頁10筆訂單-->
        <div class="product-pageall"><?=$page?></div>
        
      </div>
      <div style=" background-color:#F00;"></div>
    </div>
  </div>
</div>
<script>
function del_app(id){
	
	if(confirm('使用者手機上的訊息也會被刪除，是否確認刪除？')){
		$.ajax({
			url:'/index/del_item',
			type:'POST',
			data: 'id=' + id+'&type=1',
			success: function( msg ) 
			{
				if(msg==1)
					window.location.reload();
			}
		});	
	}
}

</script>
