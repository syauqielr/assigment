
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.87.0">
    <title>Album example · Bootstrap v5.1</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/album/">
  <!-- Bootstrap core CSS -->
<link href="<?php echo base_url();?>/assets/dist/css/bootstrap.min.css" rel="stylesheet">
      <style>
          .img-fluid {
              max-height: 100px;
              width: auto;
          }
      </style>
  </head>
  <body>

<header>
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a href="<?php echo base_url();?>/home/logout" role="button" class="navbar-brand d-flex align-items-rights">
        <strong>logout</strong>
      </a>

    </div>
  </div>
</header>

<main>
  <div class="album py-5 bg-light">
    <div class="container">
        <div class="row mb-3">
        <!-- Edit Button trigger modal -->
        <button type="button" class="btn btn-success btn-lg btn-block" data-bs-toggle="modal" data-bs-target="#addModal">
            Add Barang
        </button>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
          <table class="table align-middle">
              <thead class="table-dark">
              <tr>
                  <th scope="col">No</th>
                  <th scope="col">Foto Barang</th>
                  <th scope="col">Nama Barang</th>
                  <th scope="col">Kategori</th>
                  <th scope="col">Harga</th>
                  <th scope="col">Diskon</th>
                  <th scope="col">Aksi</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                  <th scope="row">1</th>
                  <td>
                      <img src="<?php echo base_url();?>/assets/dist/images/coffee.jpg" alt="..." class="img-fluid">
                  </td>
                  <td>Otto</td>
                  <td>@mdo</td>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>
                      <!-- Edit Button trigger modal -->
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
                          Edit
                      </button>
                      <a class="btn btn-danger" href="#" role="button">Delete</a>

                  </td>
              </tr>
              </tbody>
          </table>
      </div>
    </div>
  </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action=" ">
                <div class="modal-body">

                        <div class="form-group mb-3">
                            <label for="formNama">Nama Barang</label>
                            <input type="text" class="form-control" id="formNama" name="namaBarang" placeholder="Nama Barang" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="formKategori">Kategori</label>
                            <select class="form-select" name="kategoriBarang" aria-label="Default select example" required>
                                <option selected value="Retail">Retail</option>
                                <option value="Wholesale">Wholesale</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="formHarga">Harga Barang</label>
                            <input type="number" class="form-control" name="hargaBarang" id="formHarga" placeholder="Harga Barang" required>
                        </div>
                        <div class="form-group">
                            <label for="fotoBarang">Foto Barang</label>
                            <input type="file" class="form-control-file" name="fotoBarang" id="fotoBarang" accept="image/*" required>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action=" ">
                    <div class="modal-body">

                        <div class="form-group mb-3">
                            <label for="formNama">Nama Barang</label>
                            <input type="text" class="form-control" id="formNama" name="namaBarang" placeholder="Nama Barang" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="formKategori">Kategori</label>
                            <select class="form-select" name="kategoriBarang" aria-label="Default select example" required>
                                <option selected value="Retail">Retail</option>
                                <option value="Wholesale">Wholesale</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="formHarga">Harga Barang</label>
                            <input type="number" class="form-control" name="hargaBarang" id="formHarga" placeholder="Harga Barang" required>
                        </div>
                        <div class="form-group">
                            <label for="fotoBarang">Foto Barang</label>
                            <input type="file" class="form-control-file" name="fotoBarang" id="fotoBarang" accept="image/*" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</main>


<script src="<?php echo base_url();?>/assets/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
