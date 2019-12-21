<!DOCTYPE HTML>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>UploadiFive Test</title>
	
	<script src="jquery.uploadifive.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="uploadifive.css">
	<style type="text/css">
		body {
			font: 13px Arial, Helvetica, Sans-serif;
		}

		.uploadifive-button {
			float: left;
			margin-right: 10px;
		}

		#queue {
			border: 1px solid #E5E5E5;
			height: 177px;
			overflow: auto;
			margin-bottom: 10px;
			padding: 0 3px 3px;
			width: 300px;
		}
	</style>
</head>

<body>

	<div class="row">
		<!-- row Begin -->

		<div class="col-lg-12">
			<!-- col-lg-12 Begin -->

			<ol class="breadcrumb">
				<!-- breadcrumb Begin -->

				<li class="active">
					<!-- active Begin -->

					<i class="fa fa-dashboard"></i> Dashboard / Insert Products

				</li><!-- active Finish -->

			</ol><!-- breadcrumb Finish -->

		</div><!-- col-lg-12 Finish -->

	</div><!-- row Finish -->

	<div class="row">
		<!-- row Begin -->

		<div class="col-lg-12">
			<!-- col-lg-12 Begin -->

			<div class="panel panel-default">
				<!-- panel panel-default Begin -->

				<div class="panel-heading">
					<!-- panel-heading Begin -->

					<h3 class="panel-title">
						<!-- panel-title Begin -->

						<i class="fa fa-money fa-fw"></i> Thêm sản phẩm

					</h3><!-- panel-title Finish -->

				</div> <!-- panel-heading Finish -->

				<div class="panel-body">
					<!-- panel-body Begin -->

					<form method="post" class="form-horizontal" enctype="multipart/form-data">
						<!-- form-horizontal Begin -->

						<div class="form-group">
							<!-- form-group Begin -->

							<label class="col-md-3 control-label"> Tên Sản Phẩm </label>

							<div class="col-md-6">
								<!-- col-md-6 Begin -->

								<input name="product_title" type="text" class="form-control" required>

							</div><!-- col-md-6 Finish -->

						</div><!-- form-group Finish -->

						<div class="form-group">
							<!-- form-group Begin -->

							<label class="col-md-3 control-label"> Hãng sản xuất </label>

							<div class="col-md-6">
								<!-- col-md-6 Begin -->

								<select name="manufacturer" class="form-control">
									<!-- form-control Begin -->

									<option selected disabled> Chọn hãng </option>

									<?php

									$get_manufacturer = "select * from hang";
									$run_manufacturer = mysqli_query($con, $get_manufacturer);

									while ($row_manufacturer = mysqli_fetch_array($run_manufacturer)) {

										$manufacturer_id = $row_manufacturer['id'];
										$manufacturer_title = $row_manufacturer['name'];

										echo "
                                  
                                  <option value='$manufacturer_id'> $manufacturer_title </option>
                                  
                                  ";
									}

									?>

								</select><!-- form-control Finish -->

							</div><!-- col-md-6 Finish -->

						</div><!-- form-group Finish -->

						<div class="form-group">
							<!--form-group Begin-->

							<label class="col-md-3 control-label"> Danh mục sản phẩm </label>


							<div class="col-md-6">
								<select name="cat" class="form-control" onchange="showUser(this.value)">
									<option selected disabled>Chọn danh mục:</option>
									<?php
									$get_p_cats = "select * from product_type";
									$run_p_cats = mysqli_query($con, $get_p_cats);
									while ($row_p_cats = mysqli_fetch_array($run_p_cats)) {
										$p_cat_id = $row_p_cats['id'];
										$p_cat_title = $row_p_cats['name'];

										echo "
                <option value='$p_cat_id'> $p_cat_title </option>
            ";
									}
									?>
								</select>
								<br>
								<div id="txtHint"></div>




							</div>

						</div>
						<!--form-group End-->




						<div class="form-group">
							<!-- form-group Begin -->

							<label class="col-md-3 control-label"> Giá </label>

							<div class="col-md-6">
								<!-- col-md-6 Begin -->

								<input name="product_price" type="text" class="form-control" required>

							</div><!-- col-md-6 Finish -->

						</div><!-- form-group Finish -->


						<div class="form-group">
							<!-- form-group 3 begin -->

							<label for="" class="control-label col-md-3">
								<!-- control-label col-md-3 begin -->

								Hình Sản Phẩm

							</label><!-- control-label col-md-3 finish -->

							<div id="queue"></div>
							<input id="file_upload" name="file_upload" type="file" multiple="true">
							<a style="position: relative; top: 8px;" href="javascript:$('#file_upload').uploadifive('upload')">Upload Files</a>

						</div><!-- form-group 3 finish -->


						<div class="form-group">
							<!-- form-group Begin -->

							<label class="col-md-3 control-label"> Mô tả </label>

							<div class="col-md-6">
								<!-- col-md-6 Begin -->

								<textarea name="product_desc" cols="19" rows="6" class="form-control"></textarea>

							</div><!-- col-md-6 Finish -->

						</div><!-- form-group Finish -->



						<div class="form-group">
							<!-- form-group Begin -->

							<label class="col-md-3 control-label"></label>

							<div class="col-md-6">
								<!-- col-md-6 Begin -->

								<input name="submit" value="Insert Product" type="submit" class="btn btn-primary form-control">

							</div><!-- col-md-6 Finish -->

						</div><!-- form-group Finish -->

					</form><!-- form-horizontal Finish -->

				</div><!-- panel-body Finish -->

			</div><!-- canel panel-default Finish -->

		</div><!-- col-lg-12 Finish -->

	</div><!-- row Finish -->

	<script src="js/tinymce/tinymce.min.js"></script>
	<script>
		tinymce.init({
			selector: 'textarea'
		});
	</script>

	<script type="text/javascript">
		<?php $timestamp = time(); ?>
		$(function() {
			$('#file_upload').uploadifive({
				'auto': false,
				'checkScript': 'check-exists.php',
				'formData': {
					'timestamp': '<?php echo $timestamp; ?>',
					'token': '<?php echo md5('unique_salt' . $timestamp); ?>'
				},
				'queueID': 'queue',
				'uploadScript': 'uploadifive.php',
				'onUploadComplete': function(file, data) {
					console.log(data);
				}
			});
		});
	</script>
</body>

</html>