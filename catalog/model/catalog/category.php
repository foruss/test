<?php
class ModelCatalogCategory extends Model {
	public function getManufacturers($filter_category_id = 0, $filter_sub_category = false) {

                        if($filter_category_id == 0) $filter_sub_category = true;

                        $sql = "SELECT m.name, m.manufacturer_id ";
                        $sql .= " FROM " . DB_PREFIX . "manufacturer m ";

                        $sql .= " INNER JOIN " . DB_PREFIX . "product p ON (p.manufacturer_id=m.manufacturer_id)";
                            if ($filter_sub_category == true) {
                                $implode_data = array();
                                $categories = $this->getCategoriesByParentId($filter_category_id);
                                $categories[]=$filter_category_id;
                                $implode_data = implode(',',$categories);
                                $sql .= " INNER JOIN " . DB_PREFIX . "product_to_category p2c ON (p.`product_id`=p2c.`product_id`) and p2c.`category_id` in (".$implode_data.")";
                            } else {
                                $sql .= " INNER JOIN " . DB_PREFIX . "product_to_category p2c ON (p.`product_id`=p2c.`product_id`) and p2c.`category_id`=".$filter_category_id."";
                            }
                        $sql .= " GROUP BY p.manufacturer_id";


                        $query = $this->db->query($sql);
                        return $query->rows;

                    }

	public function getManufacturersTotal($filter_category_id = 0,$filter_sub_category = false, $manufacturer_id) {


                        $sql = "SELECT COUNT(*) AS total, m.name, m.manufacturer_id";
                        $sql .= " FROM " . DB_PREFIX . "manufacturer m ";

                        $sql .= " INNER JOIN " . DB_PREFIX . "product p ON (p.manufacturer_id=m.manufacturer_id)";
                            if ($filter_sub_category == true) {
                                $implode_data = array();
                                $categories = $this->getCategoriesByParentId($filter_category_id);
                                $categories[]=$filter_category_id;
                                $implode_data = implode(',',$categories);
                                $sql .= " INNER JOIN " . DB_PREFIX . "product_to_category p2c ON (p.`product_id`=p2c.`product_id`) and p2c.`category_id` in (".$implode_data.")";
                            } else {
                                $sql .= " INNER JOIN " . DB_PREFIX . "product_to_category p2c ON (p.`product_id`=p2c.`product_id`) and p2c.`category_id` = ".$filter_category_id." ";
                            }
                        $sql .= "WHERE p.manufacturer_id = ".$manufacturer_id." GROUP BY p.manufacturer_id";


                        $query = $this->db->query($sql);
                        return $query->row['total'];

                    }

		public function getCategoriesByParentId($category_id) {
		$category_data = array();

		$categories = $this->getCategories((int)$category_id);

		foreach ($categories as $category) {
			$category_data[] = $category['category_id'];

			$children = $this->getCategoriesByParentId($category['category_id']);

			if ($children) {
				$category_data = array_merge($children, $category_data);
			}
		}

		return $category_data;
	}
		public function getCategory($category_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE c.category_id = '" . (int)$category_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND c.status = '1'");

		return $query->row;
	}

	public function getCategories($parent_id = 0) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  AND c.status = '1' ORDER BY c.sort_order, LCASE(cd.name)");

		return $query->rows;
	}

	public function getCategoryFilters($category_id, $manufacturer_id) {
		$implode = array();
        $filter_group_data = array();

		if ($manufacturer_id) {		 $m_id = " AND p.manufacturer_id = '".(int)$manufacturer_id ."' ";
		 $m_flag="";
		} else {			$m_id = "";
			$m_flag=" AND fg.manufacturer='0' ";
		}


		$query = $this->db->query("SELECT cf.filter_id FROM " . DB_PREFIX . "category_filter cf
		LEFT JOIN " . DB_PREFIX . "product_filter pf ON (cf.filter_id = pf.filter_id)
		LEFT JOIN " . DB_PREFIX . "product p ON (pf.product_id = p.product_id)
		LEFT JOIN " . DB_PREFIX . "filter f ON (f.filter_id = cf.filter_id)
		LEFT JOIN " . DB_PREFIX . "filter_group fg ON (fg.filter_group_id = f.filter_group_id)

		WHERE cf.category_id = '" . (int)$category_id . "' ".$m_id." ".$m_flag." ");

		foreach ($query->rows as $result) {
			$implode[] = (int)$result['filter_id'];
		}


		$filter_group_data = array();

		if ($implode) {
			$filter_group_query = $this->db->query("SELECT DISTINCT f.filter_group_id, fgd.name, fg.sort_order
			FROM " . DB_PREFIX . "filter f LEFT JOIN " . DB_PREFIX . "filter_group fg ON (f.filter_group_id = fg.filter_group_id)
			LEFT JOIN " . DB_PREFIX . "filter_group_description fgd ON (fg.filter_group_id = fgd.filter_group_id)
			WHERE f.filter_id IN (" . implode(',', $implode) . ")
			AND fgd.language_id = '" . (int)$this->config->get('config_language_id') . "'
			GROUP BY f.filter_group_id ORDER BY fg.sort_order, LCASE(fgd.name)");

			foreach ($filter_group_query->rows as $filter_group) {
				$filter_data = array();

				$filter_query = $this->db->query("SELECT DISTINCT f.filter_id, fd.name
				FROM " . DB_PREFIX . "filter f LEFT JOIN " . DB_PREFIX . "filter_description fd ON (f.filter_id = fd.filter_id)
				WHERE f.filter_id IN (" . implode(',', $implode) . ")
				AND f.filter_group_id = '" . (int)$filter_group['filter_group_id'] . "'
				AND fd.language_id = '" . (int)$this->config->get('config_language_id') . "'
				ORDER BY f.sort_order, LCASE(fd.name)");

				foreach ($filter_query->rows as $filter) {
					$filter_data[] = array(
						'filter_id' => $filter['filter_id'],
						'name'      => $filter['name']
					);
				}

				if ($filter_data) {
					$filter_group_data[] = array(
						'filter_group_id' => $filter_group['filter_group_id'],
						'name'            => $filter_group['name'],
						'filter'          => $filter_data
					);
				}
			}
		}

		return $filter_group_data;
	}

	public function getCategoryLayoutId($category_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category_to_layout WHERE category_id = '" . (int)$category_id . "' AND store_id = '" . (int)$this->config->get('config_store_id') . "'");

		if ($query->num_rows) {
			return $query->row['layout_id'];
		} else {
			return $this->config->get('config_layout_category');
		}
	}

	public function getTotalCategoriesByCategoryId($parent_id = 0) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND c.status = '1'");

		return $query->row['total'];
	}
}
?>