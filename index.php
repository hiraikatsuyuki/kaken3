<?php include("./template-header-connection.php"); ?>
<?php include("./template-header-html.php"); ?>

<div class="row">
  <h3>分科別採択状況</h3>
  <div class="col-md-6">
    <form method="GET" action="./bunkasearch.php">
      <div class="form-group">
        <label>分科</label>
        <input type="text" name="bunka" class="form-control" id="shumokubetsu">
        <a href="#modalFade" id="modalTrigger" data-toggle="modal">分科を一覧から選択</a>
      </div>
      <button type="submit" class="btn btn-default">検索</button>
    </form>
    <hr>
    </div>

  <!-- modal dialog -->
  <div class="modal fade" id="modalFade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3>分科選択</h3>
        </div>
        <div class="modal-body row" id="bunka">
          <div class="col-md-12">
            <input type="text" class="form-control" id="sentakuShumoku">
            <button id="set" data-dismiss="modal" class="btn btn-default">設定</button>
          </div>
          <div class="col-md-3">
            <h3>総合系</h3>
            <h4>情報学</h4>
            <ul>
              <li>情報学基礎</li>
              <li>計算基盤</li>
              <li>人間情報学</li>
              <li>情報学フロンティア</li>
            </ul>
            <h4>環境学</h4>
            <ul>
              <li>環境解析学</li>
              <li>環境保全学</li>
              <li>環境創成学</li>
            </ul>
            <h4>複合領域</h4>
            <ul>
              <li>デザイン学</li>
              <li>生活科学</li>
              <li>科学教育・教育工学</li>
              <li>科学社会学・科学技術史</li>
              <li>文化財科学・博物館学</li>
              <li>地理学</li>
              <li>社会・安全システム科学</li>
              <li>人間医工学</li>
              <li>健康・スポーツ科学</li>
              <li>子ども学</li>
              <li>生体分子科学</li>
              <li>脳科学</li>
            </ul>
          </div>
          <div class="col-md-3">
            <h3>人文社会系</h3>
            <h4>総合人文社会</h4>
            <ul>
              <li>地域研究</li>
              <li>ジェンダー</li>
              <li>観光学</li>
            </ul>
            <h4>人文学</h4>
            <ul>
              <li>哲学</li>
              <li>芸術学</li>
              <li>文学</li>
              <li>言語学</li>
              <li>史学</li>
              <li>人文地理学</li>
              <li>文化人類学</li>
            </ul>
            <h4>社会科学</h4>
            <ul>
              <li>法学</li>
              <li>政治学</li>
              <li>経済学</li>
              <li>経営学</li>
              <li>社会学</li>
              <li>心理学</li>
              <li>教育学</li>
            </ul>
          </div>
          <div class="col-md-3">
            <h3>理工系</h3>
            <h4>総合理工</h4>
            <ul>
              <li>ナノ・マイクロ科学</li>
              <li>応用物理学</li>
              <li>量子ビーム科学</li>
              <li>計算科学</li>
            </ul>
            <h4>数物系科学</h4>
            <ul>
              <li>数学</li>
              <li>天文学</li>
              <li>物理学</li>
              <li>地球惑星科学</li>
              <li>プラズマ科学</li>
            </ul>
            <h4>化学</h4>
            <ul>
              <li>基礎化学</li>
              <li>複合化学</li>
              <li>材料化学</li>
            </ul>
            <h4>工学</h4>
            <ul>
              <li>機械工学</li>
              <li>電気電子工学</li>
              <li>土木工学</li>
              <li>建築学</li>
              <li>材料工学</li>
              <li>プロセス・化学工学</li>
              <li>総合工学</li>
            </ul>
          </div>
          <div class="col-md-3">
            <h3>生物系</h3>
            <h4>総合生物</h4>
            <ul>
              <li>神経科学</li>
              <li>実験動物学</li>
              <li>腫瘍学</li>
              <li>ゲノム科学</li>
              <li>生物資源保全学</li>
            </ul>
            <h4>生物学</h4>
            <ul>
              <li>生物科学</li>
              <li>基礎生物学</li>
              <li>人類学</li>
            </ul>
            <h4>農学</h4>
            <ul>
              <li>生産環境農学</li>
              <li>農芸化学</li>
              <li>森林圏科学</li>
              <li>水圏応用科学</li>
              <li>社会経済農学</li>
              <li>農業工学</li>
              <li>動物生命科学</li>
              <li>境界農学</li>
            </ul>
            <h4>医歯薬学</h4>
            <ul>
              <li>薬学</li>
              <li>基礎医学</li>
              <li>境界医学</li>
              <li>社会医学</li>
              <li>内科系臨床医学</li>
              <li>外科系臨床医学</li>
              <li>歯学</li>
              <li>看護学</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- modal dialog END -->
  <script type="text/javascript">
    $(function() {
      $(".trigger").click(function() {
        $("#modalTrigger").trigger('click');
      });
      $("#bunka li").click(function() {
        var bunka = $(this).text();
        $('#sentakuShumoku').val(bunka);
      });
      $("#set").click(function() {
        var shumoku = $('#sentakuShumoku').val();
        $('#shumokubetsu').val(shumoku);
      });
    });
  </script>



<div class="col-md-6">
<?php include("./index_chuushutsujouken.html"); ?>
</div>
</div>


<?php include("./template-footer.php"); ?>
