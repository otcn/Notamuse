<?php snippet('header') ?>

    <h1><?= $page->title()->kirbytext() ?></h1>
    <section class="interview">
        <ul>
            <?php foreach($page->Interview()->toStructure() as $interview): ?>
                <li id="<?php echo ($interview->fid()); ?>">
                    <div class="q">
                        <?php
                            //if(!$interview->vorfrage()->empty()) {
                            //    echo $interview->vorfrage();
                            //}
                        ?>
                        <?php echo $interview->frage() ?>
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

<?php snippet('footer') ?>
