<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8" />
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<?php if ($icon) { ?>
<link href="<?php echo $icon; ?>" rel="icon" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/stylesheet.css" />
<?php foreach ($styles as $style) { ?>
<link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />
<script type="text/javascript" src="catalog/view/javascript/common.js"></script>
<script type='text/javascript'>$(function(){$.config = {url:'<?php echo HTTP_SERVER; ?>'};});</script>
<script type="text/javascript" src="catalog/view/javascript/fastorder.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery.liveValidation.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/fastorder.css" />
<script type="text/javascript" src="catalog/view/javascript/vegas/jquery.vegas.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/vegas/jquery.vegas.css" media="screen" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/print.css" media="print" />
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery.jcarousel.min.js"></script>
<link type="text/css" rel="stylesheet" href="catalog/view/javascript/jquery/jScrollPane.css"/>
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/jscrollpane.js"></script>

<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/skins/tango/skin.css" />
<script type="text/javascript">
    jQuery(function()
    {
        jQuery('.left-data').jScrollPane({showArrows:false});
		jQuery('.left-data1').jScrollPane({showArrows:false});
    });
</script>


<script type="text/javascript">

jQuery(document).ready(function() {
	jQuery('#mycarousel').jcarousel({
	});
});
</script>
<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/ie7.css" />
<![endif]-->
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/ie6.css" />
<script type="text/javascript" src="catalog/view/javascript/DD_belatedPNG_0.0.8a-min.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix('#logo img');
</script>
<![endif]-->
<?php if ($stores) { ?>
<script type="text/javascript"><!--
$(document).ready(function() {
<?php foreach ($stores as $store) { ?>
$('body').prepend('<iframe src="<?php echo $store; ?>" style="display: none;"></iframe>');
<?php } ?>
});
//--></script>
<?php } ?>
<script type="text/javascript" >
$(document).ready(function() {
	$("#menu>ul>li>a").click(function() {
		$("#menu>ul>li>div").hide();
		if(jQuery(this).hasClass('active'))
		{
		$(this).next().slideUp();
		$(this).attr('class', 'unacive');
		} else {
		$(this).next().slideDown();
		$("#menu>ul>li>a").attr('class', 'unacive');
		$(this).attr('class', 'active');
		}
	});
	$(document).click( function(event){
      if( $(event.target).closest("#menu>ul>li").length )
        return;
      $("#menu>ul>li>div").hide();
	  $("#menu>ul>li>a").attr('class', 'unacive');
      event.stopPropagation();
    });
	$("#item-select1").live('change',function(){
	var opt = $(this).val();
	//alert(opt);
	$('#rezults').html($('#itof1').html());
	$('li.multiselect.sel select').val(opt);
	$('.info').show();
	});
	$("#item-select2").live('change',function(){
	var opt1 = $(this).val();
	$('#rezults').html($('#itof2').html());
	$('li.sel.f2 select').val(opt1)
	$('.info').show();
	});
});

</script>
<!-- <?php echo $background; ?> -->
<?php echo $google_analytics; ?>
</head>
<body>
<div id="wrapper">
<div id="container">
<div id="header">
  <?php if ($logo) { ?>
  <div id="logo"><a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></a></div>
  <?php } ?>
  <?php echo $language; ?>
  <?php echo $currency; ?>
  <?php echo $cart; ?>
  <div id="search">
    <div class="button-search"></div>
    <input type="text" name="search" placeholder="<?php echo $text_search; ?>" value="<?php echo $search; ?>" />
  </div>
  <div class="links"><a href="<?php echo $wishlist; ?>" id="wishlist-total"><?php echo $text_wishlist; ?></a><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></div>
</div>
<?php if ($categories) { ?>
<div id="menu">
  <ul>
    <?php foreach ($categories as $category) { ?>
    <li><a href="javascript:void(0)"><?php echo $category['name']; ?></a>
      <?php if ($category['children']) { ?>
      <div>
        <?php for ($i = 0; $i < count($category['children']);) { ?>
        <ul>
          <?php $j = $i + ceil(count($category['children']) / $category['column']); ?>
          <?php for (; $i < $j; $i++) { ?>
          <?php if (isset($category['children'][$i])) { ?>
          <li><a href="<?php echo $category['children'][$i]['href']; ?>"><span class="img"><img src="<?php echo $category['children'][$i]['image_src']; ?>"></span><span class="txt"><?php echo $category['children'][$i]['name']; ?></span></a></li>
          <?php } ?>
          <?php } ?>
        </ul>
        <?php } ?>
      </div>
      <?php } ?>
    </li>
    <?php } ?>
	<li class="nonactive"><a id="uppercase" href="/export/">Export</a>
	<li class="contact_us nonactive"><a id="uppercase" href="<?php echo $contact; ?>">Contact Us</a>
  </ul>
</div>
<?php } ?>
<?php if ($error) { ?>

    <div class="warning"><?php echo $error ?><img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>

<?php } ?>
<div id="notification"></div>
