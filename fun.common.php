<?php
/**
 * 复选框
 * 
 * @param $array 选项 二维数组
 * @param $id 默认选中值，多个用 '逗号'分割
 * @param $str 属性
 * @param $defaultvalue 是否增加默认值 默认值为 -99
 * @param $width 宽度
 */
function form_checkbox($array = array(), $id = '', $str = '', $defaultvalue = '', $width = 0, $field = '') {
    $string = '<ul class="forms-inline-list"   style="padding-left:5px;">';
    $id = trim($id);
    if($id != '') $id = strpos($id, ',') ? explode(',', $id) : array($id);
    if($defaultvalue) $string .= '<input type="hidden" '.$str.' value="-99">';
    $i = 1;
    foreach($array as $key=>$value) {
        $key = trim($key);
        $checked = ($id && in_array($key, $id)) ? 'checked' : '';
        if($width) $string .= '<label class="ib" style="width:'.$width.'px">';
        $string .= '<li><input type="checkbox" '.$str.' id="'.$field.'_'.$i.'" '.$checked.' value="'.htmlspecialchars($key).'"> '.htmlspecialchars($value) . "</li>&nbsp;&nbsp;";
        if($width) $string .= '</label>';
        $i++;
    }
    $string .= '</ul>';
    return $string;
}
/**
 * 浮点数相加
 * */
