<?php
    $function = $_GET['function'];
    $link = mysql_connect("localhost","root","12345678") or die("Could not connect to MySQL server");
    mysql_query("SET NAMES utf8"); 
    mysql_select_db("fyp", $link) or die("Could not select database");
    
    if ($function == "getFaq"){
        $query = "select * from faq";
        $result = mysql_query($query);
        $arr = array();
        while ($row = mysql_fetch_assoc($result)) {
            $arr[] = array('id' => $row['id'],
                           'question' => $row['question'],
                           'answer' => $row['answer']);
        }
        if(count($arr) == 0){
            $final_result = array('status' => "no record", 'data'=>null);
        }else{
            $final_result = array('status' => "success", 'data'=>$arr);
        }
        echo json_encode($final_result);
        //http://localhost/fyp_api/faq.php?function=getFaq
        
    }else{
        $final_result = array('status' => "no function", 'data'=>null);
        echo json_encode($final_result);
    }

?>