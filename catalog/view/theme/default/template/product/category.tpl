<?php echo $header; ?><?php if ($products) { ?><?php echo $column_left; ?><?php echo $column_right; ?><?php } ?>
<div id="content"><?php echo $content_top; /*?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php  <h1><?php echo $heading_title; ?></h1> */ ?>
  <?php /* if ($thumb || $description) { ?>
  <div class="category-info">
    <php if ($thumb) { ?>
    <div class="image"><img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" /></div>
    <?php } ?>
    <?php if ($description) { ?>
    <?php echo $description; ?>
    <?php } ?>
  </div>
  <?php } */ ?>
  <?php  if ($categories) { ?>
  <div class="category-list">
    <?php if (count($categories) <= 5) { ?>
    <ul>
      <?php foreach ($categories as $category) { ?>
      <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
      <?php } ?>
    </ul>
    <?php } else { ?>
    <?php for ($i = 0; $i < count($categories);) { ?>
    <ul>
      <?php $j = $i + ceil(count($categories) / 4); ?>
      <?php for (; $i < $j; $i++) { ?>
      <?php if (isset($categories[$i])) { ?>
      <li><a href="<?php echo $categories[$i]['href']; ?>"><?php echo $categories[$i]['name']; ?></a></li>
      <?php } ?>
      <?php } ?>
    </ul>
    <?php } ?>
    <?php } ?>
  </div>
  <?php }  ?>
  <?php if ($products) { ?>
   <!-- Manufacturers -->
                       <?php if ($manufacturers) { ?>
                       <div class="manufacturers">
                       <div>
                           
                            <?php foreach ($manufacturers as $manufacturer) { ?>
                            <?php if($manufacturer['manufacturer_id']==$manufacturer_id) { ?>
                            <span><?php echo $manufacturer['name'] ?></span>
                            <?php } else {?>
                            <a href="<?php echo $manufacturer['href'] ?>"><?php echo $manufacturer['name'] ?></a>
                            <?php }?>
                            
                            <?php } ?>
                        <div class="sort">
                            <div class="allnames"><a href="<?php echo $all_manufacturers; ?>">All Inventory</a></div>
     
							<div class="names">Name/Model</div>
							<div class="years">Year</div>
							<div class="miles">Miles</div>
							<div class="priceh">
							<?php
							$key = "";
							foreach ($sorts as $sorts) { ?>
							<?php
							if ($sort == "p.sort_order")  {
							$class="non";
							$sorts['href'] = str_replace("ASC","DESC",$sorts['href']);
							}
							elseif ($sort == "p.price")	{
							if ($order == "ASC") {
							$sorts['href'] = str_replace("ASC","DESC",$sorts['href']);
							$class="desc";
							$sorts['text'] = $text_price_asc;
							} elseif ($order == "DESC") {
							$sorts['href'] = str_replace("DESC","ASC",$sorts['href']);
							$class="asc";
							$sorts['text'] = $text_price_desc;
							}
							}
							?>
							<a href="<?php echo $sorts['href']; ?>" class="<?php echo $class; ?>"><?php echo $sorts['text']; ?></a>
							<?php
							?>
							<?php } ?>
							</div>
						</div>
						</div>
                        </div>
                        <?php } ?>
  <?php /*<div class="product-filter">
    <div class="limit"><b><?php echo $text_limit; ?></b>
      <select onchange="location = this.value;">
        <?php foreach ($limits as $limits) { ?>
        <?php if ($limits['value'] == $limit) { ?>
        <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
        <?php } else { ?>
        <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
        <?php } ?>
        <?php } ?>
      </select>
    </div>
    
  </div> */ ?>
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
  <?php } ?>
  <?php if (!$categories && !$products) { ?>
  <div class="content-search"><h2><?php echo $text_empty; ?></h2></div>
  
  <?php } ?>
  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?>