<?php

class c8_category {
	protected $id;
	protected $parent_id;
	protected $lang_id;
	protected $title_arr = [];
	protected $description_arr = [];
	protected $category_section;
	protected $date;
	protected $date_update;
	protected $user_id;
	protected $code;
	protected $sort;
	protected $published = false;

	public function __construct() {}

	public function setId($i) {
		$this->id = $i;
	}

	public function setParentId($pi) {
		$this->parent_id = $pi;
	}

	public function setLangId($li) {
		$this->lang_id = $li;
	}

	public function setContent($t, $c, $mk, $md) {
		$this->title_arr = $t;
		$this->content_arr = $c;
		$this->meta_keywords = $mk;
		$this->meta_description = $md;
	}

	public function setCode($c) {
		$this->code = $c;
	}

	public function setUserId($u) {
		$this->user_id = $u;
	}

	public function setCategorySection($s) {
		$this->category_section = $s;
	}

	public function setPublished($p) {
		$this->published = $p;
	}

	public function setSort($s) {
		$this->sort = $s;
	}

	public function setDate($d = null) {
		$this->date = ($d !== null) ? $d : date("Y-m-d H:i:s", time());
	}

	public function setDateUpdate($d = null) {
		$this->date_update = ($d !== null) ? $d : date("Y-m-d H:i:s", time());
	}

	public function insert() {
		global $cfg, $db;

		$query[0] = sprintf("INSERT INTO %s_8_categories (parent_id, category_section, code, sort, user_id, date, date_update, published) VALUES (%s, '%s', '%s', %s, %s, '%s', '%s', %s)",
			$cfg->db->prefix,
			$this->parent_id,
			$this->category_section,
			$this->code,
			$this->sort,
			$this->user_id,
			$this->date,
			$this->date_update,
			$this->published
		);

		if ($db->query($query[0])){

			$this->id = $db->insert_id;

			foreach ($this->title_arr as $i => $item) {
				$query[1] = sprintf("INSERT INTO %s_8_categories_lang (category_id, lang_id, title, text, `meta-keywords`, `meta-description`) VALUES (%s, %s, '%s', '%s', '%s', '%s')",
					$cfg->db->prefix,
					$this->id,
					$i+1,
					$db->real_escape_string($this->title_arr[$i]),
					$db->real_escape_string($this->content_arr[$i]),
					$db->real_escape_string($this->meta_keywords[$i]),
					$db->real_escape_string($this->meta_description[$i])
				);

				$db->query($query[1]);
			}

			return true;
		} else {
			return false;
		}
	}

	public function update() {
		global $cfg, $db;
		$toReturn = false;

		$query[0] = sprintf("UPDATE %s_8_categories SET parent_id = '%s', category_section = '%s', code = '%s', sort = '%s', date = '%s', date_update = '%s', published = '%s' WHERE id = '%s'",
			$cfg->db->prefix,
			$this->parent_id,
			$this->category_section,
			$this->code,
			$this->sort,
			$this->date,
			$this->date_update,
			$this->published,
			$this->id
		);

		if ($db->query($query[0])){

			$toReturn = true;

			foreach ($cfg->lg as $index=>$lg) {
				if($lg[0]){
					$query[$index] = sprintf("UPDATE %s_8_categories_lang SET title = '%s', text = '%s', `meta-keywords` = '%s', `meta-description` = '%s' WHERE category_id = '%s' AND lang_id = '%s'",
						$cfg->db->prefix,
						$db->real_escape_string($this->title_arr[$index-1]),
						$db->real_escape_string($this->content_arr[$index-1]),
						$db->real_escape_string($this->meta_keywords[$index-1]),
						$db->real_escape_string($this->meta_description[$index-1]),
						$this->id,
						$index
					);

					if ($db->query($query[$index]) && $toReturn) {
						$toReturn = true;
					} else {
						$toReturn = false;
					}
				}
			}
		} else {
			$toReturn = false;
		}
		return $toReturn;
	}

	public function delete() {
		global $cfg, $db;

		$category = new c8_category();
		$category->setId($this->id);
		$category_obj = $category->returnOneCategoryAllLanguages();

		$category_rel = $category->returnCategoryRel();

		if(count($category_rel) > 0 && is_array($category_rel)) {
			foreach ($category_obj as $o => $obj) {
				$obj->category_rel = $category_rel;
			}
		}

		$trash = new trash();
		$trash->setCode(json_encode($category_obj));
		$trash->setDate();
		$trash->setModule($cfg->mdl->folder);
		$trash->setUser($authData["id"]);

		if($trash->insert()) {
			$query = sprintf("DELETE c, cl
				FROM %s_8_categories c
					INNER JOIN %s_8_categories_lang cl on cl.category_id = c.id
				WHERE c.id = %s",
					$cfg->db->prefix,
					$cfg->db->prefix,
					$this->id
			);

			if(count($category_rel) > 0 && is_array($category_rel)) {
				$query_del = sprintf("DELETE FROM %s_8_categories_rel WHERE category_id = %s",
					$cfg->db->prefix, $this->id
				);

				if($db->query($query) && $db->query($query_del)) {
					return ($category->returnOneCategoryAllLanguages() == FALSE) ? TRUE : FALSE;
				}
			}

			if($db->query($query)) {
				return ($category->returnOneCategoryAllLanguages() == FALSE) ? TRUE : FALSE;
			}
		}

		return FALSE;
	}

	public function returnObject() {
		return get_object_vars($this);
	}

	public static function checkRel($id = null) {
		global $cfg, $db;

		if(isset($id)) {
			$query = sprintf("SELECT * FROM %s_8_categories_rel WHERE category_id = '%s'", $cfg->db->prefix, $id);

			$source = $db->query($query);

			return $source->num_rows;
		}

		return FALSE;
	}

