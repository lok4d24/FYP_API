<?php
    $function = $_GET['function'];
    $link = mysql_connect("localhost","root","12345678") or die("Could not connect to MySQL server");
    mysql_query("SET NAMES utf8"); 
    mysql_select_db("fyp", $link) or die("Could not select database");
    
    if ($function == "getCarparks"){
        $query = "select * from carpark";
        $result = mysql_query($query);
        $arr = array();
        while ($row = mysql_fetch_assoc($result)) {
            $arr[] = array('id' => $row['id'],
                           'name_zh' => $row['name_zh'],
                           'telephone' => $row['telephone'],
                           'lat' => $row['lat'],
                           'long' => $row['long'],
                           'district_code' => $row['district_code'],
                           'area_code' => $row['area_code'],
                           'addr_zh' => $row['addr_zh'],
                           'hourly_space' => $row['hourly_space'],
                           'monthly_space' => $row['monthly_space'],
                           'hourly_price' => $row['hourly_price'],
                           'monthly_price' => $row['monthly_price'] );
        }
        if(count($arr) == 0){
            $final_result = array('status' => "no record", 'data'=>null);
        }else{
            $final_result = array('status' => "success", 'data'=>$arr);
        }
        echo json_encode($final_result);
        //http://localhost/fyp_api/carpark.php?function=getCarparks
        
    } else if ($function == "getCarparkById"){
        $id = $_GET['id'];
        $query = "select * from carpark where id = '$id'";
        $result = mysql_query($query);
        $arr = array();
        while ($row = mysql_fetch_assoc($result)) {
            $arr[] = array('id' => $row['id'],
                           'name_zh' => $row['name_zh'],
                           'telephone' => $row['telephone'],
                           'lat' => $row['lat'],
                           'long' => $row['long'],
                           'district_code' => $row['district_code'],
                           'area_code' => $row['area_code'],
                           'addr_zh' => $row['addr_zh'],
                           'hourly_space' => $row['hourly_space'],
                           'monthly_space' => $row['monthly_space'],
                           'hourly_price' => $row['hourly_price'],
                           'monthly_price' => $row['monthly_price'] );
        }
        if(count($arr) == 0){
            $final_result = array('status' => "no record", 'data'=>null);
        }else{
            $final_result = array('status' => "success", 'data'=>$arr);
        }
        echo json_encode($final_result);
        //http://localhost/fyp_api/carpark.php?function=getCarparkById&id=
        
    }else if ($function == "getCarparkByDistrict"){
        $district = $_GET['district'];
        $query = "select * from carpark where district_code = '$district'";
        $result = mysql_query($query);
        $arr = array();
        while ($row = mysql_fetch_assoc($result)) {
            $arr[] = array('id' => $row['id'],
                           'name_zh' => $row['name_zh'],
                           'telephone' => $row['telephone'],
                           'lat' => $row['lat'],
                           'long' => $row['long'],
                           'district_code' => $row['district_code'],
                           'area_code' => $row['area_code'],
                           'addr_zh' => $row['addr_zh'],
                           'hourly_space' => $row['hourly_space'],
                           'monthly_space' => $row['monthly_space'],
                           'hourly_price' => $row['hourly_price'],
                           'monthly_price' => $row['monthly_price'] );
        }
        if(count($arr) == 0){
            $final_result = array('status' => "no record", 'data'=>null);
        }else{
            $final_result = array('status' => "success", 'data'=>$arr);
        }
        echo json_encode($final_result);
        //http://localhost/fyp_api/carpark.php?function=getCarparkByDistrict&district=
        
    } else if ($function == "getCarparkByArea"){
        $area = $_GET['area'];
        $query = "select * from carpark where area_code = '$area'";
        $result = mysql_query($query);
        $arr = array();
        while ($row = mysql_fetch_assoc($result)) {
            $arr[] = array('id' => $row['id'],
                           'name_zh' => $row['name_zh'],
                           'telephone' => $row['telephone'],
                           'lat' => $row['lat'],
                           'long' => $row['long'],
                           'district_code' => $row['district_code'],
                           'area_code' => $row['area_code'],
                           'addr_zh' => $row['addr_zh'],
                           'hourly_space' => $row['hourly_space'],
                           'monthly_space' => $row['monthly_space'],
                           'hourly_price' => $row['hourly_price'],
                           'monthly_price' => $row['monthly_price'] );
        }
        if(count($arr) == 0){
            $final_result = array('status' => "no record", 'data'=>null);
        }else{
            $final_result = array('status' => "success", 'data'=>$arr);
        }
        echo json_encode($final_result);
        //http://localhost/fyp_api/carpark.php?function=getCarparkByArea&area=
        
    }else if ($function == "getCarparkSpaceByCarpark"){
        $cp_id = $_GET['cp_id'];
        $query = "select * from parking_space where cp_id = '$cp_id'";
        $result = mysql_query($query);
        $arr = array();
        while ($row = mysql_fetch_assoc($result)) {
            $arr[] = array('id' => $row['id'],
                           'cp_id' => $row['cp_id'],
                           'area' => $row['area'],
                           'floor' => $row['floor'],
                           'number' => $row['number'],
                           'type' => $row['type'],
                           'shape' => $row['shape'],
                           'status' => $row['status'] );
        }
        if(count($arr) == 0){
            $final_result = array('status' => "no record", 'data'=>null);
        }else{
            $final_result = array('status' => "success", 'data'=>$arr);
        }
        echo json_encode($final_result);
        //http://localhost/fyp_api/carpark.php?function=getCarparkSpaceByCarpark&cp_id=
        
    }else if ($function == "getCarparkSpaceById"){
        $id = $_GET['id'];
        $query = "select * from parking_space where id = '$id'";
        $result = mysql_query($query);
        $arr = array();
        while ($row = mysql_fetch_assoc($result)) {
            $arr[] = array('id' => $row['id'],
                           'cp_id' => $row['cp_id'],
                           'area' => $row['area'],
                           'floor' => $row['floor'],
                           'number' => $row['number'],
                           'type' => $row['type'],
                           'shape' => $row['shape'],
                           'status' => $row['status'] );
        }
        if(count($arr) == 0){
            $final_result = array('status' => "no record", 'data'=>null);
        }else{
            $final_result = array('status' => "success", 'data'=>$arr);
        }
        echo json_encode($final_result);
        //http://localhost/fyp_api/carpark.php?function=getCarparkSpaceById&id=
        
    }else if ($function == "getCarparkSpaceByShape"){
        $shape = $_GET['shape'];
        $query = "select * from parking_space where shape = '$shape'";
        $result = mysql_query($query);
        $arr = array();
        while ($row = mysql_fetch_assoc($result)) {
            $arr[] = array('id' => $row['id'],
                           'cp_id' => $row['cp_id'],
                           'area' => $row['area'],
                           'floor' => $row['floor'],
                           'number' => $row['number'],
                           'type' => $row['type'],
                           'shape' => $row['shape'],
                           'status' => $row['status'] );
        }
        if(count($arr) == 0){
            $final_result = array('status' => "no record", 'data'=>null);
        }else{
            $final_result = array('status' => "success", 'data'=>$arr);
        }
        echo json_encode($final_result);
        //http://localhost/fyp_api/carpark.php?function=getCarparkSpaceByShape&shape=
        
    }else if ($function == "getCarparkSpaceByStatus"){
        $status = $_GET['status'];
        $query = "select * from parking_space where status = '$status'";
        $result = mysql_query($query);
        $arr = array();
        while ($row = mysql_fetch_assoc($result)) {
            $arr[] = array('id' => $row['id'],
                           'cp_id' => $row['cp_id'],
                           'area' => $row['area'],
                           'floor' => $row['floor'],
                           'number' => $row['number'],
                           'type' => $row['type'],
                           'shape' => $row['shape'],
                           'status' => $row['status'] );
        }
        if(count($arr) == 0){
            $final_result = array('status' => "no record", 'data'=>null);
        }else{
            $final_result = array('status' => "success", 'data'=>$arr);
        }
        echo json_encode($final_result);
        //http://localhost/fyp_api/carpark.php?function=getCarparkSpaceByStatus&status=
        
    }else if ($function == "getAvailableCarparkSpaceCountById"){
        $id = $_GET['id'];
        $query = "select count('id') as count from parking_space where  cp_id = '$id' and type = 'hr' and status='OK'";
        $result = mysql_query($query);
        $arr = array();
        while ($row = mysql_fetch_assoc($result)) {
            $arr = array('count' => $row['count'] );
        }
        
        $final_result = array('status' => "success", 'data'=>$arr);
        
        echo json_encode($final_result);
        //http://localhost/fyp_api/carpark.php?function=getAvailableCarparkSpaceCountById&id=
        
    }else{
        $final_result = array('status' => "no function", 'data'=>null);
        echo json_encode($final_result);
    }

?>