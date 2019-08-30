<?php
echo "No.".$_POST["id"]."   削除完了";
?>
    <br/>
<?php
echo "<p><a href='app1.php'>戻る</a></p>";
try {
            
    $pdo = new PDO('mysql:host=localhost;dbname=test;charset=utf8','root','1235',
    array(PDO::ATTR_EMULATE_PREPARES => false));

} catch (PDOException $e) {

    exit('データベース接続失敗。'.$e->getMessage());

}
if(empty($_POST)){
    echo "<a href='app1.php'>戻る</a>";
}
else{
	if (!isset($_POST['id'])  || !is_numeric($_POST['id']) ){
		echo "IDエラー";
		exit();
    }
    else{
        $id = $_POST['id'];
        $contents = $_POST["contents"];
        $set_time = $_POST["set_time"];
        $sche_time = $_POST["sche_time"];

        echo $contents;
        echo $set_time;
        echo $sche_time;

        $pdo->query("delete from schedule where id=$id");
        $pdo->query("insert into rireki values(0,'$contents','$set_time','$sche_time');");
        }
    }
    header('Location: app1.php');
?>