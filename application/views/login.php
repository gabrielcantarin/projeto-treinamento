
<div class="register-photo">
    <div class="form-container">
        <form method="post" action="<?= base_url('login') ?>">
            <? alerts($this->session->flashdata('success'));  ?>
            <h2 class="text-center"><strong>Entrar no Sistema</strong></h2>
            <div class="form-group">
                <input class="form-control" value="<?= set_value('email') ?>" type="email" name="email" placeholder="E-mail" autofocus="">
            </div>
            <div class="form-group">
                <input class="form-control" value="<?= set_value('pass') ?>" type="password" name="pass" placeholder="Senha">
            </div>

            <input type="hidden" name="lat" id="lat">
            <input type="hidden" name="log" id="log">

            <div class="form-group">
                <div class="checkbox">
                    <label class="control-label">
                        <input type="checkbox">Permanecer Logado</label>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Entrar </button>
            </div><a href="<?= base_url('forget'); ?>" class="already">Esqueceu sua senha? Clique aqui.</a></form>
    </div>
</div>
