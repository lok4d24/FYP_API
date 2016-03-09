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
        
        }else if( $function == 'register' ){
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
        }else if ($function == 'reservation'){
            
//========================================================================================================
            $query = "select * from parking_space where status='booked' and time < now()";
            $result = mysql_query($query);
           
            while ( $row = mysql_fetch_assoc($result) ) {
                $ban = $row['reservationBy'];
                $query = "update member set badRecord=badRecord+1 where id='$ban'";
                mysql_query($query);
                
                $reset = $row['id'];
                $query = "update parking_space set time=NULL, status='OK', reservationBy=NULL where id='$reset'";
                mysql_query($query);
            }
//========================================================================================================
            $id = $_POST['id'];
            $cid = $_POST['cid'];
            $query = "select status, badrecord, value, class from member where id='$id'";
            $result = mysql_query($query);
            $row = mysql_fetch_assoc($result);
            if ($row['status'] == 'activate'){
                if ($row['badrecord'] < 3){
                    if ($row['value'] > 0){
                        //member checking all clear
                        $class = $row['class'];
                        $query = "select * from parking_space where status='OK' and type='hr' and cp_id='$cid'";
                        $result = mysql_query($query);
                        $count = mysql_num_rows($result);
                            
                        if ($count == 0){
                            $final_result = array('status' => "fail", 'data'=>"count");
                            echo json_encode($final_result);
                        }else{
                            while ($row = mysql_fetch_assoc($result)) {
                                $thisid = $row["id"];
                                $thiscid = $row["cp_id"];
                                if ( $class == 'Normal'){
                                    $query = "update parking_space set status='booked', time=date_add(now(), interval 30 minute), reservationBy='$id' where id='$thisid'";
                                }else{
                                    $query = "update parking_space set status='booked', time=date_add(now(), interval 1 hour), reservationBy='$id' where id='$thisid'";
                                }
                                $result2 = mysql_query($query);
                                
                                $query = "select * from carpark where id='$thiscid'";
                                $result3 = mysql_query($query);
                                while ($row = mysql_fetch_assoc($result3)) {
                                    $price = $row["hourly_space"];    
                                    $query = "update member set value=value-'$price' where id='$id'";
                                    mysql_query($query);
                                }
                        
                                
                                if($result2){
                                    $id = array('id' => $thisid);
                                    $final_result = array('status' => "success", 'data'=>$id);
                                }else{
                                    $final_result = array('status' => "fail", 'data'=>mysql_errno());
                                }
                                echo json_encode($final_result);
                                break;
                            } 
                        }
                    }else{
                        $final_result = array('status' => "fail", 'data'=>"value");
                        echo json_encode($final_result);
                    }
                
                }else{
                    $final_result = array('status' => "fail", 'data'=>"badrecord");
                    echo json_encode($final_result);
                }    
                
            }else{
                $final_result = array('status' => "fail", 'data'=>"status");
                echo json_encode($final_result);
            }

            //http://localhost/fyp_api/member.php?function=reservation&id=&cid=
        }else if($function == 'cancelReserve'){
                
//========================================================================================================
                $query = "select * from parking_space where status='booked' and time < now()";
                $result = mysql_query($query);

                while ( $row = mysql_fetch_assoc($result) ) {
                    $ban = $row['reservationBy'];
                    $query = "update member set badRecord=badRecord+1 where id='$ban'";
                    mysql_query($query);

                    $reset = $row['id'];
                    $query = "update parking_space set time=NULL, status='OK', reservationBy=NULL where id='$reset'";
                    mysql_query($query);
                }
//========================================================================================================
                $id = $_POST['id'];
                $query = "update parking_space set time=NULL, status='OK', reservationBy=NULL where reservationBy='$id'";
                mysql_query($query);
        
        
        }else{
            $final_result = array('status' => "no post function", 'data'=>null);
            echo json_encode($final_result);
        }
    
    }else if ($_SERVER['REQUEST_METHOD'] == 'GET') { //get
        $function = $_GET['function'];
        
         
        $final_result = array('status' => "no get function", 'data'=>null);
        echo json_encode($final_result);
          
    }
?>