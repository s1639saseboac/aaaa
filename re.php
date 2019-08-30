<html>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <head><title>schedule_page</title>
    </head>
    <body class="container">
    <?php
            ini_set('display_errors', "On");
            try {
            
                $pdo = new PDO('mysql:host=localhost;dbname=test;charset=utf8','root','1235',
                array(PDO::ATTR_EMULATE_PREPARES => false));
        
            } catch (PDOException $e) {
            
                exit('データベース接続失敗。'.$e->getMessage());
            
            }

            $stmt=$pdo->query("select * from rireki order by sche_time asc");
    ?>

    <p id="RealtimeClockArea"></p>
            <table class="table" border="1">
                <tr>
                <th>No.</th>
                <th>予定</th>
                <th>登録日</th>
                <th>予定日</th>
                <th>削除</th>
                <th>発信</th>
                </tr>
    <?php
            while($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {

                $schedule_id = $row["id_r"];
                $schedule_contents = $row["contents"];
                $schedule_set_time = $row["set_time"];
                $schedule_sche_time = $row["sche_time"];

    ?>
                
                <tr>
    <?php
                echo "<td>".$schedule_id."</td><td>".$schedule_contents."</td><td>".$schedule_set_time."</td><td>".$schedule_sche_time."</td>";
    ?>
                <td>
                <form action="./re_del.php" method="post">
                     <input type='submit' class="btn" value='削除' style="background-color:#d1530a" onmouseover="this.style.background='#d10a0a'
                        " onmouseout="this.style.background='#d1530a'"/>
                     <input type="hidden" name="id_r" value="<?php echo $row['id_r']; ?>"/>
               </form>
                </td>

                <td>
                <form id="schedule<?php echo $row["id"] ?>" action="make_call.php" method="post" >
                     <input type='submit'value='追加'class="btn" id='call' style="background-color:#b1ff99" onmouseover="this.style.background='#3ae06c'
                        " onmouseout="this.style.background='#b1ff99'"/>
                        <input type="hidden" name="schedule" value="<?php echo $row["contents"];?>"/>
                        <input type="hidden" name="sche_time" value="<?php echo $row["sche_time"]; ?>"/>
               </form>
                </td>
            </tr>
    <?php    } ?>
               
            </table>

    <hr/><p><a href='app1.php'>戻る</a></p>
            
</html>