<?php
if(!kirby()->request()->ajax()) {
    snippet('header');
    echo '<div class="content">';
    snippet('menu');
    snippet('home');
    echo '<div id="interviews"><div class="int-content">';
}
?>

    <h1><?= $page->title()->html() ?></h1>
    <section class="interview">
        <ul>
          <?php $plural = $page->interviewpartner(); ?>

            <?php foreach($page->Interview()->toStructure() as $interview): ?>
                <li id="<?php echo ($interview->fid()); ?>">
                    <div class="q">
                        <?php
                            if(!$interview->vorfrage()->empty()) {
                                echo $interview->vorfrage();
                            }
                            if($plural == '1') {
                                echo $interview->frage();
                            } else {
                                foreach($pages->find('themen')->grandchildren()->visible() as $frage)
                                if(strcasecmp($frage->title(), $interview->frage()) == 0) {
                                    echo $frage->alternative();
                                }
                            }
                        ?>
                    </div>
                    <div class="a">
                        <?php echo $interview->antwort()->html() ?>
                    </div>
                </li>
                <br/>
            </br/>
            <?php endforeach ?>
        </ul>
    </section>



<?php
if(!kirby()->request()->ajax()) {
    echo '</div></article>';
    echo '</div>';
    snippet('footer');
}
?>
