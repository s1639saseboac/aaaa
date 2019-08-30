<html>
<?php
    echo $_POST["schedule"];
    echo $_POST["sche_time"];
?>
    <br/>
<?php
        try {

            $pdo = new PDO('mysql:host=localhost;dbname=test;charset=utf8','root','1235',
        array(PDO::ATTR_EMULATE_PREPARES => false));

            } catch (PDOException $e) {
                             exit('データベース接続失敗。'.$e->getMessage());
        }       

    $sche = $_POST["schedule"];
    $times=$_POST["sche_time"];

    $pdo->query("insert into schedule values(0,'$sche',now(),'$times');");
    echo "入力完了";

?>
         <br/>
    <?php
    echo "<a href='app1.php'>戻る</a>";
    header('Location: app1.php');
    ?>
</html>