<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>

<!-- css -->
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<link type="text/css" rel="stylesheet" href="/css/uform_add.css">
  
<div class="content-all">
    <div class="content-title" >
    <div class="content-ti-title"><?=$apptitle?></div>
    
    <div class="clear"></div>
    </div>
    <div class="content-content">
      <div class="product-table">
        <div class="product-table-all">
    <?=form_open($form,array('enctype'=>"multipart/form-data","onsubmit"=>"return check_form(this)"));?>
        <table border="0" cellspacing="0" cellpadding="0" class="contentin-table" style="width:100%;">
        <tr>
            <th>表單標題</th>
            <td colspan="2">
                <input type="text" name="title"  class="contentin-table-tdtextfield" value="<?php echo $data['title']?>" >
            </td>
        </tr>
        <tr>
            <th>表單說明</th>
            <td colspan="2">
           		<textarea name="content" id="content"><?=$data['content']?></textarea>
            </td>
        </tr>
        <tr>
            <th>列表照片</th>
            <td colspan="2">
           		<input type="file" name="pic" />
            </td>
            <td>
            	<? if($data['pic']!=''){?>
                	<img src="<?=substr($data['pic'],1,strlen($data['pic']))?>" name="pic1"  width="250" height="250"/>
                <? }?>
            </td>
        </tr>
        <input type="hidden" name="id" value="<?php echo $data['survey_id']?>" />        
        <tr >
        	
            <td class='table-cell-right'>
            <?php if($data['survey_id']==''){?>
                欄位名稱<br>
                <select class='form-control' id='select_form_item' style="display:inline; width: 80px; margin-top: 4px;">
                    <option value='0'>新增</option>
                    <option value='1'>日期</option>
                    <option value='2'>文字</option>
                    <option value='3'>單選按鈕</option>
                    <option value='4'>下拉選項</option>
                    <option value='5'>複選按鈕</option>
                    <option value='6'>數字數量</option>
           		</select>
             <?php }?>    
            </td>
           
            <td class='table-cell-left'>
            <table id='h_col_table' class='personal-info'>
              <tr><td>固定欄位名稱</td></tr>
              <tr>
              	<td>
                	<input style="width:507px;display:inline;" type='text' placeholder='必填欄位名稱，例如：姓名' class='form-control'  name='required_name'  maxlength='32' value="<?=$data['required_name']?>">
                </td>
              </tr>
              <tr>
                  <td>
                	  <input style="width:507px;display:inline;" type='text' placeholder='必填欄位名稱，例如：手機' class='form-control'  name='required_phone'  maxlength='32' value="<?=$data['required_phone']?>">
                  </td>
              </tr>
              <tr>
              <td>
              <input style="width:507px;display:inline;" type='text' placeholder='必填欄位名稱，例如：信箱' class='form-control'  name='required_email'  maxlength='32' value="<?=$data['required_email']?>"></td></tr>
			</table>
            
            <table id='c_col_table' class='personal-info'>
                <tr><td>「左側勾選」可設為必填欄位，左鍵按住&nbsp;<i class="fa fa-bars"></i>&nbsp;可拖曳排序</td></tr>
                <tr id='prompt_tr' class='prompt_tr'><td style="color: #ff6600;">您尚有「未填寫」欄位，請將以下欄位內容填妥後重試</td></tr>
            </table>
            <table id='col_table' class='personal-info'>
                <tbody id='col_table_tbody'>
					<? if($item){foreach($item as $key=>$val){ ?>
                        <tr class="item_tr<?=$key?>">
                            <td style="width: 484px;">
								<? if($val['item_type']==1){?>
                                    <input name="item[type][]" type="hidden" value="1">
									<input name="item[item_id][]"  value="<?=$val['item_id']?>" type="hidden"/>
                                    <input style="zoom: 200%;-moz-transform: scale(2);position: relative;top: 3px;" type="checkbox" name="item[required][]" value="<?=$val['item_id']?>" <? echo ($val['is_required']==1)?'checked':'';?> class="form-control">
                                    <input style="width: 374px; padding: 7px; border: 1px solid #CAC2A9; border-radius: 3px; margin: 0px 3px; font-size: 1em; font-family: \'Microsoft Jhenghei\'; box-shadow: inset 3px 3px 5px #eee;" name="item[name][]" placeholder="[日期] [欄位名稱] 例如：您的生日" class="item_name" value="<?=$val['item_title']?>">
                                    <button type="button" style="cursor: pointer; border: 0px; font-size: 1em;" class="aa7 btn btn-danger del_col" onclick="javascript:void(0);" value="<?=$val['item_id']?>">移除</button>
                                    <i class="fa fa-bars" style="font-size: 2em;position: relative;top: 6px;"></i>
                                <? }if($val['item_type']==2){	?>
                                    <input name="item[type][]" type="hidden" value="2">
                                    <input name="item[item_id][]"  value="<?=$val['item_id']?>" type="hidden"/>
                                    <input style="zoom: 200%;-moz-transform: scale(2);position: relative;top: 3px;" type="checkbox" name="item[required][]" value="<?=$val['item_id']?>" <? echo ($val['is_required']==1)?'checked':'';?> class="form-control">
                                    <input style="width: 374px; padding: 7px; border: 1px solid #CAC2A9; border-radius: 3px; margin: 0px 3px; font-size: 1em; font-family: \'Microsoft Jhenghei\'; box-shadow: inset 3px 3px 5px #eee;" name="item[name][]" placeholder="[文字] [欄位名稱] 例如：您的公司電話" class="item_name" value="<?=$val['item_title']?>">
                                    <button type="button" style="cursor: pointer; border: 0px; font-size: 1em;" class="aa7 btn btn-danger del_col" onclick="javascript:void(0);" value="<?=$val['item_id']?>">移除</button>
                                    <i class="fa fa-bars" style="font-size: 2em;position: relative;top: 6px;"></i>
                                <? }if($val['item_type']==3){?>                                
                                    <input name="item[type][]" type="hidden" value="3">
                                    <input name="item[item_id][]"  value="<?=$val['item_id']?>" type="hidden"/>
                                    <input style="zoom: 200%;-moz-transform: scale(2);position: relative;top: 3px;" type="checkbox" name="item[required][]" value="<?=$val['item_id']?>" <? echo ($val['is_required']==1)?'checked':'';?> class="form-control">
                                    <input style="width: 374px; padding: 7px; border: 1px solid #CAC2A9; border-radius: 3px; margin: 0px 3px; font-size: 1em; font-family: \'Microsoft Jhenghei\'; box-shadow: inset 3px 3px 5px #eee;" name="item[name][]" placeholder="[單選] [欄位名稱] 例如：您的交通工具" class="item_name" value="<?=$val['item_title']?>">
                                    <button type="button" style="cursor: pointer; border: 0px; font-size: 1em;" class="aa7 btn btn-danger del_col" onclick="javascript:void(0);" value="<?=$val['item_id']?>">移除</button>
                                    <i class="fa fa-bars" style="font-size: 2em;position: relative;top: 6px;"></i>
                                    <input style="margin-top: 6px; margin-left: 34px; background-color: #F3FBFF; width: 374px; padding: 7px; border: 1px solid #CAC2A9; border-radius: 3px; font-size: 1em; font-family: \'Microsoft Jhenghei\'; box-shadow: inset 3px 3px 5px #eee;" name="item[content][]" placeholder="[單選] [選項] 例如：機車 汽車 計程車?>" class="item_content" value="<?=$val['item_value']?>">
                                    <a href="#" class="why" tabindex = "-1" style="top: -3px;">?</a>
                                    <div class="prompt-box" style="padding: 3px 10px;">
                                        <p>[單選] 請輸入 [欄位名稱] 與 [選項]，舉例來說：</p>
                                        <p>
                                           <input style="zoom: 200%;-moz-transform: scale(2);position: relative;top: 3px;" type="checkbox" disabled="disabled" class="form-control">&nbsp;
                                           <input style="margin-top: 6px;background-color: #F3FBFF; width: 334px; padding: 7px; border: 1px solid #CAC2A9; border-radius: 3px; font-size: 1em; font-family: \'Microsoft Jhenghei\'; box-shadow: inset 3px 3px 5px #eee;" value="您的交通工具" class="form-control" readonly="true">&nbsp;
                                           <button type="button" style="border: 0px; font-size: 1em;" class="aa7 btn btn-danger">移除</button>&nbsp;<i class="fa fa-bars" style="font-size: 2em;position: relative;top: 6px;"></i></p>
                                        <p><input style="margin-top: 6px; margin-left: 34px; background-color: #F3FBFF; width: 333px; padding: 7px; border: 1px solid #CAC2A9; border-radius: 3px; font-size: 1em; font-family: \'Microsoft Jhenghei\'; box-shadow: inset 3px 3px 5px #eee;" class="form-control" type="text" readonly="true" value="機車 汽車 計程車"></p>
                                        <p>請注意，任一選項之間請加入「空白」，以分隔您的選項內容?></p>
                                        <p>若您沒有使用任何選項間隔「空白」，此欄位將不會被新增?></p>
                                        <p>另外，若您沒有填寫欄位名稱，此欄位也不會被新增?></p>
                                    </div>
                                <? }if($val['item_type']==4){?>
                                    <input name="item[type][]" type="hidden" value="4">
                                    <input name="item[item_id][]"  value="<?=$val['item_id']?>" type="hidden"/>
                                    <input style="zoom: 200%;-moz-transform: scale(2);position: relative;top: 3px;" type="checkbox" name="item[required][]" value="<?=$val['item_id']?>" <? echo ($val['is_required']==1)?'checked':'';?> class="form-control">
                                    <input style="width: 374px; padding: 7px; border: 1px solid #CAC2A9; border-radius: 3px; margin: 0px 3px; font-size: 1em; font-family: \'Microsoft Jhenghei\'; box-shadow: inset 3px 3px 5px #eee;" name="item[name][]" placeholder="[下拉] [欄位名稱] 例如：您的交通工具" class="item_name" value="<?=$val['item_title']?>">
                                    <button type="button" style="cursor: pointer; border: 0px; font-size: 1em;" class="aa7 btn btn-danger del_col" onclick="javascript:void(0);" value="<?=$val['item_id']?>">移除</button>
                                    <i class="fa fa-bars" style="font-size: 2em;position: relative;top: 6px;"></i>
                                    <input style="margin-top: 6px; margin-left: 34px; background-color: #F3FBFF; width: 374px; padding: 7px; border: 1px solid #CAC2A9; border-radius: 3px; font-size: 1em; font-family: \'Microsoft Jhenghei\'; box-shadow: inset 3px 3px 5px #eee;" name="item[content][]" placeholder="[下拉] [選項] 例如：機車 汽車 計程車" class="item_content" value="<?=$val['item_value']?>">
                                    <a href="#" class="why" tabindex = "-1" style="top: -3px;">?</a>
                                    <div class="prompt-box" style="padding: 3px 10px;">
                                        <p>[下拉] 請輸入 [欄位名稱] 與 [選項]，舉例來說：</p>
                                        <p>
                                           <input style="zoom: 200%;-moz-transform: scale(2);position: relative;top: 3px;" type="checkbox" disabled="disabled" class="form-control">&nbsp;
                                           <input value="您的交通工具" class="form-control" style="margin-top: 6px;background-color: #F3FBFF; width: 334px; padding: 7px; border: 1px solid #CAC2A9; border-radius: 3px; font-size: 1em; font-family: \'Microsoft Jhenghei\'; box-shadow: inset 3px 3px 5px #eee;" readonly="true">&nbsp;
                                           <button type="button" style="border: 0px; font-size: 1em;" class="aa7 btn btn-danger">移除</button>&nbsp;<i class="fa fa-bars" style="font-size: 2em;position: relative;top: 6px;"></i></p>
                                        <p><input style="margin-top: 6px; margin-left: 34px; background-color: #F3FBFF; width: 333px; padding: 7px; border: 1px solid #CAC2A9; border-radius: 3px; font-size: 1em; font-family: \'Microsoft Jhenghei\'; box-shadow: inset 3px 3px 5px #eee;" class="form-control" type="text" readonly="true" value="機車 汽車 計程車"></p>
                                        <p>請注意，任一選項之間請加入「空白」，以分隔您的選項內容</p>
                                        <p>若您沒有使用任何選項間隔「空白」，此欄位將不會被新增</p>
                                        <p>另外，若您沒有填寫欄位名稱，此欄位也不會被新增</p>
                                    </div>
                                <? }if($val['item_type']==5){?>
                                    <input name="item[type][]" type="hidden" value="4">
                                    <input name="item[item_id][]"  value="<?=$val['item_id']?>" type="hidden"/>
                                    <input style="zoom: 200%;-moz-transform: scale(2);position: relative;top: 3px;" type="checkbox"  name="item[required][]" value="<?=$val['item_id']?>" <? echo ($val['is_required']==1)?'checked':'';?> class="form-control">
                                    <input style="width: 374px; padding: 7px; border: 1px solid #CAC2A9; border-radius: 3px; margin: 0px 3px; font-size: 1em; font-family: \'Microsoft Jhenghei\'; box-shadow: inset 3px 3px 5px #eee;" name="item[name][]" placeholder="[複選] [欄位名稱] 例如：您的專長" class="item_name" value="<?=$val['item_title']?>">
                                    <button type="button" style="cursor: pointer; border: 0px; font-size: 1em;" class="aa7 btn btn-danger del_col" onclick="javascript:void(0);" value="<?=$val['item_id']?>">移除</button>
                                    <i class="fa fa-bars" style="font-size: 2em;position: relative;top: 6px;"></i>
                                    <input style="margin-top: 6px; margin-left: 34px; background-color: #F3FBFF; width: 374px; padding: 7px; border: 1px solid #CAC2A9; border-radius: 3px; font-size: 1em; font-family: \'Microsoft Jhenghei\'; box-shadow: inset 3px 3px 5px #eee;" name="item[content][]"  placeholder="[複選] [選項] 例如：網站UI 平面設計 網頁撰寫"  class="item_content" value="<?=$val['item_value']?>">
                                    <a href="#" class="why" tabindex = "-1" style="top: -3px;">?</a>
                                    <div class="prompt-box" style="padding: 3px 10px;">
                                        <p>[複選] 請輸入 [欄位名稱] 與 [選項]，舉例來說：</p>
                                        <p>
                                           <input style="zoom: 200%;-moz-transform: scale(2);position: relative;top: 3px;" type="checkbox" disabled="disabled" class="form-control">&nbsp;
                                           <input value="您的專長" class="form-control" style="margin-top: 6px;background-color: #F3FBFF; width: 334px; padding: 7px; border: 1px solid #CAC2A9; border-radius: 3px; font-size: 1em; font-family: \'Microsoft Jhenghei\'; box-shadow: inset 3px 3px 5px #eee;" readonly="true">&nbsp;
                                           <button type="button" style="border: 0px; font-size: 1em;" class="aa7 btn btn-danger">移除</button>&nbsp;<i class="fa fa-bars" style="font-size: 2em;position: relative;top: 6px;"></i></p>
                                        <p><input style="margin-top: 6px; margin-left: 34px; background-color: #F3FBFF; width: 333px; padding: 7px; border: 1px solid #CAC2A9; border-radius: 3px; font-size: 1em; font-family: \'Microsoft Jhenghei\'; box-shadow: inset 3px 3px 5px #eee;" class="form-control" type="text" readonly="true" value="網站UI 平面設計 網頁撰寫"></p>
                                        <p>請注意，任一選項之間請加入「空白」，以分隔您的選項內容</p>
                                        <p>若您沒有使用任何選項間隔「空白」，此欄位將不會被新增</p>
                                        <p>另外，若您沒有填寫欄位名稱，此欄位也不會被新增</p>
                                    </div>
                                <? }if($val['item_type']==6){?>
                                    <input name="item[type][]" type="hidden" value="6">
                                    <input name="item[item_id][]"  value="<?=$val['item_id']?>" type="hidden"/>
                                    <input style="zoom: 200%;-moz-transform: scale(2);position: relative;top: 3px;" type="checkbox" name="item[required][]" value="<?=$val['item_id']?>" <? echo ($val['is_required']==1)?'checked':'';?> class="form-control">
                                    <input style="margin: 0px 3px; width: 374px; padding: 7px; border: 1px solid #CAC2A9; border-radius: 3px; font-size: 1em; font-family: \'Microsoft Jhenghei\'; box-shadow: inset 3px 3px 5px #eee;" name="item[name][]" placeholder="[數字數量] [欄位名稱] 例如：預計同行人數" class="item_name" value="<?=$val['item_title']?>">
                                    <button type="button" style="border: 0px; font-size: 1em;" class="aa7 btn btn-danger del_col" onclick="javascript:void(0);" value="<?=$val['item_id']?>" >移除</button>
                                    <i class="fa fa-bars" style="font-size: 2em;position: relative;top: 6px;"></i>
                                   
                                <? }?>
                            </td>
                    	</tr>
                    <? }}?>
                </tbody>
            </table>
            </td>
            </tr>
            <tr>
                <td class='table-cell-right'>提示文字<br>
                    <a href="#" class="why" tabindex = "-1">?</a>
                    <div class='prompt-box'>當使用者填完資料送出後，您可由此設定彈出視窗的提示文字內容</div>
                </td>
            <td class='table-cell-left'><textarea placeholder='例如：問卷填寫完成' class='form-control' name="prompt"  style="width: 512px; resize: none;" rows="4"><?=$data['prompt']?></textarea></td>
        	</tr>
        </table>
        </div>
        <div class="clear"></div>
        <div class="mt-10 contentin-button-sit ">
		<input type="submit" value="確定" class="contentin-button" >
		<input type='hidden' name='survey_item_amount' id='survey_item_amount' value='<?=$survey_item_amount?>'>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="/js/survey_sample_edit.js"></script>
