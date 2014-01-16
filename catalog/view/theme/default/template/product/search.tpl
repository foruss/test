<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1 style="color: #fff;"><?php echo $heading_title; ?></h1>

  <?php if ($products) { ?>
  
  
  <div class="product-list">
    <?php foreach ($products as $product) { ?>
    <div>
      <?php if ($product['thumb']) { ?>
      <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
      <?php } ?>
      <div class="description">
	  <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
	  <?php if ($product['filter_data']) { ?>
    <table class="attr" cellpadding="0" cellspacing="0">
	<tbody>
	
		<?php if ($product['engine'] != '') { ?>
		 <tr>
          <td>Engine:</td>
          <td><?php echo $product['engine']; ?></td>
        </tr>
		<?php } ?>
      <?php foreach ($product['filter_data'] as $filter_data) { /* ?>
      <thead>
        <tr>
          <td colspan="2"><?php echo $attribute_group['name']; ?></td>
        </tr>
      </thead> */ ?>
      
     
        <tr>
          <td><?php echo $filter_data['name']; ?>:</td>
          <td><?php echo $filter_data['text']; ?></td>
        </tr>
     
      
      <?php } ?>
	  </tbody>
    </table>
  <?php } ?></div>
  <div class="yearv"><?php echo $product['location']; ?></div>
  <div class="milev"><?php echo $product['mpn']; ?></div>
      <?php if ($product['price']) { ?>
      <div class="price">
        <?php if (!$product['special']) { ?>
        <?php echo $product['price']; ?>
        <?php } else { ?>
        <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
        <?php } ?>
      </div>
      <?php } ?>
      <?php if ($product['rating']) { ?>
      <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
      <?php } ?>
    </div>
    <?php } ?>
  </div>
  <div class="pagination"><?php echo $pagination; ?></div>
  <?php } else { ?>
  <div class="content-search"><h2><?php echo $text_empty; ?></h2></div>
  <?php }?>
  <?php echo $content_bottom; ?></div>
 
<?php echo $footer; ?>