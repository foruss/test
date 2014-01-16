
<?php echo $header; ?>
<div id="content">
<div class="breadcrumb">
  <?php foreach ($breadcrumbs as $breadcrumb) { ?>
  <?php echo $breadcrumb["separator"]; ?><a href="<?php echo $breadcrumb["href"]; ?>"><?php echo $breadcrumb["text"]; ?></a>
  <?php } ?>
</div>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?> 
<div class="box">
  <div class="heading">
    <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
    <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
  </div>
  <div class="content">
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
	<div><?php echo $entry_intro; ?></div>
      <table id="module" class="list">
        <thead>
          <tr>
            <td class="left"><?php echo $entry_layout; ?></td>
            <td class="left"><?php echo $entry_category; ?></td>
            <td class="left"><?php echo $entry_image; ?></td>
            <td class="left"><?php echo $entry_position; ?></td>
            <td class="left"><?php echo $entry_repeat; ?></td>
            <td class="left"><?php echo $entry_color; ?></td>
            <td class="left"><?php echo $entry_status; ?></td>
            <td></td>
          </tr>
        </thead>
        <?php $module_row = 0; ?>
        <?php foreach ($modules as $module) { ?>
        <tbody id="module-row<?php echo $module_row; ?>">
          <tr>
            <td class="left"><select name="smartbackground[<?php echo $module_row; ?>][layout_id]">
                <?php foreach ($layouts as $layout) { ?>
                <?php if ($layout['layout_id'] == $module['layout_id']) { ?>
                <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select><input type="hidden" name="smartbackground[<?php echo $module_row; ?>][position]" value="column_left"/></td>
			<td class="left"><select name="smartbackground[<?php echo $module_row; ?>][category_id]">
				<?php if ($module['category_id'] == 0)
				{ ?>
                <option value="0" selected="selected"><?php echo $text_none; ?></option>
				<? } else { ?>
				<option value="0"><?php echo $text_none; ?></option>
				<? } ?>
                <?php foreach ($categories as $category) { ?>
                <?php if ($category['category_id'] == $module['category_id']) { ?>
                <option value="<?php echo $category['category_id']; ?>" selected="selected"><?php echo $category['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
            <td valign="top"><input type="hidden" name="smartbackground[<?php echo $module_row; ?>][image]" value="<?php echo $module['image']; ?>" id="image<?php echo $module_row; ?>" />
              <img class="image" src="<?php if($gallery_images[$module_row]['preview']) { echo $gallery_images[$module_row]['preview']; } else { echo $preview; } ?>" alt="" id="preview<?php echo $module_row; ?>" style="border: 1px solid #EEEEEE;" />&nbsp;<img src="view/image/image.png" alt="" style="cursor: pointer;" align="top" onclick="image_upload('image<?php echo $module_row; ?>', 'preview<?php echo $module_row; ?>');" />&nbsp;<img src="view/image/error.png" alt="" style="cursor: pointer;" align="top" onclick="image_del('image<?php echo $module_row; ?>', 'preview<?php echo $module_row; ?>');" />
            </td>
			<td valign="top"><input type="text" name="smartbackground[<?php echo $module_row; ?>][position]" value="center top" id="position<?php echo $module_row; ?>" /></td>
			<td class="left">
			<select name="smartbackground[<?php echo $module_row; ?>][repeat]">
				<?php if ($module['repeat'] == 'no-repeat') { ?>
                  <option value="no-repeat" selected="selected"><?php echo $text_norepeat; ?></option>
                  <?php } else { ?>
                  <option value="no-repeat"><?php echo $text_norepeat; ?></option>
                  <?php } ?>
				  <?php if ($module['repeat'] == 'repeat') { ?>
                  <option value="repeat" selected="selected"><?php echo $text_repeat; ?></option>
                  <?php } else { ?>
                  <option value="repeat"><?php echo $text_repeat; ?></option>
                  <?php } ?>
                  <?php if ($module['repeat'] == 'repeat-x') { ?>
                  <option value="repeat-x" selected="selected"><?php echo $text_repeatx; ?></option>
                  <?php } else { ?>
                  <option value="repeat-x"><?php echo $text_repeatx; ?></option>
                  <?php } ?>
				  <?php if ($module['repeat'] == 'repeat-y') { ?>
                  <option value="repeat-y" selected="selected"><?php echo $text_repeatx; ?></option>
                  <?php } else { ?>
                  <option value="repeat-y"><?php echo $text_repeaty; ?></option>
                  <?php } ?>
                </select></td>
			<td class="left">#<input type="text" name="smartbackground[<?php echo $module_row; ?>][color]" value="<?php echo $module['color']; ?>" size="6" /></td>
            <td class="left"><select name="smartbackground[<?php echo $module_row; ?>][status]">
			<? var_dump($module); ?>
                <?php if ($module['status']) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
            <td class="left"><a onclick="$('#module-row<?php echo $module_row; ?>').remove();" class="button"><span><?php echo $button_remove; ?></span></a></td>
          </tr>
        </tbody>
        <?php $module_row++; ?>
        <?php } ?>
        <tfoot>
          <tr>
            <td colspan="4"></td>
            <td class="left"><a onclick="addModule();" class="button"><span><?php echo $button_add_module; ?></span></a></td>
          </tr>
        </tfoot>
      </table>
    </form>
  </div>
</div>
<script type="text/javascript"><!--
var module_row = <?php echo $module_row; ?>;

function addModule() {	
	html  = '<tbody id="module-row' + module_row + '">';
	html += '  <tr>';
	html += '    <td class="left"><select name="smartbackground[' + module_row + '][layout_id]">';
	<?php foreach ($layouts as $layout) { ?>
	html += '      <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>';
	<?php } ?>
	html += '    </select></td>';
	html += '    <td class="left"><select name="smartbackground[' + module_row + '][category_id]">';
	html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
	<?php foreach ($categories as $category) { ?>
	html += '      <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>';
	<?php } ?>
	html += '    </select></td>';
	html += '<td class="left"><input type="hidden" name="smartbackground[' + module_row + '][image]" value="" id="image' + module_row + '" /><img src="<?php echo $no_image; ?>" alt="" id="preview' + module_row + '" style="margin: 4px 0px; border: 1px solid #EEEEEE;" />&nbsp;<img src="view/image/image.png" alt="" style="cursor: pointer;" align="top" onclick="image_upload(\'image' + module_row + '\', \'preview' + module_row + '\');" /></td>';
	html += '<td valign="top"><input type="text" name="smartbackground[<?php echo $module_row; ?>][position]" value="center top" id="position<?php echo $module_row; ?>" /></td>';
	html += '    <td class="left"><select name="smartbackground[' + module_row + '][repeat]">';
	html += '      <option value="no-repeat"><?php echo $text_norepeat; ?></option>';
	html += '      <option value="repeat"><?php echo $text_repeat; ?></option>';
	html += '      <option value="repeat-x"><?php echo $text_repeatx; ?></option>';
	html += '      <option value="repeat-y"><?php echo $text_repeaty; ?></option>';
	html += '    </select></td>';
	html += '    <td class="left">#<input type="text" name="smartbackground[' + module_row + '][color]" value="" size="6" /></td>';
	html += '    <td class="left"><select name="smartbackground[' + module_row + '][status]">';
    html += '      <option value="1" selected="selected"><?php echo $text_enabled; ?></option>';
    html += '      <option value="0"><?php echo $text_disabled; ?></option>';
    html += '    </select></td>';
	
	html += '    <td class="left"><a onclick="$(\'#module-row' + module_row + '\').remove();" class="button"><span><?php echo $button_remove; ?></span></a></td>';
	html += '  </tr>';
	html += '</tbody>';
	
	$('#module tfoot').before(html);
	
	module_row++;
}
//--></script>
<script type="text/javascript" src="view/javascript/jquery/ui/minified/jquery.ui.draggable.min.js"></script>
<script type="text/javascript" src="view/javascript/jquery/ui/minified/jquery.ui.resizable.min.js"></script>
<script type="text/javascript" src="view/javascript/jquery/ui/minified/jquery.ui.dialog.min.js"></script>
<script type="text/javascript" src="view/javascript/jquery/ui/external/jquery.bgiframe-2.1.2.js"></script>
<script type="text/javascript"><!--
function image_upload(field, preview) {
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
                        $('#' + preview).replaceWith('<img src="' + text + '" alt="" id="' + preview + '" class="image" onclick="image_upload(\'' + field + '\', \'' + preview + '\');" />');
                    }
                });
            }
        },
        bgiframe: false,
        width: 800,
        height: 400,
        resizable: false,
        modal: false
    });
};
function image_del(field, preview) {
                $('#' + preview).replaceWith('<img src="<?php echo $preview; ?>" alt="" id="' + preview + '" style="cursor: pointer;border: 1px solid #EEEEEE;" class="image" align="top" onclick="image_upload(\'' + field + '\', \'' + preview + '\');" />');	
				$('#' + field).attr('value','');
};
//--></script>