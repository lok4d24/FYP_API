<?php
    $function = $_GET['function'];
    $link = mysql_connect("localhost","root","12345678") or die("Could not connect to MySQL server");
    mysql_query("SET NAMES utf8"); 
    mysql_select_db("fyp", $link) or die("Could not select database");
    
    if ($function == "getArea"){
        $query = "select * from area";
        $result = mysql_query($query);
        $arr = array();
        while ($row = mysql_fetch_assoc($result)) {
            $arr[] = array('area_code' => $row['area_code'],
                           'area_name_zh' => $row['area_name_zh'],
                           'area_name_en' => $row['area_name_en'] );
        }
        if(count($arr) == 0){
            $final_result = array('status' => "no record", 'data'=>null);
        }else{
            $final_result = array('status' => "success", 'data'=>$arr);
        }
        echo json_encode($final_result);
        //http://localhost/fyp_api/area.php?function=getArea    
    }else if ($function == "getDistrict"){
        $query = "select * from district";
        $result = mysql_query($query);
        $arr = array();
        while ($row = mysql_fetch_assoc($result)) {
            $arr[] = array('district_code' => $row['district_code'],
                           'district_name_zh' => $row['district_name_zh'],
                           'district_name_en' => $row['district_name_en'],
                           'area_code' => $row['area_code']);
        }
        if(count($arr) == 0){
            $final_result = array('status' => "no record", 'data'=>null);
        }else{
            $final_result = array('status' => "success", 'data'=>$arr);
        }
        echo json_encode($final_result);
        //http://localhost/fyp_api/area.php?function=getDistrict   
    }else if ($function == "getDistrictByArea"){
        $area = $_GET['area'];
        $query = "select * from district where area_code = '$area'";
        $result = mysql_query($query);
        $arr = array();
        while ($row = mysql_fetch_assoc($result)) {
            $arr[] = array('district_code' => $row['area_code'],
                           'district_name_zh' => $row['district_name_zh'],
                           'district_name_en' => $row['district_name_en'],
                           'area_code' => $row['area_code']);
        }
        if(count($arr) == 0){
            $final_result = array('status' => "no record", 'data'=>null);
        }else{
            $final_result = array('status' => "success", 'data'=>$arr);
        }
        echo json_encode($final_result);
        //http://localhost/fyp_api/area.php?function=getDistrictByArea&area=
    }else{
        $final_result = array('status' => "no function", 'data'=>null);
        echo json_encode($final_result);
    }
?>