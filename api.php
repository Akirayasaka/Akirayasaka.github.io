<?php
    include "base.php";

    $do=(!empty($_GET['do']))?$_GET['do']:"";
    switch($do){
        case "contact":
                save("index_contact",['fname'=>$_POST['fname'],'lname'=>$_POST['lname'],'email'=>$_POST['email'],'subject'=>$_POST['subject'],'message'=>$_POST['message'],'date'=>date("Y-m-d")]);
                echo "success!";
            break;
    }

?>