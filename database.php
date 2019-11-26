<h3>変更前</h3>
<table border="1">
    <tr>
        <th>名前</th>
        <th>価格</th>
    </tr>
    <?php
    $pdo = new PDO("mysql:dbname=men", "root");
    $st = $pdo->query("SELECT * FROM udon");
    while ($row = $st->fetch()) {
        $name = htmlspecialchars($row['name']);
        $price = htmlspecialchars($row['price']);
        echo "<tr><td>$name</td><td>$price 円</td></tr>";
    }
    ?>
</table>

<?php
$pdo = new PDO("mysql:dbname=men", "root");
if (isset($_POST['insert'])) {
    $st = $pdo->prepare("INSERT INTO udon VALUES(?,?)");
    $st->execute(array($_POST['name'], $_POST['price']));
    echo "<br>", "レコードを追加", "<br>";
}
if (isset($_POST['update'])) {
    $st = $pdo->prepare("UPDATE udon SET name=?,price=? WHERE name=?");
    $st->execute(array($_POST['name'], $_POST['price'], $_POST['old_name']));
    echo "<br>", "レコードを更新", "<br>";
}
if (isset($_GET['type'])) {
    $pdo = new PDO("mysql:dbname=men", "root");
    $st = $pdo->prepare("DELETE FROM udon WHERE name=?");
    $st->execute(array($_GET['name']));
    echo "<br>", "レコードを削除", "<br>";
}
?>

<h3>変更後</h3>
<table border="1">
    <tr>
        <th>名前</th>
        <th>価格</th>
    </tr>
    <?php
    $pdo = new PDO("mysql:dbname=men", "root");
    $st = $pdo->query("SELECT * FROM udon");
    while ($row = $st->fetch()) {
        $name = htmlspecialchars($row['name']);
        $price = htmlspecialchars($row['price']);
        echo "<tr><td>$name</td><td>$price 円</td></tr>";
    }
    ?>
</table>