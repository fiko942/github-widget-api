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
		//return file_get_contents(APP_PATH .);
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
		$jquery = $this->getjquery();
		$js = "
		
		
		
		
		
		
		
window.onload = () => {
	let pos = '".$this->get('p')."';
	const body = document.querySelector('body');
	const head = document.querySelector('head');
	const username = '".$this->get('u')."';
	let hrefOnClick = undefined;
	const customHrefOnClick = false;
	const posAccepcted = ['top-left', 'top-right', 'bottom-left', 'bottom-right'];
	const posDefault = posAccepcted[1];
	const customDescription = '".$this->get('cd')."';
	const description = '".$this->get('d')."';
	let divContainer = undefined;
	const personalWebsite = '".$this->get('pw')."';
	const defaultPersonalWebsite = 'https://github-widget.tobelsoft.my.id';
	
	let profile;
	let bio;
	
	function validURL(string) {
		var regex = /(?:https?):\/\/(\w+:?\w*)?(\S+)(:\d+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
		return regex.test(string);
	}
	
	
	if(customDescription === 'true')
	{
		console.log('Custom description has been enabled successfully');
	} else {
		console.log('Custom description is not enabled, description has will be set from your bio on github');
	}
	
	let posTrue = 0;
	for(let i = 0; i < posAccepcted.length; i++){
		if(pos === posAccepcted[i]) { 
			posTrue++;
		}
	}
	
	if(posTrue === 0) {
		pos = posDefault;
		console.log('Position is not valid, position has been changed automatically to: ' + pos);
	}
	
	const getUser = async (uname, callback) => {
		$.ajax({
			type: 'GET',
			url: 'https://api.github.com/users/' + username,
			processData: false,
			cache: false,
			success: (response) => {
				profile = response;
				callback(profile);
			},
			error: () => {
				console.log('Github username '+uname+' is not found');
				profile = undefined;
				return undefined;
			}
		});
	};

	
	const el = (q) => {
		return document.querySelector(q);
	};

	const elAll = (q) => {
		return document.querySelectorAll(q);
	};
	
	const appendAttribute = (element, attname, att) => {
		let attValBefore;
		if(!element.hasAttribute(attname)) {
			element.setAttribute(attname, '');
		}
		if(element.hasAttribute(attname)) {
			attValBefore = element.getAttribute(attname);
			attVal = attValBefore + ' ' + att;
			element.setAttribute(attname, attVal.trim());
			return true;
		} else {
			return false;
		}
	};
	
	const removeAttributeValue = (element, attname, delVal) => {
		if(element != undefined && element.hasAttribute(attname)) {
			let val = element.getAttribute(attname).replace(delVal.trim(), '');
			element.setAttribute(attname, val);
			delete val;
			return true;
		} else {
			return false;
		}
	};
	
	const divContainerStyle = `
		padding: 5px 13px;
		background: #fff;
		position: absolute;
		z-index: 99999999;
		overflow: hidden;
		transition: 0.2s ease-in-out all !important;
		border-radius: 15px;
		box-shadow: 1px 1px 2px #000;
		border: none;
		width: fit-content;
		height: fit-content;
		max-width: 100vh;
		display: flex;
		align-items: center;
	`;
	
	const imgAvatarStyle = `
		width: 50px;
		height: 50px;
		border-radius: 150px;
		background: #16ACAE;
		border: .5px solid #000;
		box-shadow: .5px  .5px 3px #000;
		transition: 0.2s ease-in-out all;
	`;
	
	const rightSideStyle = `
		font-family: 'Segoe UI';
		margin-right: 10px;
	`;
	
	const link = document.createElement('link');
	link.setAttribute('rel', 'stylesheet');
	link.setAttribute('href', 'https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css');
	head.appendChild(link);

	getUser(username, function(user) {
		divContainer = document.createElement('div');
		const closeBtn = document.createElement('button');
		const githubLogo = document.createElement('div');
		
		
		closeBtn.innerHTML = `<i class='bx bx-x' style='width: fit-content; height: fit-content; margin-left: -3px;'></i>`;
		closeBtn.setAttribute('style', `border-radius: 50%; cursor: pointer; z-index: 99999999; color: #fff; outline: none !important; border: none !important; width: 25px; height: 25px; background: #000; font-size: 20px; display: flex; align-items: center; text-align: center;`);
		closeBtn.setAttribute('title', 'Close Tobelsoft Widget');
		
		githubLogo.innerHTML = `<i class='bx bxl-github' ></i>`;
		githubLogo.setAttribute('style', 'position: absolute; z-index: 99999; overflow: hidden;');
		
		divContainer.appendChild(githubLogo);
		divContainer.appendChild(closeBtn);
		
		const right = document.createElement('div');
		
		appendAttribute(right, 'style', rightSideStyle);
		
		
		const name = document.createElement('div');
		name.setAttribute('style', `font-weight: 700; letter-spacing: .9px; font-family: 'Segoe UI'; cursor: pointer; width: fit-content; height: fit-content;`);
		name.innerText = user['name'];
		right.appendChild(name);
		
		if(user['bio'] != null || user['bio'].trim().length > 0)
		{
			bio = document.createElement('div');
			bio.innerText = (customDescription === 'true' && description.length > 0) ? description.trim() : user['bio']; 
			bio.setAttribute('style', `font-family: 'Segoe UI'; font-weight: 400; font-size: 13px; cursor: pointer;`);
			right.appendChild(bio);
		}
		
		const img = document.createElement('img');
		img.setAttribute('src', user['avatar_url']);
		img.setAttribute('draggable', 'false');
		img.setAttribute('alt', user['name']);
		img.setAttribute('title', user['name']);
		
		appendAttribute(img, 'style', imgAvatarStyle);
		
		divContainer.appendChild(right);
		divContainer.appendChild(img);
		
		appendAttribute(divContainer, 'style', divContainerStyle);
		
		
		const avatarOnAnyEventStyle = `
			box-shadow: none;
			transform: rotate(5deg);
			border: .5px solid #fff;
		`;
		
		img.addEventListener('mouseover', () => {
			appendAttribute(img, 'style', avatarOnAnyEventStyle);
		});
		
		img.addEventListener('mouseout', () => {
			removeAttributeValue(img, 'style', avatarOnAnyEventStyle);
		});
		
		appendAttribute(githubLogo, 'style', 'transition: .4s ease-in-out all;');

		githubLogo.addEventListener('click', (e) => {
			e.preventDefault();
			appendAttribute(githubLogo, 'style', 'transform: rotate(360deg);');
			setTimeout(function f(){
				window.open(user['html_url'], '_blank');
				removeAttributeValue(githubLogo, 'style', 'transform: rotate(360deg);');
				clearTimeout(f);
			}, 400);
		});
		
		
		
		body.appendChild(divContainer);
		
		if(personalWebsite != undefined && personalWebsite.length > 0)
		{
			console.log('Setting up your personal website');
			if(validURL(personalWebsite)) {
				bio.addEventListener('click', (e) => {
					e.preventDefault();
					window.open(personalWebsite, '_blank');
				});
				name.addEventListener('click', (e) => {
					e.preventDefault();
					window.open(personalWebsite, '_blank');
				});
				console.log('Your personal website has been applied successfully');
			} else {
				console.log('Your personal website is not valid url');
				console.log('You is not setting up the personal website');
				bio.addEventListener('click', (e) => {
					e.preventDefault();
					window.open(defaultPersonalWebsite, '_blank');
				});
				name.addEventListener('click', (e) => {
					e.preventDefault();
					window.open(defaultPersonalWebsite, '_blank');
				});
				console.log('If you click the description or name, will be open the default website: ' + defaultPersonalWebsite);
			}
		} else {
			console.log('You is not setting up the personal website');
			bio.addEventListener('click', (e) => {
				e.preventDefault();
				window.open(defaultPersonalWebsite, '_blank');
			});
			name.addEventListener('click', (e) => {
				e.preventDefault();
				window.open(defaultPersonalWebsite, '_blank');
			});
			console.log('If you click the description or name, will be open the default website: ' + defaultPersonalWebsite);
		}
		
		const containerWidth = divContainer.offsetWidth;
		const containerHeight = divContainer.offsetHeight;
		
		if(pos === 'top-right')
		{
			appendAttribute(divContainer, 'style', 'top: 10px; right: 10px; margin-left: 20px;');
			appendAttribute(githubLogo, 'style', 'top: 50px; right: 20px; font-size: 20px; position: fixed; border-radius: 50%; overflow: hidden; background: #fff; cursor: pointer; top: ' + (containerHeight - 15).toString() + 'px;');
			appendAttribute(closeBtn, 'style', 'position: fixed; top: 5px; margin-left: -25px;');
			
			closeBtn.addEventListener('click', (e) => {
				closeBtn.innerHTML = `<i class='bx bx-loader-circle' style='width: fit-content; height: fit-content; margin-left: -3.5px; margin-top: -0.2px'></i>`;
				appendAttribute(closeBtn, 'style', 'transition: 4s ease-in-out all; transform: rotate(5000deg);');
				appendAttribute(divContainer, 'style', 'right: 100px');
				githubLogo.remove();
				setTimeout(function (f) {
					appendAttribute(divContainer, 'style', 'position: absolute; right: -5000px;');
					setTimeout(function g() {
						divContainer.remove();
						clearTimeout(f);
						clearTimeout(g);
					}, 200);
				}, 400);
			});
		} else if(pos === 'top-left')
		{
			appendAttribute(divContainer, 'style', 'top: 10px; left: 10px; margin-right: 20px;');
			appendAttribute(githubLogo, 'style', 'top: 5px; left: 5px; font-size: 20px; position: fixed; border-radius: 50%; overflow: hidden; background: #fff; cursor: pointer; left: ' + (containerWidth - 40).toString() + 'px; z-index: 9999999999999999999; top: ' + (containerHeight - 15).toString() + 'px;');
			appendAttribute(closeBtn, 'style', 'position: fixed; top: 5px; left: ' + (containerWidth - 25).toString() + 'px;');
			
			closeBtn.addEventListener('click', (e) => {
				e.preventDefault();
				closeBtn.innerHTML = `<i class='bx bx-loader-circle' style='width: fit-content; height: fit-content; margin-left: -3.5px; margin-top: -0.2px'></i>`;
				appendAttribute(closeBtn, 'style', 'transition: 4s ease-in-out all; transform: rotate(5000deg);');
				appendAttribute(divContainer, 'style', 'left: 100px');
				githubLogo.remove();
				setTimeout(function (f) {
					appendAttribute(divContainer, 'style', 'position: absolute; left: -5000px;');
					setTimeout(function g() {
						divContainer.remove();
						clearTimeout(f);
						clearTimeout(g);
					}, 200);
				}, 400);
			});
			
		} else if(pos === 'bottom-right')
		{
			appendAttribute(divContainer, 'style', 'bottom: 10px; right: 10px; margin-left: 20px;');
			appendAttribute(githubLogo, 'style', 'font-size: 20px; position: fixed; border-radius: 50%; overflow: hidden; background: #fff; cursor: pointer; z-index: 9999999999999; bottom: 15px; right: 15px;');
			appendAttribute(closeBtn, 'style', 'position: fixed; bottom: ' + (containerHeight - 5).toString() + 'px; right: ' + (containerWidth - 25).toString() + 'px;');
			
			closeBtn.addEventListener('click', (e) => {
				closeBtn.innerHTML = `<i class='bx bx-loader-circle' style='width: fit-content; height: fit-content; margin-left: -3.5px; margin-top: -0.2px'></i>`;
				appendAttribute(closeBtn, 'style', 'transition: 4s ease-in-out all; transform: rotate(5000deg);');
				appendAttribute(divContainer, 'style', 'right: 100px');
				githubLogo.remove();
				setTimeout(function (f) {
					appendAttribute(divContainer, 'style', 'position: absolute; right: -5000px;');
					setTimeout(function g() {
						divContainer.remove();
						clearTimeout(f);
						clearTimeout(g);
					}, 200);
				}, 400);
			});
		} else if(pos === 'bottom-left')
		{
			appendAttribute(divContainer, 'style', 'bottom: 10px; left: 10px; margin-right: 20px;');
			appendAttribute(githubLogo, 'style', 'font-size: 20px; position: fixed; border-radius: 50%; overflow: hidden; background: #fff; cursor: pointer; z-index: 99999999999999; left: ' + (containerWidth - 40).toString() + 'px; bottom: ' + (containerHeight - 45).toString() + 'px;');
			appendAttribute(closeBtn, 'style', 'position: fixed; cursor: pointer; z-index: 999999999999999999999; bottom: ' + (containerHeight - 5).toString() + 'px; left: ' + (containerWidth - 30).toString() + 'px;');
			
				closeBtn.addEventListener('click', (e) => {
				e.preventDefault();
				closeBtn.innerHTML = `<i class='bx bx-loader-circle' style='width: fit-content; height: fit-content; margin-left: -3.5px; margin-top: -0.2px'></i>`;
				appendAttribute(closeBtn, 'style', 'transition: 4s ease-in-out all; transform: rotate(5000deg);');
				appendAttribute(divContainer, 'style', 'left: 100px');
				githubLogo.remove();
				setTimeout(function (f) {
					appendAttribute(divContainer, 'style', 'position: absolute; left: -5000px;');
					setTimeout(function g() {
						divContainer.remove();
						clearTimeout(f);
						clearTimeout(g);
					}, 200);
				}, 400);
			});
		}
	});
}
			
			
			
			
			
			
			

		";
		echo $this->minifyJavascript($jquery);
		echo $this->minifyJavascript($js);
		//echo $js;
		
	}
}
