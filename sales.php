<?php 
require_once 'header.php';
require_once 'sidebar.php'

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->

  

  <section class="content">


   <?php 

   if (isset($_GET['salesInsert'])) {?>
    <div class="box box-primary">



      <div class="content-header">
        <h1 >Satış Ekle</h1>  
        <hr>       
      </div>

      <div class="box-body">

        <?php 
        if (isset($_POST['sales_insert'])) {
          
         $sonuc=$db->insert("sales",$_POST,[
          "form_name" => "sales_insert"
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
          <label>Hesap Seçiniz</label>
          <div class="row">
            <div class="col-xs-12">
              <select class="form-control" required="" name="account_id">
                <option value=""> Seçim Yapın</option>
                <?php 
                    
                    $sql=$db->read("account",[
                        "columns_name" => "account_id",
                        "columns_sort" => "DESC"
                    ]);
                    $say=1;
      while ($row=$sql->fetch(PDO::FETCH_ASSOC)) {  ?>
        <option value="<?php echo $row['account_id'] ?>">
         <?php echo empty($row['account_company']) ? $row['account_authorized_name_surname'] : $row['account_company'] ?> </option> 
         
         
         <?php } ?>
              </select>
            </div>
          </div>
        </div>


        
      <div class="form-group">
          <label>Ürün Seçiniz</label>
          <div class="row">
            <div class="col-xs-12">
              <select class="form-control" required="" name="products_id">
              <option value=""> Seçim Yapın</option>
                <?php 
                    
                    $sql=$db->read("products",[
                        "columns_name" => "products_id",
                        "columns_sort" => "DESC"
                    ]);
                    $say=1;
      while ($row=$sql->fetch(PDO::FETCH_ASSOC)) {  ?>
        <option value="<?php echo $row['products_id'] ?>"> <?php echo $row['products_title'] ?> </option> 
         
         
         <?php } ?>
              </select>
            </div>
          </div>
        </div>
       

        

        <div align="right" class="box-footer">
          <button type="submit" class="btn btn-success" name="sales_insert">Ekle</button>
        </div>



      </form>
    </div>

  </div>
<?php }  

 ?>




<!-- Default box -->
<div class="box box-primary">

 <div class="content-header">
  <h1 >Satışlar</h1>  
  <div align="right">
    <a href="?salesInsert=true"><button class="btn btn-success">Yeni Ekle</button></a>
    <br><br>
  </div>
  <?php 
if (isset($_GET['salesDelete'])) {
  
 $sonuc=$db->delete("sales","sales_id",$_GET['sales_id']);


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
        <th>Ürün, Hizmet</th>
        <th>Hesap Sahibi</th>
        <th>Tutar</th>
        <th></th>
        
        <th></th>
     
      </tr>
    </thead>
    <tbody>

      <?php 
      
       $sql=$db->qSQL("SELECT * FROM sales INNER JOIN account ON account.account_id=sales.account_id INNER JOIN  products ON products.products_id= sales.products_id ");
      $say=1;
      while ($row=$sql->fetch(PDO::FETCH_ASSOC)) {  ?>

        <tr>
          <td><?php echo $say++; ?></td>
          <td  ><?php echo $db->tDate($row['sales_date'],["date" => TRUE]) ?></td>
          <td  ><?php echo $row['products_title'] ?></td>
          <td  ><?php echo empty($row['account_company']) ? $row['account_authorized_name_surname'] : $row['account_company'] ?></td>
          <td  ><?php echo $row['products_price'] ?></td>
          
          <td align="center" width="5"><a href="?salesDelete=True&sales_id=<?php echo $row['sales_id'] ?>"><i class="fa fa-trash-o"></i></a></td>
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
