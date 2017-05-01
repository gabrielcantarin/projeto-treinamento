
<div class="container hero">
    <div class="row" style="margin-top:15px;">
        

        <!-- COMEÇO COLUNA -->
        <div class="col-lg-4 col-lg-offset-0 col-md-4 col-md-offset-0">
            <!-- PROFILE -->
            <? constroy_perfil_left($this->session->userdata()) ?>
            <!-- BOTÕES CONFIGURAÇÕES -->
            <? constroy_btn_config("data") ?>
        </div>
        <!-- FINAL COLUNA -->




        <div class="col-lg-8 col-lg-offset-0 col-md-6 col-md-offset-0 phone-holder">
            <ul class="ca bqe bqf agk">
                
            <!-- POST NEW WAVE -->
                <li class="tu b ahx">
                    <h2>Configurações Básicas</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget egestas sapien. Donec rutrum dapibus auctor. Vivamus aliquam neque vitae ante aliquet, nec elementum justo tincidunt. Donec dignissim tortor at consectetur sollicitudin. Aenean consectetur vehicula turpis, ut ultricies lacus sagittis ut. Mauris et urna ante. Nunc at justo imperdiet, condimentum turpis ac, efficitur justo.</p>
                </li>

                <li class="tu b ahx">
                    <? alerts($this->session->flashdata()); ?>
                    <form class="form-horizontal cem" action="<?= base_url('config') ?>" method="POST">
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="name">Nome Completo:</label>
                            <div class="col-sm-9">
                                <input type="text" value="<?= set_value('name', $user->name) ?>" class="form-control" name="name" placeholder="Nome Completo">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Nome de Usuário:</label>
                            <div class="col-sm-9">
                                <input type="text" value="<?= set_value('username', $user->username) ?>" class="form-control" name="username" placeholder="Nome de Usuário">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="name">Biografia:</label>
                            <div class="col-sm-9">
                                <textarea name="bio" class="form-control" placeholder="Digite aqui uma Biografia"><?= set_value('bio', $user->bio) ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="name">Sexo:</label>
                            <div class="col-sm-9">
                              <!-- <select class="form-control">
                                  <option selected>Sexo</option>
                                  <option value="f">Feminino</option>
                                  <option value="m">Masculino</option>
                                  <option value="o">Outro</option>
                                </select> -->
                                <? $options = array(''=>'-Selecione-','f'=>'Feminino','m'=>'Masculino','o'=>'Outro'); ?>
                                <?= form_dropdown('sexo', $options, set_value('sexo', $user->sexo), 'class="form-control"'); ?>
                            </div>
                        </div>
                        <div class="form-group"> 
                            <div class="col-sm-offset-3 col-sm-12">
                                <button type="submit" class="cg pl">Salvar</button>
                            </div>
                        </div>
                    </form>

                </li>

                
            </ul>
        </div>
    </div>
</div>



