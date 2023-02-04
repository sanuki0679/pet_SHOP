<?php

// 関数ファイルを読み込む
require_once __DIR__ . '/functions.php';

//
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $keyword = filter_input(INPUT_GET, 'keyword');
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO - SELECT</title>
</head>

<body>
    <h2>本日のご紹介ペット</h2>

    <form action="" method="get">

        <input type="search" name="keyword">
        <input type="submit" name="submit" value="検索">
    </form>
    <div>
        <?php
        // データベースに接続
        $dbh = connect_db();
        $keyword_param = '%' . $keyword . '%';
        
        //$birthplace = $keyword;

        // SQL文の組み立て
        //$sql = 'SELECT * FROM animals';
        //$sql = 'SELECT * FROM animals WHERE description LIKE:keyword_param';
        $sql = 'SELECT * FROM animals WHERE description LIKE keyword_param = :keyword_param';
        //$sql = 'SELECT * FROM animals WHERE birthplace = :birthplace';
        
        // プリペアドステートメントの準備
        // $dbh->query($sql) でも良い
        $stmt = $dbh->prepare($sql);
        
        //$stmt->bindParam("keyword_param", $keyword_param, PDO::PARAM_STR);
        $stmt->bindParam("keyword_param", $keyword_param);
        //$stmt->bindParam("birthplace", $birthplace,PDO::PARAM_STR);

        // プリペアドステートメントの実行
        $stmt->execute();

        // 結果の受け取り
        $animals = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <?php foreach ($animals as $animals) : ?>
            <?= h($animals['type']) . 'の' . h($animals['classification']) . 'ちゃん' ?><br>
            <?= h($animals['description'])  ?><br>
            <?= h($animals['birthday']) . ' 生まれ'  ?><br>
            <?= '出身地 ' . h($animals['birthplace'])  ?><br>
            <hr width="100%">
        <?php endforeach; ?>

    </div>



</body>