function accAdd($arg1, $arg2){
    try{
        $r1 = strlen(strstr($arg1, '.')) -1;
    }catch(Exception $e){
        $r1 = 0;
    }
    try{
        $r2 = strlen(strstr($arg2, '.')) -1;
    }catch(Exception $e){
        $r2 = 0;
    }
    $m = pow(10, max($r1, $r2));
    return ($arg1 * $m + $arg2 * $m)/ $m;
} 
function log_msg($level, $msg, $_threshold = 2) {                                                                                                                                    
    $_levels = array('ERROR' => 1, 'DEBUG' => 2, 'INFO' => 3, 'ALL' => 4);

    $_log_path = '/var/log/cron_sh/';
    if (!is_dir($_log_path) || !is_writable($_log_path)) {
        return FALSE;
    }

    $level = strtoupper($level);

    if ((!isset($_levels[$level]) || ($_levels[$level] > $_threshold))) {
        return FALSE;
    }

    $filename = 'yadie.error_message';
    $filepath = $_log_path . $filename . '.log';
    $message  = '';

    if (!$fp = @fopen($filepath, 'ab')) {
        return FALSE;
    }

    $date = date('Y-m-d H:i:s');

    $message .= $level.' - '.$date.' -- '.$msg."\n";

    flock($fp, LOCK_EX);

    for ($written = 0, $length = strlen($message); $written < $length; $written += $result) {
        if (($result = fwrite($fp, substr($message, $written))) === FALSE) {
            break;
        }
    }

    flock($fp, LOCK_UN);
    fclose($fp);

    return is_int($result);
}
	function p($var)
	{
		echo $var;
	}
	
	function getVar($in)
	{
		$out = '';
		if (isset($_POST[$in])) {
			$out = $_POST[$in];
		} elseif (isset($_GET[$in])) {
			$out = $_GET[$in];
		} else {
			$out = '';
		}
		
		return trim($out);
	}
	
	function valid_is_logined()
	{
//return true;
/**
		if (isset($_SESSION['time_start']) && ((time()-$_SESSION['time_start'])>7200)) {
			//session_destroy();
			return false;
		}
**/ 
		//$str = date("Y-m-d H:i:s")." ".$_SESSION['name']; 
		//file_put_contents('/tmp/session_test.txt', $str."\r\n", FILE_APPEND); 
		if (!isset($_SESSION['name']) || $_SESSION['name']=='') 
		{
			//header("Location: ?c=site&a=login");
			//header("Location: /login.php");
			//session_destroy();
			return false;
		}
		
		if (SITE_IP=='178' && $_SESSION['groups']==2) 
		{ 
			return false;
		}
		
		return true;
	}
	
	function write_file($file, $data)
	{
		file_put_contents($file,  $data, FILE_APPEND);
	}
	
	function utf2gb($utf8){
		return iconv("UTF-8","GB2312//IGNORE",$utf8);
	}
	
	function utf2gbk($utf8){
		return iconv("UTF-8","GBK//IGNORE",$utf8);
	}

	function gb2utf($utf8){
		return iconv("GB2312","UTF-8//IGNORE", $utf8);
	}
	
	function gbk2utf($utf8){
		return iconv("GBK","UTF-8//IGNORE", $utf8);
	}
	
	function utf2gb_recursive($string) {
		if(is_array($string)) {
			foreach($string as $key => $value) {
				$string[$key] = utf2gb_recursive($value);
			}
		} else {
			$string = utf2gb($string);
		}
		return $string;
	}
	
	function utf2gbk_recursive($string) {
		if(is_array($string)) {
			foreach($string as $key => $value) {
				$string[$key] = utf2gbk_recursive($value);
			}
		} else {
			$string = utf2gbk($string);
		}
		return $string;
	}
	
	function gb2utf_recursive($string){
		if(is_array($string)) {
			foreach($string as $key => $value) {
				$string[$key] = gb2utf_recursive($value);
			}
		} else {
			$string = gb2utf($string);
		}
		return $string;
	}
	
	function gbk2utf_recursive($string){
		if(is_array($string)) {
			foreach($string as $key => $value) {
				$string[$key] = gbk2utf_recursive($value);
			}
		} else {
			$string = gbk2utf($string);
		}
		return $string;
	}
	
	function url_path($url)
	{
		$arr = parse_url($url);
		if (isset($arr['path'])) return $arr['path'];
		else return '';
	}

	
	function jsAlert($str) {                               
		echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
		echo "<script>alert('$str')</script>"; 
	}

	
	function jsLocation($url)                                                                                                                                                                         
    {                                                                                                                                                                                                 
		echo "<script>location.href='$url'</script>";                                                                                                                                                       
        exit;
	}
	
	function get_session($key)
	{
		return isset($_SESSION[$key])? $_SESSION[$key]: '';
	}
	
	function set_session($key, $val)
	{
		$_SESSION[$key] = $val;
	}
	
	function imei_replace($string,$length=15,$etc='...'){        		

		//$string = html_entity_decode(trim(strip_tags($string)),ENT_QUOTES,'UTF-8');             
		$strlen = strlen(trim($string));
		if ($strlen>15) {
			$string = substr($string, 0, 15)."...";	
		}
		
		return $string;
	}
	
	function mystrcut($string,$length=20,$etc='...'){
         $result= '';
         $string = html_entity_decode(trim(strip_tags($string)),ENT_QUOTES,'UTF-8');     
         $strlen = strlen($string);   

         for($i=0; (($i<$strlen)&& ($length> 0));$i++){   
             $number=strpos(str_pad(decbin(ord(substr($string,$i,1))), 8, '0', STR_PAD_LEFT), '0');
             if($number){   
                if($length   <   1.0) {   
                    break;   
                }   
                  $result   .=   substr($string, $i, $number);   
                   $length   -=   1.0;   
                $i   +=   $number   -   1;   
            }else{
                $result   .=   substr($string, $i, 1);   
                $length   -=   0.5;
            }   
         }   

         $result = htmlspecialchars($result, ENT_QUOTES, 'UTF-8');   

         if($i<$strlen){   
            $result   .=   $etc;   
         }   
        return   $result;   
    }
	

	function show_message($msg, $__arr='')
	{
		include_once(R_CLASS_ROOT.'/html.error.php');
		exit;
	}
	
	function show_message_exit($msg, $__arr='')
	{
		include_once(R_CLASS_ROOT.'/html.error.php');
		exit;
	}

	function latin2utf($str)
	{
		if (empty($str)) return $str;
		$str_ren = @iconv('utf-8', 'latin1', $str);
		$str_re_tran = @iconv('gbk', 'utf-8', $str_ren);
		return $str_re_tran;		
	}

	function latin2utf2($str)
	{
		if (empty($str)) return $str;
		$str_re_tran = @iconv('gbk', 'utf-8', $str);
		return $str_re_tran;		
	}
	
	function utf2latin($str)
	{
		if (empty($str)) return $str;
		$str = iconv('utf-8', 'gbk', $str);
		$str = iconv('latin1', 'utf-8', $str);
		
		return $str;
	}
	
	function textarea_to_phpfile($new_file, $content) {
		
		// $content = strip_tags($content);
		$content = preg_replace("/(&nbsp;)/i", " ", $content);	// 空格
		$content = preg_replace("/(&lt;)/i",   "<", $content);	// <
		$content = preg_replace("/(&gt;)/i",   ">", $content);	// >
		$content = preg_replace("/(&amp;)/i",  "&", $content);	// &
		$content = preg_replace("/@小于@/",    "&lt;", $content);	// 
		$content = preg_replace("/@大于@/",    "&gt;", $content);	// 
		/**
		if (preg_match("/\.html?$/i", $new_file)) {    // 是html文件
			$tmpfname = tempnam(R_ROOT."/tmp", "tmp_");
			file_put_contents($tmpfname, $content);
	    } else {    // 不处理
	        ;
	    }
		**/
		file_put_contents($new_file, $content);
		return true;
	}

	
	class nImage {
		public function imgsize2($s_file)
		{
			list($width, $height) = getimagesize($s_file);
			return $width."x".$height;
		}
	
		public function imgsize($s_file)
		{
			$pattern = "/.(jpg|jpeg|png)/i";
			$type = '';
			if (preg_match($pattern, $s_file, $match))
			{
				$type = strtolower($match[1]);
			}
			
			$im = '';
			if ($type=='jpg'||$type=='jpeg') {
				if (PRODUCT_MODEL) {
				    $im = imagecreatefromjpeg($s_file);
				} 
			} else if ($type=='png') {
				$im = imagecreatefrompng($s_file);
			} else {
				$im = '';
			}
			
			if ($im) {
				$pic_width = imagesx($im);
				$pic_height = imagesy($im);
				return $pic_width.'x'.$pic_height;
			} else {
				return false;
			}
		}
		
		
		public function resize_new($s_file,$maxwidth,$maxheight,$n_file) 
		{
			@unlink($n_file);
			$base_image = imagecreatetruecolor($maxwidth, $maxheight);
		
			if (!($im = imagecreatefrompng($s_file))) {			
				$im = imagecreatefromjpeg($s_file);
			}
			
			$newwidth = $maxwidth;
			$newheight= $maxheight;
			imagecopy($base_image, $im, 0, 0, 0, 0, $maxwidth, $maxheight);
				
			if (preg_match("/png/i", $s_file)) {
				imagepng($base_image, $n_file);
			} else {
				imagejpeg($base_image, $n_file);
			}
			
			//imagedestroy($im);
			//imagedestroy($base_img);
		}
		
		public function resize($s_file,$maxwidth,$maxheight,$n_file) 
		{
			@unlink($n_file);
			if (!($im = @imagecreatefromjpeg($s_file))) {
				$im = @imagecreatefrompng($s_file); /* Attempt to open */
			} 
			
			$pic_width = imagesx($im);
			$pic_height = imagesy($im);
			
			// 尺寸一样大就不要再处理了，小伙留些精力吧
			/***
			if ($pic_width==$maxwidth && $pic_height==$maxheight) {
				return true; 
			}
			***/
			$newwidth = $maxwidth;
			$newheight= $maxheight;
			
			if(function_exists("imagecopyresampled"))
			{
				$newim = imagecreatetruecolor($newwidth,$newheight);
			    @imagecopyresampled($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);
				//$newim = imagecreate($newwidth,$newheight);
			    //imagecopyresized($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);
			}
			else
			{
				//$newim = imagecreate($newwidth,$newheight);
				//$newim = imagecreatetruecolor($newwidth,$newheight);
			   @imagecopyresampled($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);
			   imagecopyresized($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);
			}
			
			if (!($ret = imagejpeg($newim, $n_file, 30))) {
				$ret = imagepng($newim, $n_file, 30);
            }
			imagedestroy($newim);
			if ($ret) return true;
			else return false;
		}
		
		public function resize_70x37($s_file, $n_file) {
			return nImage::resize($s_file, "70", "37", $n_file);
		}
		
		public function imagefilter($s_file, $n_file) {
		
			@unlink($n_file);
			if (!($im = @imagecreatefrompng($s_file))) {
				$im = @imagecreatefromjpeg($s_file);
			}
			
			if ($im && imagefilter($im, IMG_FILTER_GRAYSCALE)) 
			{
            	if (!($ret = imagepng($im, $n_file))) {
                	$ret = imagejpeg($im, $n_file);
            	}
			}
			imagedestroy($im);
		}
		
		public function resize_180x64($s_file, $n_file) {
			return nImage::resize($s_file, "180", "64", $n_file);
		}
		
		public function new_resize($source_file,$size,$new_file)
		{
			$cmd = "convert '$source_file' -resize '$size'  '$new_file'";
			@exec($cmd);
		}
	}
	
	
	function get_pinpai_list()
	{
		$type_id = ID_DOWN_PINPAI;
		$status  = STATUS_USING;
		$sql = "select * from menus where type_id='$type_id' and status='$status'";
		$list = mdb_query("dt_ime_shouji_dictdata", $sql);
		return $list;
	}
	
	function SafeHtml($msg = ""){
		$msg = str_replace('&amp;','&',$msg);
		$msg = str_replace('&nbsp;',' ',$msg);
		$msg = str_replace("'","&#39;",$msg);
		return $msg;
	}

	function get_chkpass_new_old($val, $init=1)
	{
		if ($init==0) {
			return "<span class='label label-kaqi'>更新中</span>";
		}
		
		if ($val==R_CHKPASS_OK) {
			return "<span class='label label-green'>已通过</span>";
		} elseif ($val==R_CHKPASS_NO) {
			return "<span class='label label-red'>禁通过</span>";
		} elseif ($val==R_CHKPASS_UN) {
			return "<span class='label label-yellow'>待审核</span>";
		} elseif ($val==R_CHKPASS_DE) {
			return "<span class='pass_status pass_de'>已删除</span>";
		} elseif ($val==9) {	
			return "<span class='label label-black'>仅测试</span>";
		} else {
			return "<span class='label label-red'>未知包</span>";
		}
	}
	
	function get_chkpass_new($val, $init=1)
	{
		$string = '';
		if ($val==R_CHKPASS_OK) {
			$string .= "<span class='label label-green'>已通过</span>";
		} elseif ($val==R_CHKPASS_NO) {
			$string .= "<span class='label label-red'>禁通过</span>";
		} elseif ($val==R_CHKPASS_UN) {
			$string .= "<span class='label label-yellow'>待审核</span>";
		} elseif ($val==R_CHKPASS_DE) {
			$string .= "<span class='pass_status pass_de'>已删除</span>";
		} elseif ($val==9) {	
			$string .= "<span class='label label-black'>仅测试</span>";
		} elseif ($val == -1) {
		} else {
			$string .= "<span class='label label-red'>未知包</span>";
		}
		
		if ($init == -1) {
		} elseif($init == 0) {
			$string .= (empty($string)?'':'<br/>')."<span class='label label-kaqi'>更新中</span>";
		} else {
			$string .= (empty($string)?'':'<br/>')."<span class='label label-green'>已更新</span>";
		}
		
		return $string;
	}
	
	function get_chkpass_new_kill($killed,$val, $init=1)
	{
		$string = '';
		if ($killed==0){
			$string .= (empty($string)?'':'<br/>')."<span class='label label-green'>未删除</span>";
		} elseif ($killed==1) {
			$string .= (empty($string)?'':'<br/>')."<span class='label label-red'>已删除</span>";
		}		
		
		if ($val==R_CHKPASS_OK) {
			$string .= (empty($string)?'':'<br/>')."<span class='label label-green'>已通过</span>";
		} elseif ($val==R_CHKPASS_NO) {
			$string .= (empty($string)?'':'<br/>')."<span class='label label-red'>禁通过</span>";
		} elseif ($val==R_CHKPASS_UN) {
			$string .= (empty($string)?'':'<br/>')."<span class='label label-yellow'>待审核</span>";
		} elseif ($val==R_CHKPASS_DE) {
			$string .= (empty($string)?'':'<br/>')."<span class='pass_status pass_de'>已删除</span>";
		} elseif ($val==9) {	
			$string .= (empty($string)?'':'<br/>')."<span class='label label-black'>仅测试</span>";
		} elseif ($val == -1) {
		} else {
			$string .= (empty($string)?'':'<br/>')."<span class='label label-red'>未知包</span>";
		}
		
		if ($init == -1) {
		} elseif($init == 0) {
			$string .= (empty($string)?'':'<br/>')."<span class='label label-kaqi'>更新中</span>";
		} else {
			$string .= (empty($string)?'':'<br/>')."<span class='label label-green'>已更新</span>";
		}
		
		return $string;
	}
	
	function get_chkpass_opensogou($val)
	{
		$string = '';
		if ($val==1) {
			$string .= "<span class='label label-green'>已通过</span>";
		} elseif ($val==2) {
			$string .= "<span class='label label-yellow'>待审核</span>";
		} elseif ($val==3) {
			$string .= "<span class='label label-red'>未通过</span>";
		} elseif ($val==4) {
			$string .= "<span class='pass_status pass_de'>未提交</span>";
		} elseif ($val==5) {	
			$string .= "<span class='label label-black'>审核变更</span>";
		} else {
			$string .= "<span class='label label-red'>未知态</span>";
		}
		
		return $string;
	}

    function render_feedback_state($val)
    {
        $string = '';
        if ($val==1) {
            $string .= "<span class='label label-green'>待收录</span>";
        } elseif ($val==2) {
            $string .= "<span class='label label-yellow'>已收录</span>";
        } else {
            $string .= "<span class='label label-red'>未知态</span>";
        }
        return $string;
    }	
	
	function get_chk_ios8($val)
	{
		if ($val==1) {
			return "<span class='ios8_status ios8_status_yes'>ios8</span>";
		} else {
			return "<span class='ios8_status ios8_status_no'></span>";
		}
	}
	
	function get_status($val)
	{
		if ($val==STATUS_USING||$val==STATUS_ON) {
			return "<span class='tr_status_on'>使用中</span>";
		} else {
			return "<span class='tr_status_of'>&nbsp;</span>";
		}
	}
	
	function get_platform_list()
	{
		$platform_list = mdb_query('dt_ime_shouji_skinsdata', "select * from skin_platform_types");
		return $platform_list;
	}
	
	function my_debug($var)
	{
		if (getVar('debug')) var_dump($var);
	}


	function microtime_float()
	{
	    list($usec, $sec) = explode(" ", microtime());
	    return ((float)$usec + (float)$sec);
	}
	
	function microtime_float_new()
	{
		list($usec, $sec) = explode(" ", microtime());
		return date("YmdHis").substr($usec, strrpos($usec, ".")+1);	
	}
	
	function microtime_day()
	{
	    return strtotime(date("Y-m-d")." 00:00:01")."000";	    
	}

	// 递归建立目录 
	function mkdir_recursive($pathname, $mode=0755)
	{
    	is_dir(dirname($pathname)) || mkdir_recursive(dirname($pathname), $mode);
    	return is_dir($pathname) || @mkdir($pathname, $mode);
	}
	
	function page_offline() 
	{
		//exit('抱歉该页面暂不能使用！');
		echo "<script language='javascript'>window.parent.location.reload()</script>"; exit('ok');
	}
	
	function PHP_slashes($string,$type='add')
	 {
		 if ($type == 'add')
		 {
			 if (get_magic_quotes_gpc())
			 {
				 return $string;
			 }
			 else
			 {
				 if (function_exists('addslashes'))
				 {
					 return addslashes($string);
				 }
				 else
				 {
					 return mysql_real_escape_string($string);
				 }
			 }
		 }
		 else if ($type == 'strip')
		 {
			 return stripslashes($string);
		 }
		 else
		 {
			//die('error in PHP_slashes (mixed,add | strip)');
			 return $string;
		 }
	 }
	
	function xml_filter($content)
	{
	    $content = preg_replace("/&/", "&amp;", $content);
	    $content = preg_replace("/</", "&lt;", $content);
	    $content = preg_replace("/>/", "&gt;", $content);
	    $content = preg_replace("/\"/","&quot;", $content);
	    $content = preg_replace("/\'/","&apos;", $content);
	    return $content;
	}
	
	function xml_filter_new($content)
	{
		if (preg_match("/&/i", $content) && !preg_match("/&amp;/i", $content)) { 
		//if (preg_match("/&/i", $content) && !preg_match("/&amp;/i", $content) && !preg_match("/#x0D;#x0A;/i", $content)) {
			$content = preg_replace("/&/i",  "&amp;", $content);
		}
		
	    $content = preg_replace("/</", "&lt;", $content);
	    $content = preg_replace("/>/", "&gt;", $content);
	    $content = preg_replace("/\"/","&quot;", $content);
	    $content = preg_replace("/\'/","&apos;", $content);
	    return trim($content);
	}

	function xml_filter_latest($content)
	{
		if (preg_match("/&/i", $content) && !preg_match("/&amp;/i", $content) && !preg_match("/&#x0D;&#x0A;/i", $content)) {
			$content = preg_replace("/&/i",  "&amp;", $content);
		}
		
	    $content = preg_replace("/</", "&lt;", $content);
	    $content = preg_replace("/>/", "&gt;", $content);
	    $content = preg_replace("/\"/","&quot;", $content);
	    $content = preg_replace("/\'/","&apos;", $content);
		
		$content = preg_replace("/#LINE#/i", "&#x000D;&#x000A;", $content); 
		
		$content = preg_replace("/#hyphen#/i", "\n", $content); 
		
	    return trim($content);
	}
	
	function filter_json($content)
	{
		$content = preg_replace("/%2B/i",  "+", $content);
		$content = preg_replace("/%26/i",  "&", $content);
		$content = preg_replace('/,\s*([\]|}])/m', '$1', $content);
		
		// 把&换成&amp;
		if (preg_match("/&/i", $content) && !preg_match("/&amp;/i", $content)) {
			$content = preg_replace("/&/i",  "&amp;", $content);
		}
		return $content;
	}
		