<script type="text/javascript">
function check_form(frm)
{
	if(frm.elements['required_name'].value==''){
		alert("請輸入固定欄位名稱");
		frm.elements['required_name'].focus();
		return false;	
	}
	else if(frm.elements['required_phone'].value==''){
		alert("請輸入固定欄位名稱");
		frm.elements['required_phone'].focus();
		return false;	
	}

	else
		return true;	
}
$(function(){
	// sortable
	$('#col_table_tbody').sortable({scroll:false});
});

$(function()
{
	$("input[name=pic]").change(function(){
        getImgSize(this, 'pic', $("#pic"), '152', '152');
    });
/*	$("input[name=link1]").blur(function(){
       	var strurl=(this.value).substr(-3);
		
		if(strurl!='jpg'&& strurl!='JPG'&&strurl!='png'&&strurl!='PNG'){
			alert('<?php echo $this->lang->line('Picerror'); //連結圖檔格式不符，請使用 .png 或 .jpg 格式檔案?>');
        	this.value='';
		}
			
    });*/
});

getImgSize = function (input, name, image_element, w, h) 
{
    if (input.files && input.files[0]) 
    {
        var reader = new FileReader();
        reader.onload = function (e) 
        {
            image_element.attr('src', e.target.result);
            load_result($('input[name='+name+']'), image_element, w, h);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

load_result = function (file_element, image_element, w, h)
{
    eval('var type = /(.png|.PNG|.jpg|.JPG)$/i');
    var file_type = file_element.val().substr(-4);
    if(!type.test(file_type))
    {
        alert('連結圖檔格式不符，請使用 .png 或 .jpg 格式檔案');
        file_element.val('');
    }
 
}

</script>