	public function returnCategoryRel() {
		global $cfg, $db;

		$query = sprintf("SELECT * FROM %s_8_categories_rel WHERE category_id = %s", $cfg->db->prefix, $this->id);

		$source = $db->query($query);

		$toReturn = [];

		if($source->num_rows > 0) {
			while ($data = $source->fetch_object()) {
				array_push($toReturn, $data);
			}
		}

		return $toReturn;
	}

	// Returns one categorie in one language need category id and lang id. $this->id, $this->lang_id
	public function returnOneCategory() {
		global $cfg, $db;

		$query = sprintf("SELECT bc.*, bcl.title, bcl.text, bcl.`meta-keywords`, bcl.`meta-description`
			FROM %s_8_categories bc
				INNER JOIN %s_8_categories_lang AS bcl on bcl.category_id = bc.id
			WHERE bc.id = %s and bcl.lang_id = %s",
			$cfg->db->prefix, $cfg->db->prefix, $this->id, $this->lang_id
		);

		$source = $db->query($query);

		$toReturn = $source->fetch_object();

		return $toReturn;
	}

	// Returns one categories in all languages need category id. $this->id
	public function returnOneCategoryAllLanguages() {
		global $cfg, $db;

		$query = sprintf("SELECT bc.*, bcl.title, bcl.text, bcl.`meta-keywords`, bcl.`meta-description`, bcl.lang_id
			FROM %s_8_categories bc
				INNER JOIN %s_8_categories_lang AS bcl on bcl.category_id = bc.id
			WHERE bc.id = %s",
			$cfg->db->prefix, $cfg->db->prefix, $this->id
		);

		$source = $db->query($query);

		$toReturn = [];

		while ($data = $source->fetch_object()) {
			// Push to index lang_id, the result of that row
			$toReturn[$data->lang_id] = $data;
		}

		return $toReturn;
	}

	//Returns nr of childs of a category
	public function returnNrChildsCategory(){
		global $cfg, $db;

		$query = sprintf("SELECT COUNT(id) as 'nr_sub_cats'
			FROM %s_8_categories
			WHERE parent_id = '%s'",
			$cfg->db->prefix,
			$this->id
		);

		$source = $db->query($query);

		$nr = $source->num_rows;

		if($nr == 1) {
			return $source->fetch_object();
		} else {
			return false;
		}
	}


	// Returns AllMainCatgories need lang id. $this->lang_id
	public function returnAllMainCategories() {
		global $cfg, $db;

		$query = sprintf("SELECT bc.*, bcl.title, bcl.text, bcl.`meta-keywords`, bcl.`meta-description`, (SELECT COUNT(id) FROM %s_8_categories WHERE parent_id = bc.id) AS 'nr_sub_cats'
			FROM %s_8_categories bc
				INNER JOIN %s_8_categories_lang AS bcl on bcl.category_id = bc.id
			WHERE bc.parent_id = -1 AND bcl.lang_id = %s
			ORDER BY bc.sort ASC, bc.category_section ASC, bcl.title ASC",
			$cfg->db->prefix, $cfg->db->prefix, $cfg->db->prefix, $this->lang_id
		);

		$source = $db->query($query);

		$toReturn = [];
		$i = 0;

		while ($data = $source->fetch_object()) {
			$toReturn[$i] = $data;
			$i++;
		}
		return $toReturn;
	}

	//Returns sub categories need category id and lang id. $this->parent_id, $this->lang_id
	public function returnChildCategories() {
		global $cfg, $db;

		$query = sprintf("SELECT bc.*, bcl.title, bcl.text, bcl.`meta-keywords`, bcl.`meta-description`, (SELECT COUNT(id) FROM %s_8_categories WHERE parent_id = bc.id) AS 'nr_sub_cats'
			FROM %s_8_categories bc
				INNER JOIN %s_8_categories_lang AS bcl on bcl.category_id = bc.id
			WHERE bc.parent_id = %s AND bcl.lang_id = %s
			ORDER BY bc.sort ASC, bc.category_section ASC, bcl.title ASC",
			$cfg->db->prefix, $cfg->db->prefix, $cfg->db->prefix, $this->parent_id, $this->lang_id
		);

		$source = $db->query($query);

		$toReturn = [];
		$i = 0;

		while ($data = $source->fetch_object()) {
			$toReturn[$i] = $data;
			$i++;
		}
		return $toReturn;
	}

	// Returns AllMainCatgories need lang id. $this->lang_id
	public function returnAllCategories() {
		global $cfg, $db;

		$query = sprintf("SELECT bcl.title, bc.id
			FROM %s_8_categories bc
				INNER JOIN %s_8_categories_lang AS bcl on bcl.category_id = bc.id
			WHERE bcl.lang_id = %s
			ORDER BY bc.sort ASC, bc.category_section ASC, bcl.title ASC",
			$cfg->db->prefix, $cfg->db->prefix, $this->lang_id
		);

		$source = $db->query($query);

		$toReturn = [];
		$i = 0;

		while ($data = $source->fetch_object()) {
			$toReturn[$i] = $data;
			$i++;
		}
		return $toReturn;
	}

	// Return AllSections
	public function returnAllSections() {
		global $cfg, $db;

		$query = sprintf("SELECT distinct category_section
			FROM %s_8_categories
			ORDER BY category_section ASC",
			$cfg->db->prefix
		);

		$source = $db->query($query);

		$toReturn = [];
		$i = 0;

		while ($data = $source->fetch_object()) {
			$toReturn[$i] = $data;
			$i++;
		}
		return $toReturn;
	}

}
