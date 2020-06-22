<?php include("./template-header-connection.php"); ?>
<?php
$bunka = $_GET['bunka'];

if ($bunka == "") {
    $bunka = null;
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
	gl_kakendb_anbunzumi.bunka = :bunka
  AND gl_kakendb.start_fy >= 2014
  AND gl_kakendb.start_fy <= 2017
GROUP BY
	gl_kakendb.institution
ORDER BY
	kensuu DESC,
  institutioncode";
$stmt_kensuu = $conn->prepare($sql_kensuu);
$stmt_kensuu->bindValue(":bunka", $bunka, PDO::PARAM_STR);
$stmt_kensuu->execute();
?>

  <?php include("./template-header-html.php"); ?>

  <div class="row">
    <div class="col-md-12">
      <h3>分科別</h3>
      <div class="alert alert-info">分科：
        <?php echo $bunka; ?>
      </div>
    </div>
  </div>
  <div class="row allCheck">
    <div class="col-md-6">
      <form class="form-horizontal" method="POST" action="./shumokusearch_bunkabetsu.php">
        <button type="submit" class="btn btn-primary">表示</button>
        <table class="table table-striped table-hover table-condensed">
          <input type="hidden" name="bunka" value="<?php echo $bunka; ?>">
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
      </form>
    </div>
    <div class="col-md-6">
    <hr>
    <h4>旧六大学</h4>
    <div>千葉/新潟/金沢/岡山/熊本/長崎</div>

      <form method="POST" action="./shumokusearch_bunkabetsu.php">
        <input type="hidden" name="kikanmei[]" value="千葉大学">
        <input type="hidden" name="kikanmei[]" value="新潟大学">
        <input type="hidden" name="kikanmei[]" value="金沢大学">
        <input type="hidden" name="kikanmei[]" value="岡山大学">
        <input type="hidden" name="kikanmei[]" value="熊本大学">
        <input type="hidden" name="kikanmei[]" value="長崎大学">
        <input type="hidden" name="bunka" value="<?php echo $bunka; ?>">
        <button type="submit" class="btn btn-default">検索</button>
      </form>
    <hr>
    <h4>新潟県内の大学</h4>
      <form method="POST" action="./shumokusearch_bunkabetsu.php">
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
        <input type="hidden" name="bunka" value="<?php echo $bunka; ?>">
        <button type="submit" class="btn btn-default">検索</button>
      </form>
        <hr>
        <h4>新潟大学＋旧帝大</h4>
        <form method="POST" action="./shumokusearch_bunkabetsu.php">
            <input type="hidden" name="kikanmei[]" value="新潟大学">
            <input type="hidden" name="kikanmei[]" value="北海道大学">
            <input type="hidden" name="kikanmei[]" value="東北大学">
            <input type="hidden" name="kikanmei[]" value="東京大学">
            <input type="hidden" name="kikanmei[]" value="名古屋大学">
            <input type="hidden" name="kikanmei[]" value="京都大学">
            <input type="hidden" name="kikanmei[]" value="大阪大学">
            <input type="hidden" name="kikanmei[]" value="九州大学">
            <input type="hidden" name="bunka" value="<?php echo $bunka; ?>">
            <button type="submit" class="btn btn-default">検索</button>
        </form>
      <hr>
      <h4>パターン１</h4>
      <div>千葉/新潟/金沢/岡山/熊本/神戸/埼玉</div>
      <form method="POST" action="./shumokusearch_bunkabetsu.php">
      <input type="hidden" name="kikanmei[]" value="新潟大学">
      <input type="hidden" name="kikanmei[]" value="熊本大学">
      <input type="hidden" name="kikanmei[]" value="千葉大学">
      <input type="hidden" name="kikanmei[]" value="岡山大学">
      <input type="hidden" name="kikanmei[]" value="金沢大学">
      <input type="hidden" name="kikanmei[]" value="神戸大学">
      <input type="hidden" name="kikanmei[]" value="埼玉大学">
      <input type="hidden" name="bunka" value="<?php echo $bunka; ?>">
        <button type="submit" class="btn btn-default">検索</button>
      </form>
      <hr>
      <h4>パターン２</h4>
      <div>新潟/金沢/岡山/千葉/お茶の水女子/奈良女子/神戸/熊本</div>
      <form method="POST" action="./shumokusearch_bunkabetsu.php">
      <input type="hidden" name="kikanmei[]" value="新潟大学">
      <input type="hidden" name="kikanmei[]" value="熊本大学">
      <input type="hidden" name="kikanmei[]" value="千葉大学">
      <input type="hidden" name="kikanmei[]" value="岡山大学">
      <input type="hidden" name="kikanmei[]" value="金沢大学">
      <input type="hidden" name="kikanmei[]" value="神戸大学">
      <input type="hidden" name="kikanmei[]" value="お茶の水女子大学">
      <input type="hidden" name="kikanmei[]" value="奈良女子大学">
      <input type="hidden" name="bunka" value="<?php echo $bunka; ?>">
        <button type="submit" class="btn btn-default">検索</button>
      </form>
      <hr>
      <h4>パターン３</h4>
      <div>新潟/千葉/岡山/熊本/山形/富山/埼玉/静岡</div>
      <form method="POST" action="./shumokusearch_bunkabetsu.php">
      <input type="hidden" name="kikanmei[]" value="新潟大学">
      <input type="hidden" name="kikanmei[]" value="千葉大学">
      <input type="hidden" name="kikanmei[]" value="岡山大学">
      <input type="hidden" name="kikanmei[]" value="熊本大学">
      <input type="hidden" name="kikanmei[]" value="山形大学">
      <input type="hidden" name="kikanmei[]" value="富山大学">
      <input type="hidden" name="kikanmei[]" value="埼玉大学">
      <input type="hidden" name="kikanmei[]" value="静岡大学">
      <input type="hidden" name="bunka" value="<?php echo $bunka; ?>">
        <button type="submit" class="btn btn-default">検索</button>
      </form>
      <hr>
      <h4>パターン４</h4>
      <div>新潟/金沢/岡山/千葉/神戸/愛媛/熊本/筑波/広島/静岡/東京工業/東北</div>
      <form method="POST" action="./shumokusearch_bunkabetsu.php">
      <input type="hidden" name="kikanmei[]" value="新潟大学">
      <input type="hidden" name="kikanmei[]" value="金沢大学">
      <input type="hidden" name="kikanmei[]" value="岡山大学">
      <input type="hidden" name="kikanmei[]" value="千葉大学">
      <input type="hidden" name="kikanmei[]" value="神戸大学">
      <input type="hidden" name="kikanmei[]" value="愛媛大学">
      <input type="hidden" name="kikanmei[]" value="熊本大学">
      <input type="hidden" name="kikanmei[]" value="筑波大学">
      <input type="hidden" name="kikanmei[]" value="広島大学">
      <input type="hidden" name="kikanmei[]" value="静岡大学">
      <input type="hidden" name="kikanmei[]" value="東京工業大学">
      <input type="hidden" name="kikanmei[]" value="東北大学">
      <input type="hidden" name="bunka" value="<?php echo $bunka; ?>">
        <button type="submit" class="btn btn-default">検索</button>
      </form>
      <hr>
    </div>
  </div>

  <?php include("./template-footer.php"); ?>