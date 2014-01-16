<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/product.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
			<div id="tab-data" class="leftt">
        <h1>Select Following Information For The Vehicle</h1>
          <table class="form">
		  
			    
				<tr>
					<td><?php echo $entry_category; ?>
					<br><div class="scrollbox" style="width: 300px; height: 200px;">
					<?php $class = 'odd'; ?>
					<?php foreach ($categories as $category) { ?>
					<?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
					<div class="<?php echo $class; ?>">
					<?php $product_category_id=array(); ?>
					<?php foreach ($product_categories as $product_category) {                    
					$product_category_id[]=$product_category['category_id']; 
					}?>
					<?php if (in_array($category['category_id'], $product_category_id)) { ?>
					<input type="checkbox" name="product_category[]" value="<?php echo $category['category_id']; ?>" checked="checked" />
						<?php echo $category['name']; ?>
						<?php } else { ?>
						<input type="checkbox" name="product_category[]" value="<?php echo $category['category_id']; ?>" />
							<?php echo $category['name']; ?>
							<?php } ?>
						</div>
						<?php } ?>
					</div>
					<a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo 'all'; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo 'none'; ?></a></td>
					
					
              
				 <td style="width: 150px;"><b><?php echo $entry_location; ?></b><br> <select name="location">
					<option value="" selected="selected"><?php echo $text_select; ?></option>
		<?php for ($i = 2015; $i>=1925;$i--) {?>
		<?php if ($i == $location) { ?>
		<option value="<?php echo $i; ?>" selected="selected"><?php echo $i; ?></option>
		 <?php } else { ?>
		 <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
		<?php } ?>
		<?php } ?>
		
			</select>
					<br><b><?php echo $entry_manufacturer; ?></b><br>
				<select  name="manufacturer_id">
						<option value="0" selected="selected"><?php echo $text_select; ?></option>
						<?php foreach ($manufacturers as $manufacturer) { ?>
						<?php if ($manufacturer['manufacturer_id'] == $manufacturer_id) { ?>
						<option value="<?php echo $manufacturer['manufacturer_id']; ?>" selected="selected"><?php echo $manufacturer['name']; ?></option>
						<?php } else { ?>
						<option value="<?php echo $manufacturer['manufacturer_id']; ?>"><?php echo $manufacturer['name']; ?></option>
						<?php } ?>
						<?php } ?>
						</select>
						<br>
						<b>Model:</b>
						<br>
						<select name="model_id" class="large-field">
						<option value="" selected="selected"><?php echo $text_select; ?></option>
					</select>
					<br>
					<b>Drive Type</b><br><select name="product_drivetypes">
					<option value="" selected="selected"><?php echo $text_select; ?></option> 
                  <?php foreach ($product_drivetypes as $product_drivetype) { ?>    
						<?php if ($product_drivetype['filter_id'] == $product_drivetypes_id) { ?>
                  <option value="<?php echo $product_drivetype['filter_id']; ?>" selected="selected"><?php echo $product_drivetype['name']; ?></option>  <?php } else { ?>  				  
                  <option value="<?php echo $product_drivetype['filter_id']; ?>"><?php echo $product_drivetype['name']; ?></option>            
                  <?php } ?>
                  <?php } ?>
                </select>
					
					</td><td style="width: 150px;"><b>Transmission</b><br><select name="product_transmissions">
					<option value="" selected="selected"><?php echo $text_select; ?></option> 
                  <?php foreach ($product_transmissions as $product_transmission) { ?>    
						<?php if ($product_transmission['filter_id'] == $product_transmissions_id) { ?>
                  <option value="<?php echo $product_transmission['filter_id']; ?>" selected="selected"><?php echo $product_transmission['name']; ?></option>  <?php } else { ?>  				  
                  <option value="<?php echo $product_transmission['filter_id']; ?>"><?php echo $product_transmission['name']; ?></option>            
                  <?php } ?>
                  <?php } ?>
                </select>
				<br>
				<b>Interior Color</b><br><select name="product_interiors">
					<option value="" selected="selected"><?php echo $text_select; ?></option> 
                  <?php foreach ($product_interiors as $product_interior) { ?> 
						 <?php if ($product_interior['filter_id'] == $product_interiors_id) { ?>
                  <option value="<?php echo $product_interior['filter_id']; ?>" selected="selected"><?php echo $product_interior['name']; ?></option>           <?php } else { ?>  
				  <option value="<?php echo $product_interior['filter_id']; ?>"><?php echo $product_interior['name']; ?> </option>
                  <?php } ?>
				  <?php } ?>
                </select>
				
				<br>
				<b>Exterior Color</b><br><select name="product_colors">
					 <option value="" selected="selected"><?php echo $text_select; ?></option> 
                  <?php foreach ($product_colors as $product_color) { ?> 
						 <?php if ($product_color['filter_id'] == $product_colors_id) { ?>
                  <option value="<?php echo $product_color['filter_id']; ?>" selected="selected"><?php echo $product_color['name']; ?></option>           <?php } else { ?>  
				  <option value="<?php echo $product_color['filter_id']; ?>"><?php echo $product_color['name']; ?> </option>
                  <?php } ?>
				  <?php } ?>
                </select>
				
				<br>
				<b>Fuel Type</b><br><select name="product_fuels">
					 <option value="" selected="selected"><?php echo $text_select; ?></option> 
                  <?php foreach ($product_fuels as $product_fuel) { ?> 
						 <?php if ($product_fuel['filter_id'] == $product_fuels_id) { ?>
                  <option value="<?php echo $product_fuel['filter_id']; ?>" selected="selected"><?php echo $product_fuel['name']; ?></option>           <?php } else { ?>  
				  <option value="<?php echo $product_fuel['filter_id']; ?>"><?php echo $product_fuel['name']; ?> </option>
                  <?php } ?>
				  <?php } ?>
                </select>
				
				</td>
				
				<td style="width: 150px;">
					<b><?php echo $entry_isbn; ?></b><br><input type="text" name="isbn" value="<?php echo $isbn; ?>" /><br>
					<b><?php echo $entry_mpn; ?></b><br><input type="text" name="mpn" value="<?php echo $mpn; ?>" /><br>
					<b><?php echo $entry_price; ?></b><br><input type="text" name="price" value="<?php echo $price; ?>" /><br>
					<b><?php echo $entry_jan; ?></b><br><input type="text" name="jan" value="<?php echo $jan; ?>" /><br>		
				</td>
				
				
           
					
				</tr>
            <tr>
              <td><?php echo $entry_quantity; ?><br><input type="text" name="quantity" value="<?php echo $quantity; ?>" size="2" /></td>
              <td><?php echo $entry_minimum; ?><br><input type="text" name="minimum" value="<?php echo $minimum; ?>" size="2" /></td>
			  <td><?php echo $entry_stock_status; ?><br><select name="stock_status_id">
                  <?php foreach ($stock_statuses as $stock_status) { ?>
                  <?php if ($stock_status['stock_status_id'] == $stock_status_id) { ?>
                  <option value="<?php echo $stock_status['stock_status_id']; ?>" selected="selected"><?php echo $stock_status['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $stock_status['stock_status_id']; ?>"><?php echo $stock_status['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
            </tr>
                      
            <tr>
              <td><?php echo $entry_keyword; ?><br><input type="text" name="keyword" value="<?php echo $keyword; ?>" /></td>
              <td><?php echo $entry_status; ?><br><select name="status">
                  <?php if ($status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></td>
			  <td><?php echo $entry_sort_order; ?><br><input type="text" name="sort_order" value="<?php echo $sort_order; ?>" size="2" /></td>
            </tr>
          </table>
		  </div>
		  
		  
		  <div id="tab-vehicle" class="rightt">
          <h1>Select Vehicle options</h1>
         
		   <?php foreach ($product_newoptions as $newoption) { ?>
           
		   <input type="checkbox" name="product_newoption[<?php echo $newoption['newoption_id']; ?>][value]" value="1" <?php if ($newoption['value']){echo "checked";} ?>><?php echo $newoption['name']; ?><br>

          <input type="hidden" name="product_newoption[<?php echo $newoption['newoption_id']; ?>][newoption_id]" value="<?php echo $newoption['newoption_id']; ?>" />
		 
            <?php } ?>
		 </div>
		  
		 
			<div id="tab-general" class="rightt"><h1>Основные данные</h1>
          <div id="languages" class="htabs">
            <?php foreach ($languages as $language) { ?>
            <a href="#language<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
            <?php } ?>
          </div>
          <?php foreach ($languages as $language) { ?>
          <div id="language<?php echo $language['language_id']; ?>">
            <table class="form">
              <tr>
                <td><span class="required">*</span> <?php echo $entry_name; ?></td>
                <td><input type="text" name="product_description[<?php echo $language['language_id']; ?>][name]" size="100" value="<?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['name'] : ''; ?>" />
                  <?php if (isset($error_name[$language['language_id']])) { ?>
                  <span class="error"><?php echo $error_name[$language['language_id']]; ?></span>
                  <?php } ?></td>
              </tr>
              <tr>
                <td><?php echo $entry_meta_description; ?><br><textarea name="product_description[<?php echo $language['language_id']; ?>][meta_description]" cols="40" rows="5"><?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['meta_description'] : ''; ?></textarea></td>
                <td><?php echo $entry_meta_keyword; ?><br><textarea name="product_description[<?php echo $language['language_id']; ?>][meta_keyword]" cols="40" rows="5"><?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['meta_keyword'] : ''; ?></textarea></td>
              </tr>
              <tr>
                <td><?php echo $entry_description; ?></td>
                <td><textarea name="product_description[<?php echo $language['language_id']; ?>][description]" id="description<?php echo $language['language_id']; ?>"><?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['description'] : ''; ?></textarea></td>
              </tr>
            </table>
          </div>
          <?php } ?>
		  </div>
		  
		  
		   <div id="tab-images">
        <h1>Images</h1>
          <table id="images" class="list">
            <thead>
              <tr>
                <td class="left"><?php echo $entry_image; ?></td>
                <td class="right"><?php echo $entry_sort_order; ?></td>
                <td></td>
              </tr>
            </thead>
			<tbody>
            <tr>
              <td><?php echo $entry_image; ?></td><td>
             <div class="image"><img src="<?php echo $thumb; ?>" alt="" id="thumb" /><br />
                  <input type="hidden" name="image" value="<?php echo $image; ?>" id="image" />
                  <a onclick="image_upload('image', 'thumb');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb').attr('src', '<?php echo $no_image; ?>'); $('#image').attr('value', '');"><?php echo $text_clear; ?></a></div></td>
              <td></td>
            </tr>
			</tbody>
            <?php $image_row = 0; ?>
            <?php foreach ($product_images as $product_image) { ?>
            <tbody id="image-row<?php echo $image_row; ?>">
              <tr>
                <td class="left"><div class="image"><img src="<?php echo $product_image['thumb']; ?>" alt="" id="thumb<?php echo $image_row; ?>" />
                    <input type="hidden" name="product_image[<?php echo $image_row; ?>][image]" value="<?php echo $product_image['image']; ?>" id="image<?php echo $image_row; ?>" />
                    <br />
                    <a onclick="image_upload('image<?php echo $image_row; ?>', 'thumb<?php echo $image_row; ?>');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb<?php echo $image_row; ?>').attr('src', '<?php echo $no_image; ?>'); $('#image<?php echo $image_row; ?>').attr('value', '');"><?php echo $text_clear; ?></a></div></td>
                <td class="right"><input type="text" name="product_image[<?php echo $image_row; ?>][sort_order]" value="<?php echo $product_image['sort_order']; ?>" size="2" /></td>
                <td class="left"><a onclick="$('#image-row<?php echo $image_row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
              </tr>
            </tbody>
            <?php $image_row++; ?>
            <?php } ?>
            <tfoot>
              <tr>
                <td colspan="2"></td>
                <td class="left"><a onclick="addImage();" class="button"><?php echo $button_add_image; ?></a></td>
              </tr>
            </tfoot>
          </table>
       <div>
		  
		 <div id="tab-links">
			<h1>Связи</h1>
          <table class="form">                      
            <tr>
              <td><?php echo $entry_download; ?></td>
              <td><input type="text" name="download" value="" /></td>
            </tr>			
            <tr>
              <td>&nbsp;</td>
              <td><div id="product-download" class="scrollbox">
                  <?php $class = 'odd'; ?>
                  <?php foreach ($product_downloads as $product_download) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div id="product-download<?php echo $product_download['download_id']; ?>" class="<?php echo $class; ?>"> <?php echo $product_download['name']; ?><img src="view/image/delete.png" alt="" />
                    <input type="hidden" name="product_download[]" value="<?php echo $product_download['download_id']; ?>" />
                  </div>
                  <?php } ?>
                </div></td>
            </tr>
            <tr>
              <td><?php echo $entry_related; ?></td>
              <td><input type="text" name="related" value="" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><div id="product-related" class="scrollbox">
                  <?php $class = 'odd'; ?>
                  <?php foreach ($product_related as $product_related) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div id="product-related<?php echo $product_related['product_id']; ?>" class="<?php echo $class; ?>"> <?php echo $product_related['name']; ?><img src="view/image/delete.png" alt="" />
                    <input type="hidden" name="product_related[]" value="<?php echo $product_related['product_id']; ?>" />
                  </div>
                  <?php } ?>
                </div></td>
            </tr>
          </table>
</div>
		  
<h1>Атрибуты</h1>
          <table id="attribute" class="list">
            <thead>
              <tr>
                <td class="left"><?php echo $entry_attribute; ?></td>
                <td class="left"><?php echo $entry_text; ?></td>
                <td></td>
              </tr>
            </thead>
            <?php $attribute_row = 0; ?>
            <?php foreach ($product_attributes as $product_attribute) { ?>
            <tbody id="attribute-row<?php echo $attribute_row; ?>">
              <tr>
                <td class="left"><input type="text" name="product_attribute[<?php echo $attribute_row; ?>][name]" value="<?php echo $product_attribute['name']; ?>" />
                  <input type="hidden" name="product_attribute[<?php echo $attribute_row; ?>][attribute_id]" value="<?php echo $product_attribute['attribute_id']; ?>" /></td>
                <td class="left"><?php foreach ($languages as $language) { ?>
                  <textarea name="product_attribute[<?php echo $attribute_row; ?>][product_attribute_description][<?php echo $language['language_id']; ?>][text]" cols="40" rows="5"><?php echo isset($product_attribute['product_attribute_description'][$language['language_id']]) ? $product_attribute['product_attribute_description'][$language['language_id']]['text'] : ''; ?></textarea>
                  <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" align="top" /><br />
                  <?php } ?></td>
                <td class="left"><a onclick="$('#attribute-row<?php echo $attribute_row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
              </tr>
            </tbody>
            <?php $attribute_row++; ?>
            <?php } ?>
            <tfoot>
              <tr>
                <td colspan="2"></td>
                <td class="left"><a onclick="addAttribute();" class="button"><?php echo $button_add_attribute; ?></a></td>
              </tr>
            </tfoot>
          </table>

			<h1>данные</h1>
      
            <table class="list">
                <thead>
                    <tr>
                        <td class="left"><?php echo $entry_profile ?></td>
                        <td class="left"><?php echo $entry_customer_group ?></td>
                        <td class="left"></td>
                    </tr>
                </thead>
                <tbody>
                    <?php $profileCount = 0; ?>
                    <?php foreach ($product_profiles as $product_profile): ?>
                        <?php $profileCount++ ?>
                    
                        <tr id="profile-row<?php echo $profileCount ?>">
                            <td class="left">
                                <select name="product_profiles[<?php echo $profileCount ?>][profile_id]">
                                    <?php foreach ($profiles as $profile): ?>
                                        <?php if ($profile['profile_id'] == $product_profile['profile_id']): ?>
                                            <option value="<?php echo $profile['profile_id'] ?>" selected="selected"><?php echo $profile['name'] ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo $profile['profile_id'] ?>"><?php echo $profile['name'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td class="left">
                                <select name="product_profiles[<?php echo $profileCount ?>][customer_group_id]">
                                    <?php foreach ($customer_groups as $customer_group): ?>
                                        <?php if ($customer_group['customer_group_id'] == $product_profile['customer_group_id']): ?>
                                            <option value="<?php echo $customer_group['customer_group_id'] ?>" selected="selected"><?php echo $customer_group['name'] ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo $customer_group['customer_group_id'] ?>"><?php echo $customer_group['name'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td class="left">
                                <a class="button" onclick="$('#profile-row<?php echo $profileCount ?>').remove()"><?php echo $button_remove ?></a>
                            </td>
                        </tr>
                    
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2"></td>
                        <td class="left"><a onclick="addProfile()" class="button"><?php echo $button_add_profile ?></a></td>
                    </tr>
                </tfoot>
            </table>
       
        <h1>discount</h1>
          <table id="discount" class="list">
            <thead>
              <tr>
                <td class="left"><?php echo $entry_customer_group; ?></td>
                <td class="right"><?php echo $entry_quantity; ?></td>
                <td class="right"><?php echo $entry_priority; ?></td>
                <td class="right"><?php echo $entry_price; ?></td>
                <td class="left"><?php echo $entry_date_start; ?></td>
                <td class="left"><?php echo $entry_date_end; ?></td>
                <td></td>
              </tr>
            </thead>
            <?php $discount_row = 0; ?>
            <?php foreach ($product_discounts as $product_discount) { ?>
            <tbody id="discount-row<?php echo $discount_row; ?>">
              <tr>
                <td class="left"><select name="product_discount[<?php echo $discount_row; ?>][customer_group_id]">
                    <?php foreach ($customer_groups as $customer_group) { ?>
                    <?php if ($customer_group['customer_group_id'] == $product_discount['customer_group_id']) { ?>
                    <option value="<?php echo $customer_group['customer_group_id']; ?>" selected="selected"><?php echo $customer_group['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select></td>
                <td class="right"><input type="text" name="product_discount[<?php echo $discount_row; ?>][quantity]" value="<?php echo $product_discount['quantity']; ?>" size="2" /></td>
                <td class="right"><input type="text" name="product_discount[<?php echo $discount_row; ?>][priority]" value="<?php echo $product_discount['priority']; ?>" size="2" /></td>
                <td class="right"><input type="text" name="product_discount[<?php echo $discount_row; ?>][price]" value="<?php echo $product_discount['price']; ?>" /></td>
                <td class="left"><input type="text" name="product_discount[<?php echo $discount_row; ?>][date_start]" value="<?php echo $product_discount['date_start']; ?>" class="date" /></td>
                <td class="left"><input type="text" name="product_discount[<?php echo $discount_row; ?>][date_end]" value="<?php echo $product_discount['date_end']; ?>" class="date" /></td>
                <td class="left"><a onclick="$('#discount-row<?php echo $discount_row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
              </tr>
            </tbody>
            <?php $discount_row++; ?>
            <?php } ?>
            <tfoot>
              <tr>
                <td colspan="6"></td>
                <td class="left"><a onclick="addDiscount();" class="button"><?php echo $button_add_discount; ?></a></td>
              </tr>
            </tfoot>
          </table>
        
       <h1>special</h1>
          <table id="special" class="list">
            <thead>
              <tr>
                <td class="left"><?php echo $entry_customer_group; ?></td>
                <td class="right"><?php echo $entry_priority; ?></td>
                <td class="right"><?php echo $entry_price; ?></td>
                <td class="left"><?php echo $entry_date_start; ?></td>
                <td class="left"><?php echo $entry_date_end; ?></td>
                <td></td>
              </tr>
            </thead>
            <?php $special_row = 0; ?>
            <?php foreach ($product_specials as $product_special) { ?>
            <tbody id="special-row<?php echo $special_row; ?>">
              <tr>
                <td class="left"><select name="product_special[<?php echo $special_row; ?>][customer_group_id]">
                    <?php foreach ($customer_groups as $customer_group) { ?>
                    <?php if ($customer_group['customer_group_id'] == $product_special['customer_group_id']) { ?>
                    <option value="<?php echo $customer_group['customer_group_id']; ?>" selected="selected"><?php echo $customer_group['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select></td>
                <td class="right"><input type="text" name="product_special[<?php echo $special_row; ?>][priority]" value="<?php echo $product_special['priority']; ?>" size="2" /></td>
                <td class="right"><input type="text" name="product_special[<?php echo $special_row; ?>][price]" value="<?php echo $product_special['price']; ?>" /></td>
                <td class="left"><input type="text" name="product_special[<?php echo $special_row; ?>][date_start]" value="<?php echo $product_special['date_start']; ?>" class="date" /></td>
                <td class="left"><input type="text" name="product_special[<?php echo $special_row; ?>][date_end]" value="<?php echo $product_special['date_end']; ?>" class="date" /></td>
                <td class="left"><a onclick="$('#special-row<?php echo $special_row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
              </tr>
            </tbody>
            <?php $special_row++; ?>
            <?php } ?>
            <tfoot>
              <tr>
                <td colspan="5"></td>
                <td class="left"><a onclick="addSpecial();" class="button"><?php echo $button_add_special; ?></a></td>
              </tr>
            </tfoot>
          </table>
       
            
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script> 
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
CKEDITOR.replace('description<?php echo $language['language_id']; ?>', {
	filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
});
<?php } ?>
//--></script> 
<script type="text/javascript"><!--
$.widget('custom.catcomplete', $.ui.autocomplete, {
	_renderMenu: function(ul, items) {
		var self = this, currentCategory = '';
		
		$.each(items, function(index, item) {
			if (item.category != currentCategory) {
				ul.append('<li class="ui-autocomplete-category">' + item.category + '</li>');
				
				currentCategory = item.category;
			}
			
			self._renderItem(ul, item);
		});
	}
});


$('#product-category div img').live('click', function() {
	$(this).parent().remove();
	
	$('#product-category div:odd').attr('class', 'odd');
	$('#product-category div:even').attr('class', 'even');	
});


$('#product-filter div img').live('click', function() {
	$(this).parent().remove();
	
	$('#product-filter div:odd').attr('class', 'odd');
	$('#product-filter div:even').attr('class', 'even');	
});

// Downloads
$('input[name=\'download\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/download/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.download_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('#product-download' + ui.item.value).remove();
		
		$('#product-download').append('<div id="product-download' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="product_download[]" value="' + ui.item.value + '" /></div>');

		$('#product-download div:odd').attr('class', 'odd');
		$('#product-download div:even').attr('class', 'even');
				
		return false;
	},
	focus: function(event, ui) {
      return false;
   }
});

$('#product-download div img').live('click', function() {
	$(this).parent().remove();
	
	$('#product-download div:odd').attr('class', 'odd');
	$('#product-download div:even').attr('class', 'even');	
});

// Related
$('input[name=\'related\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.product_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('#product-related' + ui.item.value).remove();
		
		$('#product-related').append('<div id="product-related' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="product_related[]" value="' + ui.item.value + '" /></div>');

		$('#product-related div:odd').attr('class', 'odd');
		$('#product-related div:even').attr('class', 'even');
				
		return false;
	},
	focus: function(event, ui) {
      return false;
   }
});

$('#product-related div img').live('click', function() {
	$(this).parent().remove();
	
	$('#product-related div:odd').attr('class', 'odd');
	$('#product-related div:even').attr('class', 'even');	
});
//--></script> 
<script type="text/javascript"><!--
var attribute_row = <?php echo $attribute_row; ?>;

function addAttribute() {
	html  = '<tbody id="attribute-row' + attribute_row + '">';
    html += '  <tr>';
	html += '    <td class="left"><input type="text" name="product_attribute[' + attribute_row + '][name]" value="" /><input type="hidden" name="product_attribute[' + attribute_row + '][attribute_id]" value="" /></td>';
	html += '    <td class="left">';
	<?php foreach ($languages as $language) { ?>
	html += '<textarea name="product_attribute[' + attribute_row + '][product_attribute_description][<?php echo $language['language_id']; ?>][text]" cols="40" rows="5"></textarea><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" align="top" /><br />';
    <?php } ?>
	html += '    </td>';
	html += '    <td class="left"><a onclick="$(\'#attribute-row' + attribute_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
    html += '  </tr>';	
    html += '</tbody>';
	
	$('#attribute tfoot').before(html);
	
	attributeautocomplete(attribute_row);
	
	attribute_row++;
}

function attributeautocomplete(attribute_row) {
	$('input[name=\'product_attribute[' + attribute_row + '][name]\']').catcomplete({
		delay: 500,
		source: function(request, response) {
			$.ajax({
				url: 'index.php?route=catalog/attribute/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
				dataType: 'json',
				success: function(json) {	
					response($.map(json, function(item) {
						return {
							category: item.attribute_group,
							label: item.name,
							value: item.attribute_id
						}
					}));
				}
			});
		}, 
		select: function(event, ui) {
			$('input[name=\'product_attribute[' + attribute_row + '][name]\']').attr('value', ui.item.label);
			$('input[name=\'product_attribute[' + attribute_row + '][attribute_id]\']').attr('value', ui.item.value);
			
			return false;
		},
		focus: function(event, ui) {
      		return false;
   		}
	});
}

$('#attribute tbody').each(function(index, element) {
	attributeautocomplete(index);
});
//--></script> 

<script type="text/javascript"><!--
var discount_row = <?php echo $discount_row; ?>;

function addDiscount() {
	html  = '<tbody id="discount-row' + discount_row + '">';
	html += '  <tr>'; 
    html += '    <td class="left"><select name="product_discount[' + discount_row + '][customer_group_id]">';
    <?php foreach ($customer_groups as $customer_group) { ?>
    html += '      <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>';
    <?php } ?>
    html += '    </select></td>';		
    html += '    <td class="right"><input type="text" name="product_discount[' + discount_row + '][quantity]" value="" size="2" /></td>';
    html += '    <td class="right"><input type="text" name="product_discount[' + discount_row + '][priority]" value="" size="2" /></td>';
	html += '    <td class="right"><input type="text" name="product_discount[' + discount_row + '][price]" value="" /></td>';
    html += '    <td class="left"><input type="text" name="product_discount[' + discount_row + '][date_start]" value="" class="date" /></td>';
	html += '    <td class="left"><input type="text" name="product_discount[' + discount_row + '][date_end]" value="" class="date" /></td>';
	html += '    <td class="left"><a onclick="$(\'#discount-row' + discount_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
	html += '  </tr>';	
    html += '</tbody>';
	
	$('#discount tfoot').before(html);
		
	$('#discount-row' + discount_row + ' .date').datepicker({dateFormat: 'yy-mm-dd'});
	
	discount_row++;
}
//--></script> 
<script type="text/javascript"><!--
var special_row = <?php echo $special_row; ?>;

function addSpecial() {
	html  = '<tbody id="special-row' + special_row + '">';
	html += '  <tr>'; 
    html += '    <td class="left"><select name="product_special[' + special_row + '][customer_group_id]">';
    <?php foreach ($customer_groups as $customer_group) { ?>
    html += '      <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>';
    <?php } ?>
    html += '    </select></td>';		
    html += '    <td class="right"><input type="text" name="product_special[' + special_row + '][priority]" value="" size="2" /></td>';
	html += '    <td class="right"><input type="text" name="product_special[' + special_row + '][price]" value="" /></td>';
    html += '    <td class="left"><input type="text" name="product_special[' + special_row + '][date_start]" value="" class="date" /></td>';
	html += '    <td class="left"><input type="text" name="product_special[' + special_row + '][date_end]" value="" class="date" /></td>';
	html += '    <td class="left"><a onclick="$(\'#special-row' + special_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
	html += '  </tr>';
    html += '</tbody>';
	
	$('#special tfoot').before(html);
 
	$('#special-row' + special_row + ' .date').datepicker({dateFormat: 'yy-mm-dd'});
	
	special_row++;
}
//--></script> 
<script type="text/javascript"><!--
function image_upload(field, thumb) {
	$('#dialog').remove();
	
	$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
	$('#dialog').dialog({
		title: '<?php echo $text_image_manager; ?>',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).attr('value')),
					dataType: 'text',
					success: function(text) {
						$('#' + thumb).replaceWith('<img src="' + text + '" alt="" id="' + thumb + '" />');
					}
				});
			}
		},	
		bgiframe: false,
		width: 960,
		height: 620,
		resizable: false,
		modal: false
,
			dialogClass: 'dlg'
	});
};
//--></script> 
<script type="text/javascript"><!--
var image_row = <?php echo $image_row; ?>;

