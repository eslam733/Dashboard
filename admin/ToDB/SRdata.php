<?php


   if($_SERVER['REQUEST_METHOD'] == 'POST')
   {
      include "connection.php";
      include "../includes/func/functions.php";
      $data = json_decode(file_get_contents('php://input'), true);
      // check admin user and pass
      if($data['status'] =='overview')
      {
         echo json_encode(overview());
      }
      else if($data['status'] == "check")
      {
         $username = $data['username'];
         $password = $data['password'];
         $hash = sha1($password);
   
         try{
            $stmt = $con->prepare("select UserID, username, password from users where username = ?  and password = ?");
            $stmt->execute(array($username, $hash));
            $row = $stmt->fetch();
            $count = $stmt->rowCount();
   
            if($count > 0)
            {
               session_start();
               $_SESSION['username'] = $username;
               $_SESSION['id'] = $row['UserID'];
            }
            echo json_encode($count);
            
         }catch(PDOException $e)
         {
            echo json_encode($e->getMessage());
         }
      }else if($data['status'] == "getdata") // getdata to update
      {
         try{
            $stmt = $con->prepare("select Username, Email, Fullname from users where UserID = ?");
            $stmt->execute(array($data['id']));
            $row = $stmt->fetch();
            echo json_encode($row);
         }catch(PDOException $e)
         {
            echo json_encode($e->getMessage());
         }
      }else if($data['status'] == "updatedata") // update data
      {
         $user = strval($data['username']);
         $pass = strval($data['password']);
         $email =  strval($data['email']);
         $full = strval($data['full']);
         $err;
         if($pass == "") $err = vailtation($user, $full, $email);
         else $err = vailtation($user, $full, $email, $pass);
         if($err[0] === "true")
         {
            $IFFound =  ifIDExDB($data['id']);
            if($IFFound == 1)
            {
               $count = 0;
               if($pass != "")
               {
                  $hash = sha1($pass);
                  $stmt = $con->prepare("UPDATE `users` SET `Username` = ?, `Fullname` = ?, `Email` = ?, `Password` = ? WHERE `users`.`UserID` = ?;");
                  $stmt->execute(array($user,$full, $email,$hash,$data['id']));
                  $count = $stmt->rowCount();
               }else
               {
                  $stmt = $con->prepare("UPDATE `users` SET `Username` = ?, `Fullname` = ?, `Email` = ? WHERE `users`.`UserID` = ?;");
                  $stmt->execute(array($user,$full, $email,$data['id']));
                  $count = $stmt->rowCount();
               }
               echo json_encode($count);
            }else if($IFFound == 0)
            {
               echo json_encode(["false", "This User Not Found"]);
            }else{
               echo json_encode(["false", "Update Not seccussfully"]);
            }
         }else{
            echo json_encode($err);
         }
      }else if($data['status'] == 'addmember') // add new member
      {
         $user = strval($data['username']);
         $pass = strval($data['password']);
         $email =  strval($data['email']);
         $full = strval($data['full']);
         
         $err = vailtation($user, $full, $email, $pass);
        
         if($err[0] === "true")
         {
            try{
               $hash = sha1($pass);
               $hash = strval($hash);
               $stmt = $con->prepare("INSERT INTO `users`  VALUES (NULL, '{$user}', '{$hash}', '{$email}', '{$full}', '0', '0', '0', now());");
               $stmt->execute();
               $count = $stmt->rowCount();
               echo json_encode($count);
            }catch(PDOException $e)
            {
               echo json_encode(["false", "can't be able add new member"]);
            }
         }else{
            echo json_encode($err);
         }
      }else if($data['status'] == 'membertable') // get data for memeber table
      {
         try{
            $stmt = $con->prepare("select UserID, Username, Email, ResDate, Regstatus from users where GroupID = 0;");
            $stmt->execute();
            $count = $stmt->rowCount();
            if($count > 0)
            {
               $row =(array) $stmt->fetchAll();
               echo json_encode($row);
            }else{
               echo json_encode(0);
            }
         }catch(PDOException $e)
         {
            echo json_encode("can be able get data");
         }
      }else if($data['status'] == 'deletemember') // delete member
      {
         try{
            $IFFound = ifIDExDB($data['Reid']);
            if($IFFound == 1)
            {
               $stmt = $con->prepare("delete from users where UserID = :id");
               $stmt->execute(array(
                  "id" => $data['Reid']
               ));
               $count = $stmt->rowCount();
               if($count > 0) echo json_encode($count);
            }else if($IFFound == 0)
            {
               echo json_encode(["false", "This Member Not Found"]);   
            }else{
               echo json_encode(["false", "Problem With Deletion"]);
            }
         }catch(PDOException $e)
         {
            echo json_encode(["false", "Problem With Deletion"]);
         }
      }else if($data['status'] == 'activemember') // active member
      {
         try{
            $IFFound = ifIDExDB($data['Reid']);
            if($IFFound == 1)
            {
               $stmt = $con->prepare("update users set Regstatus = 1 where UserID = :id");
               $stmt->execute(array(
                  "id" => $data['Reid']
               ));
               $count = $stmt->rowCount();
               if($count > 0) echo json_encode($count);
            }else if($IFFound == 0)
            {
               echo json_encode(["false", "This Member Not Found"]);   
            }else{
               echo json_encode(["false", "Problem With Activation"]);
            }
         }catch(PDOException $e)
         {
            echo json_encode(["false", "Problem With Activation"]);
         }
      }else if($data['status'] == 'LastestMmember')
      {
         echo json_encode(genrialQ('UserID,Username, Regstatus', 'Users', 'Regstatus ASC , UserID DESC'));
      }
   }

?>

