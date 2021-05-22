<?php 
require_once 'header.php';
require_once 'sidebar.php'

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->

  

  <section class="content">


   <?php 

   if (isset($_GET['productsInsert'])) {?>
    <div class="box box-primary">



      <div class="content-header">
        <h1 >Ürün ve Hizmetler Ekle</h1>  
        <hr>       
      </div>

      <div class="box-body">

        <?php 
        if (isset($_POST['products_insert'])) {
          
         $sonuc=$db->insert("products",$_POST,[
          "form_name" => "products_insert"
          ]
        );

        if ($sonuc['status']) {?>
         <div class="alert alert-success">
           Kayıt Başarılı <a href="<?php $link=explode("?",$_SERVER['REQUEST_URI']); echo $link[0];  ?>">Listele</a>
         </div>
       <?php } else {?>

        <div class="alert alert-danger">
         Kayıt Başarısız.<?php echo $sonuc['error'] ?>
       </div>
     <?php }
   }
   ?>


      <!--  <div class="alert alert-success">
        Kayıt Başarılı
      </div> -->


      <form method="POST" enctype="multipart/form-data">

      

        <div class="form-group">
          <label>Ürün, Hizmet Adı</label>
          <div class="row">
            <div class="col-xs-12">
              <input type="text" name="products_title"  require="" class="form-control">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Ürün, Hizmet Detay</label>
          <div class="row">
            <div class="col-xs-12">
              <textarea name="products_content" id="editor1" class="form-control"></textarea>
            </div>
          </div>
        </div>


        <div class="form-group">
          <label>Ürün, Hizmet Fiyat</label>
          <div class="row">
            <div class="col-xs-12">
              <input type="text"  name="products_price"  require="" class="form-control">
            </div>
          </div>
        </div>

       <script>
       CKEDITOR.replace( 'editor1');
       </script>
        

        <div align="right" class="box-footer">
          <button type="submit" class="btn btn-success" name="products_insert">Ekle</button>
        </div>



      </form>
    </div>

  </div>
<?php }  else if (isset($_GET['productsUpdate'])) {

  //bağlı id bilgilerini çek...


  ?>

  <div class="box box-primary">



    <div class="content-header">
      <h1 >Ürün ve Hizmetler Düzenle</h1>  
      <hr>       
    </div>

    <div class="box-body">

      <?php 

      if (isset($_POST['products_update'])) {
        
       $sonuc=$db->update("products",$_POST,[
        "form_name" => "products_update",
        "columns" => "products_id"]
        
      );

      if ($sonuc['status']) {?>
       <div class="alert alert-success">
         Kayıt Başarılı <a href="<?php $link=explode("?",$_SERVER['REQUEST_URI']); echo $link[0];  ?>">Listele</a>
       </div>
     <?php } else {?>

      <div class="alert alert-danger">
       Kayıt Başarısız.<?php echo $sonuc['error'] ?>
     </div>
   <?php }
 }
 
 $sql=$db->wread("products","products_id",$_GET['products_id']);
 $row=$sql->fetch(PDO::FETCH_ASSOC);


 
 ?>

 <!-- update işlem sorgusu -->


 <form method="POST" enctype="multipart/form-data">


 <div class="form-group">
          <label>Ürün, Hizmet Adı</label>
          <div class="row">
            <div class="col-xs-12">
              <input type="text" name="products_title"  value="<?php echo $row['products_title'] ?>" require="" class="form-control">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Ürün, Hizmet Detay</label>
          <div class="row">
            <div class="col-xs-12">
              <textarea name="products_content" id="editor1"    class="form-control"> <?php echo $row['products_content'] ?></textarea>
            </div>
          </div>
        </div>


        <div class="form-group">
          <label>Ürün, Hizmet Fiyat</label>
          <div class="row">
            <div class="col-xs-12">
              <input type="text"  name="products_price"   value="<?php echo $row['products_price'] ?>" require="" class="form-control">
            </div>
          </div>
        </div>

       <script>
       CKEDITOR.replace( 'editor1');
       </script>




 
  

  <input type="hidden" name="products_id" value="<?php echo $row['products_id']; ?>">
  

  <div align="right" class="box-footer">
    <button type="submit" class="btn btn-success" name="products_update">Düzenle</button>
  </div>



</form>
</div>

</div>

<?php }

 ?>




<!-- Default box -->
<div class="box box-primary">

 <div class="content-header">
  <h1 >Ürün ve Hizmetler</h1>  
  <div align="right">
    <a href="?productsInsert=true"><button class="btn btn-success">Yeni Ekle</button></a>
    <br><br>
  </div>
  <?php 
if (isset($_GET['productsDelete'])) {
  
 $sonuc=$db->delete("products","products_id",$_GET['products_id']);


   if ($sonuc['status']) {?>
       <div class="alert alert-success">
         Silme Başarılı
       </div>
     <?php } else {?>

      <div class="alert alert-danger ">
       Silme Başarısız.<?php echo $sonuc['error'] ?>
     </div>
   <?php }
 }
   ?>
</div>
<!-- /.box-header -->
<div class="box-body">
  <table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th align="center" width="5">#</th>
        <th>Ürün, Hizmet Başlığı</th>
        <th>Fiyat</th>
        
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>

      <?php 
      
       $sql=$db->read("products",[
        "columns_name" => "products_id",
        "columns_sort" => "DESC"
      ]);
      $say=1;
      while ($row=$sql->fetch(PDO::FETCH_ASSOC)) {  ?>

        <tr>
          <td><?php echo $say++; ?></td>
          <td width="50" ><?php echo $row['products_title'] ?></td>
          <td width="100" ><?php echo $row['products_price'] ?></td>
          
          <td align="center" width="5"><a href="?productsUpdate=true&products_id=<?php echo $row['products_id'] ?>"><i class="fa fa-pencil-square"></i></a></td>
          <td align="center" width="5"><a href="?productsDelete=True&products_id=<?php echo $row['products_id'] ?>"><i class="fa fa-trash-o"></i></a></td>
        </tr>

      <?php } ?>

    </table>
  </div>
  <!-- /.box-body -->
</div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php require_once 'footer.php'; ?>

<script type="text/javascript">

  $(function() {
    $("#sortable").sortable({
      revert:true,
      handle:".sortable",
      stop:function(event,ui) {
        var data=$(this).sortable('serialize');
       
        $.ajax({
          type:"POST",
          dataType:"json",
          data:data,
          url:"netting/order-ajax.php?products_must=true",
          success:function(msg) {
          if (msg.islemMsj) {
            alert("Sıralama Başarılı");
          } else {
            alert("Hata Var...");
          }
          
          }
        });
      }



    });
    $("#sortable").disableSelection();
  });

</script>