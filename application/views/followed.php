
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
                <?  if($followed) { foreach($followed as $im){  ?>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <? constroy_perfil_left($im) ?>
                </div>
                <? }} else { ?>
                <? constroy_situation_main("Que pena :(", "Esse usuário ainda não tem nenhuma seguidor.") ?>
                <? } ?>
            </div>
        </div>


    </div>
</div>




