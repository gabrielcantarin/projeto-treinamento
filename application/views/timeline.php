
<div class="container hero">
    <div class="row" style="margin-top:15px;">
        
        <!-- COMEÇO COLUNA ESQUERDA -->
        <div class="col-lg-4 col-lg-offset-0 col-md-4 col-md-offset-0">
            <!-- PROFILE -->
            <? constroy_perfil_left($this->session->userdata()) ?>
            <!-- FOLLOW -->
            <? constroy_should_follow($should_follow) ?>
        </div>
        <!-- FIM COLUNA ESQUERDA -->




        <div class="col-lg-8 col-lg-offset-0 col-md-6 col-md-offset-0 phone-holder">
            <div role="alert" class="alert alert-danger beautiful" style="width:100%">
                Seu e-mail ainda não está ativo, <a class="bph" href="#"><b>clique aqui</b></a> para re-enviar o link de ativação.
            </div>
            <ul class="ca bqe bqf agk">
                
            <!-- POST NEW WAVE -->
                <li class="tu b ahx">
                    <form style="width: 100%;" method="post" action="<?= base_url('Post/create') ?>">
                        <? alerts($this->session->flashdata('success'));  ?>
                        <div class="input-group">
                            <textarea class="form-control" rows="3" id="comment" name="message" placeholder="Em que você está pensando?"></textarea>
                            <input type="hidden" name="lat" id="lat" value="<?= $this->session->userdata('last_lat') ?>">
                            <input type="hidden" name="log" id="log" value="<?= $this->session->userdata('last_log') ?>">
                            <div class="om">
                                <button type="submit" class="cg pl">Publicar</button>
                            </div>
                        </div>
                        <a href="<?= base_url('localization') ?>">
                            <small style="margin-top: 10px" class="aec axr">
                                Você está: <?= $this->session->userdata('last_city') ?>
                            </small>
                        </a>
                    </form>
                </li>
                
                <? $uri = $this->uri->segment_array();$uri = end($uri);?>
                <li class="tu b ahx">
                    <div style="text-align: center; width: 100%">
                        <a href="<?= base_url('timeline/near') ?>" style="text-decoration: none;">
                            <button class="cg <?= $uri=='near' || $uri == 'timeline'? 'pj': 'pl'?>" type="button">Próximas</button>
                        </a>
                        <a href="<?= base_url('timeline/follow') ?>" style="text-decoration: none;">
                            <button class="cg <?= $uri=='follow'? 'pj': 'pl'?>" type="button">Seguindo</button>
                        </a>
                        <a href="<?= base_url('timeline/both') ?>" style="text-decoration: none;">
                            <button class="cg <?= $uri=='both'? 'pj': 'pl'?>" type="button">Ambas</button>
                        </a>
                    </div>
                </li>


                <? if($posts){foreach ($posts as $post) { ?>
                <? constroy_post($post) ?>
                <? }} else { ?>
                <? constroy_situation_main("Que pena :(", "Siga alguém para ver o que esta pessoa está publicando.") ?>
                <? } ?>
                
            </ul>
        </div>
    </div>
</div>


 

