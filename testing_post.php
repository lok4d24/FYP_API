<?php
    $function = $_GET['function'];
    $a = $_POST['a'];


    echo 'function = ',$function,' a = ',$a;
    $link = mysql_connect("localhost","root","12345678") or die("Could not connect to MySQL server");
    mysql_query("SET NAMES utf8"); 
    mysql_select_db("fyp", $link) or die("Could not select database");

        if ($function == 'login'){
            $login = $_GET['loginId'];
            $password = $_GET['password'];
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
                                   'lincense' => $row['lincense'],
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
        
        } else {
            $login = $_POST['loginId'];
            $password = $_POST['password'];
            $final_result = array('status' => "no function1", 'data'=>$function);
            echo json_encode($final_result);
        }
?>