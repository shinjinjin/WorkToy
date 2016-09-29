<!doctype html>
<html>
    <head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=1024">

    <!-- seo -->
    <title>相簿照片上傳 - <?=$sys_name?></title>
    <link rel="shortcut icon" href="<?=$web_config['logo']?>" />
    <meta name="keywords"     content=''>
    <meta name="description"  content=''>
    <meta name="author"       content=''>
    <meta name="copyright"    content=''>

    <!-- css -->
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

    <!-- jQuery -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

    <!-- jquery.plupload-->
    <link type="text/css" rel="stylesheet" href="/css/jquery.plupload.queue.css">
    <script type="text/javascript" src="/js/plupload/plupload.full.min.js"></script>
    <script type="text/javascript" src="/js/plupload/jquery.plupload.queue.js"></script>
    <script type="text/javascript" src="/js/plupload/zh_TW.js"></script>
    <script type="text/javascript">
        $(function()
        {
            $('#cancel').click(function(){
                if(confirm('您確定要取消新增嗎?'))
                {
                    window.onbeforeunload=null;
                    window.close();
                    return true;
                }
            });
        });
    </script>

</head>

<body style="overflow: hidden;">

    <form id='form_photo'>
        <div id="main_block">
            <div id="photo_uploader" style="width: 617px; height: 189px;">您的瀏覽器不支援檔案上傳</div>
            <div style="position: relative; top: 73px; left: 122px;">
                <input class="upload_button" type='submit' name='form_submit' value='開始上傳'>
                <input type='button' name='cancel' id='cancel' value='取消'>
            </div>
        </div>
    </form>

</body>
</html>

<script type="text/javascript">

$(function()
{
    $('#form_photo').submit(function(e)
    {
        var photo_uploader = $('#photo_uploader').pluploadQueue();  // 取得上传队列
        if (photo_uploader.files.length == 0)
        {
            alert('您必須至少選擇一個檔案上傳');  
        }
        else
        {  
            if (photo_uploader.files.length > 0)
            {
                photo_uploader.bind('StateChanged', function() {  
                    if (photo_uploader.files.length === (photo_uploader.total.uploaded + photo_uploader.total.failed) ) {
                        alert('新增成功');
                        opener.window.parent.location.reload(); 
                        window.close();
                    }  
                });
                photo_uploader.start();
            }
        }
        return false;  
    });

    $("#photo_uploader").pluploadQueue(
    {
        url : '/upload_photo/photo_upload/<?=$id?>/<?=$dbname?>',
        chunk_size : '1mb',
        unique_names : true,
        dragdrop : false,
        sortable : true,
        filters : {
            max_file_size : '25mb',
            mime_types: [
                {title : "Image files", extensions : "jpg,jpeg,gif,png"}
            ]
        },
        resize : {width : 800, height : 800, quality : 90}
    });

});

</script>


<style type="text/css">
.plupload_button.plupload_start{ display:none; }
#form_photo { margin: 0px auto; }
</style>