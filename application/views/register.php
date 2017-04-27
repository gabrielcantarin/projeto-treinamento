
<div class="register-photo">
    <div class="form-container">
        <form method="post" action="<?= base_url('register') ?>">
            <? alerts($this->session->flashdata('success'));  ?>
            <h2 class="text-center"><strong>Criar uma Conta</strong></h2>
            <div class="form-group">
                <input class="form-control" value="<?= set_value('name') ?>" type="text" name="name" placeholder="Nome Completo">
            </div>
            <div class="form-group">
                <input class="form-control" value="<?= set_value('username') ?>" type="text" name="username" placeholder="Nome de Usuário">
            </div>
            <div class="form-group">
                <input class="form-control" value="<?= set_value('email') ?>" type="email" name="email" placeholder="E-mail">
            </div>
            <div class="form-group">
                <input class="form-control" value="<?= set_value('pass') ?>" type="password" name="pass" placeholder="Senha">
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label class="control-label">
                        <input type="checkbox" name="tos">Eu concordo com os Termos de Uso.</label>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Cadastrar</button>
            </div>
            <a href="<?= base_url('login'); ?>" class="already">Possui uma conta? Clique aqui para entrar.</a>
        </form>
    </div>
</div>
    
