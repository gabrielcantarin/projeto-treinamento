
<div class="container hero">
    <div class="row" style="margin-top:15px;">
        

        <!-- COMEÇO COLUNA ESQUERDA -->
        <div class="col-lg-4 col-lg-offset-0 col-md-4 col-md-offset-0">
            <!-- PROFILE -->
            <? constroy_perfil_left($user) ?>
            <!-- FOLLOW -->
            <? constroy_should_follow($should_follow) ?>
        </div>
        <!-- FIM COLUNA ESQUERDA -->




        <div class="col-lg-8 col-lg-offset-0 col-md-6 col-md-offset-0 phone-holder">
            <div class="row">
                <? if($imFollowing) {foreach($imFollowing as $im){  ?>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="rp bqq agk">
                        <div class="rv" style="background-image:url(<?= base_url('media/'.$im->last_bg) ?>);"></div>
                        <div class="rq awx">
                            <a href="<?= base_url($im->username) ?>"><img class="bqr" src="<?= base_url('media/'.$im->last_picture) ?>" /></a>
                            <h6 class="rr">
                                <a class="bph" href="<?= base_url($im->username) ?>"><?= $im->name ?></a>
                            </h6>
                            <p class="agk"><?= $im->username ?></p>
                            <ul class="bqs">
                                <li class="bqt">
                                    <a href="<?= base_url($im->username) ?>" class="bph" data-toggle="modal">Waves
                                        <h6 class="afl"><?= $im->last_wave ?></h6>
                                    </a>
                                </li>
                                <li class="bqt">
                                    <a href="<?= base_url($im->username.'/follow') ?>" class="bph" data-toggle="modal">Seguindo
                                        <h6 class="afl"><?= $im->last_follow ?></h6>
                                    </a>
                                </li>
                                <li class="bqt">
                                    <a href="<?= base_url($im->username.'/followed') ?>" class="bph" data-toggle="modal">Seguidores
                                        <h6 class="afl"><?= $im->last_followed ?></h6>
                                    </a>
                                </li>
                            </ul>
                            <div class="bqi">
                                <a href="<?= base_url('unfollow/'.$im->id) ?>">
                                    <button class="cg pq pz">Unfollow</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <? }} else { ?>
                <? constroy_situation_main("Que pena :(", "Esse usuário ainda não está seguindo ninguém.") ?>
                <? } ?>
            </div>
        </div>


    </div>
</div>




