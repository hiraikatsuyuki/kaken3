<?php include("./template-header-connection.php"); ?>
<?php
$saimoku = $_POST['saimoku'];
$kikanmei = $_POST['kikanmei'];

if ($saimoku == "") {
    echo "<div class=\"alert alert-info\">細目を指定してください。</div>";
    exit;
}

$inClause = substr(str_repeat(',?', count($kikanmei)), 1);

$sql_kensuu = "SELECT
	gl_kakendb.institution AS kikanmei,
	SUM(
		CASE WHEN gl_kakendb.category = '基盤研究(S)' THEN gl_kakendb_anbunzumi.kensuu ELSE '' END
	) AS kibanS,
	SUM(
		CASE WHEN gl_kakendb.category = '基盤研究(A)' THEN gl_kakendb_anbunzumi.kensuu ELSE '' END
	) AS kibanA,
	SUM(
		CASE WHEN gl_kakendb.category = '基盤研究(B)' THEN gl_kakendb_anbunzumi.kensuu ELSE '' END
	) AS kibanB,
	SUM(
		CASE WHEN gl_kakendb.category = '基盤研究(C)' THEN gl_kakendb_anbunzumi.kensuu ELSE '' END
	) AS kibanC,
	SUM(
		CASE WHEN gl_kakendb.category = '若手研究(A)' THEN gl_kakendb_anbunzumi.kensuu ELSE '' END
	) AS wakateA,
	SUM(
		CASE WHEN gl_kakendb.category = '若手研究(B)' THEN gl_kakendb_anbunzumi.kensuu ELSE '' END
	) AS wakateB,
	SUM(
		CASE WHEN gl_kakendb.category = '挑戦的萌芽研究' THEN gl_kakendb_anbunzumi.kensuu ELSE '' END
	) AS houga,
	SUM(
		gl_kakendb_anbunzumi.kensuu
	) AS goukei
FROM
	gl_kakendb
	LEFT OUTER JOIN gl_kakendb_anbunzumi USING (awardNumber)
WHERE
    gl_kakendb_anbunzumi.saimoku = ?
    AND gl_kakendb.start_fy >= 2014
    AND gl_kakendb.start_fy <= 2017 ";
$sql_kensuu .= sprintf("AND gl_kakendb.institution IN (%s)", $inClause);
$sql_kensuu .= "GROUP BY
	gl_kakendb.institution
ORDER BY
	goukei DESC";

$stmt_kensuu = $conn->prepare($sql_kensuu);
$value = array_merge(
	array($saimoku),
	$kikanmei
);
$stmt_kensuu->execute($value);

$sql_kingaku = "SELECT
	gl_kakendb.institution AS kikanmei,
	SUM(
		CASE WHEN gl_kakendb.category = '基盤研究(S)' THEN gl_kakendb_anbunzumi.directcost ELSE '' END
	) AS kibanS,
	SUM(
		CASE WHEN gl_kakendb.category = '基盤研究(A)' THEN gl_kakendb_anbunzumi.directcost ELSE '' END
	) AS kibanA,
	SUM(
		CASE WHEN gl_kakendb.category = '基盤研究(B)' THEN gl_kakendb_anbunzumi.directcost ELSE '' END
	) AS kibanB,
	SUM(
		CASE WHEN gl_kakendb.category = '基盤研究(C)' THEN gl_kakendb_anbunzumi.directcost ELSE '' END
	) AS kibanC,
	SUM(
		CASE WHEN gl_kakendb.category = '若手研究(A)' THEN gl_kakendb_anbunzumi.directcost ELSE '' END
	) AS wakateA,
	SUM(
		CASE WHEN gl_kakendb.category = '若手研究(B)' THEN gl_kakendb_anbunzumi.directcost ELSE '' END
	) AS wakateB,
	SUM(
		CASE WHEN gl_kakendb.category = '挑戦的萌芽研究' THEN gl_kakendb_anbunzumi.directcost ELSE '' END
	) AS houga,
	SUM(
		gl_kakendb_anbunzumi.directcost
	) AS goukei
FROM
	gl_kakendb
	LEFT OUTER JOIN gl_kakendb_anbunzumi USING (awardNumber)
