<html>
     <head>
    <meta charset="UTF=8">
    <title>mission_3-5.php</title>
    </head>
    
     
    <?php
//コメントと名前が空欄でなければ、入力フォームから受信する    
    if(!empty($_POST["str"])&&!empty($_POST["name"])){
//名前を受信する
        $name=$_POST["name"];
//コメントを受信する
        $str=$_POST["str"];
//ファイルを設定
        $filename="mission_3-5.txt";
//ファイルが存在するとき
     
        if(file_exists($filename)){
           $lines=file($filename,FILE_IGNORE_NEW_LINES);
            $end=end($lines);
            $a=explode("<>",$end);
            $num=(int)$a[0]+1;
        }
         else{
             $num=1;
         }
//はじめはファイルがないのでその時は1となるように設定        
        
//日時を設定        
        $date=date("Y/m/d H:i:s");
//パスワード設定
        $password=$_POST["password"];
        
//要素をまとめる        
        
//ファイルに反映されるようにする
//ファイルを開く
        $fp=fopen($filename,"a");
//ファイルに打ちこむ
       if(empty($_POST["checkEditnumber"])){ fwrite($fp,$num."<>".$name."<>".$str."<>".$date."<>".$password."<>".PHP_EOL);
       }
//ファイルは閉じる
        fclose($fp);


        }
    
    

    


//ここから削除機能を設定するよ

//deleteが空欄でないとき
    if(!empty($_POST["delete"])&&!empty($_POST["password1"])){
//deleteを受け取って変数化する
        $delete = $_POST["delete"];
        $password1=$_POST["password1"];
        $filename="mission_3-5.txt";
          $lines=file($filename,FILE_IGNORE_NEW_LINES);
        
            $fp=fopen($filename,"w"); 
         
            for ($i = 0; $i < count($lines); $i++){
               $line = explode("<>", $lines[$i]);
           
           if($line[0]==$delete&&$line[4]==$password1){
            fwrite($fp,"");
            }else{
            fwrite($fp, $lines[$i].PHP_EOL);
            }
        }
    // ファイルを閉じる
    fclose($fp);
     

}
if(!empty($_POST["edit"])&&!empty($_POST["password2"])){
    $password2=$_POST["password2"];
       
    $edit=$_POST["edit"];
        $filename="mission_3-5.txt";
        $lines=file($filename,FILE_IGNORE_NEW_LINES);
      
      for ($i = 0; $i < count($lines); $i++){  
        $line=explode("<>",$lines[$i]);
        
        
       if($line[0]==$edit&&$line[4] == $password2){
    

   
        $data=explode("<>",$lines[$i]);
        
        
        
        if($data[0] == $edit){
            $data1=$data[1];
            $data2=$data[2];
            $pass=$data[4];
        }
    
       }    
    }
    
}           
           
            
        
        if(!empty($_POST["checkEditnumber"])&&!empty($_POST["name"])&&!empty($_POST["str"])){
            $edit=$_POST["edit"];
            $editnumber=$_POST["checkEditnumber"];
            $filename="mission_3-5.txt";
        $lines=file($filename,FILE_IGNORE_NEW_LINES);
         $fp=fopen($filename,"w");
     for ($i = 0; $i < count($lines); $i++){
            
            $editdata = explode("<>", $lines[$i]);
     
                if($editdata[0]==$editnumber){
                     fwrite($fp,$editdata[0]."<>".$name."<>".$str."<>".$date."<>".$password."<>"."（編集済み）".PHP_EOL);
                    
                    
                }
                else{
                    fwrite($fp,$lines[$i].PHP_EOL);
                }
     }
                fclose($fp);
            
        }
            ?>

<span style= "font-size:25px; color:orange;">好きな食べ物を教えてください！</span>
  <form action=""method="post">
        <input type="text"name="str"placeholder="コメント"value="<?php if(isset($data2)) {echo $data2;} ?>"><br>
        <input type="text"name="name"placeholder="名前"value="<?php if(isset($data1)) {echo $data1;} ?>"　><br>
         <input type="text"name="password"placeholder="パスワード"value="<?php if(isset($pass)){echo $pass;}?>" ><br>
        <input type="submit"name="submit"><br>
        
        <input type="number"name="delete"placeholder="削除したい行"><br>
         <input type="text"name="password1"placeholder="削除用パスワード"><br>
        <input type="submit"name="submit"value="削除" ><br>
    
        <input type="number"name="edit"placeholder="編集対象番号"><br>
        <input type="text"name="password2"placeholder="編集用パスワード"><br>
        <input type="submit"value="編集"><br>
    
        <input type="hidden" name="checkEditnumber"value="<?php if(isset($edit)) {echo $edit;}?>"><br>
   
       
        
    </form>  


<?php
    $filename="mission_3-5.txt";
   
    
    if(file_exists($filename)){
       $lines=file($filename,FILE_IGNORE_NEW_LINES);
         for ($i = 0; $i < count($lines); $i++){
            $textdata=explode("<>",$lines[$i]);
     
       $text= ($textdata[0]."\n".$textdata[1]."\n".$textdata[2]."\n".$textdata[3]."\n".$textdata[5]);
      
        
       echo $text."<br>";
        
           
        }
        
    }
    ?>
</html>
    
   