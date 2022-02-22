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
            <form action="<?= base_url() ?>/komik/update/<?= $komik['id'] ?>" method="post" enctype="multipart/form-data">
              <?= csrf_field() ?>
              <input type="hidden" name="slug" value="<?= $komik['slug'] ?>" />
              <input type="hidden" name="sampulLama" value="<?= $komik['sampul'] ?>" />
              <div class="form-group row">
                <label for="judul" class="col-sm-3 col-form-label">Judul</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control <?= ($validation->hasError('judul'))
                                                            ? 'is-invalid' : '' ?>" id="judul" name="judul" name="judul" placeholder="Judul komik" autofocus autocomplete="off" value="<?= (old('judul')) ? old('judul') : $komik['judul'] ?>">
                  <div id="pesanjudul" class="invalid-feedback">
                    <?= $validation->getError('judul') ?>

                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="penulis" class="col-sm-3 col-form-label">Penulis</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control <?= ($validation->hasError('penulis'))
                                                            ? 'is-invalid' : '' ?>" id="penulis" name="penulis" placeholder="Nama penulis" autocomplete="off" value="<?= (old('penulis')) ? old('penulis') : $komik['penulis'] ?>">
                  <div id="pesanpenulis" class="invalid-feedback">
                    <?= $validation->getError('penulis') ?>

                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="penerbit" class="col-sm-3 col-form-label">Penerbit</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control <?= ($validation->hasError('penerbit'))
                                                            ? 'is-invalid' : '' ?>" id="penerbit" name="penerbit" placeholder="Penerbit" autocomplete="off" value="<?= (old('penerbit')) ? old('penerbit') : $komik['penerbit'] ?>">
                  <div id="pesanpenerbit" class="invalid-feedback">
                    <?= $validation->getError('penerbit') ?>

                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="sampul" class="col-sm-3 col-form-label">Sampul</label>
               
                <div class="col-sm-9">
                <div class="custom-file <?= ($validation->hasError('sampul'))
                                                            ? 'is-invalid' : '' ?>">
      <input type="file" class="custom-file-input" id="sampul" name="sampul" onchange="previewImg()">
      <label class="custom-file-label" for="sampul"><?= $komik['sampul']?></label>
    </div>
    <div class="invalid-feedback">
    <?= $validation->getError('sampul') ?>
  </div>
  <div class="col-sm-4">
                <img src="<?= base_url() . '/public/img/' . $komik['sampul']?>" class="img-thumbnail img-preview">
                </div>
                </div>
              </div>
                <button class="btn btn-primary" type="submit">Edit Data</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      

    </div><!-- /.container-fluid -->
</section>

<?= $this->endSection() ?>