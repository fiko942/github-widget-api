<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function __construct() {
		header('Content-Type: text/javascript');
	}
	
	private function get($name = '') {
		return $this->request->getVar($name);
	}
	
	private function getjquery() {
		return file_get_contents('jquery.js');
	}
	
	private function minifyJavascript(string $js = '') {
		$js = str_replace("\t", " ", $js);
		$js = preg_replace('/\n(\s+)?\/\/[^\n]*/', "", $js);	
		$js = preg_replace("!/\*[^*]*\*+([^/][^*]*\*+)*/!", "", $js);
		$js = preg_replace("/\/\*[^\/]*\*\//", "", $js);
		$js = preg_replace("/\/\*\*((\r\n|\n) \*[^\n]*)+(\r\n|\n) \*\//", "", $js);		
		$js = str_replace("\r", "", $js);
		$js = preg_replace("/\s+\n/", "\n", $js);	
		$js = preg_replace("/\n\s+/", "\n ", $js);
		$js = preg_replace("/ +/", " ", $js);
		$js = str_replace("\r", '', $js);
		$js = str_replace("\n", '', $js);
		$js = str_replace("\r\n", '', $js);
		return $js;
	}

	private function randomString($length = 1) {
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$c = '';
		for($i = 0; $i < $length; $i++) {
			$c .= $chars[random_int(0, strlen($chars) - 1)];
		}
		return $c;
	}

	public function view() {
		header('Content-Type: text/html');
		$icon = base_url('favicon.ico');
		$data = [
			'appname' => 'Github Widget',
			'icon' => "{$icon}",
			'random_string' => $this->randomString(5)
		];
		return view('land.php', $data);
	}

	public function index() {
		$js = file_get_contents('assets/js/main.min.js');
		$jquery = $this->getjquery();

		$js = str_replace('get-a', $this->get('p'), $js);
		$js = str_replace('get-b', $this->get('u'), $js);
		$js = str_replace('get-c', $this->get('cd'), $js);
		$js = str_replace('get-d', $this->get('d'), $js);
		$js = str_replace('get-e', $this->get('pw'), $js);

		echo str_replace("\r\n", '', $jquery.$js);	
	}
}