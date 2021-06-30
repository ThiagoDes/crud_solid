<?php 
	if(SIS == 2){
		header('Location: '.BASE_URL);
	}
?>

<!DOCTYPE html>

<html lang="pt-BR" class="no-js">

	<head>
		<meta charset="utf-8">
        <title><?php echo TITULO_PROJETO; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="<?php echo BASE_URL; ?>/assets/images/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style-minimal-flat.css" />
		<script src="<?php echo BASE_URL; ?>/assets/js/modernizr.custom.js"></script>
	</head>

    <body>
		<div id="loading" class="dark-back">
			<div class="loading-bar"></div>
			<span class="loading-text opacity-0">Algo Estranho?</span>
		</div>

		<div id="particles-js"></div>

        <div id="slider" class="sl-slider-wrapper">
			<div class="sl-slider">
				<div class="sl-slide bg-1" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
					<div class="sl-slide-inner">
						<div class="content-slide">
							<div class="container">
								<img src="<?php echo BASE_URL; ?>/assets/images/logo.png" alt="" class="brand-logo text-intro opacity-0" />
								<h1 class="text-intro opacity-0">Em Manutenção</h1>
								<p class="text-intro opacity-0">
									No momento estão sendo feitas mudanças no sistema.
                                	<br> Mas não fique triste, logo estará disponível novamente para acessar ;D.
								</p>
								<a data-dialog="somedialog"></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="somedialog" class="dialog">
			<div class="dialog__overlay"></div>
			<div class="dialog__content">
				<button class="close-newsletter" data-dialog-close></button>
			</div>						
		</div>

		<script src="<?php echo BASE_URL; ?>/assets/js/jquery.min.js"></script>
		<script src="<?php echo BASE_URL; ?>/assets/js/jquery.easings.min.js"></script>
		<script src="<?php echo BASE_URL; ?>/assets/js/bootstrap.min.js"></script>
		<script src="<?php echo BASE_URL; ?>/assets/js/jquery.ba-cond.min.js"></script>
		<script src="<?php echo BASE_URL; ?>/assets/js/jquery.slitslider.js"></script>
		<script src="<?php echo BASE_URL; ?>/assets/js/notifyMe.js"></script>
		<script src="<?php echo BASE_URL; ?>/assets/js/classie.js"></script>
		<script src="<?php echo BASE_URL; ?>/assets/js/dialogFx.js"></script>
		<script src="<?php echo BASE_URL; ?>/assets/js/particles.js"></script>
		<script src="<?php echo BASE_URL; ?>/assets/js/jquery.mCustomScrollbar.js"></script>
		<script src="<?php echo BASE_URL; ?>/assets/js/main-flat.js"></script>

	</body>

</html>