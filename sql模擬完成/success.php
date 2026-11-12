<?php
session_start();
echo "login success<br>";
echo "username:".$_SESSION["username"];
echo "<br>password:".$_SESSION["password"]."<br>";

ini_set("display_errors","on");
$mysql ='mysql:host=localhost;dbname=test;charset=utf8';
$mysqluser='test2';
$mysqlpass='password';
$mysql_connect= new PDO($mysql,$mysqluser,$mysqlpass);

$user=$_SESSION["username"];
$pass=$_SESSION["password"];

$sql ="select * from test where name='".$user."' and pass='".$pass."';";
echo $sql;
$mysqlinfo=$mysql_connect->prepare($sql);
//var_dump($mysqlinfo);
$mysqlinfo->execute();
//var_dump($mysqlinfo);
// 検索結果を連想配列で全件取得
$results = $mysqlinfo->fetchAll(PDO::FETCH_ASSOC);
//var_dump($results);
//<!-- 検索結果の数だけHTMLの表を出力 -->
?>
<?php if (count($results) > 0): ?>
    <table border="1">
        <thead>
            <tr>
                <!-- カラム名を見出しとして出力 -->
                <?php foreach (array_keys($results[0]) as $columnName): ?>
                    <th><?= $columnName ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <!-- 取得した行数分ループ -->
            <?php foreach ($results as $row): ?>
                <tr>
                    <?php foreach ($row as $value): ?>
                        <td><?= $value ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>検索結果は0件でした。</p>
<?php endif; ?>
