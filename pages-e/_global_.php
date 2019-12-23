<?php

class _global_ {

	public static $helloWorldString = "Hello World!";

	public function __construct() {}

	public static function start () {
		print self::$helloWorldString;
	}

	// WE USE THIS OBJECT FOR API, BUT U CAN USE IT FOR OTHER COM THINGS, IS UP TO U
	public static function generateReturn () {
		return [
			'status' => false,
			'message' => '',
			'object' => []
		];
	}

	public static function validateDate($date, $format = 'Y-m-d H:i:s') {
		$d = DateTime::createFromFormat($format, $date);
		// The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
		return $d && $d->format($format) === $date;
	}

	public static function createFolder($path = false) {
		if ($path != false) {
			if (substr($path, -1) == "/") {
				$path = substr($path, 0, -1);
			}

			$path = explode("/", $path);
		}

		$check_path = "";

		foreach ($path as $key => $folder) {
			$check_path .= "{$folder}/";

			if (!is_dir($check_path)) {
				if (!mkdir($check_path, 755)) {
					return false;
				}

				touch($check_path."index.html");
			}
		}

		return true;
	}
}
