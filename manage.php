<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>MANAGE DATABASE</title>
</head>

<body>
  <h6>データ挿入</h6>
  <form action="database.php" method="post">
    商品名<br />
    <input type="text" name="name" /><br />
    価格<br />
    <input type="text" name="price" /><br />
    <input type="submit" name="insert" />
  </form>

  <h6>データ更新</h6>
  <?php
  if (!isset($_GET['name'])) {
    ?>
    <table border="1">
      <tr>
        <th>名前</th>
        <th>価格</th>
        <th>操作</th>
      </tr>
      <?php
      $pdo = new PDO("mysql:dbname=men", "root");
      $st = $pdo->query("SELECT * FROM udon");
      while ($row = $st->fetch()) {
        $name = htmlspecialchars($row['name']);
        $price = htmlspecialchars($row['price']);
        echo "<tr><td>{$name}</td><td>", "{$price} 円</td><td>", "<a href='manage.php?name={$name}'>修正</a></td></tr>";
      }
      ?>
    </table>
  <?php
  }
  ?>
  <h6>データ削除</h6>
  <?php
  if (!isset($_GET['name'])) {
    ?>
    <table border="1">
      <tr>
        <th>名前</th>
        <th>価格</th>
        <th>操作</th>
      </tr>
      <?php
      $pdo = new PDO("mysql:dbname=men", "root");
      $st = $pdo->query("SELECT * FROM udon");
      while ($row = $st->fetch()) {
        $name = htmlspecialchars($row['name']);
        $price = htmlspecialchars($row['price']);
        echo "<tr><td>{$name}</td><td>", "{$price} 円</td><td>", "<a href='database.php?type=delete&name={$name}' onclick=\"return confirm('削除してよろしいですか？')\">削除</a></td></tr>";
        $type = "delete";
      }
      ?>
    </table>
  <?php
  }
  if (isset($_GET['name'])) {
    $name = htmlspecialchars($_GET['name']);
    $pdo = new PDO("mysql:dbname=men", "root");
    $st = $pdo->prepare("SELECT * FROM udon WHERE name=?");
    $st->execute(array($name));
    $row = $st->fetch();
    $price = htmlspecialchars($row['price']);
    ?>
    <form action="database.php" method="post">
      名前<br>
      <input type="text" name="name" value="<?php echo $name ?>"><br>
      価格<br>
      <input type="text" name="price" value="<?php echo $price ?>"><br>
      <input type="hidden" name="old_name" value="<?php echo $name ?>">
      <input type="submit" name="update">
    </form>
  <?php
  }
  ?>
</body>

</html>