<div id="<?php echo $prefix;?>ticomments_<?php echo $mark_id; ?>">
<a class="button fastordermark" href="#" style="" onclick="<?php echo $prefix;?>tel(); return false;" ><span class="offer"><?php echo $heading_title; ?></span></a>
</div>
<div style="display:none;">

<div id="<?php echo $prefix;?>icomments_<?php echo $mark_id; ?>">
<div style="padding: 20px;">
<div class="container_reviews" id="<?php echo $prefix;?>container_reviews_<?php echo $mark;?>_<?php echo $mark_id;?>">
	<div class="container_reviews_vars" style="display: none">
		<div class="mark"><?php echo $mark; ?></div>
		<div class="exec">
		//alert('JS handler Mark form generator');
		window.location.href = $(location).attr('href');
		</div>
		<div class="mark_id"><?php echo $mark_id; ?></div>
		<div class="theme"><?php echo $theme; ?></div>
		<div class="visual_editor"><?php echo $visual_editor; ?></div>
		<div class="mylist_position"><?php echo $this->registry->get('mylist_position');?></div>
		<div class="thislist"><?php echo base64_encode(serialize($thislist)); ?></div>
		<div class="text_wait"><?php echo $text_wait; ?></div>
		<div class="visual_rating"><?php echo $settings_widget['visual_rating']; ?></div>
        <div class="signer"><?php echo $settings_widget['signer']; ?></div>
        <div class="imagebox"><?php echo $imagebox; ?></div>
        <div class="prefix"><?php echo $prefix;?></div>
	</div>

	<?php if (isset($settings_widget['signer']) && $settings_widget['signer']) { ?>
		<div id="<?php echo $prefix;?>record_signer" class="marginbottom5">
			<div id="<?php echo $prefix;?>js_signer"  style="display:none;"></div>
			<form id="<?php echo $prefix;?>form_signer">
			<label>
			<input id="<?php echo $prefix;?>comments_signer" class="comments_signer" type="checkbox" <?php if (isset($signer_status) && $signer_status) echo 'checked'; ?>/>
			<ins class="fontsize_15 hrefajax"><?php echo $this->language->get('text_signer'); ?></ins>
			</label>
			</form>
		</div>
  	<?php } ?>


<?php if (isset($settings_widget['visual_editor']) && $settings_widget['visual_editor']) { ?>
<script>CURLANG=WBBLANG['<?php echo $lang_code;?>'] || WBBLANG['en'] || CURLANG;</script>
<?php } ?>

  <div id="<?php echo $prefix;?>div_comment_<?php echo $mark_id; ?>" >
<div id="form_h1<?php echo $prefix;?>" style="width: 100%; border-bottom: 2px solid #848A8F; font-size: 24px; color:#848A8F;  margin-bottom: 10px;  ">
<?php echo $heading_title; ?>
</div>
<div style="float: left; width: 30%;">
<div id="form_image<?php echo $prefix;?>"></div>

<div id="form_price<?php echo $prefix;?>" style="text-align: center; font-size: 21px;"></div>

<div>
<h3>Postal Adress</h3>
<img src="/image/data/ohpiugpug.png" style="width: 99%;">
<br>
      <?php $this->language->load('information/contact'); ?>
	  <b><?php   echo $this->language->get('text_address'); ?></b><br />
        <?php   echo $this->config->get('config_name'); ?><br />
        <?php   echo html_entity_decode($this->config->get('config_address'), ENT_QUOTES, 'UTF-8'); ?><br />
        <?php if ($this->config->get('config_telephone')) { ?>
        <b><?php   echo $this->language->get('text_telephone'); ?></b><br />
        <?php  echo $this->config->get('config_telephone'); ?><br />
        <br>
      <?php } ?>



</div>


