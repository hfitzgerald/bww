<div class="col_container">
  <div class="wrapper">
    <div class="col how"> 
      <a name="how">how</a>
      <div class="poster"></div>
      <div class="items">
        <a href="http://www.scvngr.com/" target="_blank" class="download">scvngr</a>
        <a href="/challenges" class="complete">challenges</a>
        <a href="/rules" class="win">rules</a>
      </div>
    </div>

    <div class="divider"></div>

    <div class="col leader">
      <a name="leaderboard"></a>
      <div class="poster"></div>

      <div class="items">
        <?php echo $this->element("user_leaderboard", array("users" => $users)); ?>
        <a class="view_all" href="/leaderboard">view all</a>
      </div>
    </div>

    <div class="divider"></div>

    <div class="col challenge">
      <a name="challenges"></a>
      <div class="poster"></div>
      <div class="items">
        <div class="L_arrow" onclick="shft(206);"></div>
        <div id="screen" class="cScreen"></div>
        <div class="R_arrow" onclick="shft(-206);"></div>
        <div class="clr"></div>
        <a class="view_all" href="/challenges">view all</a>
      </div>
    </div>
  </div>

  <div class="clr"></div>
</div>
