$(function()
{   
    $('#sort_submit,#sort_return_original_block,#check_all_text,#delete_submit').hide();

    $('#album_photo_add').click(function(){
        window.open("/upload_photo/index/<?=$SID?>", '新增相簿照片', config='height=350,width=640,left=400,top=50,resizable=no,scrollbar=no,scrollbars=0');
    });
    //sort
    $('#show_sort_block').click(function(){
        $('#album_photo_add,#show_sort_block,#show_delete_block').hide();
        $('#sort_submit,#sort_return_original_block').show();
        $('#photo_block_ul').toggle();
        $('#photo_sort_block_ul').toggle();
        $('#sort_return_original_block').attr('value','sort');
    });
    //sort_submit
    $('#sort_submit').click(function(){
        $('#photo_sort_from').submit();
    });
    //刪除照片
    $('#show_delete_block').click(function(){
        $('#photo_delete_block').toggle();
        $('#photo_block_ul').toggle();
        
        $('#album_photo_add,#show_sort_block,#show_delete_block').hide();
        $('#check_all_text,#delete_submit,#sort_return_original_block').show();
    });
    //返回相簿
    $('#sort_return_original_block').click(function(){
        $('#photo_block_ul').toggle();
        if(this.value=='sort')
            $('#photo_sort_block_ul').toggle();
        else
            $('#photo_delete_block').toggle();
        $('#album_photo_add,#show_sort_block,#show_delete_block').show();
        $('#sort_submit,#sort_return_original_block,#check_all_text,#delete_submit').hide();
        $('#sort_return_original_block').attr('value','');
    });
    
    
    $('#photo_sort_block_ul').sortable();
    //全選
    $('#check_all_text').click(function(){
            $("#check_all").trigger('click');
        });
        var check_all_status = 1;
        $("#check_all").click(function() {
            if(check_all_status == 1)
            {
                check_all_status = 0;
                $(".delete_photo").each(function() {
                    $(this).prop("checked", true);
                    $(this).parent().removeClass("normal");  
                    $(this).parent().addClass("green"); 
                });
            }
            else
            {
                check_all_status = 1;
                $(".delete_photo").each(function() {
                    $(this).prop("checked", false);
                    $(this).parent().removeClass("green");  
                    $(this).parent().addClass("normal"); 
                });           
            }
        });
    // 點選刪除
    $( ".delete_photo_li" ).click(function(e) {
            var chk = $(this).closest("li").find("input:checkbox").get(0);
            if(e.target != chk)
                chk.checked = !chk.checked;
            if(chk.checked)
            {
                $(this).prop("checked", true);
                $(this).removeClass("normal");  
                $(this).addClass("green"); 
            }
            else
            {
                $(this).prop("checked", false);
                $(this).removeClass("green");  
                $(this).addClass("normal");      
            }
        });
        $('#delete_submit').click(function(){
            if(confirm('您確定要刪除勾選項目嗎? 刪除後將無法復原'))
                $('#photo_delete_from').submit();
        });
});