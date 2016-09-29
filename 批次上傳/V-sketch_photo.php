<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div class="content-all">
    <div class="content-title" >
      <div class="content-ti-title">活動相簿</div>
      <div class="clear"></div>
      <div class="search">
        <div style="float:right">
          <button id='album_photo_add'style=" font-size:14px;" >新增照片</button>
          <button id='show_sort_block' style=" font-size:14px;">排序照片</button>
          <button id='sort_submit' style=" font-size:14px;">儲存排序</button>
          <button id='check_all_text' style=" font-size:14px;">全選</button><input type='checkbox' id='check_all' title='全選' style="display: none;">
          <button id='delete_submit' style=" font-size:14px;">刪除</button>
          <button id='show_delete_block' style=" font-size:14px;">刪除照片</button>
          <button id='sort_return_original_block' style=" font-size:14px;">返回相簿</button>
        </div>
      </div>
    </div>
    <div class="content-content">
      <div class="product-table">
        <div class="product-table-all">
        <div id="main_block">
            <div id='photo_block'>
                <ul id="photo_block_ul">      
                    <?foreach ($dbdata as $key => $value):?>
                        <li class="ui-state-default">
                            <img src="<?=substr($value['d_img'],1)?>">
                        </li>
                    <? endforeach;?> 
                </ul>
                <form action='<?=$this->admin_path?>/course/sketch_data_AED' method="post" name='photo_sort_from' id='photo_sort_from'>
                    <ul id="photo_sort_block_ul" style="display: none;">      
                        <?foreach ($dbdata as $key => $value):?>
                            <li class="ui-state-default">
                                <img src="<?=substr($value['d_img'],1)?>">
                                <input type='hidden' name="sort[]" value='<?=$value['d_id']?>'>
                            </li>
                        <? endforeach;?> 
                    </ul>
                    <input type="hidden" name="d_id" value="<?=$SID?>">;
                </form>
                <form action='<?=$this->admin_path?>/course/sketch_data_AED/sketch_photo' method="post" name='photo_delete_from' id='photo_delete_from'>
                    <ul id="photo_delete_block" style="display: none;">      
                        <?foreach ($dbdata as $key => $value):?>
                            <li class="ui-state-default delete_photo_li">
                                <img src="<?=substr($value['d_img'],1)?>">
                                <input type='checkbox' class='delete_photo' name='delete[]' title='全選' value='<?=$value['d_id']?>' style='display: none;'>
                            </li>
                        <? endforeach;?> 
                    </ul>
                    <input type="hidden" name="d_id" value="<?=$SID?>">;
                </form>
                </div>
            </div>         
        </div>
        <div class="clear"></div>
      </div>
    </div>
  </div>
</div>
<script src="/js/myjava/batch_upload.js"></script>
<link href="/js/myjava/batch_upload.css" rel="stylesheet" type="text/css">