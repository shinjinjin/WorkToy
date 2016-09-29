//樹狀圖寫法
function down(&$array,$id){
  $data="";
  $a=$array[$id];
  $down_member="";
  if(!empty($a["iALID"])){
    $down_member.="<li>".$array[$a['iALID']]["sName"];
    $down_member.=$this->down($array,$a["iALID"],$num);
    $down_member.="</li>";
  }
  if(!empty($a["iARID"])){
    $down_member.="<li>".$array[$a['iARID']]["sName"];
    $down_member.=$this->down($array,$a["iARID"],$num);
    $down_member.="</li>";
  }
  if(!empty($down_member)){
    $data.="<ul>";
    $data.=$down_member;
    $data.="</ul>";
  }
  return $data;
}