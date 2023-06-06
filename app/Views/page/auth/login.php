<?= $this->extend('layout/master') ?>

<?= $this->section('auth') ?>

<div class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="<?= base_url("/") ?>" class="h1">We <b>Delivery</b></a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Faça login para iniciar sua sessão</p>

        <form action="<?= base_url("/login") ?>" method="post">
          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="E-mail">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="senha" class="form-control" placeholder="Senha">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember" name="conectado">
                <label for="remember">Manter conectado</label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Entrar</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <!-- <p class="mb-1">
          <a href="forgot-password.html">I forgot my password</a>
        </p>
        <p class="mb-0">
          <a href="register.html" class="text-center">Register a new membership</a>
        </p> -->

      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>

<?= $this->endSection() ?>