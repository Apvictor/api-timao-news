<?php

use CodeIgniter\I18n\Time;

// $time = Time::createFromTimestamp(1501821586, 'America/Sao_Paulo', 'pt_BR');
$time = Time::now();
// $time = Date('Y-m-d H:i:s');

?>

<?= $this->section("footer") ?>

<footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <?= format_date($time, "d/m/Y H:i:s") ?>
    <b>Versão</b> 1.0.0
  </div>
  <strong>&copy; <?= date("Y") ?> <a href="#">Fox Software</a>.</strong> Todos os direitos reservados.
</footer>

<?= $this->endSection(); ?>