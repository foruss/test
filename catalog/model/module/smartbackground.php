<?php
	class ModelModuleSmartBackground extends Model {
		
		public function getBackground() {  
		
		$this->load->model('design/layout');
		$this->load->model('catalog/category');
		$this->load->model('catalog/product');
		$this->load->model('catalog/information');
		
		if (isset($this->request->get['route'])) {
			$route = (string)$this->request->get['route'];
		} else {
			$route = 'common/home';
		}
		
		$layout_id = 0;
		$category_id = '';
		if ($route == 'product/category' && isset($this->request->get['path'])) {
			$path = explode('_', (string)$this->request->get['path']);
				
			$layout_id = $this->model_catalog_category->getCategoryLayoutId(end($path));
			$category_id = end($path);			
		}
		
		$html = "";
		
		if ($route == 'product/product' && isset($this->request->get['product_id'])) {
			$layout_id = $this->model_catalog_product->getProductLayoutId($this->request->get['product_id']);
			
			if (isset($this->request->get['path'])) { 
			$path = explode('_', (string)$this->request->get['path']); 
			$layout_id = $this->model_catalog_category->getCategoryLayoutId(end($path));
			$category_id = end($path);	
			} else {
			$path = $this->model_catalog_product->getCategories($this->request->get['product_id']);
			
			foreach ($path as $pathik) {
			if ($pathik['category_id'] == 1) {
			$path = $pathik["category_id"];
			}
			}
			$layout_id = $this->model_catalog_category->getCategoryLayoutId($path);
			$category_id = $path;	
			}
		}
		
		if ($route == 'information/information' && isset($this->request->get['information_id'])) {
			$layout_id = $this->model_catalog_information->getInformationLayoutId($this->request->get['information_id']);
		}
		
		if (!$layout_id) {
			$layout_id = $this->model_design_layout->getLayout($route);
		}
						
		if (!$layout_id) {
			$layout_id = $this->config->get('config_layout_id');
		}
		
		$this->load->model('setting/extension');
		
		$extensions = $this->model_setting_extension->getExtensions('module');		
			$module_data = array();
			$this->load->model('tool/image'); 
			$modules = $this->config->get('smartbackground');

			$background = '';
			if ($modules) {
				foreach ($modules as $module) {
					if ($module['layout_id'] == $layout_id && $module['status'] && isset($module['category_id']) && $module['category_id'] == $category_id) {
					$background = "background:";
					if ($module['color'] != "") {
					$background .="#".$module['color'];
					}
					if ($module['image'] != "") {
					$background .= " url(image/".$module['image'].") ".$module['position'];
					}
					$background .= " ".$module['repeat'].";";
					}
					if ($module['layout_id'] == $layout_id && $module['category_id'] == 0)
					{
					$background = "background:";
					if ($module['color'] != "") {
					$background .="#".$module['color'];
					}
					if ($module['image'] != "") {
					$background .= " url(image/".$module['image'].") ".$module['position'];
					}
					$background .= " ".$module['repeat'].";";
					}
				}
			}
		if ($background != '') {
		
		$html = "<style type='text/css'>";
		$html .= "#wrapper {".$background."}";
		$html .= "</style>";
		}
		return $html;
		}
	}
	?>