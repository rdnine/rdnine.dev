<?php

class c0_basic_crm {
	protected $id;
	protected $date;
	protected $date_update;

	public function __construct() {

	}

	public function setId($i) {
		$this->id = (int)$i;
	}

	public function setDate($d = null) {
		$this->date = ($d !== null) ? $d : date("Y-m-d H:i:s", time());
	}

	public function setDateUpdate($d = null) {
		$this->date_update = ($d !== null) ? $d : date("Y-m-d H:i:s", time());
	}

	public function insert() {
		global $cfg, $db;
	}

	public function update() {
		global $cfg, $db;
	}

	public function delete() {
		global $cfg, $db;
	}

	public function returnObject() {
		return get_object_vars($this);
	}

	public static function getDisctrictById ($id) {
		global $cfg, $db;

		$query = sprintf(
			"SELECT * FROM %s_0_districts WHERE id = %s",
			$cfg->db->prefix, $id
		);

		$source = $db->query($query);

		if ($source->num_rows > 0) {
			return $source->fetch_objec();
		}

		return false;
	}
}
