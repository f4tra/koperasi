<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $template['base_title']; ?></title>
  <?php echo $template['metas']; ?>
  <?php echo $template['css']; ?>
  <?php echo $template['js_header']; ?>
  
  <link href="assets/favicon.ico" rel="shortcut icon">
  <link href="assets/apple-touch-icon.png" rel="apple-touch-icon">
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
    @javascript html5shiv respond.min
  <![endif]-->
</head>

<body>

<div class="all-wrapper fixed-header left-menu hide-sub-menu">
	<?php $this->load->view('header', $template); ?>
	<?php //$this->load->view('side', $template); ?>
  
  
  <div class="main-content">
	<?php echo $template['content']; ?>
  </div>
  <div class="page-footer">
  © 2013 Saturn Admin Template.
</div>
</div>

<?php echo $template['js_footer']; ?>
<!-- @include _footer