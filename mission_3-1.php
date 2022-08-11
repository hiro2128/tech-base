<head>
    <meta charset="UTF-8">
    <title>mission_3-2.php</title>
</head>

<body>
    
    <form action=""method="post">
        <input type="text"name="name"placeholder="your name"><br>
         <input type="text"name="str"placeholder="comment"><br>
         
        <input type="submit"name="submit"value="submit" >
    </form>
    
    <?php
    
    if(!empty($_POST["str"])){
        $name=$_POST["name"];
        $str=$_POST["str"];
        $filename="mission_3-1.txt";
        if(file_exists($filename)){
            $num=count(file($filename))+1;
        }else{
            $num=1;
        }
    
       
       $date=date("Y/m/d H:i:s");
        
    $newdata=$num."<>".$name."<>".$str."<>".$date;
        
        $fp=fopen($filename,"a");
        //ｗにすると前回までのファイルのデータ数で表示されてしまう。
         fwrite($fp,$newdata.PHP_EOL);
        fclose($fp);
         }
    
    
   
