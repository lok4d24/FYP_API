<?php
    $function = $_GET['function'];
    $link = mysql_connect("localhost","root","12345678") or die("Could not connect to MySQL server");
    mysql_query("SET NAMES utf8"); 
    mysql_select_db("fyp", $link) or die("Could not select database");
    
    if($function == "testing_get"){
        $query = "select * from carpark";
        $result = mysql_query($query);
        $arr = array();
        while ($row = mysql_fetch_assoc($result)) {
            $arr[] = array('id' => $row['id'],'name_zh' => $row['name_zh'],'telephone' => $row['telephone'],
                           'lat' => $row['lat'], 'long' => $row['long'], 'district' => $row['district'],
                          'addr_zh' => $row['addr_zh'],'hourly_space' => $row['hourly_space'],
                           'monthly_space' => $row['monthly_space'],'monthly_price' => $row['monthly_price'],
                           'hourly_price' => $row['hourly_price']);
        }
        $result = array();
        if(count($arr) == 0){
            $result[] = array('status' => "fail", 'error'=>'No match record','data'=>null);
        }else{
            $result[] = array('status' => "success", 'error'=>null, 'data'=>$arr);
        }
        echo json_encode($result);
        
        //http://localhost/fyp_api/testing_get.php?function=testing_get
    } else {
        $arr[] = array('status' => "fail", 'error'=>'No match function', 'data'=>null);
        echo json_encode($arr);
    }
?>