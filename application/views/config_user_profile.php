
<div class="container hero">
    <div class="row" style="margin-top:15px;">
        
        

        <!-- COMEÇO COLUNA -->
        <div class="col-lg-4 col-lg-offset-0 col-md-4 col-md-offset-0">
            <!-- PROFILE -->
            <? constroy_perfil_left($this->session->userdata()) ?>
            <!-- BOTÕES CONFIGURAÇÕES -->
            <? constroy_btn_config("photo") ?>
        </div>
        <!-- FINAL COLUNA -->




        <div class="col-lg-8 col-lg-offset-0 col-md-6 col-md-offset-0 phone-holder">
            <ul class="ca bqe bqf agk">
                
            <!-- POST NEW WAVE -->
                <li class="tu b ahx">
                    <h2>Foto de Perfil</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget egestas sapien. Donec rutrum dapibus auctor. Vivamus aliquam neque vitae ante aliquet, nec elementum justo tincidunt. Donec dignissim tortor at consectetur sollicitudin. Aenean consectetur vehicula turpis, ut ultricies lacus sagittis ut. Mauris et urna ante. Nunc at justo imperdiet, condimentum turpis ac, efficitur justo.</p>
                </li>

                <li class="tu b ahx">
                    <input type="file" id="upload" class="cg pl" value="Choose a file" accept="image/*" />
                </li>
                <li class="tu b ahx" upload='true' style="display:none">
                    <div class="upload-demo-wrap"  style="width:300px;height:300px;padding:20px;margin: 0 auto;">
                        <div id="upload-demo"></div>
                    </div>
                </li>

                <li class="tu b ahx" upload='true' style="display:none">
                    <button type="submit" id="btnUpload" class="cg pl upload-result">Salvar</button>
                </li>

            </ul>
        </div>
    </div>
</div>



