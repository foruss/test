<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content" class="contactpage">
  <h1><?php echo $heading_title; ?></h1>
    <strong><?php echo $text_location; ?></strong><br />
    <div class="contact-info">
      <div class="content"><div class="left"><h3>Postal Adress</h3>
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
      <div class="right">
      <div class="box1">
	  <h3> Email</h3>
	  <p>Choose a topic you`d like to email us about</p>
	  <select id="item-select1" name="item-select1" class="valid">
		<option value="- Select One -">- Select One -</option>
		<option value="Advertising">Advertising</option>
		<option value="Investor Relations">Investor Relations</option>
		<option value="Feedback Vehicle, Dealer, Company">Feedback Vehicle, Dealer, Company</option>
		<option value="Automix Extended Service Plan">Automix Extended Service Plan</option>
		<option value="Vehicle Sales Questions">Vehicle Sales Questions</option>
		<option value="Vehicle Service Questions">Vehicle Service Questions</option>
		<option value="Vehicle Warranty Questions">Vehicle Warranty Questions</option>
		<option value="Website Comments">Website Comments</option>
		<option value="Submit an Idea">Submit an Idea</option>
		<option value="Other">Other</option>
		</select>
		</div>
	<div class="box1">
	  <h3> Empoyment verification</h3>
	  <p>Choose a job position you`d like to apply</p>
		<select id="item-select2" name="item-select2">
			<option value="- Select One -">- Select One -</option>
			<option value="Auto body repaire ">Auto body repaire </option>
			<option value="Mechanic">Mechanic</option>
			<option value="Auto painter">Auto painter</option>
			<option value="Bookkeeper">Bookkeeper</option>
			<option value="Sales">Sales</option>
		</select>
		</div>
		<?php echo $content_top; ?>
		<div class="hide"><?php echo $content_bottom; ?></div>
	 <div id="rezults"></div>
	<div class="info">
	 <b>Please acknowledge you have read and understood the following:</b>
     <div class="lisub"><span class="required">*</span><input class="of-box-r" id="chvalue-4091" type="checkbox" name="item-409" value=""><label class="of-after" for="chvalue-409">Thank you for taking the time to write to Automix Company. All inquiries submitted are reviewed for use in improving our products and processes. We regret that we cannot guarantee a response to all inquiries.</label>
      </div>
	  </div>
      </div>
    </div>
    </div>
  </div>
<?php echo $footer; ?>