</div>
<div style="float: left; width: 70%">


    <div id="<?php echo $prefix;?>comment_<?php echo $mark_id; ?>" >

     <?php  echo $html_comment; ?>

    </div>

	    <div id="<?php echo $prefix;?>comment-title" style="font-size:1px; line-height: 1px; overflow: hidden;">
	    <a href="#"  id="<?php echo $prefix;?>comment_id_reply_0" class="comment_reply">
		    <ins style="font-size:1px; line-height: 1px; overflow: hidden;"  id="<?php echo $prefix;?>reply_0" class="hrefajax text_write_review"></ins>
	     </a>
	    </div>

   <div class="<?php echo $prefix;?>comment_work" id="<?php echo $prefix;?>comment_work_0"></div>

 <div id="<?php echo $prefix;?>reply_comments" style="display:none;">

 <div id="<?php echo $prefix;?>comment_work_" class="<?php echo $prefix;?>form_customer_pointer width100 margintop10">
	<?php if (isset($customer_id) && !$customer_id)   { ?>
	<div id="form_customer_none" style="display:none;"></div>
		<div class="form_customer <?php echo $prefix;?>form_customer" id="<?php echo $prefix;?>form_customer" style="display:none;">
		      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
		        <div class="form_customer_content">
				  <a href="#" style="float: right;"  class="hrefajax"  onclick="$('.<?php echo $prefix;?>form_customer').hide('slide', {direction: 'up' }, 'slow'); return false;"><?php echo $this->language->get('hide_block'); ?></a>
		          <!-- <p><?php echo $text_i_am_returning_customer; ?></p> -->
		          <b><?php echo $entry_email; ?></b><br />
		          <input type="text" name="email" value="<?php echo $email; ?>" />
		          <br />
		          <br />
		          <b><?php echo $entry_password; ?></b><br />
		          <input type="password" name="password" value="<?php echo $password; ?>" />
		          <br />
		          <a href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a><br />
		          <br />
		          <input type="submit" value="<?php echo $button_login; ?>" class="button" />
				  <a href="<?php echo $register; ?>" class="marginleft10"><?php echo $this->language->get('error_register'); ?></a>
		          <?php if ($redirect) { ?>
		          <input type="hidden" name="redirect" value="<?php echo $redirect; ?>#tabs" />
		          <?php } ?>
		        </div>
		      </form>

		</div>
	<?php } ?>



   <form id="<?php echo $prefix;?>form_work_">
   <div style="display: none;">
    <b><ins class="color_entry_name"><?php   echo $this->language->get('entry_name'); ?></ins></b>
    <br>
    <input type="text" name="name" onblur="if (this.value==''){this.value='<?php echo $text_login; ?>'}" onfocus="if (this.value=='<?php echo $text_login; ?>') this.value='';"  value="<?php echo $text_login; ?>" <?php

    if (isset($customer_id) && $customer_id) {
     //echo 'readonly="readonly" style="background-color:#DDD; color: #555;"';
    }
    ?>>


    <div style="overflow: hidden; line-height:1px; margin-top: 5px;"></div>
     </div>
