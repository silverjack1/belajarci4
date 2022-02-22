<?= $this->include('templates/admin_header') ?>
<?= $this->include('templates/admin_navbar') ?>
<?= $this->include('templates/admin_sidebar') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
 <?= $this->renderSection('content')?>
  </div>
  <!-- /.content-wrapper -->
    <?= $this->include('templates/admin_footer') ?>