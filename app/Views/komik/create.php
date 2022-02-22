<?= $this->extend('templates/admin_template') ?>

<?= $this->section('content') ?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"><?= $title ?></h1>

      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Komik</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<section class="content">
  <div class="container-fluid">
    <!-- awal container -->

    <div class="row">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <form action="<?= base_url() ?>/komik/save" method="post" enctype="multipart/form-data">
              <?= csrf_field() ?>
              <div class="form-group row">
                <label for="judul" class="col-sm-3 col-form-label">Judul</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control <?= ($validation->hasError('judul'))
                                                            ? 'is-invalid' : '' ?>" id="judul" name="judul" name="judul" placeholder="Judul komik" autofocus autocomplete="off" value="<?= old('judul')?>">
                  <div id="pesanjudul" class="invalid-feedback">
                    <?= $validation->getError('judul') ?>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="penulis" class="col-sm-3 col-form-label">Penulis</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="penulis" name="penulis" placeholder="Nama penulis" autocomplete="off" value="<?= old('penulis')?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="penerbit" class="col-sm-3 col-form-label">Penerbit</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="penerbit" name="penerbit" placeholder="Penerbit" autocomplete="off" value="<?= old('penerbit')?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="sampul" class="col-sm-3 col-form-label">Sampul</label>
               
                <div class="col-sm-9">
                <div class="custom-file <?= ($validation->hasError('sampul'))
                                                            ? 'is-invalid' : '' ?>">
      <input type="file" class="custom-file-input" id="sampul" name="sampul" onchange="previewImg()">
      <label class="custom-file-label" for="sampul">Pilih gambar</label>
    </div>
    <div class="invalid-feedback">
    <?= $validation->getError('sampul') ?>
  </div>
  <div class="col-sm-4">
                <img src="<?= base_url() . '/public/img/komik1.jpg'?>" class="img-thumbnail img-preview">
                </div>
                </div>
              </div>
              
              <button class="btn btn-primary" type="submit">Submit form</button>
            </form>
          </div>
        </div>
      </div>

    </div><!-- /.container-fluid -->
</section>

<?= $this->endSection() ?>