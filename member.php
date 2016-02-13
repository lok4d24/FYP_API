<?php
    $link = mysql_connect("localhost","root","12345678") or die("Could not connect to MySQL server");
    mysql_query("SET NAMES utf8"); 
    mysql_select_db("fyp", $link) or die("Could not select database");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $function = $_POST["function"];
        if ($function == 'login'){
            $login = $_POST['loginId'];
            $password = $_POST['password'];
            $query = "select * from member where login='$login'and password='$password'";
            $result = mysql_query($query);
            $count = mysql_num_rows($result);
            
            if($count==1){
                $arr = array();
                while ($row = mysql_fetch_assoc($result)) {
                    $arr[] = array('id' => $row['id'],
                                   'name_zh' => $row['name_zh'],
                                   'name_en' => $row['name_en'],
                                   'value' => $row['value'],
                                   'class' => $row['class'],
                                   'prefer_shape' => $row['prefer_shape'],
                                   'status' => $row['status'],
                                   'hkid' => $row['hkid'],
                                   'license' => $row['license'],
                                   'email' => $row['email'],
                                   'telephone' => $row['telephone'] );    
                }
                $final_result = array('status' => "success", 'data'=>$arr);
            } else if($count == 0) {
                $final_result = array('status' => "no record", 'data'=>null);
            } else{
                $final_result = array('status' => "duplicate record", 'data'=>null);
            }
            echo json_encode($final_result);
        
            //http://localhost/fyp_api/member.php?function=login&loginId=&password=
        
        } else if( $function == 'register' ){
            $loginId = $_POST['loginId'];
            $password = $_POST['password'];
            $name_zh = $_POST['name_zh'];
            $hkid = $_POST['hkid'];
            $license = $_POST['license'];
            $email = $_POST['email'];
            $telephone = $_POST['telephone'];
            $shape = $_POST['shape'];
            
            $query = "insert into member 
                    (name_zh, login, password, prefer_shape, hkid, license, email, telephone) values 
                    ('$name_zh', '$loginId', '$password', '$shape', '$hkid', '$license', '$email', '$telephone')";
            $result = mysql_query($query);
            if($result){
                $id = array('id' => mysql_insert_id());
                $final_result = array('status' => "success", 'data'=>$id);
            }else{
                $final_result = array('status' => "fail", 'data'=>mysql_errno());
            }
            echo json_encode($final_result);
            
            
            
            
            //http://localhost/fyp_api/member.php?function=register&loginId=&password=
        } else{
            $login = $_POST['loginId'];
            $password = $_POST['password'];
            $final_result = array('status' => "no function1", 'data'=>$function);
            echo json_encode($final_result);
        }
    
    }else{
        
        $function = $_GET['function'];        
        $final_result = array('status' => "no function", 'data'=>$function);
        echo json_encode($final_result);

//        if ($function == "getMemberByLogin"){
//            $query = "select * from member where login =''";
//            $result = mysql_query($query);
//            $arr = array();
//            while ($row = mysql_fetch_assoc($result)) {
//                $arr[] = array('area_code' => $row['area_code'],
//                               'area_name_zh' => $row['area_name_zh'],
//                               'area_name_en' => $row['area_name_en'] );
//            }
//            if(count($arr) == 0){
//                $final_result = array('status' => "no record", 'data'=>null);
//            }else{
//                $final_result = array('status' => "success", 'data'=>$arr);
//            }
//            echo json_encode($final_result);
//            //http://localhost/fyp_api/area.php?function=getArea    
//        }else{
//            $final_result = array('status' => "no function", 'data'=>null);
//            echo json_encode($final_result);
//        }
        
    }
?>