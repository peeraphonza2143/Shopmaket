<?php 

session_start();
        if(isset($_POST['a_user'])){
                  include("backend/condb.php");
                  $a_user = $_POST['a_user'];
                  $a_pass = $_POST['a_pass'];

                  $sql="SELECT * FROM tbl_admin 
                  WHERE  a_user='".$a_user."' 
                  AND  a_pass='".$a_pass."' ";
                  $result = mysqli_query($con,$sql);
              
                  $sql2="SELECT * FROM tbl_member 
                  WHERE  m_user='".$a_user."' 
                  AND  m_pass='".$a_pass."' ";
                  $result2 = mysqli_query($con,$sql2);

                  if(mysqli_num_rows($result)==1){
                      $row = mysqli_fetch_array($result);

                      $_SESSION["user_id"] = $row["a_id"];
                      $_SESSION["a_name"] = $row["a_name"];
                     
                      if($_SESSION["user_id"]!=''){ 

                        Header("Location: backend/index.php");
                      }
               
                  }elseif(mysqli_num_rows($result2)==1){
                    $row = mysqli_fetch_array($result2);

                    $_SESSION["user_id"] = $row["member_id"];
                    $_SESSION["a_name"] = $row["m_name"];
                   
                    if($_SESSION["user_id"]!=''){ 

                      Header("Location: index.php");
                    }
                  }
                  else{
                    echo "<script>";
                        echo "alert(\" user หรือ  password ไม่ถูกต้อง\");"; 
                        echo "window.history.back()";
                    echo "</script>";
 
                  }
        }else{

             Header("Location: index.php"); //user & password incorrect back to login again
 
        }
?>