function addImage() {
    html  = '<tbody id="image-row' + image_row + '">';
	html += '  <tr>';
	html += '    <td class="left"><div class="image"><img src="<?php echo $no_image; ?>" alt="" id="thumb' + image_row + '" /><input type="hidden" name="product_image[' + image_row + '][image]" value="" id="image' + image_row + '" /><br /><a onclick="image_upload(\'image' + image_row + '\', \'thumb' + image_row + '\');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$(\'#thumb' + image_row + '\').attr(\'src\', \'<?php echo $no_image; ?>\'); $(\'#image' + image_row + '\').attr(\'value\', \'\');"><?php echo $text_clear; ?></a></div></td>';
	html += '    <td class="right"><input type="text" name="product_image[' + image_row + '][sort_order]" value="" size="2" /></td>';
	html += '    <td class="left"><a onclick="$(\'#image-row' + image_row  + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
	html += '  </tr>';
	html += '</tbody>';
	
	$('#images tfoot').before(html);
	
	image_row++;
}
//--></script> 
<script type="text/javascript" src="view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script> 
<script type="text/javascript"><!--
$('.date').datepicker({dateFormat: 'yy-mm-dd'});
$('.datetime').datetimepicker({
	dateFormat: 'yy-mm-dd',
	timeFormat: 'h:m'
});
$('.time').timepicker({timeFormat: 'h:m'});
//--></script> 
<script type="text/javascript"><!-- 
$('#languages a').tabs(); 
$('#vtab-option a').tabs();

