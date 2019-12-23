<?php

class c1_emailqueue {
	// settings
	protected $name;
	protected $value;

	// emails
	protected $id;
	protected $to;
	protected $cc = "";
	protected $bcc = "";
	protected $subject;
	protected $content;
	protected $attachments = [];
	protected $priority = 0;
	protected $failure = 0;
	protected $status = false;
	protected $date;

	public function __construct() {}

	public function setId($i) {
		$this->id = (int)$i;
	}

	public function setTo($t) {
		$this->to = $t;
	}

	public function setCc($c) {
		$this->cc = $c;
	}

	public function setBcc($b) {
		$this->bcc = $c;
	}

	public function setSubject($s) {
		$this->subject = $s;
	}

	public function setContent($d) {
		$this->content = $d;
	}

	public function setAttachments($a = []) {
		if (is_array($a) && count($a) > 0) {
			$this->attachments = json_encode($a);
			return true;
		}

		return false;
	}

	public function setPriority($p) {
		$this->priority = (int)$p;
	}

	public function setStatus($s) {
		$this->status = (bool)$s;
	}

	public function setSetting ($n, $v) {
		$this->name = $n;
		$this->value = $v;
	}

	// CRUD
	public function insert() {
		global $cfg, $db;

		$query = sprintf(
			"INSERT INTO %s_1_email_queue (`to`, `cc`, `bcc`, `subject`, `attachments`, `priority`, `status`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s')",
			$cfg->db->prefix,
			$db->real_escape_string($this->to),
			$db->real_escape_string($this->cc),
			$db->real_escape_string($this->bcc),
			$db->real_escape_string($this->subject),
			$db->real_escape_string($this->attachments),
			$this->priority,
			$this->status
		);

		if ($db->query($query)) {
			$this->id = $db->insert_id;
			return true;
		}

		return false;
	}

	public function update() {
		global $cfg, $db;

		$query = sprintf();
	}

	public function delete() {
		global $cfg, $db, $authData;

		$email = new c1_emailqueue();
		$email->setId($this->id);
		$email_obj = $email->returnOneEntry();

		$trash = new trash();
		$trash->setCode(json_encode($email_obj));
		$trash->setDate();
		$trash->setModule($cfg->mdl->folder);
		$trash->setUser($authData["id"]);
		$trash->insert();

		$query = sprintf(
			"DELETE FROM %s_1_email_queue WHERE id = %s",
			$cfg->db->prefix,
			$cfg->db->prefix,
			$this->id
		);

		$db->query($query);

		return ($email->returnOneEntry() == FALSE) ? TRUE : FALSE;
	}

	public function returnObject() {
		return get_object_vars($this);
	}

	public function returnOneEntry() {
		global $cfg, $db;

		$query = sprintf(
			"SELECT * FROM %s_1_email_queue WHERE id = %s LIMIT 1",
			$cfg->db->prefix,
			$this->id
		);
		$source = $db->query($query);

		if ($source->num_rows > 0) {
			return $source->fetch_object();
		}

		return false;
	}

	public function returnAllEntries() {
		global $cfg, $db;

		$query = sprintf(
			"SELECT * FROM %s_1_email_queue WHERE true",
			$cfg->db->prefix
		);
		$source = $db->query($query);

		if ($source->num_rows > 0) {
			while ($data = $source->fetch_object()) {
				if (!isset($toReturn)) {
					$toReturn = [];
				}

				array_push($toReturn, $data);
			}

			if (count($toReturn) > 0) {
				return $toReturn;
			}
		}
		return false;
	}

	public function addFailure () {
		global $cfg, $db;

		$query = sprintf(
			"UPDATE %s_1_email_queue SET failure = failure + 1 WHERE id = '%s'",
			$cfg->db->prefix,
			$this->id
		);

		return $db->query($query);
	}

	// SETTINGS
	public function insertSetting () {
		global $cfg, $db;

		$query = sprintf("INSERT INTO %s_1_email_queue_settings (`name`, `value`) VALUES ('%s', '%s')",
			$cfg->db->prefix,
			$db->real_escape_string($this->name),
			$db->real_escape_string($this->value)
		);

		if ($db->query($query)){
			return true;
		}
		return false;
	}

	public function updateSetting() {
		global $cfg, $db;

		$query = sprintf(
			"UPDATE %s_1_email_queue_settings SET  name = '%s', value = '%s' WHERE id = %s",
			$cfg->db->prefix,
			$db->real_escape_string($this->name),
			$db->real_escape_string($this->value),
			$this->id
		);
		return $db->query($query);
	}

	public function deleteSetting () {
		global $cfg, $db, $authData;

		$gp = new c1_emailqueue();
		$gp->setId($this->id);
		$gp = $gp->returnOneSetting();

		$trash = new trash();
		$trash->setCode(json_encode($gp));
		$trash->setDate();
		$trash->setModule($cfg->mdl->folder);
		$trash->setUser($authData["id"]);
		$trash->insert();

		unset($gp);

		$query = sprintf("DELETE FROM %s_1_email_queue_settings WHERE id = %s", $cfg->db->prefix, $this->id);

		return $db->query($query);
	}

	public static function getSettings () {
		global $cfg, $db;

		$query = sprintf("SELECT * FROM %s_1_email_queue_settings WHERE true",
			$cfg->db->prefix
		);
		$source = $db->query($query);

		while ($data = $source->fetch_object()) {
			if (!isset($list)) {
				$list = [];
			}

			array_push($list, $data);
		}

		foreach ($list as $index => $value) {
			if (!isset($toReturn)) {
				$toReturn = [];
			}

			$toReturn[$value->name] = $value->value;
		}

		return isset($toReturn) ? $toReturn : false;
	}

	public static function returnAllSettings () {
		global $cfg, $db;

		$query = sprintf("SELECT * FROM %s_1_email_queue_settings WHERE true", $cfg->db->prefix);
		$source = $db->query($query);

		while ($data = $source->fetch_object()) {
			if (!isset($toReturn)) {
				$toReturn = [];
			}

			array_push($toReturn, $data);
		}

		return (isset($toReturn)) ? $toReturn : false;
	}

	public function returnOneSetting () {
		global $cfg, $db;

		$toReturn = [];

		$query = sprintf(
			"SELECT * FROM %s_1_email_queue_settings WHERE id = %s LIMIT %s",
			$cfg->db->prefix, $this->id, 1
		);
		$source = $db->query($query);

		if ($source->num_rows > 0) {
			return $source->fetch_object();
		}

		return false;
	}

	public function returnSettingByName () {
		global $cfg, $db;

		$query = sprintf(
			"SELECT * FROM %s_1_email_queue_settings WHERE name = '%s' LIMIT %s",
			$cfg->db->prefix, $this->name, 1
		);
		$source = $db->query($query);

		if ($source->num_rows > 0) {
			return $source->fetch_object();
		}

		return false;
	}
}
