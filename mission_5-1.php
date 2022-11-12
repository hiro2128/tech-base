<html>
<head>
    <meta charset="UTF-8">
    <title>mission_5-1.php</title>
</head>

<body>
    

 <?php
 // DB接続設定
    $dsn = 'mysql:dbname=tb240159db;host=localhost';
    $user = 'tb-240159';
    $password = 'Df9cUwZWzX';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
 //テーブルを新たに作成    
    $sql = "CREATE TABLE IF NOT EXISTS tb"
    ." ("
    . "id INT AUTO_INCREMENT PRIMARY KEY,"
    . "name char(32),"
    . "comment TEXT,"
    . "date char(32),"
    . "pass char(32)"
    .");";
    $stmt = $pdo-> query($sql);
//もしフォームが埋まっていたらDBにINSERTする
//投稿機能
     if(!empty($_POST["name"])&&!empty($_POST["str"])&&!empty($_POST["password"])&&empty($_POST["checkEditnumber"])){
    
    $sql = $pdo -> prepare("INSERT INTO tb (name, comment, date, pass) VALUES (:name, :comment, :date, :pass)");
    $sql -> bindParam(':name', $name, PDO::PARAM_STR);
    $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
    $sql -> bindParam(':date',$date,PDO::PARAM_STR);
    $sql -> bindParam(':pass',$pass,PDO::PARAM_STR);
    
    $name = $_POST["name"];
    $comment = $_POST["str"]; //好きな名前、好きな言葉は自分で決めること
    $date = date("Y/m/d H:i:s");
    $pass=$_POST["password"];
    $sql -> execute();
    
}

//削除機能
 if(!empty($_POST["delete"])&&!empty($_POST["password1"])){
     
     $sql = 'SELECT * FROM tb';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
    
    foreach($results as $row){
     if($row['pass']== $_POST["password1"]){
     $id=$_POST["delete"];
       
    $sql = 'delete from tb where id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
     }
 }
}
 

 
 //編集機能
//編集選択
 if(!empty($_POST["edit"])&&!empty($_POST["password2"])){
    $id=$_POST["edit"];
    $editpass=$_POST["password2"];
    $sql = 'SELECT * FROM tb';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
    
    foreach($results as $row){
    if($id==$row['id'] && $editpass==$row['pass']){
        $data0=$row['id'];
        $data1=$row['name'];
        $data2=$row['comment'];
        $data4=$row['pass'];
    }
        
    }
 }



 //編集機能実行
if(!empty($_POST["checkEditnumber"])){
       $sql = 'SELECT * FROM tb';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
    
    foreach($results as $row){
 
    if($row["id"]==$_POST["checkEditnumber"]){
      $id=$_POST["checkEditnumber"];
    $name=$_POST["name"];
    $comment=$_POST["str"];
    $pass=$_POST["password"];
    $date1 = date("Y/m/d H:i:s");
    $date2 = $date1."  (編集済み)";
    $sql='UPDATE tb SET name=:name,comment=:comment,pass=:pass,date=:date WHERE id=:id';
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(':name',$name,PDO::PARAM_STR);
    $stmt->bindParam(':comment',$comment,PDO::PARAM_STR);
    $stmt->bindParam(':pass',$pass,PDO::PARAM_STR);
    $stmt->bindParam(':date',$date2,PDO::PARAM_STR);
    $stmt->bindParam(':id',$id,PDO::PARAM_INT);
    $stmt->execute();
}
}
}
 
    ?>
    
       <form action=""method="post">
        <input type="text"name="str"placeholder="コメント"value="<?php if(!empty($data2)) {echo $data2;} ?>"><br>
        <input type="text"name="name"placeholder="名前"value="<?php if(!empty($data1)) {echo $data1;} ?>"　><br>
         <input type="text"name="password"placeholder="パスワード"value="<?php if(!empty($data4)){echo $data4;}?>" ><br>
        <input type="submit"name="submit"><br>
        
        <?php
        if(!empty($_POST["name"])&&!empty($_POST["str"])&&!empty($_POST["password"])&&empty($_POST["checkEditnumber"])){
            if(!empty($_POST["submit"])){
            echo "投稿成功！<br>";
            }
        }
        ?>
        
        <input type="number"name="delete"placeholder="削除したい行"><br>
         <input type="text"name="password1"placeholder="削除用パスワード"><br>
        <input type="submit"name="submit"value="削除" ><br>
        
        <?php
        if(!empty($_POST["delete"])&&!empty($_POST["password1"])&&!empty($_POST["submit"])){
            echo "削除成功! <br>"; 
            }
        ?>
    
        <input type="number"name="edit"placeholder="編集対象番号"><br>
        <input type="text"name="password2"placeholder="編集用パスワード"><br>
        <input type="submit"value="編集"><br>
        <?php
            if(!empty($_POST["checkEditnumber"])&&!empty($_POST["name"])&&!empty($_POST["str"])&&!empty($_POST["password"])){
                if(!empty($_POST["submit"])){
                    echo "編集成功！<br>";
                }
            }
        ?>
        <input type="hidden" name="checkEditnumber"value="<?php if(isset($data0)) {echo $data0;}?>"><br>
   
       
        
    </form>  
    
 <?php
  //挿入したDBのデータを表示する！（パスワードは表示しない）
 $sql = 'SELECT * FROM tb';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
    foreach ($results as $row){
        //$rowの中にはテーブルのカラム名が入る
        echo $row['id'].' ';
        echo $row['name'].' ';
        echo $row['comment'].' ';
        echo $row['date'].'<br>';
    echo "<hr>";
    }
    
      

 
 ?>
 
 
