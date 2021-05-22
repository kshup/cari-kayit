<?php 
require_once 'class.crud.php';
$db=new crud();

if (isset($_GET['blogs_must'])) {
	
	$sonuc=$db->orderUpdate("blogs",$_POST['item'],"blogs_must","blogs_id");

	// $returnMsg=array();
	$returnMsg= ['islemSonuc' => true, 'islemMsj' => $sonuc['status']];
	echo json_encode($returnMsg);
}


if (isset($_GET['users_must'])) {
	
	$sonuc=$db->orderUpdate("users",$_POST['item'],"users_must","users_id");

	// $returnMsg=array();
	$returnMsg= ['islemSonuc' => true, 'islemMsj' => $sonuc['status']];
	echo json_encode($returnMsg);
}


if (isset($_GET['admins_must'])) {
	
	$sonuc=$db->orderUpdate("admins",$_POST['item'],"admins_must","admins_id");

	// $returnMsg=array();
	$returnMsg= ['islemSonuc' => true, 'islemMsj' => $sonuc['status']];
	echo json_encode($returnMsg);
}

if (isset($_GET['sliders_must'])) {
	
	$sonuc=$db->orderUpdate("sliders",$_POST['item'],"sliders_must","sliders_id");

	// $returnMsg=array();
	$returnMsg= ['islemSonuc' => true, 'islemMsj' => $sonuc['status']];
	echo json_encode($returnMsg);
}

if (isset($_GET['sliders_must'])) {
	
	$sonuc=$db->orderUpdate("sliders",$_POST['item'],"sliders_must","sliders_id");

	// $returnMsg=array();
	$returnMsg= ['islemSonuc' => true, 'islemMsj' => $sonuc['status']];
	echo json_encode($returnMsg);
}

if (isset($_GET['settings_must'])) {
	
	$sonuc=$db->orderUpdate("settings",$_POST['item'],"settings_must","settings_id");

	// $returnMsg=array();
	$returnMsg= ['islemSonuc' => true, 'islemMsj' => $sonuc['status']];
	echo json_encode($returnMsg);
}

if (isset($_GET['abouts_must'])) {
	
	$sonuc=$db->orderUpdate("abouts",$_POST['item'],"abouts_must","abouts_id");

	// $returnMsg=array();
	$returnMsg= ['islemSonuc' => true, 'islemMsj' => $sonuc['status']];
	echo json_encode($returnMsg);
}



if (isset($_POST['account_id'])) {
	
	$sql=$db->qSQL("SELECT * FROM sales INNER JOIN account ON account.account_id=sales.account_id INNER JOIN products ON products.products_id=sales.products_id WHERE sales.account_id='{$_POST['account_id']}'");

	if ($sql->rowCount()>0) {?>
		

		<div id="products" class="form-group">
			<label>Ürün, Hizmet Seçin</label>
			<div class="row">
				<div class="col-xs-12">
					<select class="form-control account"  name="products_id">
						<option value="">Seçim Yapın</option>
						<?php 
						$sql=$db->read("products",[
							"columns_name" => "products_id",
							"columns_sort" => "DESC"
						]);
						$say=1;
						while ($row=$sql->fetch(PDO::FETCH_ASSOC)) {  ?>
							<option value="<?php echo $row['products_id'] ?>"><?php echo $row['products_title'] ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
		</div>

	<?php } else {

		echo "FALSE";
	}

}
?>