<?php

/**
 * 得到新订单号
 * @return  string
 */
function get_order_sn()
{
    /* 选择一个随机的方案 */
    mt_srand((double) microtime() * 1000000);

    return 'KC'. date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
}

function isEmail($username) {
    return \think\Validate::is($username, 'email');
}

//发送电子邮件函数
function sendEmail($to, $subject = 'subject', $body, $options, $cc=[], $bcc=[])  {
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);                                    // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug     = 2;                                                       // Enable verbose debug output
        $mail->isSMTP();                                                                // Set mailer to use SMTP
        $mail->Host          = $options['email_smtp'];                                  // Specify main and backup SMTP servers
        $mail->SMTPAuth      = true;                                                    // Enable SMTP authentication
        $mail->Username      = $options['email_serverusername'];                        // SMTP username
        $mail->Password      = $options['email_serverpassword'];                        // SMTP password
        $mail->SMTPSecure    = 'tls';                                                   // Enable TLS encryption, `ssl` also accepted
        $mail->Port          = $options['email_port'];                                  // TCP port to connect to

        //Recipients
        $mail->setFrom('support@kincustom.com', setting('name'));
        $mail->addAddress($to);                                                         // Add a recipient
        //$mail->addAddress('ellen@example.com');                                       // Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        foreach($cc as $v){
            $mail->addCC($v);
        }
        foreach($bcc as $v){
            $mail->addBCC($v);
        }
        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');                                 // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');                            // Optional name

        //Content
        $mail->isHTML(true);                                                            // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        // echo 'Message has been sent';
    } catch (PHPMailer\PHPMailer\Exception $e) {
        // echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
}

// 获取子模板
function template($template = 'common@email/register', $data = []) {
    $template .= '/default';
    return widget('common/Widget/template', ['template'=>$template, 'data' => $data]);
}

// 隐藏电子邮件
function email_asterisk($email)
{
    $pos = strpos($email, '@');
    $prefix = substr($email, 0, $pos);
    $length = strlen($prefix);
    $hide = substr($prefix, 0 , floor(strlen($prefix)/2));
    $_len = $length - strlen($hide);
    if ($_len >= 2) {
        $suffix = floor($_len / 2);
        $asterisk = str_repeat('*',$_len-$suffix) .substr($prefix, -($suffix));
    } else {
        $asterisk = str_repeat('*',$_len);
    }
    return $hide . $asterisk . substr($email, $pos);
}

function get_client_ip() {
    //获得IP地址
    if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
        $onlineip = getenv('HTTP_CLIENT_IP');
    } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
        $onlineip = getenv('HTTP_X_FORWARDED_FOR');
    } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
        $onlineip = getenv('REMOTE_ADDR');
    } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
        $onlineip = $_SERVER['REMOTE_ADDR'];
    }
    $onlineip = addslashes($onlineip);
    @preg_match("/[\d\.]{7,15}/", $onlineip, $onlineipmatches);
    $onlineip = $onlineipmatches[0] ? $onlineipmatches[0] : 'unknown';
    return $onlineip;
}

function activeAction() {
    return request()->module() . '/' . request()->controller() . '/' . request()->action();
}

/**
 * 检测输入中是否含有错误字符
 *
 * @param char $string 要检查的字符串名称
 * @return TRUE or FALSE
 */
function isBadword($string) {
    $badwords = array("\\",'&',' ',"'",'"','/','*',',','<','>',"\r","\t","\n","#");
    foreach($badwords as $value){
        if(strpos($string, $value) !== FALSE) {
            return TRUE;
        }
    }
    return FALSE;
}

/**
 * 检查用户名是否符合规定
 *
 * @param STRING $username 要检查的用户名
 * @return 	TRUE or FALSE
 */
function isUsername($username) {
    $strlen = strlen($username);
    if(isBadword($username) || !preg_match("/^[a-zA-Z0-9_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]+$/", $username)){
        return false;
    } elseif ( 20 < $strlen || $strlen < 2 ) {
        return false;
    }
    return true;
}

// uid
function uid() {
    return \think\Session::has('uid') ? \think\Session::get('uid') : 0;
}

/**
 * 检查密码长度是否符合规定
 *
 * @param STRING $password
 * @return 	TRUE or FALSE
 */
function isPassword($password) {
    $strlen = strlen($password);
    if($strlen >= 6 && $strlen <= 18) return true;
    return false;
}

//截取字数
function trimmed_title($text, $limit=12) {
    if ($limit) {
        $val = csubstr($text, 0, $limit);
        return $val[1] ? $val[0]."..." : $val[0];
    } else {
        return $text;
    }
}

