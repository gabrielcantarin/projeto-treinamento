
<div class="register-photo">
    <div class="form-container">
        <form method="post" action="<?= base_url('forget'); ?>">
            <? alerts($this->session->flashdata('success'));  ?>
            <h2 class="text-center"><strong>Esqueceu sua Senha</strong></h2>
            <div class="form-group">
                <input class="form-control" type="email" value="<?= set_value('email') ?>" name="email" placeholder="E-mail">
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Recuperar Senha</button>
            </div>
        </form>
    </div>
</div>
    