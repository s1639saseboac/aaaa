<?php
echo "No.".$_POST["id_r"]."   削除完了";
?>
    <br/>
<?php
echo "<p><a href='re.php'>戻る</a></p>";
try {
            
    $pdo = new PDO('mysql:host=localhost;dbname=test;charset=utf8','root','1235',
    array(PDO::ATTR_EMULATE_PREPARES => false));

} catch (PDOException $e) {

    exit('データベース接続失敗。'.$e->getMessage());

}
if(empty($_POST)){
    echo "<a href='re.php'>戻る</a>";
}
else{
	if (!isset($_POST['id_r'])  || !is_numeric($_POST['id_r']) ){
		echo "IDエラー";
		exit();
    }
    else{
        $id = $_POST['id_r'];
        $pdo->query("delete from rireki where id_r=$id");
        }
    }
    header('Location: re.php');
?>