function csubstr($text, $start=0, $limit=12) {
    if (function_exists('mb_substr')) {
        $more = (mb_strlen($text, 'UTF-8') > $limit) ? TRUE : FALSE;
        $text = mb_substr($text, 0, $limit, 'UTF-8');
        return array($text, $more);
    } elseif (function_exists('iconv_substr')) {
        $more = (iconv_strlen($text) > $limit) ? TRUE : FALSE;
        $text = iconv_substr($text, 0, $limit, 'UTF-8');
        return array($text, $more);
    } else {
        preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $text, $ar);
        if(func_num_args() >= 3) {
            if (count($ar[0])>$limit) {
                $more = TRUE;
                $text = join("",array_slice($ar[0],0,$limit))."...";
            } else {
                $more = FALSE;
                $text = join("",array_slice($ar[0],0,$limit));
            }
        } else {
            $more = FALSE;
            $text =  join("",array_slice($ar[0],0));
        }
        return array($text, $more);
    }
}

/**
 * 格式化日期显示
 * @param integer $timestamp  要显示的UNIX时间纪元
 * @param String $format      要显示的日期时间格式
 * @param boolean $convert    是否要对日期格式进行自动转换
 */
function date_formate($timestamp, $format = "", $convert = false) {
    if (is_string($timestamp)) {
        return $timestamp;
    }
    if (empty($format)) {
        $format = 'Y/m/d H:i:s';
    }
    if (intval($timestamp) == 0) {
        return '-';
    }
    $s = date($format, (int)$timestamp);

    if ($convert == true) {
        $now = time();
        $interval = $now - $timestamp;

        //分钟内
        if ($interval < 60) {
            return '<span title="' . $s . '">' . $interval . 'seconds ago</span>';
        }
        //小时内
        if ($interval < 3600) {
            return '<span title="' . $s . '">' . intval($interval / 60) . 'minutes ago</span>';
        }
        //一天内
        if ($interval < 86400) {
            return '<span title="' . $s . '">' . intval($interval / 3600) . 'hours ago</span>';
        }
    }
    return $s;
}


// 格式化树型结构
// $arr = array(
//        array('name'=>'main','id'=>'1', 'pid'=>'0'),
//        array('name'=>'sub','id'=>'2', 'pid'=>'1'),
//    );
// $tree = getSubTree($arr);
// print_r($tree);
function getSubTree($items, $id = 'id', $pid = 'pid', $sub = 'sub') {
    $tree = array();
    $tmpMap = array();
    foreach ($items as $item) {
        $tmpMap[$item[$id]] = $item; // 将用ID作为键
    }

    foreach ($items as $item) {
        if (isset($tmpMap[$item[$pid]]) && $item[$id] != $item[$pid]) {
            if (!isset($tmpMap[$item[$pid]][$sub])) {
                $tmpMap[$item[$pid]][$sub] = array();
            }
            $tmpMap[$item[$pid]][$sub][] = &$tmpMap[$item[$id]];
        } else {
            $tree[] = &$tmpMap[$item[$id]];
        }
    }
    return $tree;
}


// 格式化树型结构
// $arr = array(
//    array('id' => 1, 'pid' => 0, 'name' => 'root1'),
//    array('id' => 2, 'pid' => 0, 'name' => 'root2'),
//    array('id' => 3, 'pid' => 0, 'name' => 'root3'),
//    array('id' => 4, 'pid' => 1, 'name' => 'root1-child1'),
//    array('id' => 5, 'pid' => 4, 'name' => 'root1-child1-child1'),
//    array('id' => 6, 'pid' => 2, 'name' => 'roo2-child1'),
//);
// print_r(getTree($arr));
function getTree($array, $pid=0) {
    $parents = array($pid); // stack
    $tree = array();
    while (($pid = array_pop($parents)) !== NULL) {
        foreach ($array as $key => $value) {
            if ($value['pid'] == $pid) {
                $value['level'] = count($parents); // 统计父级分类个数
                $tree[] = $value;
                $parents[] = $value['pid'];
                $parents[] = $value['id'];
                unset($array[$key]); // 清除已经遍历的元素，其它语言如果没有unset可以使用一个元素标记状态
                break; // 深度优先，只遍历一个分支
            }
        }
    }
    return $tree;
}


// 排列组合
// $arr = array(
//    array('A', 'B'),
//    array('C', 'D'),
//    array('1', '2', '3'),
// );
// $rs = getCombination($arr);
// print_r($rs);
function getCombination($arr) {
    $combArrays = array(array());
    foreach ($arr as $arrValues) {
        $newArrayValues = array();
        foreach ($combArrays as $comArray) {
            foreach ($arrValues as $value) {
                $new = $comArray;
                $new[] = $value;
                $newArrayValues[] = $new;
            }
        }
        $combArrays = $newArrayValues;
    }
    return $combArrays;
}

function in_array_case($value,$array){
    return in_array(strtolower($value), array_map('strtolower',$array));
}

