<?php if($view_form) { ?>
<div id="it<?php echo $form_id; ?>" class="box1">
  <div  class="box-content">
    <div class="box-form">
        <?if ($link_form == false) { ?>
        <?php if($modal) : ?>
        <a id="<?php echo $form_class; ?>" href="<?php echo $form_link; ?>"><?php echo $heading_title; ?></a>
        <?php endif; ?>
        <?php echo $div_start; ?>
        <form id="<?php echo $form_id; ?>" class="oform <?php echo $class;?>" action="<?php echo $action;?>" method="post" enctype="multipart/form-data">
            <div class="hide-form"></div>
                <ol class="of-ol">
                <?php foreach($items as $item) { ?>
                    <?php if ($item['item_type'] == 'html') { ?>
                    <li class="of-html <?php echo $item['style']; ?>">
                        <h3><?php echo $item['label']; ?></h3>
                        <p><?php echo html_entity_decode($item['value'], ENT_QUOTES, 'UTF-8'); ?></p>
                    </li>
                    <?php } elseif ($item['item_type'] == 'input') { ?>
                    <li class="item-<?php echo $item['item_id']; ?> <?php echo $item['style']; ?>">
                        <label class="of-before" for="item-<?php echo $item['item_id']; ?>" ><?php echo $item['label']; ?></label><br/>
                        <?php if($customer) { ?>
                            <?php if($item['setsender'] == 1) { ?>
                            <input type="text"  title="" value="<?php echo (isset($this->request->post['item-'.$item['item_id']]) ? $this->request->post['item-'.$item['item_id']] : $this->customer->getFirstName()); ?>" name="item-<?php echo $item['item_id']; ?>" id="item-<?php echo $item['item_id']; ?>" />
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
                    <li class="textarea <?php echo $item['style']; ?>">
                        <label class="of-before" for="item-<?php echo $item['item_id']; ?>" ><?php echo $item['label']; ?></label><br/>
                        <textarea title="<?php echo $item['value'];?>" name="item-<?php echo $item['item_id']; ?>" id="item-<?php echo $item['item_id']; ?>"><?php echo (isset($this->request->post['item-'.$item['item_id']]) ? $this->request->post['item-'.$item['item_id']] : $item['value']); ?></textarea>
                        <span class="error"><?php echo (isset($error['item_error'.$item['item_id']]) ? $error['item_error'.$item['item_id']] : ''); ?></span>
                    </li>
                    <?php } elseif ($item['item_type'] == 'radio') { ?>
                    <li class="lisub <?php echo $item['style']; ?>">
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
                    <li  class="multiselect item-<?php echo $item['item_id']; ?> <?php echo $item['style']; ?>">
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
                    <li class="lisub <?php echo $item['style']; ?>">
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
                        <img src="index.php?route=information/form/captcha" alt="" /></label>
                        <input title="<?php echo $item['value']; ?>" value="" id="item-<?php echo $item['item_id']; ?>" type="text" name="captcha" class="captcha"  />
                        <span class="error"><?php echo (isset($captcha_error) ? $captcha_error : ''); ?></span>
                    </li>
                    <?php } ?>
                <?php } ?>
                </ol>
            <p class="of-sb"><input class="sendbutton" type="submit" value="<?php echo $button; ?>" /></p>
            <?php foreach ($hiddens as $hidden) { ?>
            <?php echo $hidden; ?>
            <? } ?>
          </form>
          <?php echo $div_finish; ?>
          <?php echo $div_start.$linkmas; ?>
          <div id="<?php echo $sid; ?>" class="of-success"></div>
          <?php echo $div_finish; ?>
          <? } else { ?>
          <a href="<?php echo $form_link; ?>"><?php echo $form_name; ?></a>
          <? } ?>
    </div>
  </div>
</div>
<?php } ?>