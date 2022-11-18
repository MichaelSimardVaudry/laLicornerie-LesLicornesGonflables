<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

try {
	ob_start();

?><!DOCTYPE html>
<html>
<head>
	<style type='text/css'>
		html {
			font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
			box-sizing: border-box;
			margin: 0;
			padding: 0;
		}
		body {
			margin: 0;
			padding: 0;
			overflow: hidden;
		}
		#preview-container {
			margin: 0 auto;
			min-height: 100%;
			max-width: 100%;
			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
			-webkit-box-align: center;
			   -ms-flex-align: center;
				  align-items: center;
			-webkit-box-pack: center;
			   -ms-flex-pack: center;
			 justify-content: center;
		}
		#preview-inner {
			width: 100%;
			height: auto;
		}
	</style>
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Expires" content="0">
	<?php wp_enqueue_scripts(); ?>
</head>
<body>
	<div id="preview-container">
		<div id="preview-inner">
	<?php echo $xo_slider->get_slider( $slider_id ); ?>
		</div>
	</div>
<?php
	print_late_styles();
	print_footer_scripts();
?>
</body>
</html><?php

	$html = preg_replace( ['/\>[^\S ]+/s', '/[^\S ]+\</s', '/\s+/s'], ['>', '<', ' '],  ob_get_clean() );

} catch ( Exception $e ) {
	ob_clean();
	return new WP_Error( 'preview_failed', $e->getMessage() );
}
return $html;
