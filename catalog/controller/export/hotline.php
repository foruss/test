<?php
class ControllerExportHotline extends Controller {
	
	private $eof = "\n";

	public function index() {
		if ($this->config->get('yandex_market_status')) {
		
			$output  = '<?xml version="1.0" encoding="utf-8" ?>';
			$output .= '<price>'  . "\n";
			$output .= '<date>' . date("Y-m-d H:m") . '</date>';
			$output .= '<firmname>' . $this->config->get('config_name') . '</firmname>';
			$output .= '<firmid>1234</firmid>';
			$output .= '<rate>8.10</rate>';
		
			// Категории товаров
			$this->load->model('catalog/category');
			$output .= '<categories>';
			$output .= $this->getCat();
		//	$output .='<name>'. $this->getCat() .'</name>';
			$output .= '</categories>';

			// Товарные позиции
			$this->load->model('catalog/product');
			$this->load->model('tool/image');
			$output .= '<items>';
			
			$products = $this->model_catalog_product->getProducts();
			foreach ($products as $product) {
				$output .= '<item>' . $this->eof;
				// Определяем категорию для товара
				$categories = $this->model_catalog_product->getCategories($product['product_id']);
				$output .= '<categoryId>'.$categories[0]['category_id'].'</categoryId>';
				
				$output .= '<code>'.$product['model'].'</code>';
				$output .= '<vendor>' . $product['manufacturer'] . '</vendor>';
				$output .= '<name>' . $product['name'] . '</name>';
				$output .= '<url>'.(HTTP_SERVER . 'index.php?route=product/product&amp;product_id=' . $product['product_id']).'</url>';
				// Определеяме изображение
				if ($product['image']) {
					$output .= '<image>' . $this->model_tool_image->resize($product['image'], 500, 500) . '</image>';
				} else {
					$output .= '<image>' . $this->model_tool_image->resize('no_image.jpg', 500, 500) . '</image>';
				}
				$output .= '<priceRUAH>' . $this->tax->calculate($product['price'], $product['tax_class_id']) . '</priceRUAH>';
				$output .= '<stock>На складе</stock>';
				$output .= '<guarantee>12</guarantee>';
			    $output .= '<description>'.$this->ymlTextPrepare($product['description']) .'</description>';
				$output .= '</item>';
			}
			$output .= '</items>';
			$output .= '</price>';
			$this->response->addHeader('Content-Type: application/xml');
			$this->response->setOutput($output);
		}
	}

	// Возвращает массив категорий
	protected function getCat($pi=0) {
		$categories = $this->model_catalog_category->getCategories($pi);
		$out = ' ';

		foreach ($categories as $category) {
			$out .= '<category><id>'.$category['category_id'].'</id>';
			if($pi != 0) 
			$out .= ' <parentId>'.$pi.'</parentId>';
			
			$out .='<name>'.$category['name'].'</name></category>';
			if($e =  $this->getCat($category['category_id'])) $out .= $e;
		}
		return $out;
	}

		 protected function ymlTextPrepare($text) 
		 {
        $text = htmlspecialchars_decode(trim($text));
        $text = strip_tags($text);
        $search = array('"', '&', '>', '<', '\'');
        $replace = array(' ', ' ', ' ', ' ', ' ');
        $text = str_replace($search, $replace, $text);              
        $text = preg_replace('#[\x00-\x08\x0B-\x0C\x0E-\x1F]#is', ' ', $text);
        $str1= array("/nbsp;/","/quot;/","/amp;/","/bull;/","/apos;/","/laquo;/","/raquo;/","/rdquo;/","/ldquo;/",);
        $str2 = array(" "," "," "," "," "," "," "," "," ");
        $text = preg_replace($str1,$str2,$text);
        return trim($text);
    }
	
}
?>