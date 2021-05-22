<?php 
require_once 'header.php';
require_once 'sidebar.php'

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->

  

  <section class="content">


   <?php 

   if (isset($_GET['accountInsert'])) {?>
    <div class="box box-primary">



      <div class="content-header">
        <h1 >Cari Kayıt Ekle</h1>  
        <hr>       
      </div>

      <div class="box-body">

        <?php 
        if (isset($_POST['account_insert'])) {
          
         $sonuc=$db->insert("account",$_POST,[
          "form_name" => "account_insert"
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
          <label>Firma Adı</label>
          <div class="row">
            <div class="col-xs-12">
              <input type="text" name="account_company"  class="form-control">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Yetkili Adı</label>
          <div class="row">
            <div class="col-xs-12">
              <input type="text" name="account_authorized_name_surname" require="" class="form-control">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Email </label>
          <div class="row">
            <div class="col-xs-12">
              <input type="email" name="account_email" class="form-control">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Telefon </label>
          <div class="row">
            <div class="col-xs-12">
              <input type="text" name="account_phone" class="form-control">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Vergi Dairesi </label>
          <div class="row">
            <div class="col-xs-12">
              <input type="text" name="account_tax_office" class="form-control">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Vergi Numarası </label>
          <div class="row">
            <div class="col-xs-12">
              <input type="text" name="account_tax_number" class="form-control">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>IBAN </label>
          <div class="row">
            <div class="col-xs-12">
              <input type="text" name="account_iban" class="form-control">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Adres </label>
          <div class="row">
            <div class="col-xs-12">
              <textarea class="form-control" name="account_adress" ></textarea>
            </div>
          </div>
        </div>

        

        <div align="right" class="box-footer">
          <button type="submit" class="btn btn-success" name="account_insert">Ekle</button>
        </div>



      </form>
    </div>

  </div>
<?php }  else if (isset($_GET['accountUpdate'])) {

  //bağlı id bilgilerini çek...


  ?>

  <div class="box box-primary">



    <div class="content-header">
      <h1 >Hesap Düzenle</h1>  
      <hr>       
    </div>

    <div class="box-body">

      <?php 

      if (isset($_POST['account_update'])) {
        
       $sonuc=$db->update("account",$_POST,[
        "form_name" => "account_update",
        "columns" => "account_id"]
        
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
 
 $sql=$db->wread("account","account_id",$_GET['account_id']);
 $row=$sql->fetch(PDO::FETCH_ASSOC);


 
 ?>

 <!-- update işlem sorgusu -->


 <form method="POST" enctype="multipart/form-data">


 <div class="form-group">
          <label>Firma Adı</label>
          <div class="row">
            <div class="col-xs-12">
              <input type="text" name="account_company" value="<?php echo $row['account_company'] ?>"  class="form-control">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Yetkili Adı</label>
          <div class="row">
            <div class="col-xs-12">
              <input type="text" name="account_authorized_name_surname" value="<?php echo $row['account_authorized_name_surname'] ?>" require="" class="form-control">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Email </label>
          <div class="row">
            <div class="col-xs-12">
              <input type="email" name="account_email"  value="<?php echo $row['account_email'] ?>" class="form-control">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Telefon </label>
          <div class="row">
            <div class="col-xs-12">
              <input type="text" name="account_phone"  value="<?php echo $row['account_phone'] ?>" class="form-control">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Vergi Dairesi </label>
          <div class="row">
            <div class="col-xs-12">
              <input type="text" name="account_tax_office"  value="<?php echo $row['account_tax_office'] ?>"  class="form-control">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Vergi Numarası </label>
          <div class="row">
            <div class="col-xs-12">
              <input type="text" name="account_tax_number"  value="<?php echo $row['account_tax_number'] ?>" class="form-control">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>IBAN </label>
          <div class="row">
            <div class="col-xs-12">
              <input type="text" name="account_iban" value="<?php echo $row['account_iban'] ?>" class="form-control">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Adres </label>
          <div class="row">
            <div class="col-xs-12">
              <textarea class="form-control" name="account_adress"  > <?php echo $row['account_adress'] ?></textarea>
            </div>
          </div>
        </div>

  

  <input type="hidden" name="account_id" value="<?php echo $row['account_id']; ?>">
  

  <div align="right" class="box-footer">
    <button type="submit" class="btn btn-success" name="account_update">Düzenle</button>
  </div>



</form>
</div>

</div>

<?php }

 ?>




<!-- Default box -->
<div class="box box-primary">

 <div class="content-header">
  <h1 >Cari Kayıtlar</h1>  
  <div align="right">
    <a href="?accountInsert=true"><button class="btn btn-success">Yeni Ekle</button></a>
    <br><br>
  </div>
  <?php 
if (isset($_GET['accountDelete'])) {
  
 $sonuc=$db->delete("account","account_id",$_GET['account_id']);


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
        <th>Yetkili</th>
        <th>Firma</th>
        
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>

      <?php 
      
       $sql=$db->read("account",[
        "columns_name" => "account_id",
        "columns_sort" => "DESC"
      ]);
      $say=1;
      while ($row=$sql->fetch(PDO::FETCH_ASSOC)) {  ?>

        <tr>
          <td><?php echo $say++; ?></td>
          <td width="150" ><?php echo $row['account_authorized_name_surname'] ?></td>
          <td  ><?php echo $row['account_company'] ?></td>
          <td width="50" ><a href="account-details.php?account_id=<?php echo $row['account_id'] ?>">  <button class="btn btn-primary btn-sm" > Hesap Detayı</button></a></td>
          
          <td align="center" width="5"><a href="?accountUpdate=true&account_id=<?php echo $row['account_id'] ?>"><i class="fa fa-pencil-square"></i></a></td>
          <td align="center" width="5"><a href="?accountDelete=True&account_id=<?php echo $row['account_id'] ?>"><i class="fa fa-trash-o"></i></a></td>
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
          url:"netting/order-ajax.php?account_must=true",
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