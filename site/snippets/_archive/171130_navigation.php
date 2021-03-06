<div id="nav-frame" class="flex-item">
  <div id="nav" class="nav">
    <ul>

      <li class="nav-topics"><a id="topics-button" class="nav-button">Themen</a></li>

      <li>
        <a id="questions-button" class="nav-switch" href="#">Fragen</a><a class="key-icon"></a>
          <?php
            function cmp($a, $b) {
              return strcmp($a->frage(), $b->frage());
            }
           ?>

          <div id="sl-1" class="sub">
            <ul>
              <?php
                // build an array of all unique question objects
                $fragenDone = array();
                $lettersDone = array();
                $newLetter = false;
                foreach($pages->find('interviews')->children()->visible() as $interview) {
                  foreach($interview->interview()->toStructure() as $frage) {
                    // make sure we show each question only once
                    if ( ! in_array( $frage, $fragenDone ) ) {
                      array_push($fragenDone, $frage);
                    }
                  }
                }

                // sort questions alphabetically
                usort($fragenDone, "cmp");

                // output
                foreach ($fragenDone as $frage) {
                  // determine link target for question
                  if ($frage->spezialfrage()->bool() === true) {
                    $openwraptag = '<a href="'.$interview->url().'#'.$frage->fid().'">'; // link directly to interview page/section
                    $closewraptag = '</a>';
                  } else {
                    $openwraptag = '<a href="#'.$frage->fid().'">'; // link to question in topics
                    $closewraptag = '</a>';
                  }
                  // new first letter? show it!
                  $letter = substr($frage->frage(),0,1);
                  if (! in_array($letter, $lettersDone)) {
                    array_push($lettersDone, $letter);
                    ?>
                    <li class="register-mark"><?= $letter?></li>
                    <?php
                    $newletter = true;
                  }
                  ?>
                  <li class="nav-question">
                    <?php echo $openwraptag.$frage->frage()->html().$closewraptag;?>
                  </li>
                  <?php
                }
              ?>
            </ul>
          </div>
      </li>

      <li>
        <a id="interviews-button" class="nav-switch" href="#">Interviews</a><a class="key-icon"></a>
        <div id="sl-2" class="sub">
          <ul>
            <?php
            $newLetter = false; // interviews need register mark as well
            foreach($pages->find('interviews')->children()->visible()->sortBy('title', 'asc') as $interview):

            // new first letter? show it!
            $letter = substr($interview->title(),0,1);
            if (! in_array($letter, $lettersDone)) {
              array_push($lettersDone, $letter);
              ?>
              <li class="register-mark"><?= $letter?></li>
              <?php
              $newletter = true;
            }
            ?>

            <li class="nav-interview">
              <a href="<?php echo $interview->url() ?>" imgsrc="<?php if($image = $interview->image()): ?><?php echo $image->url() ?><?php endif ?>">

                <?php if( !$interview->titlenav()->empty() ): ?>
                  <?php echo $interview->titlenav() ?>
                <?php else: ?>
                  <?php echo $interview->title() ?>
                <?php endif ?>

              </a>
            </li>
            <?php endforeach ?>
          </ul>
        </div>
      </li>

      <li class="nav-spacer"></li>
      <li class="nav-about"><a id="about-button" class="nav-button about-anchor">About</a></li>
      <li><a id="language-button" class="nav-button language-anchor">EN</a></li>

    </ul>
  </div>
</div>