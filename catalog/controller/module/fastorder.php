<?php
class ControllerModuleFastorder extends Controller {
	
	public function index() { 
		$this->load->language("module/fastorder");
		
		$this->load->model('setting/setting');

		$this->data["heading_title"] = $this->language->get("heading_title");
		$this->data["email"] = $this->config->get('config_email');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get("config_template") . "/template/module/fastorder.tpl")) {
			$this->template = $this->config->get("config_template") . "/template/module/fastorder.tpl";
		} else {
			$this->template = "default/template/module/fastorder.tpl";
		}
		
		$this->children = array(
			"common/column_left",
			"common/column_right",
			"common/content_top",
			"common/content_bottom",
			"common/footer",
			"common/header"
		);
										
		$this->response->setOutput($this->render());
	}
	public function send() {
	
	$this->load->language("module/fastorder");
		
	$this->load->model('setting/setting');

	$this->data["heading_title"] = $this->language->get("heading_title");
	$this->data["email"] = $this->config->get('config_email');
	
	
	
	
	if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			
			$body = "<b>Product:</b> <a href='".$this->request->post['url']."'>".$this->request->post['product']."</a><br/><p><b>Name: </b>".$this->request->post['name']."</p><p><b>Phone: </b>".$this->request->post['phone']."</p><p><b>E-mail: </b>".$this->request->post['email']."</p>";
			$from_email = (!empty($this->request->post['email']))?$this->request->post['email']:'notreply@'.$_SERVER['SERVER_NAME'];
			
			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->hostname = $this->config->get('config_smtp_host');
			$mail->username = $this->config->get('config_smtp_username');
			$mail->password = $this->config->get('config_smtp_password');
			$mail->port = $this->config->get('config_smtp_port');
			$mail->timeout = $this->config->get('config_smtp_timeout');				
			$mail->setTo($this->config->get('config_email'));
			$mail->setFrom($from_email);
			$mail->setSender("Быстрый заказ продукта - ".$this->request->post['product']." - ".$this->request->post['name']);
			$mail->setSubject($this->request->post['name']);
			$mail->setHtml($body);
			$mail->send();
			
			if ($this->request->post['email']) {
			
			$body1 = $body."<br /> Спасибо за Ваш заказ.<br /> Мы свяжемся с Вами в ближайшее время.";
			
			$mail1 = new Mail();
			$mail1->protocol = $this->config->get('config_mail_protocol');
			$mail1->parameter = $this->config->get('config_mail_parameter');
			$mail1->hostname = $this->config->get('config_smtp_host');
			$mail1->username = $this->config->get('config_smtp_username');
			$mail1->password = $this->config->get('config_smtp_password');
			$mail1->port = $this->config->get('config_smtp_port');
			$mail1->timeout = $this->config->get('config_smtp_timeout');				
			$mail1->setTo($this->config->get('config_email'));
			$mail1->setFrom($from_email);
			$mail1->setTo($this->request->post['email']);
			$mail1->setFrom('notreply@'.$_SERVER['SERVER_NAME']);
			$mail1->setSender("Быстрый заказ продукта - ".$this->request->post['product']." - ".$this->request->post['name']);
			$mail1->setSubject('Быстрый заказ продукта - '.$_POST['product'].' принят в обработку');
			$mail1->setHtml($body1);
			$mail1->send();
			
			}
    	}
	if (file_exists(DIR_TEMPLATE . $this->config->get("config_template") . "/template/module/fastorder.tpl")) {
			$this->template = $this->config->get("config_template") . "/template/module/fastorder.tpl";
		} else {
			$this->template = "default/template/module/fastorder.tpl";
		}
		
		$this->children = array(
			"common/column_left",
			"common/column_right",
			"common/content_top",
			"common/content_bottom",
			"common/footer",
			"common/header"
		);
										
		$this->response->setOutput($this->render());
	
	}

}
?>