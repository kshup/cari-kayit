<?php 
require_once 'header.php';
require_once 'sidebar.php';
error_reporting(0);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->

  

  <section class="content">


   <?php 

   if (isset($_GET['operationInsert'])) {?>
    <div class="box box-primary">



      <div class="content-header">
        <h1 >Gelir, Gider Ekle</h1>  
        <hr>       
      </div>

      <div class="box-body">

        <?php 
        if (isset($_POST['operation_insert'])) {

         $sonuc=$db->insert("operation",$_POST,[
          "form_name" => "operation_insert"
        ]
      );

      if ($sonuc['status']) {?>
       <div class="alert alert-success">
         Kayıt Başarılı <a href="<?php $link=explode("?",$_SERVER['REQUEST_URI']); echo $link[0]; ?>">Listele</a>
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
          <label>Fatura No</label>
          <div class="row">
            <div class="col-xs-12">
              <textarea class="form-control" name="operation_invoice"></textarea>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Tarih</label>
          <div class="row">
            <div class="col-xs-12">
              <input type="date"  name="operation_date" value="<?php echo date("Y-m-d"); ?>" class="form-control">
            </div>
          </div>
        </div>
        


        <div id="account" class="form-group">
          <label>Hesap Seç</label>
          <div class="row">
            <div class="col-xs-12">
              <select class="form-control account" required="" name="account_id">
                <option value="">Seçim Yapın</option>
                <?php 
                $sql=$db->read("account",[
                  "columns_name" => "account_id",
                  "columns_sort" => "DESC"
                ]);
                $say=1;
                while ($row=$sql->fetch(PDO::FETCH_ASSOC)) {  ?>
                  <option value="<?php echo $row['account_id'] ?>">
                    <?php echo empty($row['account_company']) ? $row['account_authorized_name_surname'] : $row['account_company'] ?>

                  </option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>İşlem Tipi</label>
          <div class="row">
            <div class="col-xs-12">
              <select class="form-control" required="" name="operation_type">
                <option value="">Seçim Yapın</option>

                <option value="Gelir">Gelir</option>
                <option value="Gider">Gider</option>

              </select>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Tutar</label>
          <div class="row">
            <div class="col-xs-12">
              <input type="text"  name="operation_price" required="" class="form-control">
            </div>
          </div>
        </div>


        <div align="right" class="box-footer">
          <button type="submit" class="btn btn-success" name="operation_insert">Ekle</button>
        </div>



      </form>
    </div>

  </div>
<?php }  

?>




<!-- Default box -->
<div class="box box-primary">

 <div class="content-header">
  <h1 >Gelir, Giderler</h1>  
  <div align="right">
    <a href="?operationInsert=true"><button class="btn btn-success">Yeni Ekle</button></a>
    <br><br>
  </div>
  <?php 
  if (isset($_GET['operationDelete'])) {

   $sonuc=$db->delete("operation","operation_id",$_GET['operation_id'],$_GET['file_delete']);


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
        <th>Tarih</th>
        <th>Tip</th>
        <th>Ürün</th>
        <th>Hesap</th>
        <th>Tutar</th>
        <th>Fatura NO</th>
        <th></th>

      </tr>
    </thead>
    <tbody>

      <?php 
      $sql=$db->qSQL("SELECT * FROM operation INNER JOIN account ON account.account_id=operation.account_id ");
      
      $say=1;
      while ($row=$sql->fetch(PDO::FETCH_ASSOC)) {  ?>

        <tr> 
        <td><?php echo $say++; ?></td>
          <td width="100"><?php echo $db->tDate($row['operation_date'],["date_time" => TRUE]) ?></td>
          <td><?php echo ($row['operation_type']=='Gelir') ? "<span class='label label-success'>Gelir</span>" : "<span class='label label-danger'>Gider</span>" ?></td>
          <td ><?php echo $row['products_title'] ?></td>
          <td><?php echo empty($row['account_company']) ? $row['account_authorized_name_surname'] : $row['account_company'] ?></td>
          <td><?php echo $row['operation_price'] ?></td>
          <td><?php echo $row['operation_invoice'] ?></td>
          
          <td align="center" width="5"><a href="?operationDelete=True&operation_id=<?php echo $row['operation_id'] ?>&file_delete=<?php echo $row['operation_file'] ?>"><i class="fa fa-trash-o"></i></a></td>
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
  
  $("select.account").on('change',function() {
    var account_id=$(this).children( "option:selected").val();
    console.log(account_id);

    $.ajax({

      type:'POST',
      url:'netting/order-ajax.php',
      data:{'account_id':account_id},
      success:function(data) {

       if (data!="FALSE") {
        $("#account").after(data);
       } else {

        $("#products").after(data);
       }

      }

    });

  });
</script>