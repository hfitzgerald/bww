<?php

App::import('Core', 'Folder');
App::import('Core', 'File');

/**
 * Code Completion
 * 2009-12-26 ms
 */
class CcShell extends Shell {
	var $uses = array();

	private $content = '';

	function main() {
		$this -> out('AutoComplete Dump');

		//TODO: ask for version (1.2 etc - defaults to 1.3!)

		$this -> filename = APP . 'code_completion__.php';

		# get classes
		$this -> models();
		$this -> components();
		$this -> helpers();
		//TODO: behaviors

		# write to file
		$this -> _dump();

		$this -> out('...done');
	}

	/**
 	* @deprecated
 	* now use: Configure::listObjects()
 	*/
	function __getFiles($folder) {
		$handle = new Folder($folder);
		$handleFiles = $handle -> read(true, true);
		$files = $handleFiles[1];
		foreach($files as $key => $file) {
			$file = extractPathInfo('file', $file);

			if(mb_strrpos($file, '_') === mb_strlen($file) - 1) { # ending with _ like test_.php
				unset($files[$key]);
			} else {
				$files[$key] = Inflector::camelize($file);
			}
		}
		return $files;
	}

	public function _getFiles($type) {
		$files = App::objects($type);
		# lib
		$paths = (array)App::path($type . 's');
		$libFiles = App::objects($type, $paths[0] . 'lib' . DS, false);

		$plugins = App::objects('plugin');
		if(!empty($plugins)) {
			foreach($plugins as $plugin) {
				$pluginFiles = App::objects($type, App::pluginPath($plugin) . $type . 's' . DS, false);
				if(!empty($pluginFiles)) {
					foreach($pluginFiles as $t) {
						$files[] = $t;
						//"$plugin.$type";
					}
				}
			}
		}
		$files = array_merge($files, $libFiles);
		$files = array_unique($files);

		$appIndex = array_search('App', $files);
		if($appIndex !== false) {
			unset($files[$appIndex]);
		}

		# no test/tmp files etc (helper.test.php or helper.OLD.php)
		foreach($files as $key => $file) {
			if(strpos($file, '.') !== false || !preg_match('/^[\da-zA-Z_]+$/', $file)) {
				unset($files[$key]);
			}
		}
		return $files;
	}

	function models() {
		//$files = App::objects('component', null, false);
		$files = $this -> _getFiles('model');
		//$files = $this->_getFiles(COMPONENTS);

		$content = "\n" . '<?php' . "\n";
		$content .= '/*** model start ***/' . "\n";
		$content .= 'class AppModel extends Model {' . "\n";
		if(!empty($files)) {
			$content .= $this -> _prepModels($files);
		}
		$content .= '}' . "\n";
		$content .= '/*** model end ***/' . "\n";
		$content .= '?>';

		$this -> content .= $content;
	}

	function components() {
		$files = $this -> _getFiles('component');

		$content = "\n" . '<?php' . "\n";
		$content .= '/*** component start ***/' . "\n";
		$content .= 'class AppController extends Controller {' . "\n";
		if(!empty($files)) {
			$content .= $this -> _prepComponents($files);
		}
		$content .= '}' . "\n";
		$content .= '/*** component end ***/' . "\n";
		$content .= '?>';

		$this -> content .= $content;
	}

	function helpers() {
		$files = $this -> _getFiles('helper');

		$content = "\n" . '<?php' . "\n";
		$content .= '/*** helper start ***/' . "\n";
		$content .= 'class AppHelper extends Helper {' . "\n";
		if(!empty($files)) {
			$content .= $this -> _prepHelpers($files);
		}
		$content .= '}' . "\n";
		$content .= '/*** helper end ***/' . "\n";
		$content .= '?>';

		$this -> content .= $content;
	}

	function _prepModels($files) {
		$res = '';
		foreach($files as $name) {
			$res .= '
			/**
			* ' . $name . '
			*/
			public $' . $name . ';
			' . "\n";
		}

		$res .= '	function __construct() {';

		foreach($files as $name) {
			$res .= '
			$this->' . $name . ' = new ' . $name . '();';
		}

		$res .= '}' . "\n";
		return $res;
	}

	function _prepComponents($files) {
		$res = '';
		foreach($files as $name) {
			$res .= '
			/**
			* ' . $name . 'Component
			*/
			public $' . $name . ';
			' . "\n";
		}

		$res .= '	function __construct() {';

		foreach($files as $name) {
			$res .= '
			$this->' . $name . ' = new ' . $name . 'Component();';
		}

		$res .= '}' . "\n";
		return $res;
	}

	function _prepHelpers($files) {
		# new ones
		$res = '';

		foreach($files as $name) {
			$res .= '
			/**
			* ' . $name . 'Helper
			*/
			public $' . $name . ';
			' . "\n";
		}

		$res .= '	function __construct() {';

		foreach($files as $name) {
			$res .= '
			$this->' . $name . ' = new ' . $name . 'Helper();';
		}

		# old ones
		$res .= '' . "\n";
		/*
 		foreach ($files as $name) {
 		$res .= '
 		$'.lcfirst($name).' = new '.$name.'Helper();
 		';
 		}
 		$res .= "\n";
 		*/

		$res .= '	}' . "\n";

		return $res;
	}

	function _dump() {
		$file = new File($this -> filename, true);

		$content = '<?php exit();' . "\n";
		$content .= '//Add in some helpers so the code assist works much better' . "\n";
		$content .= '//Printed: ' . date('d.m.Y, H:i:s') . "\n";
		$content .= '?>' . "\n";
		$content .= $this -> content;
		return $file -> write($content);
	}

}

?>