function is_in_remove_catid($catid)
{
    $del_catid_arr = array("8", "9", "11", "12", "16", "22", "41", "42");
    return in_array($catid, $del_catid_arr);
}

function remove_quot($str)
{
	return preg_replace("/\"/", "&quot;", $str);
}

function send_me_sms($msg)
{
    if (PRODUCT_MODEL) {
	    $desc = date("Y-m-d_H-i-s")."_".$msg;
        //$cmd= "curl -G -d number=18910872697 -d desc=".$desc." http://portal.sys.sogou/portal/mobile/smsproxy.php";
    	//@exec($cmd);
	}
}

function get_new_f($url, $field='f'){
    return (preg_match("/.*?".$field."=(.*?)(&|&.*)?$/i", $url, $match))? $match[1]: '';
}
 
function fr($val){
    return "<![CDATA[".$val."]]>";
}


function gen_pic($f_new, $arr)
{
	$f_bg = R_ROOT."/images/pure_bg3_new.png";	
	$len = count($arr);
	
	$bg_info  = getimagesize($f_bg);
	$fr_info = getimagesize($arr[0]);
	
	//$base_image = imagecreatetruecolor($bg_info[0], $bg_info[1]); // 大小 
	$base_image = imagecreatefrompng($f_bg);
	imagesavealpha($base_image, true);

	if (!($re_bg = imagecreatefrompng($f_bg))) {
		$re_bg  = imagecreatefromjpeg($f_bg);
	}
	
	$x1 = ($bg_info[0]-3*$fr_info[0])/4;
	$w = $fr_info[0];
	
	$y1 = ($bg_info[1]-2*$fr_info[1])/3;
	$h = $fr_info[1];
	
	// merge images
	//imagecopy($base_image, $re_bg, 0, 0, 0, 0, $bg_info[0], $bg_info[1]);		
	$XW = 40;
	$YH = 40;
	//$XW = 0;
	//$YH = 0;
	
	for ($i=0; $i<$len; $i++)
	{
		if ($i>6) break;
		$tmp_re = imagecreatefrompng($arr[$i]);
		
		if ($i<3){
			$xdif= $i==0? -$XW: ($i==2?$XW:0);
			$ydif= -$YH;
			
			imagecopy($base_image, $tmp_re, round($x1*($i+1)+$w*$i)+$xdif, round($y1)+$ydif, 0, 0, $fr_info[0], $fr_info[1]);
			
		} else {
			$xdif= $i==3? -$XW: ($i==5?$XW:0);
			$ydif= 0;
			
			$j = $i-3;
			imagecopy($base_image, $tmp_re, round($x1*($j+1)+$w*$j)+$xdif, round($y1*2+$h)+$ydif, 0, 0, $fr_info[0], $fr_info[1]);
		}
	}
	
	imagepng($base_image, $f_new);
	imagedestroy($base_image); 
	imagedestroy($re_bg); 		
}