<?php if (isset($fields) && !empty($fields)) { ?>
<div class="marginbottom5" style="display: none;">

<a href="#" class="hrefajax" onclick="$('.addfields').toggle(); return false;"><?php echo $this->language->get('entry_addfields_begin');  ?><ins class="lowercase"><?php
  $i=0;
  foreach   ($fields as $aff => $field) {
  	$i++;
 	echo str_replace('?','',$field['field_description'][$this->config->get('config_language_id')]);
 	if (count($fields)!=$i) echo ", ";
  }
?></ins></a>
</div>

<div class="addfields" style="<?php if (!$fields_view) echo 'display: none;'; ?>">
<div id="form_h1" style="width: 98%; font-size: 24px; color:#848A8F;  margin-bottom: 10px; margin-left: 25px;">
Contact information <ins style="text-decoration: none; font-size: 14px;">(*Required Fields)</ins>
</div>

<table style="width:97%; margin-left: 20px;">
<?php
  foreach   ($fields as $aff => $field) {
?>

<!--
<td style="width: 16px;">
 <?php
    $template = '/image/'.$field['field_name'].'.png';
	if (file_exists(DIR_TEMPLATE . $theme . $template)) {
	?>

<img src="/catalog/view/theme/<?php
			$template = '/image/'.$field['field_name'].'.png';
			if (file_exists(DIR_TEMPLATE . $theme . $template)) {
				$fieldspath = $theme . $template;
			} else {
				$fieldspath = 'default' . $template;
			}
			echo $fieldspath;
?>">


 <?php  } ?>
</td>
-->
<?php if ($field['field_order']==0 || $field['field_order']==1) { ?>
<?php if ($field['field_order']==0) { ?>
<tr><td><table style="width: 100%;"><tr>
<?php } ?>

	<td style="width: 50%;">
	<b><ins class="color_entry_name">*<?php echo html_entity_decode($field['field_description'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');  ?></ins></b><br>
	<input type="text" name="af[<?php echo $field['field_name']; ?>]" style="width: 90%;">
    </td>

<?php if ($field['field_order']==1) { ?>
</tr></table></td></tr>
<?php } ?>
<?php } ?>

<?php if ($field['field_order']==2 || $field['field_order']==3) { ?>
<?php if ($field['field_order']==2) { ?>
<tr><td><table style="width: 100%;"><tr>
<?php } ?>

	<td style="width: 50%;">
	<b><ins class="color_entry_name">*<?php echo html_entity_decode($field['field_description'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');  ?></ins></b><br>
	<input type="text" name="af[<?php echo $field['field_name']; ?>]" style="width: 90%;">
    </td>

<?php if ($field['field_order']==3) { ?>
</tr></table></td></tr>
<?php } ?>
<?php } ?>


<?php if ($field['field_order']==4 || $field['field_order']==5) { ?>
<?php if ($field['field_order']==4) { ?>
<tr><td><table style="width: 100%;"><tr>
<?php } ?>

	<td style="width: 50%;">
	<b><ins class="color_entry_name">*<?php echo html_entity_decode($field['field_description'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');  ?></ins></b><br>
	<input type="text" name="af[<?php echo $field['field_name']; ?>]" style="width: 90%;">
    </td>

<?php if ($field['field_order']==5) { ?>
</tr></table></td></tr>
<?php } ?>
<?php } ?>

<?php if ($field['field_order']==6 || $field['field_order']==7) { ?>
<?php if ($field['field_order']==6) { ?>
<tr><td><table style="width: 100%;"><tr>
<?php } ?>

	<td style="width: 50%;">
	<b><ins class="color_entry_name">*<?php echo html_entity_decode($field['field_description'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');  ?></ins></b><br>
	<input type="text" value="" <?php if ($field['field_order']==7) { ?>placeholder="$"<?php } ?>  name="af[<?php echo $field['field_name']; ?>]" style="width: 90%;">
    </td>

<?php if ($field['field_order']==7) { ?>
</tr></table></td></tr>
<?php } ?>
<?php } ?>


<?php if ($field['field_order']==8 ) { ?>
<tr>
<td>
	<input type="hidden" id="hidden_form" value="" name="af[<?php echo $field['field_name']; ?>]">
</td>
</tr>
<?php } ?>





<?php  } ?>
</table>
</div>
<?php  } ?>

<?php
if (!function_exists('getQString')) {
	 function getQString($get, $exclude = array())
	{
		if (!is_array($exclude)) {
			$exclude = array();
		}
		return urldecode(http_build_query(array_diff_key($get, array_flip($exclude))));
	}
}
		$seo = str_replace('&amp;', '&', $this->url->link($this->request->get['route'], getQString($this->request->get, array(
				'route'
			)), 'NONSSL'));
?>


    <b style="margin-left:25px;"><ins class="color_entry_name"><?php echo $this->language->get('entry_comment');  ?></ins></b>
    <br>
    <div style="display: view;">
    <textarea name="text" id="<?php echo $prefix;?>editor_" class="blog-record-textarea <?php echo $prefix;?>editor blog-textarea_height" cols="30" style="width: 91%; margin-left: 25px;"></textarea>
    </div>
  <div class="bordernone overflowhidden margintop5 lineheight1"></div>


    <script>
    if (typeof h1_tovar<?php echo $prefix;?>=='undefined') {
     var h1_tovar<?php echo $prefix;?> = $('.product-info h1').text();


     var vin_code<?php echo $prefix;?> = $('.vin_code').text();
     $('#form_h1<?php echo $prefix;?>').append(' '+h1_tovar<?php echo $prefix;?>);
     $('#hidden_form<?php echo $prefix;?>').val(h1_tovar<?php echo $prefix;?>);


     }

    if (typeof image_tovar<?php echo $prefix;?>=='undefined') {
     var image_tovar<?php echo $prefix;?> = $('.image').html();
     $('#form_image<?php echo $prefix;?>').append(image_tovar<?php echo $prefix;?>);
     $('#form_image<?php echo $prefix;?> #image').css('width','100%');
     }

     if (typeof price_tovar<?php echo $prefix;?>=='undefined') {
     var price_tovar<?php echo $prefix;?> = $('.price').text();
     $('#form_price<?php echo $prefix;?>').append(price_tovar<?php echo $prefix;?>);
     }


    </script>



<?php if (isset($settings_widget['rating']) && $settings_widget['rating']) { ?>
     <b><ins class="color_entry_name"><?php echo $this->language->get('entry_rating_review'); ?></ins></b>&nbsp;&nbsp;
<?php if (isset($settings_widget['visual_rating']) && $settings_widget['visual_rating']) { ?>
<div>
    <input type="radio" class="visual_star" name="rating" alt="#8c0000" title="<?php echo $this->language->get('entry_bad'); ?> 1" value="1" >
    <input type="radio" class="visual_star" name="rating" alt="#8c4500" title="<?php echo $this->language->get('entry_bad'); ?> 2" value="2" >
    <input type="radio" class="visual_star" name="rating" alt="#b6b300" title="<?php echo $this->language->get('entry_bad'); ?> 3" value="3" >
    <input type="radio" class="visual_star" name="rating" alt="#698c00" title="<?php echo $this->language->get('entry_good'); ?> 4" value="4" >
    <input type="radio" class="visual_star" name="rating" alt="#008c00" title="<?php echo $this->language->get('entry_good'); ?> 5" value="5" >
   <div class="floatleft"  style="padding-top: 5px; "><b><ins class="color_entry_name marginleft10"><span id="hover-test" ></span></ins></b></div>
   <div  class="bordernone overflowhidden clearboth lineheight1"></div>
</div>
<?php } else { ?>
<span><ins class="color_bad"><?php echo $this->language->get('entry_bad'); ?></ins></span>&nbsp;
    <input type="radio"  name="rating" value="1" >
    <ins class="blog-ins_rating" style="">1</ins>
    <input type="radio"  name="rating" value="2" >
    <ins class="blog-ins_rating" >2</ins>
    <input type="radio"  name="rating" value="3" >
    <ins class="blog-ins_rating" >3</ins>
    <input type="radio"  name="rating" value="4" >
    <ins class="blog-ins_rating" >4</ins>
    <input type="radio"  name="rating" value="5" >
    <ins class="blog-ins_rating" >5</ins>
   &nbsp;&nbsp; <span><ins  class="color_good"><?php echo $this->language->get('entry_good'); ?></ins></span>
<?php } ?>

 <?php } else {?>
    <input type="radio" name="rating" value="5" checked style="display:none;">
    <?php } ?>


  <div class="bordernone overflowhidden margintop5 lineheight1"></div>

    <?php if ($captcha_status) { ?>
	    <div class="captcha_status"></div>
    <?php  } ?>

    <div class="buttons" style="margin-left: 25px; width: 90%;">
      <div class="left"><a class="button button-comment" id="<?php echo $prefix;?>button-comment-0"><span><?php echo $this->language->get('button_write'); ?></span></a></div>
    </div>

    </form>
   </div>


   </div>



</div>
 <div style="overflow: hidden; line-height:1px; margin-top: 5px;"></div>





  </div>




   <div class="overflowhidden">&nbsp;</div>

  </div>
  </div>

  </div>
</div>


<script type="text/javascript">


<?php echo $prefix;?>tel = function() {$('#<?php echo $prefix;?>comment_id_reply_0').click();
  <?php
    if ($imagebox=='colorbox') {
  ?>

var my_form = $('#<?php echo $prefix;?>icomments_<?php echo $mark_id; ?>');
var colorboxInterval;
$.colorbox({
 width: "auto",
 height: "auto",
 scrolling: true,
 returnFocusOther: true,
 maxHeight: "100%",
 innerHeight: "100%",
 opacity: 0.5,
 onOpen: function(){
       $('#colorbox').css('z-index','800');
       $('#cboxOverlay').css('z-index','800');
       $('#cboxOverlay').css('opacity','0.4');
       $('#cboxWrapper').css('z-index','800');

		colorboxInterval = setInterval( function() {
			 $(this).colorbox.resize();
		 }, 2000 );

 },
 onClosed: function(){
		clearInterval(colorboxtimeout);
 },

 title: "<?php echo $heading_title; ?>",
 inline:true, href: my_form});

 return false;


	}
  <?php
    }
    ?>
$(document).ready(function(){
	<?php if (isset($settings_widget['anchor']) && $settings_widget['anchor']!='') { ?>
	var ticomments_<?php echo $mark_id; ?> = $('#<?php echo $prefix;?>ticomments_<?php echo $mark_id; ?>').html();
	<?php echo $settings_widget['anchor']; ?>(ticomments_<?php echo $mark_id; ?>);
	$('#<?php echo $prefix;?>ticomments_<?php echo $mark_id; ?>').hide('slow').remove();
   <?php  } ?>
});
</script>
<style>
 #colorbox, #cboxOverlay, #cboxWrapper { z-index: 800;
 }
</style>
<!--
<script type="text/javascript" src="catalog/view/javascript/blog/ui/js/jquery-ui.js"></script>

<script type="text/javascript" src="catalog/view/javascript/blog/timepicker/jquery-ui-timepicker-addon.js"></script>
-->
