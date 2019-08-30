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

            $stmt=$pdo->query("select * from schedule order by sche_time asc");
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

                $schedule_id = $row["id"];
                $schedule_contents = $row["contents"];
                $schedule_set_time = $row["set_time"];
                $schedule_sche_time = $row["sche_time"];

    ?>
                
                <tr>
    <?php
                echo "<td>".$schedule_id."</td><td>".$schedule_contents."</td><td>".$schedule_set_time."</td><td>".$schedule_sche_time."</td>";
    ?>
                <td>
                <form action="./del.php" method="post">
                     <input type='submit' class="btn" value='削除' style="background-color:#d1530a" onmouseover="this.style.background='#d10a0a'
                        " onmouseout="this.style.background='#d1530a'"/>
                     <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
                     <input type="hidden" name="contents" value="<?php echo $row["contents"]; ?>"/>
                     <input type="hidden" name="set_time" value="<?php echo $row["set_time"]; ?>"/>
                     <input type="hidden" name="sche_time" value="<?php echo $row["sche_time"]; ?>"/>
               </form>
                </td>

                <td>
                <form id="schedule<?php echo $row["id"] ?>" action="make_call.php" method="post" >
                     <input type='submit'value='Call'class="btn" id='call' style="background-color:#b1ff99" onmouseover="this.style.background='#3ae06c'
                        " onmouseout="this.style.background='#b1ff99'"/>
                        <input type="hidden" name="schedule" value="<?php echo $row["contents"];?>"/>
                        <input type="hidden" name="sche_time" value="<?php echo $row["sche_time"]; ?>"/>
               </form>
                </td>
            </tr>
    <?php    } ?>
               
            </table>
            
        

        <br/>
        <form action="enter.php" method="POST">
            <input type="datetime-local" name="sche_time"/><br/>
            <input type="text" name="schedule" placeholder="予定を入力"/>
            <input type="submit" value="確定"/>
            <input type="reset" value="取消"/>
        </form>

        <p><a href='re.php'>履歴</a></p>
    </body>



    <script>
        let test =<?php echo 123421421421; ?>;
        console.log(test);
        var btn = document.getElementById('call');
        var schedules=[];

        <?php
            ini_set('display_errors', "On");
            try {
            
                $pdo = new PDO('mysql:host=localhost;dbname=test;charset=utf8','root','1235',
                array(PDO::ATTR_EMULATE_PREPARES => false));
        
            } catch (PDOException $e) {
            
                exit('データベース接続失敗。'.$e->getMessage());
            
            }

            $stmt=$pdo->query("select * from schedule order by sche_time asc");
    

            while($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {

                $scheduleRow = $row;
                
        ?>       
                schedules.push(JSON.parse('<?php echo json_encode($scheduleRow) ?>'));
        <?php
            };
        ?>

        console.log(schedules);
        showClock2();
        function set2fig(num) { 
            // 桁数が1桁だったら先頭に0を加えて2桁に調整する
            var ret;
            if( num < 10 ) { ret = "0" + num; }
            else { ret = num; }
            return ret;
        }
        function showClock2() {
            var nowDate_time = new Date();
            var nowYear = nowDate_time.getFullYear();
            var nowmonth = nowDate_time.getMonth()+1;
            var nowweek = nowDate_time.getDay();
            var nowday = nowDate_time.getDate();
            var nowHour = set2fig( nowDate_time.getHours() );
            var nowMin  = set2fig( nowDate_time.getMinutes() );
            var nowSec  = set2fig( nowDate_time.getSeconds() );
            var yobi= ["日","月","火","水","木","金","土"];

            var nowmonth2 = set2fig(nowmonth);
            var nowday2 = set2fig(nowday);

            var msg = "西暦"+nowYear+"年"+nowmonth+"月"+nowday+"日 "+yobi[nowweek]+"曜日"+'<br>'+nowHour + ":" + nowMin + "'" + nowSec+"\"";
            var checked = nowYear + "-" + nowmonth2 + "-" + nowday2 + " " + nowHour + ":" + nowMin + ":" + nowSec;
            document.body.style.fontSize = "225%"; 
            document.getElementById("RealtimeClockArea").innerHTML = msg;

            console.log(checked);

            for(i=0;i < schedules.length ;i++){

                if((schedules[i]["sche_time"].indexOf(checked)) != -1){
                console.log(test);
                    //submit()でフォームの内容を送信
                document.getElementById(`schedule${schedules[i].id}`).submit();
                }
            }

            

        }
        setInterval(showClock2, 1000);
    </script>
</html>