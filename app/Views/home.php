<?php
$modal="";
$class="";
if ($role){
    $modal="
        <!-- Add Modal -->
    <div class=\"modal fade\" id=\"modal_form\" role=\"dialog\">
        <div class=\"modal-dialog\">
            <div class=\"modal-content\">
                <div class=\"modal-header\">
                    <h5 class=\"modal-title\" id=\"addModalLabel\">Add Barang</h5>
                    <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
                </div>
                <div class=\"modal-body form\">
                    <form action=\"#\" id=\"form\" >
                        <input type=\"hidden\" value=\"\" name=\"barangId\"/>
                        <div class=\"form-group mb-3\">
                            <label for=\"formNama\">Nama Barang</label>
                            <input type=\"text\" class=\"form-control\" id=\"formNama\" name=\"namaBarang\" placeholder=\"Nama Barang\" required>
                        </div>
                        <div class=\"form-group mb-3\">
                            <label for=\"formKategori\">Kategori</label>
                            <select class=\"form-select\" name=\"kategoriBarang\" aria-label=\"Default select example\" required>
                                <option selected value=\"Retail\">Retail</option>
                                <option value=\"Wholesale\">Wholesale</option>
                            </select>
                        </div>
                        <div class=\"form-group mb-3\">
                            <label for=\"formHarga\">Harga Barang</label>
                            <input type=\"number\" class=\"form-control\" name=\"hargaBarang\" id=\"formHarga\" placeholder=\"Harga Barang\" required>
                        </div>
                        <div class=\"form-group\">
                            <label for=\"fotoBarang\">Foto Barang</label>
                            <input type=\"file\" class=\"form-control-file\" name=\"fotoBarang\" id=\"fotoBarang\" accept=\"image/*\" required>
                        </div>

                </div>
                <div class=\"modal-footer\">
                    <button type=\"button\"  class=\"btn btn-secondary\" data-bs-dismiss=\"modal\">Close</button>
                    <button type=\"button\" id=\"btnSave\" onclick=\"save()\" class=\"btn btn-success\">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    ";
}else{$class="hide";}

?>
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
          .hide{
              display: none;
          }
      </style>
  </head>
  <body>

<header>
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a href="<?php echo base_url();?>/home/main" role="button" class="navbar-brand d-flex align-items-rights">
        <strong>Home</strong>
      </a>
        <a class="btn btn-danger" href="<?php echo base_url();?>/home/logout" role="button">Logout</a>
    </div>
  </div>
</header>

<main>
  <div class="album py-5 bg-light">
    <div class="container">
        <div class="mb-3 <?php echo $class; ?>">
        <!-- Edit Button trigger modal -->
        <button type="button" class="btn btn-success " onclick="add_barang()">
            Add Barang
        </button>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
          <table id="table_id" class="table align-middle" cellspacing="0" width="200%">
              <thead class="table-dark">
              <tr>
                  <th scope="col">No</th>
                  <th scope="col">Foto Barang</th>
                  <th scope="col">Nama Barang</th>
                  <th scope="col">Kategori</th>
                  <th scope="col">Harga</th>
                  <th scope="col">Diskon</th>
                  <th class="<?php echo $class; ?>" scope="col">Aksi</th>
              </tr>
              </thead>
              <tbody>
              <?php $i=1;
              foreach($barang as $x){
                  $discount=0;
              if($x->harga > 20000){$discount=$x->harga*5/100;}
              if($x->harga > 40000){$discount=$x->harga*10/100;}?>
                <tr>
                  <th scope="row"><?php echo $i;?></th>
                  <td>
                      <img src="<?php echo base_url();?>/uploads/<?php echo $x->image_name;?>" alt="..." class="img-fluid">
                  </td>
                  <td><?php echo $x->nama;?></td>
                  <td><?php echo $x->kategori;?></td>
                  <td><?php echo $x->harga;?></td>
                  <td><?php echo $discount;?></td>
                  <td class="<?php echo $class; ?>">
                      <button class="btn btn-primary" onclick="edit_barang(<?php echo $x->id;?>)">Edit</button>
                      <button class="btn btn-danger" onclick="delete_barang(<?php echo $x->id;?>)">Delete</button>

                  </td>
                    <?php $i++; }?>
              </tbody>
          </table>
      </div>
    </div>
  </div>

    <?php echo $modal; ?>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="<?php echo base_url();?>/assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready( function () {
        $('#table_id').DataTable();
    } );
    var save_method; //for save method string
    var table;

    function add_barang()
    {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('#modal_form').modal('show'); // show bootstrap modal
    }

    function edit_barang(id)
    {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        <?php header('Content-type: application/json'); ?>
        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('home/ajax_edit/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                console.log(data);

                $('[name="idBarang"]').val(data.id);
                $('[name="namaBarang"]').val(data.nama);
                $('[name="kategoriBarang"]').val(data.kategor);
                $('[name="hargaBarang"]').val(data.harga);
                $('[name="fotoBarang"]').val(data.image_name);

                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Barang'); // Set title to Bootstrap modal title

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                console.log(jqXHR);
                alert('Error get data from ajax');
            }
        });
    }

    function save()
    {
        var url;
        if(save_method == 'add')
        {
            url = "<?php echo site_url('home/addBarang')?>";
        }
        else
        {
            url = "<?php echo site_url('home/updateBarang')?>";
        }

        // ajax adding data to database
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                //if success close modal and reload ajax table
                $('#modal_form').modal('hide');
                location.reload();// for reload a page
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    }

    function delete_book(id)
    {
        if(confirm('Are you sure delete this data?'))
        {
            // ajax delete data from database
            $.ajax({
                url : "<?php echo site_url('index.php/home/deleteBarang')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {

                    location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });

        }
    }

</script>
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h3 class="modal-title">Book Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="book_id"/>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Book ISBN</label>
                            <div class="col-md-9">
                                <input name="book_isbn" placeholder="Book ISBN" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Book Title</label>
                            <div class="col-md-9">
                                <input name="book_title" placeholder="Book_title" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Book Author</label>
                            <div class="col-md-9">
                                <input name="book_author" placeholder="Book Author" class="form-control" type="text">

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Book Category</label>
                            <div class="col-md-9">
                                <input name="book_category" placeholder="Book Category" class="form-control" type="text">

                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

  </body>
</html>