function urlcheck($url)
{
	$array = get_headers($url,1); 	
	//var_dump($array);
	
	if(preg_match('/http.*?(200|302|301)/i',$array[0])){ 
		return true;
	}else{ 
		return false;
	} 
}

function urlcheck2($url, &$array)
{
	$array = get_headers($url,1); 	
	//var_dump($array);
	
	if(preg_match('/http.*?(200|302|301)/i',$array[0])){ 
		return true;
	}else{ 
		return false;
	} 
}

function get_urlapp_size($url)
{
	$array = get_headers($url,1); 	
	//var_dump($array);	
	
	if(preg_match('/http.*?(200|304)/i',$array[0])){ 
		$arr = get_headers($url,1); 	
		return $arr['Content-Length'];
		
	}else{ 
		return 0;
	} 
}


function get_cdn_size($url)
{
	$icon_file = R_CDN_ROOT."/".substr($url,12);
	var_dump($icon_file);exit;
	$size = filesize($icon_file);
	return round($size/1000);
}

function get_cdn_img_size($icon_url)
{
	//$icon_url= "http://wap.dl.pinyin.sogou.com/wapdl/img/201308/20130802/2013080214331006060800.jpg";
	$icon_file = R_ROOT.'/data/keyupdate/'. substr($icon_url, strpos($icon_url, "img"));
	$size = filesize($icon_file);	
	return $size;
}

function get_img_size($file)
{
	$cmd = "identify $file";
	@exec($cmd,$out);
	$arr = @explode(" ", $out[0]);
	$wb_img_size = $arr[2];	
	return $wb_img_size;
}


function get_user_groups($k='')
{
	$arr = array();
	$arr['0']  = '管理';
	$arr['1']  = '测试';
	$arr['2']  = '客服';
	$arr['3']  = '产品';
	$arr['20'] = '指定';
	if ($k) return $arr[$k];
	return $arr;
}

function get_extend($file_name)
{
	$pos = strrpos($file_name, ".");
	return substr($file_name, $pos);
	
	//$extend =explode("." , $file_name);
	//$va=count($extend)-1;
	//return $extend[$va];
}

function get_extend_nodot($file_name)
{
	$pos = strrpos($file_name, ".");
	return substr($file_name, $pos+1);
	
	//$extend =explode("." , $file_name);
	//$va=count($extend)-1;
	//return $extend[$va];
}

function get_apk_from_url_old($url)
{
	$url = substr($url, strpos($url, "wapdl"));
	$url = substr($url, 0, strpos($url, ".apk")+4);

	$file = '/search/web/'.$url;
	if (!file_exists($file)) return false; 
	
	$p= new ApkParser();
	$res=$p->open('/search/web/'.$url);
	$xml = $p->getXML();
	$arr = xml2array($xml); // 可能存在错误 
	$a = $arr['manifest_attr'];
	return $a;
}


function get_apk_from_url($url)
{
	$url = substr($url, strpos($url, "wapdl"));
	$url = substr($url, 0, strpos($url, ".apk")+4);

	$file = '/search/web/'.$url;
	if (!file_exists($file)) return false; 
	
	$p= new ApkParser();
	$res=$p->open('/search/web/'.$url);
	$xml = $p->getXML();
	
	$xml = preg_replace("/\r|\n/", "", $xml);
	//preg_match("/manifest.*?android:versionCode.*?=[\"\'](.*?)[\"\'].*\>/i",$xml, $arr_version_code);
	//preg_match("/manifest.*?android:versionName.*?=[\"\'](.*?)[\"\'].*\>/i",$xml, $arr_version_name);
	//preg_match("/manifest.*?package.*?=[\"\'](.*?)[\"\'].*\>/i",$xml, $arr_package_name);
	
	preg_match("/manifest.*?versionCode.*?=[\"\'](.*?)[\"\'].*\>/i",$xml, $arr_version_code);
	preg_match("/manifest.*?versionName.*?=[\"\'](.*?)[\"\'].*\>/i",$xml, $arr_version_name);
	preg_match("/manifest.*?package.*?=[\"\'](.*?)[\"\'].*\>/i",$xml, $arr_package_name);
	
	$arr = array();
	$arr['package'] = strtolower($arr_package_name[1]);
	$arr['android:versionName'] = $arr_version_name[1];
	$arr['android:versionCode'] = $arr_version_code[1];
	
	if (empty($arr['android:versionCode'])) { 
		show_message("<font color='red'> $url 的version_code为空！</font>"); 
		exit;
	}	
	
	return $arr;
}

function get_filename_from_url($url){
	$path_url = parse_url($url);
	return basename($path_url['path']);
}

function resizeimage($image,$w,$h,$file=false, $default=50)
{
	$info=getimagesize($image);
	$ow=$info[0];
	$oh=$info[1];
	$mime=$info['mime'];
	$mime=explode('/',$mime);
	$type=$mime[1];
	if($type=='vnd.wap.wbmp'){$type='xbmp';}
	$createfunc='imagecreatefrom'.$type;
	$imagefunc='image'.$type;
	if(!function_exists($createfunc) || !function_exists($imagefunc))
	{
		die('Not support the file format');
	}
	$op=$ow/$oh;
	$p=$w/$h;
	if($p>=$op)
	{
		$w=$op*$h;
	}else{
		$h=$w/$op;
	}
	
	$thumb = imagecreatetruecolor($w, $h);
	$source = $createfunc($image);
	imagesavealpha($source,true);
	imagealphablending($thumb,false);
	imagesavealpha($thumb,true);
	imagecopyresampled($thumb, $source, 0, 0, 0, 0, $w, $h, $ow, $oh);
	
	if($file)
	{
		if ($type=='jpg'||$type=='jpeg') {
			$imagefunc($thumb,$file,$default);
		}else {
			$imagefunc($thumb,$file);
		}
	}else{
		header('Content-type: image/'.$type);
		$imagefunc($thumb);
	}
	
	imagedestroy($source);
	imagedestroy($thumb);
}