var profileCount = <?php echo $profileCount ?>;

function addProfile() {
    profileCount++;
    
    var html = '';
    html += '<tr id="profile-row' + profileCount + '">';
    html += '  <td class="left">';
    html += '    <select name="product_profiles[' + profileCount + '][profile_id]">';
    <?php foreach ($profiles as $profile): ?>
    html += '      <option value="<?php echo $profile['profile_id'] ?>"><?php echo $profile['name'] ?></option>';
    <?php endforeach; ?>
    html += '    </select>';
    html += '  </td>';
    html += '  <td class="left">';
    html += '    <select name="product_profiles[' + profileCount + '][customer_group_id]">';
    <?php foreach ($customer_groups as $customer_group): ?>
    html += '      <option value="<?php echo $customer_group['customer_group_id'] ?>"><?php echo $customer_group['name'] ?></option>';
    <?php endforeach; ?>
    html += '    <select>';
    html += '  </td>';
    html += '  <td class="left">';
    html += '    <a class="button" onclick="$(\'#profile-row' + profileCount + '\').remove()"><?php echo $button_remove ?></a>';
    html += '  </td>';
    html += '</tr>';
    
    $('#tab-profile table tbody').append(html);
}

function openbayLinkStatus(){
    var product_id = '<?php echo $this->request->get['product_id']; ?>';
    $.ajax({
        type: 'GET',
        url: 'index.php?route=extension/openbay/linkStatus&token=<?php echo $token; ?>&product_id='+product_id,
        dataType: 'html',
        success: function(data) {
            //add the button to nav
            $('<a href="#tab-openbay">Marketplace links</a>').hide().appendTo("#tabs").fadeIn(1000);
            $('#tab-general').before(data);
            $('#tabs a').tabs();
        },
        failure: function(){

        },
        error: function() {

        }
    });
}

$(document).ready(function(){
    openbayLinkStatus();
});

//--></script>

<script type="text/javascript"><!--
$('select[name=\'manufacturer_id\']').bind('change', function() {
	id = this.value;
	if (id == 0) return;
	$.ajax({
		url: 'index.php?route=catalog/product/checkmodel&token=<?php echo $token; ?>&manufacturer_id=' + id,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'manufacturer_id\']').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
		},
		complete: function() {
			$('.wait').remove();
		},			
		success: function(json) {
			html = '<option value=""><?php echo $text_select; ?></option>';
			
			if (json != '') {
				for (i = 0; i < json.length; i++) {
        			html += '<option value="' + json[i]['filter_id'] + '"';
	    			
					if (json[i]['filter_id'] == '<?php echo $product_model_id; ?>') {
	      				html += ' selected="selected"';
	    			}
	
	    			html += '>' + json[i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
			}
			
			$('select[name=\'model_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'manufacturer_id\']').trigger('change');
//--></script>

<?php echo $footer; ?>