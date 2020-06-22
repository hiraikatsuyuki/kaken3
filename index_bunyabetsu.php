<?php include("./template-header-connection.php"); ?>
<?php include("./template-header-html.php"); ?>

<div class="row">
  <h3>分野別採択状況</h3>
  <div class="col-md-6">
    <form method="GET" action="./bunyasearch.php">
      <div class="form-group">
        <label>分野</label>
        <input type="text" name="bunya" class="form-control" id="shumokubetsu">
        <a href="#modalFade" id="modalTrigger" data-toggle="modal">分野を一覧から選択</a>
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
          <h3>分野選択</h3>
        </div>
        <div class="modal-body row" id="bunya">
          <div class="col-md-12">
            <input type="text" class="form-control" id="sentakuShumoku">
            <button id="set" data-dismiss="modal" class="btn btn-default">設定</button>
          </div>
          <div class="col-md-3">
            <h3>総合系</h3>
            <ul>
            <li>情報学</li>
            <li>環境学</li>
            <li>複合領域</li>
            </ul>
          </div>
          <div class="col-md-3">
            <h3>人文社会系</h3>
            <ul>
            <li>総合人文社会</li>
            <li>人文学</li>
            <li>社会科学</li>
            </ul>
          </div>
          <div class="col-md-3">
            <h3>理工系</h3>
            <ul>
            <li>総合理工</li>
            <li>数物系科学</li>
            <li>化学</li>
            <li>工学</li>
            </ul>
          </div>
          <div class="col-md-3">
            <h3>生物系</h3>
            <ul>
            <li>総合生物</li>
            <li>生物学</li>
            <li>農学</li>
            <li>医歯薬学</li>
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
      $("#bunya li").click(function() {
        var bunya = $(this).text();
        $('#sentakuShumoku').val(bunya);
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