function get_appid_from_zhushou($package_name) // 凌哲接口 
{
	if (!$package_name) return "-1";
	//$url = "http://10.143.56.184/jsp/util/queryPackage_name.jsp?package_name=".$package_name;
	$url = "http://10.11.203.99/jsp/util/queryPackage_name.jsp?package_name=".$package_name;
	
	$appid = preg_replace("/\<|\>|p|\/|\s/","",trim(file_get_contents($url)));
	$appid = round($appid);	
	//return "-1"; 
	return $appid ? $appid : "-1";
}

function get_appid_from_api_zhushou($pkg_name) // 蔡雨晨接口
{
    $pkg_name = trim($pkg_name);
	if (!$pkg_name) return false;
	
	$url = "http://api.zhushou.sogou.com/android/inputmethod.html?action=getappid&pk=$pkg_name";
    $contents = file_get_contents($url);
    $json = json_decode($contents, true);
    $new = array();
    foreach ($json as $v)
    {
        $key = key($v);
        $new[$key] =$v[$key];
    }
	
    return $new;
}

function get_appid_from_api_zhushou_one($pkg_name)
{
    $url = "http://api.zhushou.sogou.com/android/inputmethod.html?action=getappid&pk=$pkg_name";
    $contents = file_get_contents($url);
    $json = json_decode($contents, true);
	$appid = isset($json[$pkg_name])? $json[$pkg_name] : '-1';
    //$appid = (isset($json[0]) && isset($json[0][$pkg_name]))? $json[0][$pkg_name] : '-1';
    return $appid;
}

function get_row_from_json($app_list, $field, $find)
{
	$got = "";
	if ($field=='index') {
		foreach ($app_list as $k=>$v) {
			if ($k==$find) {
				$got = $v; 
				break;
			}
		}
	
	} else {
		foreach ($app_list as $v) {
			if ($v[$field]==$find) {
				$got = $v; 
				break;
			}
		}
	}
	
	return $got; 
}

function push_mail($title, $content,$addr='') {
	$url = "http://10.12.136.222/mail/push_mail.php?title=".$title."&content=".$content;
	@exec("wget '$url'");
}

function filter_xml_special_char($content) {
	$content = preg_replace("/sogou_switch_on/i",  "1", $content);
	$content = preg_replace("/sogou_switch_off/i",  "0", $content);
	
	if (preg_match("/&amp;/i", $content)) {
		$content = preg_replace("/&amp;/i",  "&", $content);
		return filter_xml_special_char($content);
	}
	
	if (preg_match("/&&/i", $content)) {
		$content = preg_replace("/&&/i",  "&", $content);
		return filter_xml_special_char($content);
	}
	
	//$content = preg_replace("/&&/i","&", $content);
	$content = preg_replace("/&/i",  "&amp;", $content);
	return $content;
}

function filter_before_save($content) {
	$content = preg_replace("/%2B/i",  "+", $content);
	$content = preg_replace("/%26/i",  "&", $content);
	$content = preg_replace('/,\s*([\]|}])/m', '$1', $content);
	$content = recursive_replace_chart($content);
	$content = preg_replace("/&&+/i",  "&", $content);
	return $content;
}

function recursive_replace_chart($content) {
	if (preg_match("/&amp;/i", $content)) {
		$content = preg_replace("/&amp;/i",  "&", $content);
		return recursive_replace_chart($content);
	}
	return $content;
}

function filter_before_decode($content) {
	$content = preg_replace("/sogou_switch_on/i",  "1", $content);
	$content = preg_replace("/sogou_switch_off/i",  "0", $content);
	
	$content = preg_replace("/&/i",  "&amp;", $content);
	
	$content = preg_replace("/#LINE#/i", "&#x000D;&#x000A;", $content);
    $content = preg_replace("/#hyphen#/i", "\n", $content);
	
	return $content;
}


function check_xml_syntax($method_name, $xml) {
	$xmlObj = @simplexml_load_string($xml);
	if ($xmlObj==false) { 
		show_message("<font color='red'>保存失败，error：".$method_name."</font>");
		exit; 
	}
}

/**	功能 写文件
 *	@param $filename String 文件路径(含文件名)
 *	@param $content String 写入的内容
 *	@param $add Boolean 追加还是覆盖 缺省为false [true:追加, false:覆盖]
 *	@return Integer/Boolean 成功则返回写入内容的字符数 失败返回false
 */
function swritefile($filename,$content,$add = false) {
	$return = false;
	@clearstatcache();//清除文件系统缓存
	if(file_exists($filename)) {
		if(!is_writable($filename)) {//不可写
			@clearstatcache();
			$waitng = 0;//等待次数
			while(!is_writable($filename) && $waitng < 100){
				@clearstatcache();
				$waitng++;
				usleep(10000 + intval(random(3,1)));//等待一个随机时间9500~10500us约10ms
			}
			@clearstatcache();
			if(!is_writable($filename))
				return false;
		}
		if(!$handle = @fopen($filename,$add ? "ab+" : "wb+"))
			return false;
		if(@flock($handle, LOCK_EX)){//锁定(独占锁)
			$return = @fwrite($handle,$content,strlen($content));
			@flock($handle, LOCK_UN);
		}else{
			return false;
		}
		fclose($handle);
	} else {
		if(!$handle = @fopen($filename,$add ? "ab+" : "wb+"))
			return false;
		$return = @fwrite($handle,$content,strlen($content));
		fclose($handle);
	}
	return $return;
}

/**	功能 生成随机字符串
 *	@param $length Integer 生成的随机串的字符长度
 *	@param $numeric Boolean 是否纯数字串 缺省为false [true:是, false:否]
 *	@return String
 */
function random($length, $numeric = false) {
	$seed = base_convert(md5(microtime().$_SERVER['DOCUMENT_ROOT']), 16, $numeric ? 10 : 35);
	$seed = $numeric ? (str_replace('0', '', $seed).'012340567890') : ($seed.'zZ'.strtoupper($seed));
	$hash = '';
	$max = strlen($seed) - 1;
	for($i = 0; $i < $length; $i++) {
		$hash .= $seed{mt_rand(0, $max)};
	}
	return $hash;
}

//是否ajax请求
function isajax() {
	if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
		if('xmlhttprequest' == strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])){
			return true;
		}
    }
	if(!empty($_POST['inajax']) || !empty($_GET['inajax']))
		// 判断Ajax方式提交
		return true;
	return false;
}

/**
 *	功能 比较 check_array(待检查数组) 与 sample_array(样品数组)的key的差异(仅比较key,不比较key值)
 *		 当sample_array中存在的key在check_array中不存在时，该key会加入到返回Array中
 *	@param $sample_array Array 样品数组
 *	@param $check_array Array 待检查数组
 *	@param $keystr String key深度累积串
 *	@return Array array() / array('[key1]', '[key2][key3]', ...)
 */
function diff_array_keys($sample_array, $check_array, $keystr = '') {
	$ret = array();
	if(!is_array($sample_array)) {
		return $ret;
	}
	
	if(!is_array($check_array)) {
		foreach($sample_array as $key => $value) {
			$ret[] = $keystr . '[' . $key .']';
		}
	} else {
		$length = count($sample_array);
		foreach ($sample_array as $key => $value) {
			if (!isset($check_array[$key])) {
				$ret[] = $keystr . '[' . $key .']';
				continue;
			} else {
				$ret = array_merge($ret, diff_array_keys($sample_array[$key], $check_array[$key], $keystr.'['.$key.']'));
			}
		}
	}
	
	return $ret;
}


