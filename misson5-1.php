<!DOCTYPE html>

<html>

    <head>
        <meta charset="utf-8">
        <title>Mission5-1</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>

    <span style="color:cyan">
    <h1>あなたの行ってみたい国はどこですか？</h1>
    </span>

    <hr>
    
    <div style="background-color: linen">
        
    <?php
    
    $editname = "";
    $editstr = "";
    $editpass = "";
    
    // DB接続設定
    $dsn = 'データベース名';
    $user = 'ユーザー名';
    $password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
  
    //　DB内にテーブルを作成    
    $sql = "CREATE TABLE IF NOT EXISTS tbtest"
    ." ("
    . "id INT AUTO_INCREMENT PRIMARY KEY,"
    . "name char(32),"
    . "str TEXT,"
    . "posttime TEXT,"
    . "pass TEXT"
    .");";
    $stmt = $pdo->query($sql);  
        
    //挿入モジュール
    if(isset($_POST["submitbutton"]) && empty($_POST["editing"])){
        
        //名前とコメントとパスワードが入力されていないとき
        if(empty($_POST["name"]) && empty($_POST["str"]) && empty($_POST["pass"])){
            
            echo "名前とコメントとパスワードを入力してください";
            
        }else
        //コメントとパスワードが入力されていないとき
        if(!empty($_POST["name"]) && empty($_POST["str"]) && empty($_POST["pass"])){
            
            echo "コメントとパスワードを入力してください";
            
        }else
        //名前とコメントが入力されていないとき
        if(empty($_POST["name"]) && empty($_POST["str"]) && !empty($_POST["pass"])){
            
            echo "名前とコメントを入力してください";
            
        }else
        //名前とパスワードが入力されていないとき
        if(empty($_POST["name"]) && empty($_POST["str"]) && !empty($_POST["pass"])){
            
            echo "名前とパスワードを入力してください";
            
        }else
        //パスワードが入力されていないとき
        if(!empty($_POST["name"]) && !empty($_POST["str"]) && empty($_POST["pass"])){
            
            echo "パスワードを入力してください";
            
        }else
        //コメントが入力されていないとき
        if(!empty($_POST["name"]) && empty($_POST["str"]) && !empty($_POST["pass"])){
            
            echo "コメントを入力してください";
            
        }else
        //名前が入力されていないとき
        if(empty($_POST["name"]) && !empty($_POST["str"]) && !empty($_POST["pass"])){
            
            echo "パスワードを入力してください";
            
        }else
        //それ以外
        {
            $sql = $pdo -> prepare("INSERT INTO tbtest (name, str, posttime, pass) VALUES (:name, :str, :posttime, :pass)");
            $sql -> bindParam(':name', $name, PDO::PARAM_STR);
            $sql -> bindParam(':str', $str, PDO::PARAM_STR);
            $sql -> bindParam(':posttime', $posttime, PDO::PARAM_STR);
            $sql -> bindParam(':pass', $pass, PDO::PARAM_STR);            
            $name = $_POST["name"];
            $str = $_POST["str"]; //好きな名前、好きな言葉は自分で決めること
            $posttime = date("Y/m/d H:i:s");
            $pass = $_POST["pass"];
            $sql -> execute();
            
            echo "名前と国名を受信しました";
        }
    }
    
    //削除フォーム
    if(isset($_POST["deletebutton"])){
        
        $deletenumber = $_POST["delete"];
        $deletepass = $_POST["deletepass"];
        
        //削除番号とパスワードが入力されていないとき
        if(empty($_POST["delete"]) && empty($_POST["deletepass"])){
            
            echo "削除対象番号とパスワードを入力してください";
            
        }else
        //パスワードが入力されていないとき
        if(!empty($_POST["delete"]) && empty($_POST["deletepass"])){
            
            echo "パスワードを入力してください";
            
        }else
        //削除対象番号が入力されていないとき
        if(empty($_POST["delete"]) && !empty($_POST["deletepass"])){
            
            echo "削除対象番号を入力してください";
            
        }else
        //それ以外
        {
            
            $id = $_POST["delete"];
            $sql = 'delete from tbtest where id=:id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
            $results = $stmt->fetchALL();
            
            foreach($results as $row){
                $deletepass2 = $row['pass'];
            }
            
            //パスワードが一致したとき
            if($deletepass == $deletepass2){
                
                $id = $_POST["delete"];
                $sql = 'delete from tbtest where id =:id';
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                
                echo $deletenumber."番の名前とコメントを削除しました<hr>";
                
            }else
            //パスワードが一致しなかったとき
            {
                
                echo "<p>パスワードが違います<hr>";
                
            }
            
        }
    }
    
    //編集フォーム
    if(isset($_POST["editbutton"])){
        
        $editnumber = $_POST["edit"];
        $editpass = $_POST["editpass"];
        
        //編集対象番号とパスワードが入力されていないとき
        if(empty($_POST["edit"]) && empty($_POST["editpass"])){
            
            echo "編集対象番号とパスワードを入力してください";
            
        }else
        //パスワードが入力されていないとき
        if(!empty($_POST["edit"]) && empty($_POST["editpass"])){
            
            echo "パスワードを入力してください";
            
        }else
        //編集対象番号を入力してください
        if(empty($_POST["edit"]) && !empty($_POST["editpass"])){
            
            echo "編集対象番号を入力してください";
            
        }else
        //それ以外
        {
            
            $sql = 'SELECT * FROM tbtest WHERE id=:id ';                // SELECT文
            $stmt = $pdo->prepare($sql);                                // ←差し替えるパラメータを含めて記述したSQLを準備し、
            $stmt->bindParam(':id', $editnumber, PDO::PARAM_INT);    // ←その差し替えるパラメータの値を指定してから、
            $stmt->execute();                                           // ←SQLを実行する。
            $results = $stmt->fetchAll(); 
            
            foreach($results as $row){
                $editpass2 = $row['pass'];
                
            }
            
            //パスワードが一致したとき
            if($editpass == $editpass2){
                
                foreach($results as $row){
                    
                    $hiddennumber = $row['id'];
                    $editname = $row['name'];
                    $editstr = $row['str'];
                    $editpass3 = $row['pass'];
                    
                    echo $hiddennumber."番のコメントを編集しています";
                    echo "パスワードを変更しないときは、パスワード欄は空です";
                    
                }

            }else{
                
                echo "パスワードが違います";
                
            }
            
        }
    }
    
    if(isset($_POST["submitbutton"]) && !empty($_POST["editing"])){
        
        $id = $_POST["editing"];
        $name = $_POST["name"];
        $str = $_POST["str"];
        $posttime =  date("Y/m/d H:i:s");
        $pass = $_POST["pass"];
        $sql = 'UPDATE tbtest SET name=:name, str=:str, posttime=:posttime, pass=:pass WHERE id=:id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':str', $str, PDO::PARAM_STR);
        $stmt->bindParam(':posttime', $posttime, PDO::PARAM_STR);
        $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        echo $id."番のコメントを編集しました";
        
    }
    
    ?>
    
    <form action = "" method = "post">
        
        <div class = "list">
            
            <input type = "text" name = "name" placeholder = "名前" value = "<?php echo $editname; ?>" >
            
            <input type = "text" name = "str" placeholder = "国名" value = "<?php echo $editstr; ?>">
            
            <input type = "password" name = "pass" placeholder = "パスワード" value = "<?php echo $editpass; ?>">
            
            <input type = "submit" name = "submitbutton">
            
            <input type = "hidden" name = "editing" value = "<?php if(isset($_POST["editbutton"])){ echo $hiddennumber; } ?>" >
            
        </div>
        
    </form>
    
    <pre>
        
    </pre>
    
    削除フォーム
    <form action = "" method = "post">
        
        <dive class = "list">
            
            <input type = "number" name = "delete" placeholder = "削除対象番号">
            
            <input type = "password" name = "deletepass" placeholder = "パスワード">
            
            <input type = "submit" name = "deletebutton" value = "削除">
            
        </dive>
        
    </form>

    <pre>
        
    </pre>
    
    編集番号
    <form action = "" method = "post">
        
        <div class = "list">
            
            <input type = "number" name = "edit" placeholder = "編集対象番号">
            
            <input type = "password" name = "editpass" placeholder = "パスワード">
            
            <input type = "submit" name = "editbutton" value = "編集">
            
        </div>
        
    </form>
    
    <hr>
    
    <?php
    
        $sql = 'SELECT * FROM tbtest';
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();

        foreach ($results as $row){
        
        echo $row['id'];
        echo '<span style="color:hotpink">'.$row['name'].'</span>';
        echo $row['posttime'].'<br>';
        echo '<p style = "font-size:25px;">'."国名：".$row['str'].'</span>'.'</p>';

    }
    
    ?>

    </font>
    
    </body>
    
    </div>    
</html>