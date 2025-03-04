</div>
</div>
</body>
<footer class="page-footer blue darken-3">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">IASOTECG</h5>
                <?php if($this->session->has_userdata("nombre")){ ?>
                <p class="white-text"><?=$this->session->userdata("ncliente");?></p>
                <p class="white-text">Bienvenido: <?=$this->session->userdata("nombre");?></p>
                <p class="white-text">Tipo usuario: <?=$this->session->userdata("tipo");?></p>
                <?php }else{ ?>
                <p class="white-text">Ingreso</p>
                <?php }?>
              </div>
              <div class="col l4 offset-l2 s12">
                <h6 class="white-text">Problemas tecnicos?</h6>
                <p class="white-text">escriba un correo a comercial@iasotec.com</p>
                </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            2014 Copyright Text
            </div>
          </div>
        </footer>
<script src="<?=base_url();?>/assets/js/header.js"   type="text/javascript"></script>


</html>