// 例子 
// $xml = simplexml_load_file(R_ROOT."/tmp/yanwenzi.xml", 'SimpleXMLElement', LIBXML_NOCDATA );//兼容CDATA格式
// $arr = xmltoarray($xml);
function xmltoarray($object, &$tmparr=array()) {
    if (is_object($object)) {
        $tmparr = get_object_vars($object);
    }
    foreach ($tmparr as $k => $v) {
        if (is_array($v)) {
            $tmparr[$k] = xmltoarray($v, $tmparr[$k]);
        } elseif (is_object($v)) {
            $tmparr[$k] = xmltoarray($v, $tmparr[$k]);
        } else {
            $tmparr[$k] = $v;
        }
    }
    return $tmparr;
}


function gen_shanci($dict_id)
{
	$sql = "select * from  celldict_word  where is_del='0' and dict_id='$dict_id' and action=1 order by id desc"; 
	$list = mdb_query_latin("sogou_shouji", $sql);
	$file =  "/search/celldict_files/scdmkr_py/shancibiao.txt";
	file_put_contents($file, "");

	foreach ($list as $v)
	{
		file_put_contents($file, $v['entry']."\r\n", FILE_APPEND);
	}
}


function getQueryString($url, $name) {
    preg_match("/".$name."=(.*?)(&|$)/i", $url, $match);
	return $match[1];
}


function urlencode_sogou_search_keyword($url)
{
	if(strpos($url,"wap.sogou.com/web") >0  || strpos($url,"m.sogou.com/web") >0){
		$word = getQueryString($url,"keyword");
		$word = trim($word,"&");
		$gbk_word = iconv('UTF-8', 'GBK', $word); 
		//$word = substr($url,strpos($url,"keyword=")+8);		
		$url = substr($url,0,strpos($url,"keyword=")+8).urlencode($word);		
	}
	
	return $url;

}


function get_check_hdimg($img_src)
{
	$ret = preg_match("/(^\d{6})(\d{2})hdimg\d\d\.(jpg|jpeg|gif|png)/i", $img_src, $match);
	if ($ret) {
		$yyyymm = $match[1];
		$dd = $match[2];
		//$img_src = "http://wap.dl.pinyin.sogou.com/wapdl/hole/".$yyyymm."/".$dd."/".$img_src;
		$img_src = "http://img.shouji.sogou.com/wapdl/hole/".$yyyymm."/".$dd."/".$img_src;
	}
	
	return $img_src;
}

function process_hdimg($content)
{
	//$content = preg_replace("/(\"|\')((\d{6})(\d{2})(hdimg(\d{2}).(jpg|jpeg|gif|png)))/i", "\\1http://wap.dl.pinyin.sogou.com/wapdl/hole/\\3/\\4/\\2", $content);
	$content = preg_replace("/(\"|\')((\d{6})(\d{2})(hdimg(\d{2}).(jpg|jpeg|gif|png)))/i", "\\1http://img.shouji.sogou.com/wapdl/hole/\\3/\\4/\\2", $content);
	return $content;
}

function convert_png2jpg($file_png)
{
	$exif_type=exif_imagetype($file_png);	
	if ($exif_type==3) {
		$file_png_tmp = str_replace(".png", ".jpg", $file_png);
		$cmd = "convert '$file_png' '$file_png_tmp'";
		@exec($cmd);
		@unlink($file_png);
		$file_png = $file_png_tmp;
	}
	
	$file_png_new   = str_replace(".png", ".jpg", str_replace("tmp_", "", $file_png));
	return $file_png_new;
}

function get_one_skin($skin_id)
{
	$sql = "select * from skin_info where skin_id='$skin_id' limit 1";
	$list = mdb_query_latin("slave_shouji_skin", $sql);
	return $list[0];
}

function get_one_feeling($skin_id)
{
	$sql = "select * from sogou_zip_new where id='$skin_id' limit 1";
	$list = mdb_query_gbk("sogou", $sql);
	return $list[0];
}
function get_star_list()
{
	$sql = "select * from yz_star_list where is_del='0'";
	$list = mdb_query("db_yizhan", $sql);
	return $list;	
}

function pic_resize($frm, $press=100)
{
	$info=getimagesize($frm);
	$mime=$info['mime'];
	$mime=explode('/',$mime);
	$img_type=".". strtolower($mime[1]);
	
	$ext_name = strtolower(substr($frm, strrpos($frm, ".")));  // 如 $ext_name=".jpg"				
	if ($img_type!=$ext_name && ($ext_name=='jpg'||$ext_name=='jpeg') ) { // 上传的图片类型与扩展名不匹配  
		exit("error -- $frm ");
	}
	
	$frm_tmp = dirname($frm)."/".basename($frm, $ext_name)."_tmp".$ext_name;
	resizeimage($frm,180,180, $frm_tmp, $press);
	@unlink($frm);	// 删除旧文件
	@rename($frm_tmp, $frm);
}

function popup_close_exit(){
	echo "<script>parent.parent.location.reload();</script>";
	exit;
}

function popup_message_exit($msg){
	echo "<script>alert('".$msg."');</script>";
	exit;
}

function message_exit($msg, $__arr='')
{
	include_once(R_CLASS_ROOT.'/html.error.php');
	exit;
}

function reset_url_domain($str)
{
	$str = preg_replace("/img.shouji.sogou.com/i", 'wap.dl.pinyin.sogou.com', $str);
	return $str;
}

function get_next_pcid()
{
	$sql = "select max(pc_id) maxid from skin_info where pc_id>1000000000 and pc_id<1001000000";	
	$list = mdb_query("shouji_skin", $sql);
	$pc_id = $list[0]['maxid']+1;
	return $pc_id;
}

function get_next_smsid()
{
	$sql = "select max(sms_id) maxid from sogou_plugin_smslist";
	$list = mdb_query("sogou", $sql);
	$new_id = $list[0]['maxid']+1;
	return $new_id;
}

function get_rule()
{
	$sql = "select * from skin_jifen_rule where id=1";
	$list = mdb_query("db_yizhan", $sql);
	$row = $list[0];
	
	$arr = array();
	for($i=0;$i<24;$i++) {
		$val = $row["rule".$i];
		$tmp_arr = explode(",", $val);
		$arr[$i] = array();
		$arr[$i][0] = $tmp_arr[0];
		$arr[$i][1] = $tmp_arr[1];
		$arr[$i][2] = $tmp_arr[2];
	}
	
	return $arr;
}

function format_add($date)
{
	if (empty($date)) return "";
	return substr($date,0,4)."-".substr($date,4,2)."-".substr($date,6,2);
}

function format_remove($date)
{
	return preg_replace("/\-/i", "", $date);
}

function convertlatin2utf($list) {
	foreach ($list as $key=>$row){
		foreach ($row as $kk=>$vv) {
			if ($kk=="share_text" || $kk=="share_title" || $kk=="sign" || $kk=="android_tip" || $kk=="iphone_tip" || $kk=="intro_sentence" ) {
				$list[$key][$kk] = $vv;
			} else {
				$list[$key][$kk] = latin2utf($vv);
			}
		}
	}
	return $list;
}

function convertlatin2utf2($list) {
	foreach ($list as $key=>$row){
		foreach ($row as $kk=>$vv) {
			if ($kk=="share_text" || $kk=="share_title" || $kk=="sign" || $kk=="android_tip" || $kk=="iphone_tip" || $kk=="intro_sentence" ) {
				$list[$key][$kk] = $vv;
			} else {
				$list[$key][$kk] = latin2utf($vv);
			}
		}
	}
	return $list;
}

