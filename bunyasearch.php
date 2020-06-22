<?php include("./template-header-connection.php"); ?>
<?php
$bunya = $_GET['bunya'];

if ($bunya == "") {
    $bunya = null;
}

//件数
$sql_kensuu = "SELECT
	gl_kakendb.institution AS kikanmei,
	gl_kakendb.institutioncode,
	SUM(
		gl_kakendb_anbunzumi.kensuu
	) AS kensuu
FROM
	gl_kakendb
	LEFT OUTER JOIN gl_kakendb_anbunzumi USING (awardNumber)
WHERE
	gl_kakendb_anbunzumi.bunya = :bunya
  AND gl_kakendb.start_fy >= 2014
  AND gl_kakendb.start_fy <= 2017
GROUP BY
	gl_kakendb.institution
ORDER BY
	kensuu DESC,
  institutioncode";
$stmt_kensuu = $conn->prepare($sql_kensuu);
$stmt_kensuu->bindValue(":bunya", $bunya, PDO::PARAM_STR);
$stmt_kensuu->execute();
?>

  <?php include("./template-header-html.php"); ?>

  <div class="row">
    <div class="col-md-12">
      <h3>分野別</h3>
      <div class="alert alert-info">分野：
        <?php echo $bunya; ?>
      </div>
    </div>
  </div>
  <div class="row allCheck">
    <form class="form-horizontal" method="POST" action="./shumokusearch_bunyabetsu.php">
      <div class="col-md-6">
        <button type="submit" class="btn btn-primary">表示</button>
        <table class="table table-striped table-hover table-condensed">
          <input type="hidden" name="bunya" value="<?php echo $bunya; ?>">
          <div class="form-group">
            <tr>
              <th>研究機関名</th>
              <th style="text-align: right">件数</th>
            </tr>
            <?php
            while ($row_kensuu = $stmt_kensuu->fetch()) {
                echo "<tr>";
                echo "<td>
                        <div class=\"checkbox\">
                          <label>
                            <input type=\"checkbox\" name=\"kikanmei[]\" value=\""
                             . $row_kensuu["kikanmei"]
                             . "\">"
                             . $row_kensuu["kikanmei"]
                             . "</label></div></td>";
                echo "<td style=\"text-align: right\">" . number_format($row_kensuu["kensuu"], 1) . "</td>";
                echo "</tr>";
            }
        ?>
          </div>
        </table>
      </div>
    </form>
    <div class="col-md-6">
      <form method="POST" action="./shumokusearch_bunyabetsu.php">
        <input type="hidden" name="kikanmei[]" value="千葉大学">
        <input type="hidden" name="kikanmei[]" value="新潟大学">
        <input type="hidden" name="kikanmei[]" value="金沢大学">
        <input type="hidden" name="kikanmei[]" value="岡山大学">
        <input type="hidden" name="kikanmei[]" value="熊本大学">
        <input type="hidden" name="kikanmei[]" value="長崎大学">
        <input type="hidden" name="bunya" value="<?php echo $bunya; ?>">
        <button type="submit" class="btn btn-default">旧六大学</button>
      </form>
      <form method="POST" action="./shumokusearch_bunyabetsu.php">
        <input type="hidden" name="kikanmei[]" value="敬和学園大学">
        <input type="hidden" name="kikanmei[]" value="国際大学">
        <input type="hidden" name="kikanmei[]" value="事業創造大学院大学">
        <input type="hidden" name="kikanmei[]" value="上越教育大学">
        <input type="hidden" name="kikanmei[]" value="長岡技術科学大学">
        <input type="hidden" name="kikanmei[]" value="長岡造形大学">
        <input type="hidden" name="kikanmei[]" value="長岡大学">
        <input type="hidden" name="kikanmei[]" value="新潟医療福祉大学">
        <input type="hidden" name="kikanmei[]" value="新潟経営大学">
        <input type="hidden" name="kikanmei[]" value="新潟県立看護大学">
        <input type="hidden" name="kikanmei[]" value="新潟県立大学">
        <input type="hidden" name="kikanmei[]" value="新潟工科大学">
        <input type="hidden" name="kikanmei[]" value="新潟国際情報大学">
        <input type="hidden" name="kikanmei[]" value="新潟産業大学">
        <input type="hidden" name="kikanmei[]" value="新潟青陵大学">
        <input type="hidden" name="kikanmei[]" value="新潟大学">
        <input type="hidden" name="kikanmei[]" value="新潟薬科大学">
        <input type="hidden" name="kikanmei[]" value="新潟リハビリテーション大学">
        <input type="hidden" name="kikanmei[]" value="日本歯科大学">
        <input type="hidden" name="kikanmei[]" value="長岡工業高等専門学校">
        <input type="hidden" name="kikanmei[]" value="新潟県立歴史博物館">
        <input type="hidden" name="bunya" value="<?php echo $bunya; ?>">
        <button type="submit" class="btn btn-default">新潟県内の大学</button>
      </form>
        <form method="POST" action="./shumokusearch_bunyabetsu.php">
            <input type="hidden" name="kikanmei[]" value="新潟大学">
            <input type="hidden" name="kikanmei[]" value="北海道大学">
            <input type="hidden" name="kikanmei[]" value="東北大学">
            <input type="hidden" name="kikanmei[]" value="東京大学">
            <input type="hidden" name="kikanmei[]" value="名古屋大学">
            <input type="hidden" name="kikanmei[]" value="京都大学">
            <input type="hidden" name="kikanmei[]" value="大阪大学">
            <input type="hidden" name="kikanmei[]" value="九州大学">
            <input type="hidden" name="bunya" value="<?php echo $bunya; ?>">
            <button type="submit" class="btn btn-default">新潟大学＋旧帝大</button>
        </form>
    </div>
  </div>


  <?php include("./template-footer.php"); ?>