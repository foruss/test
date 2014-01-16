/**
 * Sets a Cookie with the given name and value.
 *
 * name       Name of the cookie
 * value      Value of the cookie
 * [expires]  Expiration date of the cookie (default: end of current session)
 * [path]     Path where the cookie is valid (default: path of calling document)
 * [domain]   Domain where the cookie is valid
 *              (default: domain of calling document)
 * [secure]   Boolean value indicating if the cookie transmission requires a
 *              secure transmission
 */
function setCookie(color, value, expires, path, domain, secure) {
    document.cookie= color + "=" + escape(value) +
        ((expires) ? "; expires=" + expires.toGMTString() : "") +
        ((path) ? "; path=" + path : "") +
        ((domain) ? "; domain=" + domain : "") +
        ((secure) ? "; secure" : "");
}

/**
 * Gets the value of the specified cookie.
 *
 * name  Name of the desired cookie.
 *
 * Returns a string containing value of specified cookie,
 *   or null if cookie does not exist.
 */
function getCookie(color) {
    var dc = document.cookie;
    var prefix = color + "=";
    var begin = dc.indexOf("; " + prefix);
    if (begin == -1) {
        begin = dc.indexOf(prefix);
        if (begin != 0) return null;
    } else {
        begin += 2;
    }
    var end = document.cookie.indexOf(";", begin);
    if (end == -1) {
        end = dc.length;
    }
    return unescape(dc.substring(begin + prefix.length, end));
}

/**
 * Deletes the specified cookie.
 *
 * name      name of the cookie
 * [path]    path of the cookie (must be same as path used to create cookie)
 * [domain]  domain of the cookie (must be same as domain used to create cookie)
 */
function deleteCookie(color, path, domain) {
    if (getCookie(color)) {
        document.cookie = color + "=" +
            ((path) ? "; path=" + path : "") +
            ((domain) ? "; domain=" + domain : "") +
            "; expires=Thu, 01-Jan-70 00:00:01 GMT";
    }
}


/*
*
*
*/
function changebgcolor(colo){
	if(colo == 'pink') {
	document.body.style.backgroundImage = "url(/images/body_bg_pink.gif)";
	document.body.style.backgroundColor = "#610034";
	//alert (colo);
	setCookie('color', 'pink', '', '/', '');
	}
	else if (colo == 'black'){
	document.body.style.backgroundImage = "url(/images/body_bg_black.gif)";
	document.body.style.backgroundColor = "#000000";
	//alert (colo);
	setCookie('color', 'black', '', '/', '');
	}
	else if (colo == 'blue') {
	document.body.style.backgroundImage = "url(/images/body_bg_blue.gif)";
	document.body.style.backgroundColor = "#002A6A";
	//alert (colo);
	setCookie('color', 'blue', '', '/', '');
	}
	else if (colo == 'gray') {
	document.body.style.backgroundImage = "url(/images/main_bg_1.jpg)";
	document.body.style.backgroundColor = "#4B4B4B";
	//alert (colo);
	setCookie('color', 'gray', '', '/', '');
	}
	else if (colo == 'orange') {
	document.body.style.backgroundImage = "url(/images/body_bg_orange.gif)";
	document.body.style.backgroundColor = "#ff6f02";
	//alert (colo);
	setCookie('color', 'orange', '', '/', '');
	}
	else if (colo == 'white') {
	document.body.style.backgroundImage = "url(/images/body_bg_white.gif)";
	document.body.style.backgroundColor = "#c7c7c7";
	//alert (colo);
	setCookie('color', 'white', '', '/', '');
	}
	else {
	document.body.style.backgroundImage = "url(/images/main_bg_1.jpg)";
	document.body.style.backgroundColor = "#4B4B4B";
	}
}