function convertgbk2utf($list) {
	foreach ($list as $key=>$row){
		foreach ($row as $kk=>$vv) {
			if ($kk=="share_text" || $kk=="share_title" || $kk=="sign" ) {
				$list[$key][$kk] = $vv;
			} else {
				$list[$key][$kk] = gbk2utf($vv);
			}
		}
	}
	return $list;
}

function curl_get_contents($url,$timeout=1) { 
	$curlHandle = curl_init(); 
	curl_setopt( $curlHandle , CURLOPT_URL, $url ); 
	curl_setopt( $curlHandle , CURLOPT_RETURNTRANSFER, 1 ); 
	curl_setopt( $curlHandle , CURLOPT_TIMEOUT, $timeout ); 
	$result = curl_exec( $curlHandle ); 
	curl_close( $curlHandle ); 
	return $result; 
}

function get_multy_skin_id($ids) {
	$ids = trim($ids);
	$url = "http://interface.shouji.sac.sogou/skin/mobile.php?skin_id=".$ids;
	$json = curl_get_contents($url);
	$arr  = json_decode($json, true);	
	return $arr;
}

function get_multy_pc_id($ids) {
	$ids = trim($ids);
	$url = "http://interface.shouji.sac.sogou/skin/pc.php?pc_id=".$ids;
	$json = curl_get_contents($url);
	$arr  = json_decode($json, true);	
	return $arr;
}

function get_multy_zmapps_id($ids) {
	$ids = trim($ids);
	$url = "http://config.zhuomian.sac.sogou/zm_apps/appid.php?app_id=".$ids;
	$json = curl_get_contents($url);
	$arr  = json_decode($json, true);
	return $arr;
}

/**
 * 获取作品信息
 *
 * */
function get_zuopin_info($id, $type) {

    switch ($type) {
        case 'skin':
            $ret = get_multy_pc_id($id);
            $zuopin_info = $ret[0];
            break;
        case 'expr_tpbq':
            $ret = get_multy_expr_zip_id($id);
            $zuopin_info = $ret[0];
            break;
        case 'expr_ywz':
            //todo
            break;
        case 'expr_doutu':
            //todo
            break;
    
    }

    return $zuopin_info;
}

/**
 * 获取表情包信息
 *
 * @param $ids string  多个逗号分割
 * */
function get_multy_expr_zip_id($ids) {
	$ids = trim($ids);
	$url = "http://interface.shouji.sac.sogou/expr/express_zip_list.php?express_id=".$ids;
    log_msg('debug', $url);
	$json = curl_get_contents($url);
	$arr  = json_decode($json, true);
	return $arr;
}

function get_multy_expr_pic_id($ids) {
	$ids = trim($ids);
	$url = "http://interface.shouji.sac.sogou/expr/expr_pic.php?pic_id=".$ids;
	$json = curl_get_contents($url);
	$arr  = json_decode($json, true);
	return $arr;
}

/**
 * 获取细胞词库
 *
 * */
function get_multy_dict_id($ids) {
	$ids = trim($ids, ',');
    $_link = redis_class::getInstance('dict_redis');
    $list = $_link->getMultipleV2($ids, 'dict_id_');
	return $list;
}

function get_some_ids($url) {
	$ids_str = curl_get_contents($url);
	$ids_str = trim($ids_str, " \r\n");
	return $ids_str;
}

function get_appkey_allfields($key) {
	$sql  = "select * from cms_app where app='$key' limit 1";
	$list = mdb_agent("db_yizhan", $sql);
	return isset($list[0]) ? $list[0] : array();
}

function get_appkey_val($key) {
	$sql  = "select * from cms_app where app='$key' limit 1";
	$list = mdb_agent("db_yizhan", $sql);
	return @$list[0]['content'];
}

function get_appkey_ini($app) {
	$sql  = "select * from cms_app where app='$app' limit 1";
	$list = mdb_agent("db_yizhan", $sql);
	return $list[0]['init'];
}

function get_skin_ini($id) {
	$sql  = "select * from skin_info where skin_id='$id' limit 1";
	$list = mdb_query("shouji_skin", $sql);
	return $list[0]['init'];
}

function get_pkg_ini($id) {
	$sql  = "select * from sogou_zip_new where id='$id' limit 1";
	$list = mdb_query("sogou", $sql);
	return $list[0]['init'];
}

/**
 *
 * @param $platform string 平台 ios or android
 * */
function get_ywz_ini($id, $platform) {
    switch($platform) {
        case 'ios':
            $table_name = 'sogou_ywz_zip';
            $db = 'sogou';
            break;
        case 'android':
            $table_name = 'android_ywz_zip';
            $db = 'db_yizhan';
            break;
    } 

    if (empty ($db) || empty($table_name)) {
        return 0;
    }
	$sql  = "select * from {$table_name} where id='$id' limit 1";
	$list = mdb_query($db, $sql);
	return !empty($list[0]['init']) ? $list[0]['init'] : 0;
}

function set_appkey_val($key, $val, $tt="") {
	$sql  = "select count(*) cnt from cms_app where app='$key' limit 1";
	$list = mdb_agent("db_yizhan", $sql);
	$cnt  = $list[0]['cnt'];
	if ($cnt>0) {
		$sql = "update cms_app set init='0', content='$val', tt='$tt', update_time='".date('Y-m-d H:i:s')."' where app='$key' limit 1";
	} else {
		$sql = "insert into cms_app set content='$val',app='$key',tt='$tt'";
	}
	
	mdb_agent("db_yizhan", $sql);
	
	mdb_agent("db_yizhan", "insert into cms_log set app='$key', content='$val', tt='$tt', update_time='".date('Y-m-d H:i:s')."'");
}

function set_appkey_val_proxy($key, $val, $tt="") {
	$sql  = "select count(*) cnt from cms_app where app='$key' limit 1";
	$list = mdb_query("db_yizhan_test", $sql);
	$cnt  = $list[0]['cnt'];
	if ($cnt>0) {
		$sql = "update cms_app set init='0', content='$val', tt='$tt', update_time='".date('Y-m-d H:i:s')."' where app='$key' limit 1";
	} else {
		$sql = "insert into cms_app set content='$val',app='$key',tt='$tt'";
	}

    mdb_query("db_yizhan_test", $sql);

    mdb_query("db_yizhan_test", "insert into cms_log set app='$key', content='$val', tt='$tt', update_time='".date('Y-m-d H:i:s')."'");
}

function gen_randcode( $length = 16 ) {
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$code  = ""; 
	for ( $i = 0; $i < $length; $i++ )
	{
		$code .= $chars[ mt_rand(0, strlen($chars) - 1) ];
	}
	return $code;
}

function get_db_row_key($rand_id, $list) {
	$row_key = "";
	foreach ($list as $k=>$v) {
		if (isset($v['rand_id']) && $v['rand_id']==$rand_id) {
			$row_key = $k;
			break;
		}
	}
	return $row_key;
}

function get_hotdict_pool_xml()
{
	$sql = "select * from hotdict_pool where is_del=0 order by id desc";
	$list = mdb_query("db_yizhan", $sql);
	$xml = "";
	foreach ($list as $v) {
		$pinyin = $v['pinyin'];
		$pinyin = preg_replace("/-/", "|", $pinyin);
		$word   = $v['word'];
		$xml .="<word pinyin=\"$pinyin\" index=\"1499\">$word</word>\r\n";
	}
	return $xml;
}

