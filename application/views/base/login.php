<!DOCTYPE html>
<html lang="en">
	<link href="<?php echo IMAGE_APP_PATH; ?>ccbs.ico" rel="shortcut icon" />
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>iFalconi - Rating and Billing System</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo BS_CSS_PATH; ?>bootstrap.css" />
		<link rel="stylesheet" href="<?php echo BS_CSS_PATH; ?>font-awesome.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo BS_CSS_PATH; ?>ace-fonts.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo BS_CSS_PATH; ?>ace.css" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="<?php echo BS_CSS_PATH; ?>ace-part2.css" />
		<![endif]-->
		<link rel="stylesheet" href="<?php echo BS_CSS_PATH; ?>ace-rtl.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="<?php echo BS_CSS_PATH; ?>ace-ie.css" />
		<![endif]-->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="<?php echo BS_JS_PATH; ?>html5shiv.js"></script>
		<script src="<?php echo BS_JS_PATH; ?>respond.js"></script>
		<![endif]-->
		
		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo BS_JS_PATH; ?>jquery.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->
		
		<!--[if IE]>
        <script type="text/javascript">
         window.jQuery || document.write("<script src='<?php echo BS_JS_PATH; ?>jquery1x.js'>"+"<"+"/script>");
        </script>
        <![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo BS_JS_PATH; ?>jquery.mobile.custom.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo BS_JS_PATH; ?>bootstrap.js"></script>
	</head>

	<body class="login-layout">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h3><img border="0" src="<?php echo IMAGE_APP_PATH; ?>ifalconi_v_rb2.gif"/></h3>
								<h5 class="red" id="id-company-text"> <strong>Version: 1.07.15, &copy; PT. Triklin Rekatama, 2015 <br/>
								    Front-End Counter User </strong>
								    </h5>
							</div>

							<div class="space-6"></div>
                            
							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<i class="ace-icon fa fa-coffee green"></i>
												Please Enter Your Information
											</h4>

											<div class="space-6"></div>

											<form action="<?php echo $login_url;?>" method="post" role="form" enctype="application/x-www-form-urlencoded">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" placeholder="Username" name="uname" id="uname" />
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" placeholder="Password" name="password" id="password" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<div class="space"></div>

													<div class="clearfix">
														<button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110">Login</span>
														</button>
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>
											
										</div><!-- /.widget-main -->

									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->
                                <?php if(!empty($errormsg)):?>
                                    <div class="alert alert-danger">
                                        <button class="close" data-dismiss="alert" type="button">
                                         <i class="ace-icon fa fa-times"></i>
                                        </button> 
                                        <?php echo $errormsg;?>   
                                    </div>
                                    <script>
                                        $(".alert").fadeTo(5000, 500).fadeOut(1000, function(){
                                            $(".alert").alert('close');        
                                        });
                                    </script>
                                <?php endif;?>
							</div><!-- /.position-relative -->
                            
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		

		<!-- inline scripts related to this page -->
		<script type="text/javascript">

			//you don't need this, just used for changing background
			jQuery(function($) {
			 
    			 //default theme   
    			 $('body').attr('class', 'login-layout light-login');
				 $('#id-text2').attr('class', 'grey');
				 $('#id-company-text').attr('class', 'red');			 
			});
		</script>
	</body>
</html>
