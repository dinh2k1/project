
<!--danh sách đơn hàng-->

<?php require_once('orders_c/orders_c.php');?>

<?php 
	$orders_class = new orders_controller();
	$list_orders = $orders_class->get_orders();
	// $del_cats = $cat_class->remove_cat();
?>


<!DOCTYPE html>
<html lang="en-us">
	<head>
		<title> Danh sách đơn hàng </title>
		
		<?php include('module/head.php')?>

	</head>
	
	<!-- #BODY -->

	<body class="">

		

		<!-- #NAVIGATION -->
		<!-- Left panel : Navigation area -->
		<!-- Note: This width of the aside area can be adjusted through LESS variables -->
		<?php include('module/nav.php')?>
		<!-- END NAVIGATION -->

		<!-- MAIN PANEL -->
		<div id="main" role="main">

			
			<!-- MAIN CONTENT -->
			<div id="content">
				<div class="row">
					
					</div>
				</div>

				<!-- widget grid -->
				<section id="widget-grid" class="">

					<!-- row -->
					<div class="row">

						<!-- NEW WIDGET START -->
						<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

							<!-- Widget ID (each widget will need unique ID)-->
							<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-0" data-widget-editbutton="false">
								
								

								<!-- widget div-->
								<div>

									<!-- widget edit box -->
									<div class="jarviswidget-editbox">
										<!-- This area used as dropdown edit box -->

									</div>
									<!-- end widget edit box -->

									
										<div class="table-responsive">
										
											<table class="table table-bordered table-striped table-hover">
												
												<thead>
													<tr>
														<th class="text-center">ID</th>
														<th>Chủ đơn hàng</th>
														<th>Liên hệ</th>
														<th>Hình thức thanh toán</th>
														<th>Giao hàng HCM</th>
														<th>Giao hàng HN</th>
														<th>Cách thức nhận hàng</th>
														<th>Giá</th>
														
														<th>Trạng thái</th>
														<th class="text-center">Thao tác</th>
													</tr>
												</thead>
												<tbody>
													<?php if (!empty($list_orders)): ?>
														<?php foreach ($list_orders as $v):?>
															<tr>
																<td class="text-center"><?=$v['Orders_ID']?></td>
																<td><?=$v['Orders_Name']?></td>
																	
																<td>
																	<?=$v['Orders_Phone']?><br>
																	<?=$v['Orders_Email']?><br>
																	<?=$v['Orders_Address']?>
																	
																</td>
																
																<td><?=$v['Orders_Payway']?>
																
																
																</td>
																
																<td><?=$v['Orders_HCM']?></td>
																<td><?=$v['Orders_HN']?></td>
																<td><?=$v['Orders_Rec']?></td>
																<td><?=number_format($v['Orders_Price'],0,',','.')?></td>
																
																<td>
																	<?php if ($v['Orders_Status']==0): ?>
																		Đơn hàng mới
																	<?php elseif($v['Orders_Status']==1): ?>
																		Đang vận chuyển
																	<?php else: ?>	
																		Đã thanh toán
																	<?php endif ?>
																</td>
																<td class="text-center">
																	<a class="btn btn-sm btn-primary" href="orders_detail_list.php?id=<?=$v['Orders_ID']?>">Chi tiết</a>
																	<a class="btn btn-sm btn-primary" href="orders_add.php?edit=<?=$v['Orders_ID']?>"><i class="fa fa-pencil-square-o"></i></a>
																	<a class="btn btn-sm btn-danger" href="orders_list.php?delete=<?=$v['Orders_ID']?>"><i class="fa fa-times"></i></a>
																</td>
															</tr>	
														<?php endforeach ?>
													<?php else:?>
														<tr>
															<td colspan="4" class="text-center">Chưa có dữ liệu</td>
														</tr>	
													<?php endif ?>
													
												</tbody>
											</table>
											
										</div>
									</div>
									<!-- end widget content -->

								</div>
								<!-- end widget div -->

							</div>
							<!-- end widget -->

						</article>
						<!-- WIDGET END -->

					</div>

					<!-- end row -->

					<!-- row -->

				</section>
				<!-- end widget grid -->
			</div>
			<!-- END MAIN CONTENT -->

		</div>
		<!-- END MAIN PANEL -->

		
		<!-- SHORTCUT AREA : With large tiles (activated via clicking user name tag)
		Note: These tiles are completely responsive,
		you can add as many as you like
		-->
		<div id="shortcut">
			<ul>
				<li>
					<a href="inbox.html" class="jarvismetro-tile big-cubes bg-color-blue"> <span class="iconbox"> <i class="fa fa-envelope fa-4x"></i> <span>Mail <span class="label pull-right bg-color-darken">14</span></span> </span> </a>
				</li>
				<li>
					<a href="calendar.html" class="jarvismetro-tile big-cubes bg-color-orangeDark"> <span class="iconbox"> <i class="fa fa-calendar fa-4x"></i> <span>Calendar</span> </span> </a>
				</li>
				<li>
					<a href="gmap-xml.html" class="jarvismetro-tile big-cubes bg-color-purple"> <span class="iconbox"> <i class="fa fa-map-marker fa-4x"></i> <span>Maps</span> </span> </a>
				</li>
				<li>
					<a href="invoice.html" class="jarvismetro-tile big-cubes bg-color-blueDark"> <span class="iconbox"> <i class="fa fa-book fa-4x"></i> <span>Invoice <span class="label pull-right bg-color-darken">99</span></span> </span> </a>
				</li>
				<li>
					<a href="gallery.html" class="jarvismetro-tile big-cubes bg-color-greenLight"> <span class="iconbox"> <i class="fa fa-picture-o fa-4x"></i> <span>Gallery </span> </span> </a>
				</li>
				<li>
					<a href="profile.html" class="jarvismetro-tile big-cubes selected bg-color-pinkDark"> <span class="iconbox"> <i class="fa fa-user fa-4x"></i> <span>My Profile </span> </span> </a>
				</li>
			</ul>
		</div>
		<!-- END SHORTCUT AREA -->

		<!--================================================== -->

		<!-- MAIN JS -->
		<?php include('module/js.php')?>

		<!-- PAGE RELATED PLUGIN(S) -->


		<script type="text/javascript">
		// DO NOT REMOVE : GLOBAL FUNCTIONS!
		$(document).ready(function() {
			pageSetUp();
		})

		</script>

		<!-- Your GOOGLE ANALYTICS CODE Below -->
		<?php //include('module/google_analytics.php')?>

	</body>

</html>
													