/**	获取皮肤分类列表
 *	@param $id_key Boolean 是否将分类id作为返回的二维数组的第一维的key 缺省true [true:是,false:否
 *	@param $ptype Integer 获取的平台类型 [0:全部,1:安卓,2:苹果,3:兼容]
 *	@param $orderby String 排序的字段 缺省cid [cid:按分类id排序,listorder:按安卓排序值排序,listorder_ios:按苹果排序值排序]
 *	@param $ordersc String 排序的规则 缺省desc [asc:升序,desc:降序]
 *	@return Array array()/array(0=>array('cid'=>xx,..),..)
 */
function get_skin_cate_list($id_key = true, $ptype = 0, $orderby = 'cid', $ordersc = 'desc') {
	$list = array();
	
	$db = mysql::getInstance('shouji_skin');
	$db->query('SET NAMES utf8');
	$sql = "SELECT * FROM `cate_info_new` WHERE `killed`=0 AND `checked`=1";
	if($ptype == 1 || strtolower($ptype) == 'android') {
		$sql .= " AND `is_android`=1";
	} elseif($ptype == 2 || strtolower($ptype) == 'ios') {
		$sql .= " AND `is_ios`=1";
	} elseif($ptype == 3 || strtolower($ptype) == 'compat') {
		$sql .= " AND `is_android`=1 AND `is_ios`=1";
	}
	if(!in_array(($ordersc=strtolower($ordersc)), array('asc','desc'))) {
		$ordersc = 'desc';
	}
	if(strtolower($orderby) == 'cid') {
		$sql .= " ORDER BY `cid` {$ordersc}";
	}
	$query = $db->query($sql);
	$db->query('SET NAMES latin1');
	
	while($tmp = $db->fetch_array($query)) {
		$list[$tmp['cid']] = $tmp;
	}
	if(!$id_key) {
		$list = array_merge($list);
	}
	
	return $list;
}

/*获取表情统计用的分类,运营的需求*/
function _get_exp_stat_category() {
	return array(
		1 => array(
			'id' => 1,
			'name' => '动漫',
		),
		2 => array(
			'id' => 2,
			'name' => '娱乐',
		),
		3 => array(
			'id' => 3,
			'name' => '游戏/二次元',
		),
		4 => array(
			'id' => 4,
			'name' => '文字',
		),
		5 => array(
			'id' => 5,
			'name' => '异形',
		),
	);
}

/**
 * 更新cms_app 中上线表情包的id的集合
 *
 * */
function update_online_bqb($id, $is_online) {
    if (!in_array($is_online, array(0,1), TRUE)) {
        return false;
    }
    
    $app_key = 'express_bqb_zip_reco_v410_ids';
	$ids_str = get_appkey_val($app_key);
    $ids_arr = explode(',', $ids_str);
    if (1 === $is_online ) {
        array_unshift($ids_arr, $id); 
        $ids_arr = array_unique($ids_arr);
    } else if (0 === $is_online) {
        $ids_arr = array_diff($ids_arr, array($id)); 
    }
    $ids_up_str = implode(',', $ids_arr);
	set_appkey_val($app_key, $ids_up_str);

}

/**
 * 更新cms_app 中上线安卓表情包的id的集合
 *
 * */
function update_online_andr_bqb($id, $is_online) {
    if (!in_array($is_online, array(0,1), TRUE)) {
        return false;
    }
    
    $app_key = 'express_bqb_zip_reco_android_ids';
	$ids_str = get_appkey_val($app_key);
    $ids_arr = explode(',', $ids_str);
    if (1 === $is_online ) {
        array_unshift($ids_arr, $id); 
        $ids_arr = array_unique($ids_arr);
    } else if (0 === $is_online) {
        $ids_arr = array_diff($ids_arr, array($id)); 
    }
    $ids_up_str = implode(',', $ids_arr);
	set_appkey_val($app_key, $ids_up_str);

}

function json_filter_latest($str) {
    return $str;
}
/**
 *  静态资源替换为https访问
 *
 *  @param
 * */
function sResource2https($url){
	$result = str_replace("http://", "https://", $url);
	$result = str_replace("img.shouji.sogou.com/", "img-minput.sogoucdn.com/", $result);
	$result = str_replace("wap.dl.pinyin.sogou.com/", "wapdl-minput.sogoucdn.com/", $result);

	return $result;
}

/**
 *  遍历多维数组 do sth
 *
 *  @param $array  数组名
 *  @param $action 函数名
 *  @example Multiarray_action($array, "sResource2https")
 * */
function Multiarray_action(&$array, $action){
	if(is_array($array)){
		foreach($array as $key=>$value){
			if(is_array($value)){
				$array[$key] = Multiarray_action($array[$key], $action);
			}
			else{
				//do sth.
				$array[$key] = $action($array[$key]);
			}
		}
	}
	return $array;
}

/**
 * 获取当前登录用户的 菜单
 *
 * */
function get_menu_by_groups($group_id) {
    if (empty($group_id)) {
        return; 
    }
    if ('rootusr' === $_SESSION['name']) {
        $sql = "SELECT b.menu_id,b.name,b.controller, b.action,b.param,b.lvl,b.pid,b.order_val from yadie_rbac_menu b order by b.order_val DESC, b.menu_id ASC";
    } else {
        $sql = "SELECT a.menu_id, a.group_id, b.name,b.controller, b.action,b.param,b.lvl,b.pid,b.order_val from yadie_rbac_group_access a left join yadie_rbac_menu b on a.menu_id=b.menu_id where a.group_id IN ({$group_id}) order by b.order_val DESC, b.menu_id ASC";
    }
    $db = new nDB("shouji_dict_utf8");
    $data = $db->getData($sql);

    if (empty($data)) {
        return;
    }

    $result = array();
    foreach($data as $k=>$row) {
        $row['url'] = "";
        if (!empty($row['controller'])) {
            $row['url'] = "?c={$row['controller']}&a={$row['action']}&{$row['param']}";
        }
        $result[$row['menu_id']] = $row;
    }

    return $result;
}

/**
 * 核实权限
 * */
function rbac_check_auth() {
}

function gen_url_with_frm($url, $frm) {
    if (false === strpos($url, '?')) {
      $url .= '?frm=' . $frm;
    }else {
      $url .= '&frm=' . $frm;
    }
    return $url;
}                               

function console_debug($data, $method = "warn") {
    if (empty($_GET['cdebug']) || $_GET['cdebug'] != "9210db4ed9fd87427f8c6a7692234614") {
        return false;
    }
    include_once "ChromePhp.php";
    if (!class_exists("ChromePhp")) {
        log_msg("error", "ChromePhp.php not found.");
        return false; 
    }
    if (!in_array($method, array('info', 'warn', 'error', 'table', 'group', 'groupEnd', 'groupCollapsed'))) {
        log_msg("error", "ChromePhp::". $method . " not found.");
        $method = "log";
    }
    ChromePhp::$method($data);

}
function update_author_reward($is_reward, $author_id) {
    $db = new nDB("ime_ucenter"); 
    $sql = "update `author_base_info` set `is_reward` ={$is_reward} where `author_id`='{$author_id}'";
    log_msg('debug', $sql);
    $ret = $db->exec($sql);
}

/**
 *	测试url是否在外链白名单中
 */
function url_whitelist_detection($url){
	$url_array = explode("/",$url);
	$url_base = $url_array[2];

	$url_whitelist = get_appkey_val("ios_url_whitelist");
	$url_array = explode(",",$url_whitelist);
	$a = false;
	foreach($url_array as $k=>$v){
		if(strpos($v,"*")!== false){
			$part = explode("*",$v);			
			foreach($part as $key=>$value){
				if($value == '') continue;
				if(strpos($url,$value)!== false){
					$a = true;
					break;
				}
				else{
					continue;
				}
			}
		}
		elseif(strpos($v,"*")=== false && $url_base===$v){
			$a = true;
		}
	}	
	return $a;
}
?>
