<?php echo $header; ?>
<?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1><?php echo $heading_title; ?></h1>
	<div style="float: left;width: 29%"><h3>Postal Adress</h3>
	  <img src="/image/data/ohpiugpug.png" width="196" height="132"><br />
	  <b><?php echo $text_address; ?></b><br />
        <?php echo $store; ?><br />
        <?php echo $address; ?><br /><?php if ($telephone) { ?>
        <b><?php echo $text_telephone; ?></b><br />
        <?php echo $telephone; ?><br />
        <br />
        <?php } ?>
        <?php if ($fax) { ?>
        <b><?php echo $text_fax; ?></b><br />
        <?php echo $fax; ?>
        <?php } ?></div>
		 <div style="float: right;width: 69%">
  <form id="<?php echo $form_id; ?>" class="oform <?php echo $class;?>" action="<?php echo $action;?>" method="post" enctype="multipart/form-data">
        <ol class="of-ol">
        <?php foreach($items as $item) { ?>
            <?php if ($item['item_type'] == 'html') { ?>
            <li class="of-html">
                <h3><?php echo $item['label']; ?></h3>
                <p><?php echo html_entity_decode($item['value'], ENT_QUOTES, 'UTF-8'); ?></p>
            </li>
            <?php } elseif ($item['item_type'] == 'input') { ?>
             <li class="<?php echo $item['style']; ?>">
                <label class="of-before" for="item-<?php echo $item['item_id']; ?>" ><?php echo $item['label']; ?></label><br/>
                <?php if($customer) { ?>
                    <?php if($item['setsender'] == 1) { ?>
                    <input type="text" title="" value="<?php echo (isset($this->request->post['item-'.$item['item_id']]) ? $this->request->post['item-'.$item['item_id']] : $this->customer->getFirstName()); ?>" name="item-<?php echo $item['item_id']; ?>" id="item-<?php echo $item['item_id']; ?>" />
                    <?php } elseif($item['setfrom'] == 1) { ?>
                    <input type="text" title="" value="<?php echo (isset($this->request->post['item-'.$item['item_id']]) ? $this->request->post['item-'.$item['item_id']] : $this->customer->getEmail()); ?>" name="item-<?php echo $item['item_id']; ?>" id="item-<?php echo $item['item_id']; ?>" />
                    <?php } else { ?>
                    <input type="text" title="<?php echo $item['value'];?>" value="<?php echo (isset($this->request->post['item-'.$item['item_id']]) ? $this->request->post['item-'.$item['item_id']] : $item['value']); ?>" name="item-<?php echo $item['item_id']; ?>" id="item-<?php echo $item['item_id']; ?>" />
                    <?php } ?>
                <?php } else { ?> 
                <input type="text" title="<?php echo $item['value'];?>" value="<?php echo (isset($this->request->post['item-'.$item['item_id']]) ? $this->request->post['item-'.$item['item_id']] : $item['value']); ?>" name="item-<?php echo $item['item_id']; ?>" id="item-<?php echo $item['item_id']; ?>" />
                <?php } ?>
                <span class="error"><?php echo (isset($error['item_error'.$item['item_id']]) ? $error['item_error'.$item['item_id']] : ''); ?></span>
            </li>
            <?php } elseif ($item['item_type'] == 'date') { ?>
             <li class="<?php echo $item['style']; ?>">
                <label class="of-before" for="item-<?php echo $item['item_id']; ?>" ><?php echo $item['label']; ?></label><br/>
                <input class="of-datepicker" type="text" title="<?php echo $item['value'];?>" value="<?php echo (isset($this->request->post['item-'.$item['item_id']]) ? $this->request->post['item-'.$item['item_id']] : $item['value']); ?>" name="item-<?php echo $item['item_id']; ?>" id="item-<?php echo $item['item_id']; ?>" />
                <span class="error"><?php echo (isset($error['item_error'.$item['item_id']]) ? $error['item_error'.$item['item_id']] : ''); ?></span>
            </li>
            <?php } elseif ($item['item_type'] == 'time') { ?>
             <li class="<?php echo $item['style']; ?>">
                <label class="of-before" for="item-<?php echo $item['item_id']; ?>" ><?php echo $item['label']; ?></label><br/>
                <input class="of-timepicker" type="text" title="<?php echo $item['value'];?>" value="<?php echo (isset($this->request->post['item-'.$item['item_id']]) ? $this->request->post['item-'.$item['item_id']] : $item['value']); ?>" name="item-<?php echo $item['item_id']; ?>" id="item-<?php echo $item['item_id']; ?>" />
                <span class="error"><?php echo (isset($error['item_error'.$item['item_id']]) ? $error['item_error'.$item['item_id']] : ''); ?></span>
            </li>
            <?php } elseif ($item['item_type'] == 'datetime') { ?>
             <li class="<?php echo $item['style']; ?>">
                <label class="of-before" for="item-<?php echo $item['item_id']; ?>" ><?php echo $item['label']; ?></label><br/>
                <input class="of-datetimepicker" type="text" title="<?php echo $item['value'];?>" value="<?php echo (isset($this->request->post['item-'.$item['item_id']]) ? $this->request->post['item-'.$item['item_id']] : $item['value']); ?>" name="item-<?php echo $item['item_id']; ?>" id="item-<?php echo $item['item_id']; ?>" />
                <span class="error"><?php echo (isset($error['item_error'.$item['item_id']]) ? $error['item_error'.$item['item_id']] : ''); ?></span>
            </li>
            <?php } elseif ($item['item_type'] == 'textarea') { ?>
             <li class="<?php echo $item['style']; ?>">
                <label class="of-before" for="item-<?php echo $item['item_id']; ?>" ><?php echo $item['label']; ?></label><br/>
                <textarea title="<?php echo $item['value'];?>" name="item-<?php echo $item['item_id']; ?>" id="item-<?php echo $item['item_id']; ?>"><?php echo (isset($this->request->post['item-'.$item['item_id']]) ? $this->request->post['item-'.$item['item_id']] : $item['value']); ?></textarea>
                <span class="error"><?php echo (isset($error['item_error'.$item['item_id']]) ? $error['item_error'.$item['item_id']] : ''); ?></span>
            </li>
            <?php } elseif ($item['item_type'] == 'radio') { ?>
            <li class="lisub">
                <label class="of-before"><?php echo $item['label']; ?></label><br/>
                <?php $values = explode("\r\n",$item['value']); $i = 1 ; ?>
                <ul class="of-sub">
                <?php foreach($values as $value) { ?>
                    <li>
                    <?php 
                    $checked = '';
                    if (isset($this->request->post['item-'.$item['item_id']])) {
                    $checked = $this->request->post['item-'.$item['item_id']] == $value ? 'checked="checked"' : '';
                    } ?>
                        <input <?php echo $checked; ?> class="of-box-r" id="rvalue-<?php echo $item['item_id'].$i; ?>" type="radio" name="item-<?php echo $item['item_id']; ?>" value="<?php echo $value; ?>">
                        <label class="of-after" for="rvalue-<?php echo $item['item_id'].$i; ?>" ><?php echo $value; ?></label><br/>
                    </li>
                <?php $i++; } ?>
                </ul>
                <span class="error"><?php echo (isset($error['item_error'.$item['item_id']]) ? $error['item_error'.$item['item_id']] : ''); ?></span>
            </li>
            <?php } elseif ($item['item_type'] == 'dropdown') { ?>
             <li class="<?php echo $item['style']; ?>">
                <label class="of-before"><?php echo $item['label']; ?></label><br/>
                <?php $values = explode("\r\n",$item['value']); $i = 1 ; ?>
                <select id="item-<?php echo $item['item_id']; ?>" name="item-<?php echo $item['item_id']; ?>">
                <?php foreach($values as $value) { ?>
                    <li>
                    <?php 
                    $checked = '';
                    if (isset($this->request->post['item-'.$item['item_id']])) {
                    $checked = $this->request->post['item-'.$item['item_id']] == $value ? 'selected="selected"' : '';
                    } ?>
                        <option <?php echo $checked; ?> value="<?php echo $value; ?>"><?php echo $value; ?></option>
                    </li>
                <?php $i++; } ?>
                </select>
                <span class="error"><?php echo (isset($error['item_error'.$item['item_id']]) ? $error['item_error'.$item['item_id']] : ''); ?></span>
            </li>
            <?php } elseif ($item['item_type'] == 'checkbox') { ?>
            <li class="lisub">
                <label class="of-before"><?php echo $item['label']; ?></label><br/>
                <?php $values = explode("\r\n",$item['value']); $i = 1 ; ?>
                <ul class="of-sub">
                <?php foreach($values as $value) { ?>
                    <li>
                    <?php 
                    $checked = '';
                    if (isset($this->request->post['item-'.$item['item_id']])) {
                    $checked = in_array($value,$this->request->post['item-'.$item['item_id']]) ? 'checked="checked"' : '';
                    } ?>
                        <input <?php echo $checked; ?> class="of-box-r" id="chvalue-<?php echo $item['item_id'].$i; ?>" type="checkbox" name="item-<?php echo $item['item_id']; ?>[]" value="<?php echo $value; ?>">
                        <label class="of-after" for="chvalue-<?php echo $item['item_id'].$i; ?>" ><?php echo $value; ?></label><br/>
                    </li>
                <?php $i++; } ?>
                </ul>
                <span class="error"><?php echo (isset($error['item_error'.$item['item_id']]) ? $error['item_error'.$item['item_id']] : ''); ?></span>
            </li>
            <?php } elseif ($item['item_type'] == 'multiselect') { ?>
             <li class="multiselect <?php echo $item['style']; ?>">
                <label class="of-before"><?php echo $item['label']; ?></label><br/>
                <?php $values = explode("\r\n",$item['value']); $i = 1 ; ?>
                <select size="3" multiple="multiple" id="item-<?php echo $item['item_id']; ?>" name="item-<?php echo $item['item_id']; ?>[]">
                <?php foreach($values as $value) { ?>
                    <li>
                    <?php 
                    $checked = '';
                    if (isset($this->request->post['item-'.$item['item_id']])) {
                    $checked = in_array($value,$this->request->post['item-'.$item['item_id']]) ? 'selected="selected"' : '';
                    } ?>
                        <option <?php echo $checked; ?> value="<?php echo $value; ?>"><?php echo $value; ?></option>
                    </li>
                <?php $i++; } ?>
                </select>
                <span class="error"><?php echo (isset($error['item_error'.$item['item_id']]) ? $error['item_error'.$item['item_id']] : ''); ?></span>
            </li>
            <?php } elseif ($item['item_type'] == 'file' && $fileon) { ?>
             <li class="<?php echo $item['style']; ?>">
                <label class="of-before" for="item-<?php echo $item['item_id']; ?>" ><?php echo $item['label']; ?></label><br/>
                <input class="of_upload" type="file" name="item-<?php echo $item['item_id']; ?>" id="item-<?php echo $item['item_id']; ?>" />
                <span class="error"><?php echo (isset($error['item_error'.$item['item_id']]) ? $error['item_error'.$item['item_id']] : ''); ?></span>
            </li>
            <?php } elseif ($item['item_type'] == 'capcha') { ?>
             <li class="<?php echo $item['style']; ?>">
                <label class="of-before  of-lc" for="item-<?php echo $item['item_id']; ?>" ><?php echo $item['label']; ?><br />
                <img src="index.php?route=information/form/captcha" alt="" /></label><br/>
                <input title="<?php echo $item['value']; ?>" value="" id="item-<?php echo $item['item_id']; ?>" type="text" name="captcha" class="captcha"  />
                <span class="error"><?php echo (isset($captcha_error) ? $captcha_error : ''); ?></span>
            </li>
            <?php } ?>
        <?php } ?>
        </ol>
    <p class="of-sb"><input class="sendbutton" type="submit" value="<?php echo $button; ?>" /></p>
  </form>
  
</div>
<?php echo $footer; ?>