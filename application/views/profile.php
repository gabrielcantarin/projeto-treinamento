
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
            <ul class="ca bqe bqf agk">
                <? if($posts) { foreach ($posts as $post) { ?>
                <? constroy_post($post) ?>
                <? }} else { ?>
                <? constroy_situation_main("Que pena :(", "Esse usuário ainda não fez nenhuma publicação.") ?>
                <? } ?>
            </ul>
        </div>

    </div>
</div>




