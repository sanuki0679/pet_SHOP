<?php

// 関数ファイルを読み込む
require_once __DIR__ . '/functions.php';

// データベースに接続
$dbh = connect_db();

// SQL文の組み立て
$sql = 'SELECT * FROM animals';

// プリペアドステートメントの準備
// $dbh->query($sql) でも良い
$stmt = $dbh->prepare($sql);

// プリペアドステートメントの実行
$stmt->execute();

// 結果の受け取り
$animals = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <ul>
        <?php foreach ($animals as $animals): ?>
            <a><?= h($animals['type']) . 'の' . h($animals['classification']) . 'ちゃん' ?></a><br>
            <a><?= h($animals['description'])  ?></a><br>
            <a><?= h($animals['birthday']) . ' 生まれ'  ?></a><br>
            <a><?= '出身地 ' . h($animals['birthplace'])  ?></a><br>
            <hr width="100%">
        <?php endforeach; ?>
    </ul>
</body>
</hちゃん'
