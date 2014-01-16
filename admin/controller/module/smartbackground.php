<?php
class ControllerModuleSmartbackground extends Controller {
	private $error = array(); 
	
	
	private function getAllCategories($categories, $parent_id = 0, $parent_name = '') {
		$output = array();

		if (array_key_exists($parent_id, $categories)) {
			if ($parent_name != '') {
				$parent_name .= $this->language->get('text_separator');
			}

			foreach ($categories[$parent_id] as $category) {
				$output[$category['category_id']] = array(
					'category_id' => $category['category_id'],
					'name'        => $parent_name . $category['name']
				);

				$output += $this->getAllCategories($categories, $category['category_id'], $parent_name . $category['name']);
			}
		}

		return $output;
	}
	
	
	
	public function index() { 
		$this->load->language("module/smartbackground");

		$this->document->setTitle($this->language->get("heading_title")); 
		
		$this->load->model("setting/setting");
				
		if (($this->request->server["REQUEST_METHOD"] == "POST") && $this->validate()) {
			$this->model_setting_setting->editSetting("smartbackground", $this->request->post);		
					
			$this->session->data["success"] = $this->language->get("text_success");
						
			$this->redirect($this->url->link("extension/module", "token=" . $this->session->data["token"], "SSL"));
		}
		
		$this->data["heading_title"] = $this->language->get("heading_title");
		
		$this->data["text_enabled"] = $this->language->get("text_enabled");
		$this->data["text_disabled"] = $this->language->get("text_disabled");
		$this->data["text_none"] = $this->language->get("text_none");
		$this->data['text_upload'] = $this->language->get('text_upload');
		$this->data['text_repeat'] = $this->language->get('text_repeat');
		$this->data['text_repeatx'] = $this->language->get('text_repeatx');
		$this->data['text_repeaty'] = $this->language->get('text_repeaty');
		$this->data['text_norepeat'] = $this->language->get('text_norepeat');
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');
		
		$this->data["entry_intro"] = $this->language->get("entry_intro");
		$this->data["entry_layout"] = $this->language->get("entry_layout");
		$this->data["entry_image"] = $this->language->get("entry_image");
		$this->data["entry_position"] = $this->language->get("entry_position");
		$this->data["entry_color"] = $this->language->get("entry_color");
		$this->data["entry_repeat"] = $this->language->get("entry_repeat");
		$this->data["entry_category"] = $this->language->get("entry_category");
		$this->data["entry_status"] = $this->language->get("entry_status");
		$this->data["entry_sort_order"] = $this->language->get("entry_sort_order");
		
		//buttons
		$this->data["button_save"] = $this->language->get("button_save");
		$this->data["button_cancel"] = $this->language->get("button_cancel");
		$this->data["button_add_module"] = $this->language->get("button_add_module");
		$this->data["button_remove"] = $this->language->get("button_remove");
		
		//errors
		if (isset($this->error["warning"])) {
			$this->data["error_warning"] = $this->error["warning"];
		} else {
			$this->data["error_warning"] = "";
		}
		
		//breadcrumbs
		$this->data["breadcrumbs"] = array();

   		$this->data["breadcrumbs"][] = array(
       		"text"      => $this->language->get("text_home"),
			"href"      => $this->url->link("common/home", "token=" . $this->session->data["token"], "SSL"),
      		"separator" => false
   		);

   		$this->data["breadcrumbs"][] = array(
       		"text"      => $this->language->get("text_module"),
			"href"      => $this->url->link("extension/module", "token=" . $this->session->data["token"], "SSL"),
      		"separator" => " :: "
   		);
		
   		$this->data["breadcrumbs"][] = array(
       		"text"      => $this->language->get("heading_title"),
			"href"      => $this->url->link("module/smartbackground", "token=" . $this->session->data["token"], "SSL"),
      		"separator" => " :: "
   		);
		
		$this->data["action"] = $this->url->link("module/smartbackground", "token=" . $this->session->data["token"], "SSL");
		
		$this->data["cancel"] = $this->url->link("extension/module", "token=" . $this->session->data["token"], "SSL");
		
		//------------------------------
		//insert you data
		//------------------------------
		
		
		
		$this->data["modules"] = array();
		
		if (isset($this->request->post["smartbackground"])) {
			$this->data["modules"] = $this->request->post["smartbackground"];
		} elseif ($this->config->get("smartbackground")) { 
			$this->data["modules"] = $this->config->get("smartbackground");
		}	
		$this->load->model('tool/image'); 
		
		$results = $this->config->get("smartbackground");
		
		$this->data['gallery_images'] = array();
	
		if(isset($results)) {
		foreach ($results as $result) {
					$this->data['gallery_images'][] = array(
						'preview' => $this->model_tool_image->resize($result['image'], 100, 100),
					);
		};
		}
		
		if (isset($gallery_info) && $gallery_info['image'] && file_exists(DIR_IMAGE . $gallery_info['image'])) {
			$this->data['preview'] = $this->model_tool_image->resize($gallery_info['image'], 100, 100);
		} else {
			$this->data['preview'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		}
		$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
				
		$this->load->model("design/layout");
		
		$this->data["layouts"] = $this->model_design_layout->getLayouts();
		
		
		$this->load->model('catalog/category');
		
		$data = array(
			'start' => 0,
			'limit' => $this->config->get('config_admin_limit')
		);
		
		$this->data['categories'] = $this->model_catalog_category->getCategories(null,null);

		//$this->data['categories'] = $this->getAllCategories($categories);
		
		$this->template = "module/smartbackground.tpl";
		$this->children = array(
			"common/header",
			"common/footer",
		);
		
		$this->data["token"] = $this->session->data["token"];
				
		$this->response->setOutput($this->render());
	}
	
	public function install(){
	
	
	}
	
	public function uninstall(){
	
	}
	
	private function validate() {
		if (!$this->user->hasPermission("modify", "module/smartbackground")) {
			$this->error["warning"] = $this->language->get("error_permission");
		}

		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}
?>