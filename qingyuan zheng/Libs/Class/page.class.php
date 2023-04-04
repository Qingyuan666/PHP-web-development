<?php

class page_link{
    var $page;//current page；
    var $firstcount; //（the begain item)；
    var $total; //the total page number
    var $displaypg;//every page has how many contents
    var $get_txt; //page index
    var $url;//page ip adress
    var $lastpg;////total page number (the last page index)
    
    function page_link($total,$displaypg=30,$get_txt='page',$url=''){
        $lastpg=ceil($total/$displaypg);
        $this->lastpg=$lastpg;
        $this->page=(intval($_GET[$get_txt])=='')?1:min(intval($_GET[$get_txt]),$lastpg);
        $this->total=$total;
        $this->displaypg=$displaypg;
        $this->get_txt=$get_txt;
        $this->url=($url=='')?$_SERVER["REQUEST_URI"]:$url;
        $this->firstcount=($this->page-1)*$displaypg;
     }
    
    //url check the page 
    function get_new_url(){
        $url=$this->url;
        $parse_url=parse_url($url);
        $url_query=$parse_url["query"]; 
        if($url_query){
            //delet old page index and add new。
            //$url_query=ereg_replace("(^|&)".$this->get_txt."=[0-9]+",'',$url_query); 
			$url_query=preg_replace("(^|&)".$this->get_txt."=[0-9]+",'',$url_query);

            //new substitue old：
            $new_url=str_replace($parse_url["query"],$url_query,$url);
			//$new_url=str_replace("'","",$new_url);

            //
            if($url_query)$new_url.="&".$this->get_txt; else $new_url.=$this->get_txt;
         }else {
            $new_url=$url."?".$this->get_txt;
         }
        return  $new_url;
     }
    
    ////page navigation index：
    function show_link(){
        $pagenav="Total $this->total pages &nbsp;&nbsp;&nbsp; current is <B>".($this->total?($this->firstcount+1):0)."~~".min($this->firstcount+$this->displaypg,$this->total)."</B> page";

        //more than one page：
        if($this->lastpg >1){
            $prepg=$this->page-1; //last page
            $nextpg=($this->page==$this->lastpg ? 0 : $this->page+1); //next page
            $url=$this->get_new_url();
            $pagenav.="<a href='$url=1'>first page</a> ";
            if($prepg) $pagenav.=" <a href='$url=$prepg'>last page</a> "; else $pagenav.=" last page ";
            if($nextpg) $pagenav.=" <a href='$url=$nextpg'>next page</a> "; else $pagenav.=" next page ";
            $pagenav.=" <a href='$url=$this->lastpg'>the end page</a> ";
            //circle out all page：
            $pagenav.="　to <select name='topage' size='1' onchange='javascript:window.location=\"$url=\"+this.value'>\n";
            for($i=1;$i<=$this->lastpg;$i++){
                if($i==$this->page) $pagenav.="<option value='$i' selected>$i</option>\n";
                else $pagenav.="<option value='$i'>$i</option>\n";
             }
            $pagenav.="</select> page，total $this->lastpg pages";
         }

        return $pagenav;
     }
}
?>