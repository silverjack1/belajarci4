<?= $this->extend('templates/admin_template') ?>

<?= $this->section('content') ?>

<div class="content-header">
  <div class="container-fluid">
      <h1 class="m-0"><?= $title ?></h1>
    <div class="row">
      <div class="col-sm-6">
          <form action="" action="post">
      <div class="input-group mb-3">
  <input name="keyword" type="text" class="form-control" placeholder="Masukkan nama...">
  <div class="input-group-append">
    <button class="btn btn-outline-secondary" type="submit">Cari</button>
  </div>
</div>
</form>
        <?php if (session()->getFlashdata('pesan')) : ?>
          <div class="mt-1 alert alert-warning alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('pesan') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif; ?>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">orang</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col card">
        <table class="table">
          <thead>
            <tr>

              <th scope="col">#</th>
              <th scope="col">Nama Orang</th>
              <th scope="col">Alamat</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php $i = 1 + (10 * ($current_page-1)); ?>
              <?php foreach ($orang as $o) : ?>
                <th scope="row"><?= $i++ ?></th>
                <td><?= $o['nama'] ?></td>
                <td><?= $o['alamat'] ?></td>
                <td><a href="#" class="btn btn-success">Detail</a></td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
        <?= $pager->links('orang','orang_pagination') ?>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<?= $this->endSection() ?>