// 限制操作间隔时间
function timeLimit($timeout = 60, $count = null, $key_name = 'REGISTER_LIMIT') {

    $request = request();

    $name    = strtoupper('LIMIT_' . $request->module() . '_' . $request->controller() . '_' . $request->action());

    $is_allow_multiple = !is_null($count);
    $is_init = false;
    if (!isset($_SESSION[$key_name][$name]['timeout'])) {
        $is_init = true;
    }else{
        if($_SESSION[$key_name][$name]['timeout'] < time()){
            $is_init = true;
        }else{
            if(!$is_allow_multiple){
                return false;
            }
            if($_SESSION[$key_name][$name]['count'] > $count - 1){
                return false;
            }
            $_SESSION[$key_name][$name]['count']++;
        }
    }
    if($is_init){
        $_SESSION[$key_name][$name]['timeout'] = time() + $timeout;
        if($is_allow_multiple){
            $_SESSION[$key_name][$name]['count'] = 1;
        }
    }
    return true;
}


// 转换时间单位:秒 to XXX
function format_timespan($seconds = '') {
    if ($seconds == '') $seconds = 1;
    $str = '';
    $years = floor($seconds / 31536000);
    if ($years > 0) {
        $str .= $years.' years, ';
    }
    $seconds -= $years * 31536000;
    $months = floor($seconds / 2628000);
    if ($years > 0 || $months > 0) {
        if ($months > 0) {
            $str .= $months.' months, ';
        }
        $seconds -= $months * 2628000;
    }
    $weeks = floor($seconds / 604800);
    if ($years > 0 || $months > 0 || $weeks > 0) {
        if ($weeks > 0)    {
            $str .= $weeks.' weeks, ';
        }
        $seconds -= $weeks * 604800;
    }
    $days = floor($seconds / 86400);
    if ($months > 0 || $weeks > 0 || $days > 0) {
        if ($days > 0) {
            $str .= $days.' days, ';
        }
        $seconds -= $days * 86400;
    }
    $hours = floor($seconds / 3600);
    if ($days > 0 || $hours > 0) {
        if ($hours > 0) {
            $str .= $hours.' hours, ';
        }
        $seconds -= $hours * 3600;
    }
    $minutes = floor($seconds / 60);
    if ($days > 0 || $hours > 0 || $minutes > 0) {
        if ($minutes > 0) {
            $str .= $minutes.' minutes, ';
        }
        $seconds -= $minutes * 60;
    }
    if ($str == '') {
        $str .= $seconds.' seconds, ';
    }
    $str = substr(trim($str), 0, -1);
    return $str;
}


/**
 * 获得某年某月的时间戳范围
 * @param integer $year 年
 * @param integer $month 月
 * @return string $start.'-'.$end 返回UNIX时间戳范围
 */
function get_timestamp($year, $month) {
    $start = strtotime($year . '-' . $month . '-1');
    if ($month == 12) {
        $endyear = $year + 1;
        $endmonth = 1;
    } else {
        $endyear = $year;
        $endmonth = $month + 1;
    }
    $end = strtotime($endyear . '-' . $endmonth . '-1');
    return $start . '-' . $end;
}

/**
 * 在首字母前加空格
 * @param $title string title,name
 * @return mixed string
 */
function title_plus_space($title) {
    $newTitle = preg_replace('/(\B[A-Z])/', ' \\1', $title);
    return $newTitle;
}

/**
 * CSV导出
 */
function exportExcel($title=array(), $data=array(), $fileName='', $savePath='./', $isDown=true, $_row = 1){
    $obj = new \PHPExcel();

    //横向单元格标识
    $cellName = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');

    $obj->getActiveSheet(0)->setTitle('sheet名称');   //设置sheet名称
    // $_row = 3;   //设置纵向单元格标识
    if($title){
        $i = 0;
        foreach($title AS $v){   //设置列标题
            $obj->setActiveSheetIndex(0)->setCellValue($cellName[$i].$_row, $v);
            $i++;
        }
        $_row++;
    }

    //填写数据
    if($data){
        $i = 0;
        foreach($data AS $_v){
            $j = 0;
            foreach($_v AS $_cell){
                $obj->getActiveSheet(0)->setCellValue($cellName[$j] . ($i+$_row), $_cell, true);
                $j++;
            }
            $i++;
        }
    }

    //文件名处理
    if(!$fileName){
        $fileName = uniqid(time(),true);
    }

    $objWrite = \PHPExcel_IOFactory::createWriter($obj, 'CSV');

    if($isDown){   //网页下载
        header('pragma:public');
        header("Content-Disposition:attachment;filename=$fileName.csv");
        ob_start();
        $objWrite->save('php://output');
        $outPut = ob_get_contents();
        ob_end_clean();
        echo str_replace('""', '', $outPut);
        exit;
    }

    $_fileName = iconv("utf-8", "gb2312", $fileName);   //转码
    $_savePath = $savePath.$_fileName.'.csv';
    $objWrite->save($_savePath);

    return $savePath.$fileName.'.csv';
}
