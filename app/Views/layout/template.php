<?= $this->extend('layout/master') ?>

<?= $this->section('template') ?>

<?= $this->include('layout/navbar') ?>
<?= $this->include('layout/sidebar') ?>

<?= $this->include('layout/breadcrumb') ?>

<?= $this->renderSection('content') ?>

<?= $this->include('layout/footer') ?>

<?= $this->endSection() ?>