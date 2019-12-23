<?php

/**
* trash Class
* Class used to deal with information that is about to be deleted
* All is saved in json on the trash DB table
*
* @author 	Carlos Santos
* @version 1.0
* @since 2016-10
* @license The MIT License (MIT)
*/

class trash {
	protected $id; /** @var int **/
	protected $code; /** @var string **/
	protected $module; /** @var string **/
	protected $user; /** @var int **/
	protected $date; /** @var DateTime **/

	/** === Class Constructor === **/
	public function __construct($code = null, $date = null, $module = null, $user = null) {
		$this->code = $code; /** @param string **/
		$this->date = ($date !== null) ? $date : date("Y-m-d H:i:s", time()); /** @param DateTime **/
		$this->module = $module; /** @param string **/
		$this->user = $user; /** @param int **/
	}

	/** === CRUD Functions === */

	/** [Insert information in DB] @return boolean */
	public function insert() {
		global $cfg, $db;

		if(
			$db->query(sprintf(
				"INSERT INTO %s_trash (module, code, user_id, date) VALUES ('%s', '%s', '%s', '%s')",
				$cfg->db->prefix,
				$db->real_escape_string($this->module),
				$db->real_escape_string($this->code),
				$this->user,
				$this->date
			))
		) {
			return TRUE;
		}

		return FALSE;
	}
}
