<?php include("./template-header-connection.php"); ?>
<?php
$bunya = $_GET['bunya'];
$bunka = $_GET['bunka'];
$saimoku = $_GET['saimoku'];
$shumoku = $_GET['shumoku'];
$kikanmei = $_GET['kikanmei'];

if ($bunya == "") {
    $bunya = null;
}
if ($bunka == "") {
    $bunka = null;
}
if ($saimoku == "") {
    $saimoku = null;
}
if ($shumoku == "") {
    $shumoku = null;
}
if ($kikanmei == "") {
    $kikanmei = null;
}

$sql = "SELECT
	*
FROM
	gl_kakendb
	LEFT OUTER JOIN gl_kakendb_anbunzumi USING (awardNumber)
WHERE
	gl_kakendb_anbunzumi.bunya = COALESCE(:bunya, bunya)
	AND gl_kakendb_anbunzumi.bunka = COALESCE(:bunka, bunka)
  AND gl_kakendb_anbunzumi.saimoku = COALESCE(:saimoku, saimoku)
	AND gl_kakendb.category = COALESCE(:category, category)
	AND gl_kakendb.institution = COALESCE(:institution, institution)
  AND gl_kakendb.start_fy >= 2014
  AND gl_kakendb.start_fy <= 2017
ORDER BY
  bunka, saimoku";
$stmt = $conn->prepare($sql);
$stmt->bindValue(":bunya", $bunya, PDO::PARAM_STR);
$stmt->bindValue(":bunka", $bunka, PDO::PARAM_STR);
$stmt->bindValue(":saimoku", $saimoku, PDO::PARAM_STR);
$stmt->bindValue(":category", $shumoku, PDO::PARAM_STR);
$stmt->bindValue(":institution", $kikanmei, PDO::PARAM_STR);
$stmt->execute();
$rowcnt = $stmt->rowCount();
?>

  <?php include("./template-header-html.php"); ?>

  <div class="row">
    <h3>課題検索</h3>
    <div class="alert alert-info">
      <ul>
        <li>分野：
          <?php echo $bunya; ?>
        </li>
        <li>分科：
          <?php echo $bunka; ?>
        </li>
        <li>細目：
          <?php echo $saimoku; ?>
        </li>
        <li>種目：
          <?php echo $shumoku; ?>
        </li>
        <li>大学名：
          <?php echo $kikanmei; ?>
        </li>
      </ul>
    </div>
    <div class="alert alert-success">
      <?php echo $rowcnt; ?> 件 見つかりました</div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <table class="table table-striped">
        <caption>金額の単位は100万円です</caption>
        <tr>
          <th>大学名</th><th>種目</th><th>分野</th><th>分科</th><th>細目</th><th>金額</th><th>氏名</th><th>課題名</th><th></th>
        </tr>
        <?php
        while ($row = $stmt->fetch()) {
            echo "<tr>";
            echo "<td>" . $row["institution"] . "</td>";
            echo "<td>" . $row["category"] . "</td>";
            echo "<td>" . $row["bunya"] . "</td>";
            echo "<td>" . $row["bunka"] . "</td>";
            echo "<td>" . $row["saimoku"] . "</td>";
            echo "<td>" . number_format($row["directcost"]/1000000, 1) . "</td>";
            echo "<td>" . $row["fullName"] . "</td>";
            echo "<td width=20%>" . $row["title"] . "</td>";
            echo "<td><a href=\"https://kaken.nii.ac.jp/search/?qb=" . $row["awardNumber"]. "\" target=\"_blank\" class=\"btn btn-default btn-xs\">詳細</a>";
            echo "</tr>";
        }
        ?>
      </table>
    </div>
</div>
    <?php include("./template-footer.php"); ?>