WHERE
    gl_kakendb_anbunzumi.saimoku = ?
    AND gl_kakendb.start_fy >= 2014
    AND gl_kakendb.start_fy <= 2017 ";
$sql_kingaku .= sprintf("AND gl_kakendb.institution IN (%s)", $inClause);
$sql_kingaku .= "GROUP BY
	gl_kakendb.institution
ORDER BY
	goukei DESC";
$stmt_kingaku = $conn->prepare($sql_kingaku);
$value = array_merge(
	array($saimoku),
	$kikanmei
);
$stmt_kingaku->execute($value);
?>

    <?php include("./template-header-html.php"); ?>

    <div class="row">
        <h3>研究種目別</h3>
        <div class="alert alert-info">細目：
            <?php echo $saimoku; ?>
        </div>
    </div>
    <div class="row">
        <hr>
        <div class="col-md-6">
      <h4>件数</h4>
            <table class="table table-striped">
                <tr>
                    <th>大学名</th>
                    <th style="text-align: right">基S</th>
                    <th style="text-align: right">基A</th>
                    <th style="text-align: right">基B</th>
                    <th style="text-align: right">基C</th>
                    <th style="text-align: right">若A</th>
                    <th style="text-align: right">若B</th>
                    <th style="text-align: right">萌芽</th>
                    <th style="text-align: right">合計</th>
                </tr>
                <?php
                $kikanmei = [];
                $kensuu_kibanS = [];
                $kensuu_kibanA = [];
                $kensuu_kibanB = [];
                $kensuu_kibanC = [];
                $kensuu_wakateA = [];
                $kensuu_wakateB = [];
                $kensuu_houga = [];
                $removallist = array('大学', '共同利用機関法人', '国立研究開発法人', '公益財団法人', '一般財団法人');
                $row_kensuu = [];
                while ($row_kensuu = $stmt_kensuu->fetch()) {
                    $replace_kikanmei = str_replace($removallist, '', $row_kensuu["kikanmei"]);
                    echo "<tr>";
                    echo "<td>" . $replace_kikanmei . "</td>";
                    echo "<td style=\"text-align: right\"><a href=\"./kadaisearch.php?saimoku=" . $saimoku .  "&shumoku=基盤研究(S)&kikanmei=" . $row_kensuu["kikanmei"] . "\">" . $row_kensuu["kibanS"] . "</td>";
                    echo "<td style=\"text-align: right\"><a href=\"./kadaisearch.php?saimoku=" . $saimoku .  "&shumoku=基盤研究(A)&kikanmei=" . $row_kensuu["kikanmei"] . "\">" . $row_kensuu["kibanA"] . "</td>";
                    echo "<td style=\"text-align: right\"><a href=\"./kadaisearch.php?saimoku=" . $saimoku .  "&shumoku=基盤研究(B)&kikanmei=" . $row_kensuu["kikanmei"] . "\">" . $row_kensuu["kibanB"] . "</td>";
                    echo "<td style=\"text-align: right\"><a href=\"./kadaisearch.php?saimoku=" . $saimoku .  "&shumoku=基盤研究(C)&kikanmei=" . $row_kensuu["kikanmei"] . "\">" . $row_kensuu["kibanC"] . "</td>";
                    echo "<td style=\"text-align: right\"><a href=\"./kadaisearch.php?saimoku=" . $saimoku .  "&shumoku=若手研究(A)&kikanmei=" . $row_kensuu["kikanmei"] . "\">" . $row_kensuu["wakateA"] . "</td>";
                    echo "<td style=\"text-align: right\"><a href=\"./kadaisearch.php?saimoku=" . $saimoku .  "&shumoku=若手研究(B)&kikanmei=" . $row_kensuu["kikanmei"] . "\">" . number_format($row_kensuu["wakateB"], 1) . "</td>";
                    echo "<td style=\"text-align: right\"><a href=\"./kadaisearch.php?saimoku=" . $saimoku .  "&shumoku=挑戦的萌芽研究&kikanmei=" . $row_kensuu["kikanmei"] . "\">" . $row_kensuu["houga"] . "</td>";
                    echo "<th style=\"text-align: right\">" . number_format($row_kensuu["goukei"], 1) . "</th>";
                    echo "</tr>";
                    $kikanmei[] = mb_substr($replace_kikanmei, 0, 4, 'utf8');
                    $kensuudata[] = number_format($row_kensuu["kensuu"], 1);
                    $kensuu_kibanS[] = $row_kensuu["kibanS"];
                    $kensuu_kibanA[] = $row_kensuu["kibanA"];
                    $kensuu_kibanB[] = $row_kensuu["kibanB"];
                    $kensuu_kibanC[] = $row_kensuu["kibanC"];
                    $kensuu_wakateA[] = $row_kensuu["wakateA"];
                    $kensuu_wakateB[] = $row_kensuu["wakateB"];
                    $kensuu_houga[] = $row_kensuu["houga"];
                }
                $kikanmei_json = json_encode($kikanmei, JSON_UNESCAPED_UNICODE);
                $kensuu_kibanS_json = json_encode($kensuu_kibanS);
                $kensuu_kibanA_json = json_encode($kensuu_kibanA);
                $kensuu_kibanB_json = json_encode($kensuu_kibanB);
                $kensuu_kibanC_json = json_encode($kensuu_kibanC);
                $kensuu_wakateA_json = json_encode($kensuu_wakateA);
                $kensuu_wakateB_json = json_encode($kensuu_wakateB);
                $kensuu_houga_json = json_encode($kensuu_houga);
        ?>
            </table>
        </div>

        <div class="col-md-6">
            <canvas id="kensuuChart"></canvas>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
            <script>
                var ctx = document.getElementById("kensuuChart");
                var kensuuChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: <?php echo $kikanmei_json ?>,
                        datasets: [
                        {
                            label: "基盤S",
                            backgroundColor : "#f0e0c0",
                            data: <?php echo $kensuu_kibanS_json ?>
                        },
                        {
                            label: "基盤A",
                            backgroundColor : "#d0f0c0",
                            data: <?php echo $kensuu_kibanA_json ?>
                        },
                        {
                            label: "基盤B",
                            backgroundColor : "#c0f0e0",
                            data: <?php echo $kensuu_kibanB_json ?>
                        },
                        {
                            label: "基盤C",
                            backgroundColor : "#c0d0f0",
                            data: <?php echo $kensuu_kibanC_json ?>
                        },
                        {
                            label: "若手A",
                            backgroundColor : "#e0c0f0",
                            data: <?php echo $kensuu_wakateA_json ?>
                        },
                        {
                            label: "若手B",
                            backgroundColor : "#f0c0d0",
                            data: <?php echo $kensuu_wakateB_json ?>
                        },
                        {
                            label: "萌芽",
                            backgroundColor : "#f0c8c0",
                            data: <?php echo $kensuu_houga_json ?>
                        }
                    ]
                    },
                    options: {
                        animation: {
                            animateRotate: true
                        },
                        scales: {
                            xAxes: [{
                                stacked: true
                            }],
                            yAxes: [{
                                stacked: true,
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            </script>
        </div>
    </div>

    <div class="row">
        <hr>
        <div class="col-md-6">
      <h4>金額（単位：百万円）</h4>
            <table class="table table-striped">
                <tr>
                    <th>大学名</th>
                    <th style="text-align: right">基S</th>
                    <th style="text-align: right">基A</th>
                    <th style="text-align: right">基B</th>
                    <th style="text-align: right">基C</th>
                    <th style="text-align: right">若A</th>
                    <th style="text-align: right">若B</th>
                    <th style="text-align: right">萌芽</th>
                    <th style="text-align: right">合計</th>
                </tr>
                <?php
                $kikanmei = [];
                $kingaku_kibanS = [];
                $kingaku_kibanA = [];
                $kingaku_kibanB = [];
                $kingaku_kibanC = [];
                $kingaku_wakateA = [];
                $kingaku_wakateB = [];
                $kingaku_houga = [];
                $row_kingaku = [];
                while ($row_kingaku = $stmt_kingaku->fetch()) {
                    $replace_kikanmei = str_replace($removallist, '', $row_kingaku["kikanmei"]);
                    echo "<tr>";
                    echo "<td>" . $replace_kikanmei . "</td>";
                    echo "<td style=\"text-align: right\">" . number_format($row_kingaku["kibanS"]/1000000, 0) . "</td>";
                    echo "<td style=\"text-align: right\">" . number_format($row_kingaku["kibanA"]/1000000, 0) . "</td>";
                    echo "<td style=\"text-align: right\">" . number_format($row_kingaku["kibanB"]/1000000, 0) . "</td>";
                    echo "<td style=\"text-align: right\">" . number_format($row_kingaku["kibanC"]/1000000, 0) . "</td>";
                    echo "<td style=\"text-align: right\">" . number_format($row_kingaku["wakateA"]/1000000, 0) . "</td>";
                    echo "<td style=\"text-align: right\">" . number_format($row_kingaku["wakateB"]/1000000, 0) . "</td>";
                    echo "<td style=\"text-align: right\">" . number_format($row_kingaku["houga"]/1000000, 0) . "</td>";
                    echo "<th style=\"text-align: right\">" . number_format($row_kingaku["goukei"]/1000000, 0) . "</th>";
                    echo "</tr>";
                    $kikanmei[] = mb_substr($replace_kikanmei, 0, 4, 'utf8');
                    $kingaku_kibanS[] = floor($row_kingaku["kibanS"]/1000000);
                    $kingaku_kibanA[] = floor($row_kingaku["kibanA"]/1000000);
                    $kingaku_kibanB[] = floor($row_kingaku["kibanB"]/1000000);
                    $kingaku_kibanC[] = floor($row_kingaku["kibanC"]/1000000);
                    $kingaku_wakateA[] = floor($row_kingaku["wakateA"]/1000000);
                    $kingaku_wakateB[] = floor($row_kingaku["wakateB"]/1000000);
                    $kingaku_houga[] = floor($row_kingaku["houga"]/1000000);
                }
                $kikanmei_json = json_encode($kikanmei, JSON_UNESCAPED_UNICODE);
                $kingaku_kibanS_json = json_encode($kingaku_kibanS);
                $kingaku_kibanA_json = json_encode($kingaku_kibanA);
                $kingaku_kibanB_json = json_encode($kingaku_kibanB);
                $kingaku_kibanC_json = json_encode($kingaku_kibanC);
                $kingaku_wakateA_json = json_encode($kingaku_wakateA);
                $kingaku_wakateB_json = json_encode($kingaku_wakateB);
                $kingaku_houga_json = json_encode($kingaku_houga);
                ?>
            </table>
        </div>

        <div class="col-md-6">
            <canvas id="kingakuChart"></canvas>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
            <script>
                var ctx = document.getElementById("kingakuChart");
                var kingakuChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: <?php echo $kikanmei_json ?>,
                        datasets: [
                        {
                            label: "基盤S",
                            backgroundColor : "#f0e0c0",
                            data: <?php echo $kingaku_kibanS_json ?>
                        },
                        {
                            label: "基盤A",
                            backgroundColor : "#d0f0c0",
                            data: <?php echo $kingaku_kibanA_json ?>
                        },
                        {
                            label: "基盤B",
                            backgroundColor : "#c0f0e0",
                            data: <?php echo $kingaku_kibanB_json ?>
                        },
                        {
                            label: "基盤C",
                            backgroundColor : "#c0d0f0",
                            data: <?php echo $kingaku_kibanC_json ?>
                        },
                        {
                            label: "若手A",
                            backgroundColor : "#e0c0f0",
                            data: <?php echo $kingaku_wakateA_json ?>
                        },
                        {
                            label: "若手B",
                            backgroundColor : "#f0c0d0",
                            data: <?php echo $kingaku_wakateB_json ?>
                        },
                        {
                            label: "萌芽",
                            backgroundColor : "#f0c8c0",
                            data: <?php echo $kingaku_houga_json ?>
                        }
                    ]
                    },
                    options: {
                        animation: {
                            animateRotate: true
                        },
                        scales: {
                            xAxes: [{
                                stacked: true
                            }],
                            yAxes: [{
                                stacked: true,
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            </script>
        </div>

    </div>
    <?php include("./template-footer.php"); ?>
