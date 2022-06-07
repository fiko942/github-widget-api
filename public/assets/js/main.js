window.onload = () => {
	let pos = 'get-a';
	const body = document.querySelector('body');
	const head = document.querySelector('head');
	const username = 'get-b';
	let hrefOnClick = undefined;
	const customHrefOnClick = false;
	const posAccepcted = ['top-left', 'top-right', 'bottom-left', 'bottom-right'];
	const posDefault = posAccepcted[1];
	const customDescription = 'get-c';
	const description = 'get-d';
	let divContainer = undefined;
	const personalWebsite = 'get-e';
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
			return true;
		} else {
			return false;
		}
	};
	
	const divContainerStyle = `
		padding: 5px 13px !important;
		background: #fff !important;
		position: absolute !important;
		z-index: 99999999 !important;
		overflow: hidden !important;
		transition: 0.2s ease-in-out all !important;
		border-radius: 15px !important;
		box-shadow: 1px 1px 2px #000 !important;
		border: none !important;
		width: fit-content !important;
		height: fit-content !important;
		max-width: 100vh !important;
		display: flex !important;
		align-items: center !important;
		color: #000 !important;
		position: fixed !important;
	`;
	
	const imgAvatarStyle = `
		width: 50px !important;
		height: 50px !important;
		border-radius: 150px !important; 
		background: #16ACAE !important;
		border: .5px solid #000 !important;
		box-shadow: .5px  .5px 3px #000 !important;
		transition: 0.2s ease-in-out all !important;
	`;
	
	const rightSideStyle = `
		font-family: 'Segoe UI' !important;
		margin-right: 10px !important;
		color: #000 !important;
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
		closeBtn.setAttribute('style', `border-radius: 50% !important; cursor: pointer !important; z-index: 99999999 !important; color: #fff !important; outline: none !important; border: none !important; width: 25px !important; height: 25px !important;  background: #000 !important; font-size:  20px !important; display: flex !important; align-items: center !important; text-align: center !important;`);
		closeBtn.setAttribute('title', 'Close Tobelsoft Widget');
		
		githubLogo.innerHTML = `<i class='bx bxl-github'></i>`;
		githubLogo.setAttribute('style', 'position: absolute !important; z-index: 9999999999999999999 !important; overflow: hidden !important; color: #000 !important; padding: 0 !important; border-radius: 50% !important !important; color: #000 !important background: #000 !important; position: fixed !important; height: 25px !important; height: 25px !important; color: #000 !important; background: transparent !important;');
		
		divContainer.appendChild(githubLogo);
		divContainer.appendChild(closeBtn);
		
		const right = document.createElement('div');
		
		appendAttribute(right, 'style', rightSideStyle);
		
		const name = document.createElement('div');
		name.setAttribute('style', `font-weight: 700 !important; letter-spacing: .9px !important; font-family: 'Segoe UI' !important; cursor: pointer !important; width: fit-content !important; height: fit-content !important; color: #000 !important;`);
		name.innerText = user['name'];
		right.appendChild(name);
		
		if(user['bio'] != null || user['bio'].trim().length > 0)
		{
			bio = document.createElement('div');
			bio.innerText = (customDescription === 'true' && description.length > 0) ? description.trim() : user['bio']; 
			bio.setAttribute('style', `font-family: 'Segoe UI' !important; font-weight: 400 !important; font-size: 13px !important; cursor: pointer !important; color: #000 !important;`);
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
			box-shadow: none !important;
			transform: rotate(5deg) !important;
			border: .5px solid #fff !important;
		`;
		
		img.addEventListener('mouseover', () => {
			appendAttribute(img, 'style', avatarOnAnyEventStyle);
		});
		
		img.addEventListener('mouseout', () => {
			removeAttributeValue(img, 'style', avatarOnAnyEventStyle);
		});
		
		appendAttribute(githubLogo, 'style', 'transition: .4s ease-in-out all !important;');

		githubLogo.addEventListener('click', (e) => {
			e.preventDefault();
			appendAttribute(githubLogo, 'style', 'transform: rotate(360deg) !important;');
			setTimeout(function f(){
				window.open(user['html_url'], '_blank');
				removeAttributeValue(githubLogo, 'style', 'transform: rotate(360deg) !important;');
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
		appendAttribute(githubLogo, 'style', 'width: 25px !important; height: 25px !important; background: #fff !important; border-radius: 50% !important;');
		appendAttribute(githubLogo, 'class', 'gh-logo');
		document.querySelector('.gh-logo i').setAttribute('style', 'color: #000 !important; width: 25px !important; height: 25px !important; font-size: 27px; top: 0 !important; position: relative !important; display: flex !important; margin-left: -2px !important; padding: 0 !important; top: -1px !important; border-radius: 50% !important; padding-bottom: -2px !important;');
		
		if(pos === 'top-right')
		{
			appendAttribute(divContainer, 'style', 'top: 10px !important; right: 10px !important; margin-left: 20px !important;');
			appendAttribute(githubLogo, 'style', 'top: 50px !important; right: 20px !important; font-size: 20px !important; position: fixed !important; border-radius: 50% !important; overflow: hidden !important; background: #fff !important; cursor: pointer !important; top: ' + (containerHeight - 15).toString() + 'px !important;');
			appendAttribute(closeBtn, 'style', 'position: fixed !important; top: 5px !important; margin-left: -25px !important;');
			
			closeBtn.addEventListener('click', (e) => {
				closeBtn.innerHTML = `<i class='bx bx-loader-circle' style='width: fit-content !important; height: fit-content !important; margin-left: -3.5px !important; margin-top: -0.2px !important;'></i>`;
				appendAttribute(closeBtn, 'style', 'transition: 4s ease-in-out all !important; transform: rotate(5000deg) !important;');
				appendAttribute(divContainer, 'style', 'right: 100px !important;');
				githubLogo.remove();
				setTimeout(function (f) {
					appendAttribute(divContainer, 'style', 'position: absolute !important; right: -5000px !important;');
					setTimeout(function g() {
						divContainer.remove();
						clearTimeout(f);
						clearTimeout(g);
					}, 200);
				}, 400);
			});
		} else if(pos === 'top-left')
		{
			appendAttribute(divContainer, 'style', 'top: 10px !important; left: 10px !important; margin-right: 20px !important;');
			appendAttribute(githubLogo, 'style', 'top: 5px !important; left: 5px !important; font-size: 20px !important; position: fixed !important; border-radius: 50% !important; overflow: hidden !important; background: #fff !important; cursor: pointer !important; left: ' + (containerWidth - 47).toString() + 'px !important; z-index: 9999999999999999999 !important; top: ' + (containerHeight - 17).toString() + 'px !important;');
			appendAttribute(closeBtn, 'style', 'position: fixed !important; top: 5px !important; left: ' + (containerWidth - 25).toString() + 'px !important;');
			
			closeBtn.addEventListener('click', (e) => {
				e.preventDefault();
				closeBtn.innerHTML = `<i class='bx bx-loader-circle' style='width: fit-content !important; height: fit-content !important; margin-left: -3.5px !important; margin-top: -0.2px !important'></i>`;
				appendAttribute(closeBtn, 'style', 'transition: 4s ease-in-out all !important; transform: rotate(5000deg) !important;');
				appendAttribute(divContainer, 'style', 'left: 100px !important;');
				githubLogo.remove();
				setTimeout(function (f) {
					appendAttribute(divContainer, 'style', 'position: absolute !important; left: -5000px !important;');
					setTimeout(function g() {
						divContainer.remove();
						clearTimeout(f);
						clearTimeout(g);
					}, 200);
				}, 400);
			});
			
		} else if(pos === 'bottom-right')
		{
			appendAttribute(divContainer, 'style', 'bottom: 10px !important; right: 10px !important; margin-left: 20px !important;');
			appendAttribute(githubLogo, 'style', 'font-size: 20px !important; position: fixed !important; border-radius: 50% !important; overflow: hidden !important; background: #fff !important; cursor: pointer !important; z-index: 9999999999999 !important; bottom: 15px !important; right: 15px !important;');
			appendAttribute(closeBtn, 'style', 'position: fixed !important; bottom: ' + (containerHeight - 5).toString() + 'px !important; right: ' + (containerWidth - 25).toString() + 'px !important;');
			
			closeBtn.addEventListener('click', (e) => {
				closeBtn.innerHTML = `<i class='bx bx-loader-circle' style='width: fit-content !important; height: fit-content !important; margin-left: -3.5px !important; margin-top: -0.2px !important;'></i>`;
				appendAttribute(closeBtn, 'style', 'transition: 4s ease-in-out all !important; transform: rotate(5000deg) !important;');
				appendAttribute(divContainer, 'style', 'right: 100px !important');
				githubLogo.remove();
				setTimeout(function (f) {
					appendAttribute(divContainer, 'style', 'position: absolute !important; right: -5000px !important;');
					setTimeout(function g() {
						divContainer.remove();
						clearTimeout(f);
						clearTimeout(g);
					}, 200);
				}, 400);
			});
		} else if(pos === 'bottom-left')
		{
			appendAttribute(divContainer, 'style', 'bottom: 10px !important; left: 10px !important; margin-right: 20px !important;');
			appendAttribute(githubLogo, 'style', 'font-size: 20px !important; position: fixed !important; border-radius: 50% !important; overflow: hidden !important; background: #fff !important; cursor: pointer !important; z-index: 99999999999999 !important; left: ' + (containerWidth - 47).toString() + 'px !important; bottom: ' + (containerHeight - 45).toString() + 'px !important;');
			appendAttribute(closeBtn, 'style', 'position: fixed !important; cursor: pointer !important; z-index: 999999999999999999999 !important; bottom: ' + (containerHeight - 5).toString() + 'px !important; left: ' + (containerWidth - 30).toString() + 'px !important;');
			
				closeBtn.addEventListener('click', (e) => {
				e.preventDefault();
				closeBtn.innerHTML = `<i class='bx bx-loader-circle' style='width: fit-content !important; height: fit-content !important; margin-left: -3.5px !important; margin-top: -0.2px !important;'></i>`;
				appendAttribute(closeBtn, 'style', 'transition: 4s ease-in-out all !important; transform: rotate(5000deg) !important;');
				appendAttribute(divContainer, 'style', 'left: 100px !important');
				githubLogo.remove();
				setTimeout(function (f) {
					appendAttribute(divContainer, 'style', 'position: absolute !important; left: -5000px !important;');
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