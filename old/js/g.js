/*
 @Name: $RCSfile: global.js,v $
 @Version: $Revision: 1.31 $
 @Date: $Date: 2008/12/19 02:05:56 $
 
 Copyright (C) 2007 Copart, Inc. All rights reserved.
 */
var errorNotSupported = "error: not supported";


/*
 This function will disable all the form elements on the page.
 */
function disableAll(){
    var formElem = document.getElementsByTagName("input");
    for (var i = 0; i < formElem.length; i++) {
        if (formElem[i].type != "hidden") {
            formElem[i].disabled = true;
        }
    }
}

/*
 This function enables all the form elements on a page
 and removes the error div from the body so that it can
 be used again.
 */
function enableAll(obj){
    var formElem = document.getElementsByTagName("input");
    for (var i = 0; i < formElem.length; i++) {
        if (formElem[i].type != "hidden") {
            formElem[i].disabled = false;
        }
    }
    document.body.removeChild(obj);
}

/**
 Show/Hide selects in IE.
 This allows the divs to be displayed above select elements.
 If 'hidden' is specified, the selects will be hidden.
 If 'visible' is specified, the selects will be visible.
 
 Default behavior is to toggle between visible and hidden.
 */
function toggleSelects(f){
    var f = f ? f : '';
    var action;
    
    if (navigator.userAgent.indexOf("MSIE") != -1) {
        for (var S = 0; S < document.forms.length; S++) {
            for (var R = 0; R < document.forms[S].length; R++) {
                if (document.forms[S].elements[R].options) {
                
                    if (f != '' && f == 'hidden') {
                        action = 'hidden';
                    }
                    if (f != '' && f == 'visible') {
                        action = 'visible';
                    }
                    
                    if (f == '') {
                        if (document.forms[S].elements[R].style.visibility == 'visible' ||
                        document.forms[S].elements[R].style.visibility == '') {
                            action = 'hidden';
                        }
                        else {
                            action = 'visible';
                        }
                    }
                    document.forms[S].elements[R].style.visibility = action;
                }
            }
        }
    }
}


/**
 *  This function will remove any collection of elements from the page's DOM
 *  @param obj - is the array of object ids that will be removed
 *               from the current page's DOM
 */
function removeElementFromDOM(obj){
    if (obj.length > 0) {
        for (var i = 0; i < obj.length; i++) {
            if ($(obj[i]) != null) {
                document.body.removeChild($(obj[i]));
            }
        }
    }
}

/**
 *  This function will remove a comma seperated collection of elements from the page's DOM
 *  @param obj - is the comma separated object ids that will be removed from DOM
 *
 */
function removeElement(objs){
    // Force selects visible.
    toggleSelects('visible');
    
    if (objs.length > 0) {
        var splitObj = objs.split(",");
        for (var i = 0; i < splitObj.length; i++) {
            if ($(splitObj[i]) != null) {
                document.body.removeChild($(splitObj[i]));
            }
        }
    }
}

/**
 * This function will close the T&C div and redirect the user to homepage
 */
function declineTandC(objs){
    var declineURL = "virtualsales.html"
    redirect(objs, declineURL);
}

/**
 * This function will close the logoff div and redirect the user to the logoff
 * Copart.com page.
 */
function logoff(objs){
    var logoutURL = "securitylogout.html";
    redirect(objs, logoutURL);
}

function redirect(objs, url){
    //removeElement(objs);
    var logoutURL = url;
    var tempURL = window.location.href;
    var locationOfQueryString = tempURL.indexOf("?");
    
    if (locationOfQueryString > -1) {
        tempURL = tempURL.substring(0, locationOfQueryString);
    }
    var splitURL = tempURL.split("/");
    var urlLength = splitURL.length; //Split the URL cause we dont need the page url
    splitURL[urlLength - 1] = logoutURL; //Set the last element to the logout url
    var endURL = "";
    //Loop through the items in the split url array
    for (var i = 0; i < urlLength; i++) {
        // Rebuild the url
        endURL = endURL + splitURL[i];
        if (i == 0) //If we are at first element 'http' the add an additional /
        {
            endURL = endURL + "/";
        }
        else //Just add / to create a properly formed url
        {
            endURL = endURL + "/";
        }
    }
    //Trim off the last /
    var trimmedURL = endURL.substring(0, endURL.length - 1);
    //Set window url to logoff user
    window.location.href = trimmedURL;
}

/**
 * This function is to be used to create logoff div popup.
 */
function getInfoDivPageLogout(){
    var params = null;
    createInfoDivPopup(null, 'Divs/logoff', params, true);
}

/**
 *  This function is to be used to create informational/error message div/popups.
 * @param controller - passable url to a different controller, because some
 *                     div will need to do some processing and wont be able to
 *                     use the standard static controller.
 * @param view       - path and file name of the ftl to use as the view
 * @return           - none
 */
function getInfoDivPage(controller, view, method){
    method = method ? method : "get";
    var params = null;
    createInfoDivPopup(controller, view, params, false, method);
}

/**
 *  This function is a wrapper for the facility info div.
 *
 * @param yardNumber - The yard to show the facility info for.
 */
function getFacilityInfo(yardNumber){
    getInfoDivPage(message.facilityInfoAjax+'?yardnumber=' + yardNumber, 'Divs/facilityInfo');
}

/**
 *  This function is to be used to create the sale highlights div popup.
 * @param controller     - passable url to a different controller, because some
 *                         div will need to do some processing and wont be able to R
 *                         use the standard static controller.
 * @param view           - path and file name of the ftl to use as the view
 * @param facility       - Display value for Facility
 * @param saleHighlights - Display value for Sale Highlights
 * @return               - none
 */
function getInfoDivPageWithContent(controller, view, facility, saleHighlights){
    //var cleanSaleHighlights = removeCopartSingleQuote(saleHighlights);
    //cleanSaleHighlights = createPoundSignEntity(cleanSaleHighlights);
    var params = "facility=" + facility + "&saleHighlights=" + encodeURIComponent(saleHighlights);
    createInfoDivPopup(controller, view, params, false);
}

/**
 *  This function is responsible for creating the actual ajax divs.
 *  This function will create 2 divs in the DOM, the msgDisable that captures page
 *  clicks (not on the message div) and closes the dynamic divs, a info-div-global
 *  div that is a container that the AJAX (H) response will be placed into.
 */
function createInfoDivPopup(controller, view, params, isLogout, method){
    method = method ? method : "get";
    // If there is already a popup open, close it
    if ($("info-div-global") != null) {
        removeElement('info-div-global,msgDisabler')
    }
    
    // Hide selects for IE.
    toggleSelects('hidden');
    
    if (controller == null) {
        controller = "info.html";
    }
    if (params == null) {
        params = "";
    }
    else {
        params = "&" + params;
    }
    
    var msgBg = $E({
        tag: "div",
        id: "msgDisabler"
    });
    if (isLogout) {
        msgBg.setAttribute("onclick", "logoff('info-div-global,msgDisabler');");
        msgBg.onclick = function(){
            logoff('info-div-global,msgDisabler');
        };
    }
    else {
        msgBg.setAttribute("onclick", "removeElement('info-div-global,msgDisabler');");
        msgBg.onclick = function(){
            removeElement('info-div-global,msgDisabler');
        };
    }
    new Ajax.Request(controller, {
        method: method,
        parameters: "view=" + view + params,
        onSuccess: function(transport){
            var infoContainer = $E({
                tag: "div",
                id: "info-div-global"
            });
            document.body.appendChild(msgBg);
            document.body.appendChild(infoContainer);
            $("info-div-global").innerHTML = transport.responseText;
            var draggableMsg = new Draggable("information-div", {
                handle: "information-div-titleBar"
            });
            Position.center(infoContainer)
            setDisablerHeight();
        },
        onFailure: function(transport){
            redirectOnFailure(view);
        },
        onException: function(transport){
            redirectOnFailure(view);
        }
    });
}

function redirectOnFailure(view){
    if (view == 'Divs/logoff') {
        logoff('info-div-global,msgDisabler');
    }
    else {
        redirect('info-div-global,msgDisabler', 'virtualsales.html');
    }
}

function createTandCDivPopup(){
    // If there is already a popup open, close it
    if ($("info-div-global") != null) {
        removeElement('info-div-global,msgDisabler')
    }
    
    var controller = "info.html";
    var view = "Divs/viewTandC";
    
    var msgBg = $E({
        tag: "div",
        id: "msgDisabler"
    });
    msgBg.setAttribute("onclick", "declineTandC('info-div-global,msgDisabler');");
    msgBg.onclick = function(){
        declineTandC('info-div-global,msgDisabler');
    };
    new Ajax.Request(controller, {
        method: "get",
        parameters: "view=" + view,
        onSuccess: function(transport){
            var infoContainer = $E({
                tag: "div",
                id: "info-div-global"
            });
            document.body.appendChild(msgBg);
            document.body.appendChild(infoContainer);
            $("info-div-global").innerHTML = transport.responseText;
            var draggableMsg = new Draggable("information-div", {
                handle: "information-div-titleBar"
            });
            Position.center(infoContainer)
            setDisablerHeight();
        }
    });
}

function confirmTAndC(){
    var controller = "acceptTAndC.ajax";
    new Ajax.Request(controller, {
        method: "get",
        parameters: "",
        onSuccess: function(transport){
            if (transport.responseText.indexOf("error") > -1) {
                $("inCaseOfError").innerHTML = transport.responseText;
            }
            // If there is already a popup open, close it
            else 
                if ($("info-div-global") != null) {
                    removeElement('info-div-global,msgDisabler')
                }
        },
        onFailure: function(transport){
            createTandCDivPopup();
        }
    });
}

/**
 * This function will size the disabler div based on the window height and width
 */
function setDisablerHeight(){
    var yWithScroll;
    var xWithScroll;
    if (window.innerHeight && window.scrollMaxY) {
        // Firefox
        yWithScroll = window.innerHeight + window.scrollMaxY;
        xWithScroll = window.innerWidth + window.scrollMaxX;
    }
    else 
        if (document.body.scrollHeight > document.body.offsetHeight) {
            // all but Explorer Mac
            yWithScroll = document.body.scrollHeight;
            xWithScroll = document.body.scrollWidth;
        }
        else {
            // works in Explorer 6 Strict, Mozilla (not FF) and Safari
            yWithScroll = (document.body.offsetHeight + document.body.offsetTop) - 20;
            xWithScroll = (document.body.offsetWidth + document.body.offsetLeft) - 20;
        }
    
    $("msgDisabler").style.height = yWithScroll + "px";
    $("msgDisabler").style.width = xWithScroll + "px";
}

/**
 * This function was created to deal with the single quotes that we may have to
 * deal with in JavaScript. It is a 2 part fix, part one is in the ftl itself,
 * we have to use the function to replace ' with copartSingleQuote. Then this
 * function will replace copartSingleQuote with the JavaScript escaped single
 * quote.
 *
 * @param str - String that is going to have the copartSingleQuote replaced
 */
function removeCopartSingleQuote(str){
    var cleanStr;
    if (str.indexOf("copartSingleQuote") > -1) {
        cleanStr = str.replace("copartSingleQuote", "\'");
    }
    else {
        cleanStr = str;
    }
    return cleanStr;
}

/**
 * This function will replace the # and convert it to *CopartPound*. The reason this is
 * needed is because when we are using pound sign, in js it can be interperted as
 * part of a url instead of just a string. Then the *CopartPound* has to be replaced
 * in the FTL with a # for display.
 */
function createPoundSignEntity(str){
    var cleanStr;
    if (str.indexOf("#") > -1) {
        cleanStr = str.replace("#", "*CopartPound*");
    }
    else {
        cleanStr = str;
    }
    return cleanStr;
}

/*
 This function will remove DraggableImageViewer
 */
function hideDiv(child, parent){
    document.body.removeChild(child);
    document.body.removeChild(parent);
}

/**
 * document.createElement convenience wrapper
 *
 * The data parameter is an object that must have the "tag" key, containing
 * a string with the tagname of the element to create.  It can optionally have
 * a "children" key which can be: a string, "data" object, or an array of "data"
 * objects to append to this element as children.  Any other key is taken as an
 * attribute to be applied to this tag.
 *
 * Release homepage:
 * http://www.arantius.com/article/dollar+e
 *
 * Available under an MIT license:
 * http://www.opensource.org/licenses/mit-license.php
 *
 * @param {Object} data The data representing the element to create
 * @return {Element} The element created.
 */
function $E(data){
    var el;
    if ('string' == typeof data) {
        el = document.createTextNode(data);
    }
    else {
        //create the element
        el = document.createElement(data.tag);
        delete (data.tag);
        
        //append the children
        if ('undefined' != typeof data.children) {
            if ('string' == typeof data.children ||
            'undefined' == typeof data.children.length) {
                //strings and single elements
                el.appendChild($E(data.children));
            }
            else {
                //arrays of elements
                for (var i = 0, child = null; 'undefined' != typeof(child = data.children[i]); i++) {
                    el.appendChild($E(child));
                }
            }
            delete (data.children);
        }
        
        //any other data is attributes
        for (attr in data) {
            el[attr] = data[attr];
        }
    }
    
    return el;
}

/**
 * View PDF Files in new Window
 */
function viewPdf(url){
    var winPdf = window.open(url, 'ViewPDF', "width=680, height=500, scrollbars=yes, menubar=no, location=no, status=no, resizable=yes, toolbars=no");
}



Position.GetWindowSize = function(w){
    w = w ? w : window;
    var width = w.innerWidth || (w.document.documentElement.clientWidth || w.document.body.clientWidth);
    var height = w.innerHeight || (w.document.documentElement.clientHeight || w.document.body.clientHeight);
    return [width, height]
}


/**
 * This function allows the centering of objects based on where the client is viewing
 */
Position.center = function(element){
    var copartCenterX = 260; //Added to adjust what 'center' was
    var copartCenterY = 220;
    var options = Object.extend({
        zIndex: 999,
        update: false
    }, arguments[1] ||
    {});
    element = $(element)
    if (!element._centered) {
        Element.setStyle(element, {
            position: 'absolute',
            zIndex: options.zIndex
        });
        element._centered = true;
    }
    var dims = Element.getDimensions(element);
    Position.prepare();
    var winWidth = self.innerWidth || document.documentElement.clientWidth || document.body.clientWidth || 0;
    var winHeight = self.innerHeight || document.documentElement.clientHeight || document.body.clientHeight || 0;
    var offLeft = (Position.deltaX + Math.floor((winWidth - dims.width) / 2)) - copartCenterX;
    var offTop = (Position.deltaY + Math.floor((winHeight - dims.height) / 2) - copartCenterY);
    element.style.top = ((offTop != null && offTop > 0) ? offTop : '0') + 'px';
    element.style.left = ((offLeft != null && offLeft > 0) ? offLeft : '0') + 'px';
    if (options.update) {
        Event.observe(window, 'resize', function(evt){
            Position.center(element);
        }, false);
        Event.observe(window, 'scroll', function(evt){
            Position.center(element);
        }, false);
    }
}

/* The following JS was taken from VB2 */

// Trims off all leading/trailing whitespace
function trimWS(strValue){
    var objRegExp = /^(\s*)$/;
    //check for all spaces
    if (objRegExp.test(strValue)) {
        strValue = strValue.replace(objRegExp, '');
        if (strValue.length == 0) {
            return strValue;
        }
    }
    //check for leading & trailing spaces
    objRegExp = /^(\s*)([\W\w]*)(\b\s*$)/;
    if (objRegExp.test(strValue)) {
        //remove leading and trailing whitespace characters
        strValue = strValue.replace(objRegExp, '$2');
    }
    return strValue;
}

function checkEmail(theField, msg, placementId){
    // Strip off leading/following whitespace
    theField.value = trimWS(theField.value);
    // Email check
    // pattern1 = beginning pattern of email, case insensitive
    // pattern2 = middle pattern of email, case insensitive
    // pattern3 = end pattern of email, case insensitive
    // pattern4 = only one @ allowed
    // pattern5 = no white space allowed
    
    var pattern1 = /^\w+/i;
    var pattern2 = /\w+\@\w+/i;
    var pattern3 = /[a-z|0-9]\.[a-z]{2,3}$/i;
    var pattern4 = /\@.+\@/;
    var pattern5 = /\s|\/|\\|\;|\:|\"|,/;
    
    if (theField.value == '' || theField.value.substr(0, 4) == 'www.') {
        theField.focus();
        $(placementId).innerHTML = msg;
        return false;
    }
    else 
        if (!(pattern1.test(theField.value) && pattern2.test(theField.value) && pattern3.test(theField.value))) {
            theField.focus();
            $(placementId).innerHTML = msg;
            return false;
        }
        else 
            if (pattern4.test(theField.value) || pattern5.test(theField.value)) {
                theField.focus();
                $(placementId).innerHTML = msg;
                return false;
            }
    return true;
}

function checkNumber(theField, required, minLength, minValue, msg, placementId){
    // Strip off leading/following whitespace
    theField.value = trimWS(theField.value);
    
    // If NaN, return error
    if (isNaN(theField.value) && required) {
        theField.focus();
        $(placementId).innerHTML = msg;
        return false;
    }
    // If contains an 'e', return error
    else 
        if (regex(theField.value, 'e')) {
            theField.focus();
            $(placementId).innerHTML = msg;
            return false;
        }
        // If value < 0, return error
        else 
            if (theField.value < 0) {
                theField.focus();
                $(placementId).innerHTML = msg;
                return false;
            }
            // If not an int, return error
            else 
                if (theField.value != Math.floor(theField.value)) {
                    theField.focus();
                    $(placementId).innerHTML = msg;
                    return false;
                }
                // If (required == 1 or length > 0) and length < minLength, return error
                else 
                    if ((required || theField.value.length > 0) && theField.value.length < minLength) {
                        theField.focus();
                        $(placementId).innerHTML = msg;
                        return false;
                    }
                    // If (required == 1 or length > 0) and value < minValue, return error
                    else 
                        if ((required || theField.value.length > 0) && theField.value < minValue) {
                            theField.focus();
                            $(placementId).innerHTML = msg;
                            return false;
                        }
    return true;
}

function checkAlphaNumeric(theField, required, minLength, strongFilter, msg, placementId){
    // Strip off leading/following whitespace
    theField.value = trimWS(theField.value);
    var myRegxp = /^([a-zA-Z0-9_-]+)$/;
    // Converting all strings to uppercase except password
    //  if (theField.name != "oldpassword" || theField.name != "password1" || theField.name != "password2"){
    //	theField.value=theField.value.toUpperCase();
    //}
    
    // If has illegal chars ("), return error
    if (regex(theField.value, '"')) {
        theField.focus();
        $(placementId).innerHTML = msg;
        return false;
    }
    // If (required == 1 or length > 0) and length <= minLength, return error
    else 
        if ((required || theField.value.length > 0) && theField.value.length < minLength) {
            theField.focus();
            $(placementId).innerHTML = msg;
            return false;
        }
        // If strongFilter == 1 and contains (!@#$%^&* etc), return error
        else 
            if (strongFilter && !myRegxp.test(theField.value)) {
                theField.focus();
                $(placementId).innerHTML = msg;
                return false;
            }
    return true;
}

function checkAlphaNumericStrict(theField, required, minLength, strongFilter, msg, placementId){
    // Strip off leading/following whitespace
    theField.value = trimWS(theField.value);
    var myRegxp = /^([a-zA-Z0-9]+)$/;
    // Converting all strings to uppercase except password
    //  if (theField.name != "oldpassword" || theField.name != "password1" || theField.name != "password2"){
    //	theField.value=theField.value.toUpperCase();
    //}
    
    // If has illegal chars ("), return error
    if (regex(theField.value, '"')) {
        theField.focus();
        $(placementId).innerHTML = msg;
        return false;
    }
    // If (required == 1 or length > 0) and length <= minLength, return error
    else 
        if ((required || theField.value.length > 0) && theField.value.length < minLength) {
            theField.focus();
            $(placementId).innerHTML = msg;
            return false;
        }
        // If strongFilter == 1 and contains (!@#$%^&* etc), return error
        else 
            if (strongFilter && !myRegxp.test(theField.value)) {
                theField.focus();
                $(placementId).innerHTML = msg;
                return false;
            }
    return true;
}

function regex(strValue, pattern){
    var objRegExp = new RegExp('[' + pattern + ']');
    
    if (objRegExp.test(strValue)) {
        return true;
    }
    else {
        return false;
    }
}

/**
 * This function will take in the params to create the featured listings component.
 */
function getFeaturedCarList(url, params, outputDiv, loadingGif, errorMsg){
    var messageDivStart = '<div style="margin: 50px auto 50px auto;text-align: center;">';
    var messageDivEnd = '</div>';
    $(outputDiv).innerHTML = messageDivStart + loadingGif + messageDivEnd;
    new Ajax.Request(url, {
        method: "get",
        parameters: params,
        onSuccess: function(transport){
            $(outputDiv).innerHTML = transport.responseText;
        },
        onFailure: function(){
            $(outputDiv).innerHTML = messageDivStart + errorMsg + messageDivEnd;
        }
    });
}

function getDropdownValue(dropdown){
    var value = dropdown.options[dropdown.selectedIndex].value;
    return value;
}

/*
 *******************************
 About Title Type Codes - DIV
 *******************************
 */
function getStatesByCountry(countryDropdown, emptyListMsg, errMsg, defaultStateValue){
    var countryId = getDropdownValue(countryDropdown);
    if (countryId.length > 1) //Country selected is not 'Select a Country'
    {
        var controller = "aboutTitleTypeStates.ajax";
        var stateSplitter = "~";
        var setSplitter = "*";
        new Ajax.Request(controller, {
            method: "get",
            parameters: "countryId=" + countryId,
            onSuccess: function(transport){
                if (transport.responseText.indexOf("empty") > -1) {
                    $("listContent").innerHTML = "<div class=\"alertred\">" + emptyListMsg + "</div>";
                }
                else {
                    $("submitTitleType").disabled = false;
                    var returnValue = transport.responseText;
                    var states = returnValue.split(stateSplitter);
                    $("titleTypeState").options.length = 0;
                    for (var i = 0; i < states.length - 1; i++) {
                        var state = states[i].split(setSplitter);
                        $("titleTypeState").options[i] = new Option(state[1], state[0]);
                    }
                }
            },
            onFailure: function(transport){
                $("listContent").innerHTML = "<div class=\"alertred\">" + errMsg + "</div>";
            }
        });
    }
    else {
        $("submitTitleType").disabled = true;
        $("titleTypeState").options.length = 0;
        $("titleTypeState").options[0] = new Option(defaultStateValue, '');
    }
}

function getLossTypeCodes(errMsg, loadImg, loadImgAlt){
    var stateId = getDropdownValue($("titleTypeState"));
    if (stateId.length > 0) {
        var loadingImg = "<img src=\"" + loadImg + "\" alt=\"" + loadImgAlt + "\"/>";
        var controller = "aboutTitleTypeCodesList.ajax";
        $("listContent").innerHTML = "<div class=\"centerobj\">" + loadingImg + "</div>";
        new Ajax.Request(controller, {
            method: "get",
            parameters: "stateId=" + trimWS(stateId),
            onSuccess: function(transport){
                $("listContent").innerHTML = transport.responseText;
            },
            onFailure: function(transport){
                $("listContent").innerHTML = "<div class=\"alertred\">" + errMsg + "</div>";
            }
        });
    }
}

/*
 *******************************
 Oklahoma Compliance - DIV
 *******************************
 */
function submitOKComplianceForm(errMsg){
    var lotId = $("okLotId").value;
    var controller = "oklahomaComplianceLotInfo.ajax";
    var formattedErrMsg = "<div class=\"alertneutral\">" + errMsg + "</div>";
    $("okComplianceResultTd").innerHTML = "<div style=\"text-align: center;\"><img src=\"" + $("loadingImgSrc").src + "\"></div>";
    if ((lotId.length < 1) || (isNaN(lotId))) {
        $("okComplianceResultTd").innerHTML = formattedErrMsg;
        return false;
    }
    new Ajax.Request(controller, {
        method: "get",
        parameters: "okLotId=" + lotId,
        onSuccess: function(transport){
            $("okComplianceResultTd").innerHTML = transport.responseText;
        },
        onFailure: function(transport){
            $("okComplianceResultTd").innerHTML = formattedErrMsg;
        }
    });
}

/**
 * This function takes in either 2 xml strings or 2 xml documents. If strings
 * are passed in, they are converted into xml documents. Then the xsl is applied
 * to the xml and sent back to the caller
 */
function getFormattedXMLContent(xmlString, xslString){
    //If Moz/Opera
    if (document.implementation && document.implementation.createDocument) {
        var xmlDoc;
        var xslDoc;
        if ("string" == typeof xmlString) {
            xmlDoc = returnXMLDocument(xmlString);
        }
        else {
            xmlDoc = xmlString;
        }
        if ("string" == typeof xslString) {
            xslDoc = returnXMLDocument(xslString);
        }
        else {
            xslDoc = xslString;
        }
        if (isError(xmlDoc, xslDoc)) {
            return errorNotSupported;
        }
        var xsltProcessor = new XSLTProcessor();
        xsltProcessor.importStylesheet(xslDoc)
        return xsltProcessor.transformToFragment(xmlDoc, document);
    }
    //If IE
    else 
        if (window.ActiveXObject) {
            var xmlDoc;
            var xslDoc;
            
            if ("string" == typeof xmlString) {
                xmlDoc = returnXMLDocument(xmlString);
            }
            else {
                xmlDoc = xmlString;
            }
            if ("string" == typeof xslString) {
                xslDoc = returnXMLDocument(xslString);
            }
            else {
                xslDoc = xslString;
            }
            if (isError(xmlDoc, xslDoc)) {
                return errorNotSupported;
            }
            return xmlDoc.transformNode(xslDoc)
        }
        else {
            return errorNotSupported;
        }
    
    function isError(xml, xsl){
        //Check that both items are objects
        if ((xml && "object" == typeof xml) &&
        (xsl && "object" == typeof xsl)) {
            return false;
        }
        return true;
    }
}

/**
 * This function takes a string and attempts to convert it to an xml document.
 */
function returnXMLDocument(strDocument){
    //If Mozilla/Opera
    if (document.implementation && document.implementation.createDocument) {
        var domParser = new DOMParser();
        var xmlDocument = domParser.parseFromString(strDocument, "text/xml");
        return xmlDocument;
    }
    //If IE
    else 
        if (window.ActiveXObject) {
            var xmlDocument = new ActiveXObject("Microsoft.XMLDOM");
            xmlDocument.async = "false";
            xmlDocument.loadXML(strDocument);
            return xmlDocument;
        }
        //Not Supported
        else {
            return errorNotSupported;
        }
}


/**
 Replace the image tag with the replacement image.
 **/
function imageNotFound(image, imgName){
    var imgName = imgName || 'carImageNotFoundThumb.jpg';
    imageURL = global.contextRoot + 'images/global/' + imgName;
    imageWidth = image.width;
    imageHeight = image.height;
    image.parentNode.innerHTML = "<img alt='Image Not Found' src='" + imageURL + "' width='" + imageWidth + "' height='" + imageHeight + "' />";
}



/**
 Global session timeout.
 Time is in miliseconds.
 **/
var sessionTimeoutValue = 24 * 60 * 60000; /**24 hours**/
window.setTimeout('_onSessionTimeout()', sessionTimeoutValue);
function _onSessionTimeout(){
    alert(globalTimeOut.message);
    window.location.href = 'securitylogout.html';
}

function checkForBackForm(formName){
    if ($(formName) == null && $('backLink') != null) {
        $('backLink').innerHTML = '';
    }
}



/**
 * This method will validate that a field is present if another is as well.
 * @param dependentValue - value that needs to be present if parentValue is
 *        present
 * @param parentValue - value that when set makes the depenentValue required
 */
function requiredIf(dependentValue, parentValue){
    if (parentValue.length > 0 || parentValue != "") {
        if (dependentValue.length <= 0 || dependentValue == "") {
            return true;
        }
    }
    return false;
    
}

/**
 * This event is waiting for the window to resize, when the window is resized,
 * the function resizewindow() is called.
 */
Event.observe(window, 'resize', resizewindow);

/** This Function is used for Resizing the window and it will take cares to close the DIV  
 *   when Maximize.
 */
function resizewindow(){
    if ($('msgDisabler') != null) {
        setDisablerHeight();
        
    }
}

/**
 * This method checks that a field exists, if the field value is not empty or
 * null then it returns the field's vlaue, if the field
 * does not exist or is blank or null, it returns the defaultValue.
 * @param {Object} fieldName - field to get value from.
 * @param {Object} defaultValue - default value if field does not exist.
 */
function getHiddenFieldValue(fieldName, defaultValue){
    if ($(fieldName) != null) {
        if ($(fieldName).value != "" || $(fieldName).value != null) {
            return $(fieldName).value;
        }
        else {
            return defaultValue;
        }
    }
    return defaultValue;
}

/**
 * This function takes the number of minutes needed by the user and returns
 * milliseconds, since this is the default time interval for JavaScript.
 * @param {Object} minutes - this param can be an int, double or float.
 */
function getMinutesInMilliSeconds(minutes){
    return minutes * 60000;
}

function getLoadingImage(){
    return '<p class="ajaxLoadingImage"><img src="' + $("loadingImgSrc").src + '" width="16" height="16" /></p>';
}

/**
 * This method will make an AJAX call and get the featured listings compact list.
 * @param {Object} selectedValue - value selected for the criteria.
 * @param {Object} ajaxContentContainerName - container that we will write our content to.
 * @param {Object} failureMessage - message to present to the user if a failure happens.
 */
function getFeaturedListings(selectedValue, ajaxContentContainerName, failureMessage){
    var selectedLotType = selectedValue;
    $(ajaxContentContainerName).innerHTML = getLoadingImage();
    new Ajax.Request("featuredListingsCompact.ajax", {
        method: "get",
        parameters: "lotType=" + trimWS(selectedLotType),
        onSuccess: function(transport){
            $(ajaxContentContainerName).innerHTML = transport.responseText;
        },
        onFailure: function(transport){
            $(ajaxContentContainerName).innerHTML = failureMessage;
        }
    });
}

//Script in place that limits email to 1000 characters.
var ns6 = document.getElementById && !document.all

function restrictinput(maxlength, e, placeholder){
    if (window.event && event.srcElement.value.length >= maxlength) 
        return false
    else 
        if (e.target && e.target == eval(placeholder) && e.target.value.length >= maxlength) {
            var pressedkey = /[a-zA-Z0-9\.\,\/]/ //detect alphanumeric keys
            if (pressedkey.test(String.fromCharCode(e.which))) 
                e.stopPropagation()
        }
}

function countlimit(maxlength, e, placeholder){
    var theform = eval(placeholder)
    var lengthleft = maxlength - theform.value.length
    var placeholderobj = document.all ? document.all[placeholder] : document.getElementById(placeholder)
    if (window.event || e.target && e.target == eval(placeholder)) {
        if (lengthleft < 0) 
            theform.value = theform.value.substring(0, maxlength)
        placeholderobj.innerHTML = lengthleft
    }
}

function displaylimit(thename, theid, thelimit){
    var theform = theid != "" ? document.getElementById(theid) : thename
    var limit_text = '<b><span id="' + theform.toString() + '">' + thelimit + '</span></b> '
    if (document.all || ns6) 
        document.write(limit_text)
    if (document.all) {
        eval(theform).onkeypress = function(){
            return restrictinput(thelimit, event, theform)
        }
        eval(theform).onkeyup = function(){
            countlimit(thelimit, event, theform)
        }
    }
    else 
        if (ns6) {
            document.body.addEventListener('keypress', function(event){
                restrictinput(thelimit, event, theform)
            }, true);
            document.body.addEventListener('keyup', function(event){
                countlimit(thelimit, event, theform)
            }, true);
        }
}


function replayLot(lotSoldKey)
{
    var windowTarget = "replayWindow" + lotSoldKey;
    $("replayForm").target = windowTarget;
    $("soldLotKey").value = lotSoldKey;
    
    window.open("", windowTarget, "width=730, height=480, scrollbars=yes, menubar=no, location=no, status=no, resizable=no, toolbars=no");
    setTimeout("openReplayWindow()", 500);
    
}

function openReplayWindow()
{
    $("replayForm").submit();
}


function backToPrevious(formName, eventId)
{
    $("_eventId").value = eventId;
    $(formName).method = "get";
    $(formName).submit();
}

function getLot(formName, eventId, lotId)
{
    $("lotId").value = lotId;
    $("_eventId").value = eventId;
    $(formName).submit();
}


/**
 * This function will perform validation on the Search By Type form.
 */
function detailSearchValidate(){
    var selectedMake = $F("make");
    var fromYear = $F("startYear");
    var toYear = $F("endYear");
    var zipPostalCode = $F("zipPostalCode");
    var errors = "";
    
    if (fromYear > toYear) {
        errors += message.detailSearch_error_yearRange;
    }
    
    if($F("vehicleType") == message.validVehicleType)
    {
    	if (selectedMake == "*" || selectedMake == "") {
        	if (errors != "") {
            	errors += "<br>";
        	}
        	errors += message.detailSearch_error_make;
    	}
    }
    
    if(zipPostalCode != null && zipPostalCode != "")
    {
       var isValid = checkAlphaNumericStrict($("zipPostalCode"), 0, 0, 1, message.detailSearch_zip_required, "detailedSearchError");
	   //Corrected this IF condition to display the invalid zip code error message -- Bug 5944
	   if (!isValid)
	   {
	     if (errors != "") {
            errors += "<br>";
          }
         errors += message.detailSearch_zip_required;
	   }
	   else
	   {
	     rememberZip(zipPostalCode);
	   }
    }
    
    if (errors != "") {
        $("detailedSearchError").innerHTML = errors;
        return false;
    }
    return true;
}

/**
 * This function is used to update the State / Facility Drop down.
 * @param {Object} dropDownName - this is the drop down that triggers the onchange even.
 * @param {Object} contentContainer - this is the drop down that will be update with new content.
 */
function updateStateFacilityDropDown(dropDownName, contentContainer){
    var xmlNodeName = "state";
    var xmlNodeAttribute1 = "code";
    var xmlNodeAttribute2 = "description";
    var reqParam = "statefacility";
    
    if ($F(dropDownName) == "facility") {
        xmlNodeName = "yard";
        xmlNodeAttribute1 = "number";
        xmlNodeAttribute2 = "name";
    }
    
    
    if ($F(dropDownName) != "zip") {
        $("location-container").style.display = "block";
        $("zip-container").style.display = "none";
        if(xmlNodeName == "yard")
        {
          updateDropDown(dropDownName, contentContainer, xmlNodeName, xmlNodeAttribute1, xmlNodeAttribute2, reqParam, message.stateFacilityAjax, message.defaultFacilityDisplay, message.defaultFacilityValue);
        }
        else
        {
          updateDropDown(dropDownName, contentContainer, xmlNodeName, xmlNodeAttribute1, xmlNodeAttribute2, reqParam, message.stateFacilityAjax, message.defaultStateDisplay, message.defaultStateValue);
        }
        
    	var zip = getZip();
    	if(zip == 0){  
    		$("zipPostalCode").value = "";
    	}else{
    		$("zipPostalCode").value = zip;
    	}
    }
    else
    {
        $("location-container").style.display = "none";
        $("zip-container").style.display = "block";
    }
}

/**
 * This function is used to update the Models Drop down.
 * @param {Object} dropDownName - this is the drop down that triggers the onchange even.
 * @param {Object} contentContainer - this is the drop down that will be update with new content.
 */
function updateMakeDropDown(dropDownName, contentContainer){
    var reqParam = "vehicleType";
    var xmlNodeName = "make";
    var xmlNodeAttribute1 = "code";
    var xmlNodeAttribute2 = "description";
    
    //if ($F(dropDownName) == message.validVehicleType) {
        $("model").disabled = false;
        updateDropDown(dropDownName, contentContainer, xmlNodeName, xmlNodeAttribute1, xmlNodeAttribute2, reqParam, message.makeAjax, message.defaultMakeDisplay, "*");
    	setTimeout("timeoutForModel()", 10000);
    //}
    //else {
    //	$("model").disabled = false;
    //    updateDropDown(dropDownName, contentContainer, xmlNodeName, xmlNodeAttribute1, xmlNodeAttribute2, reqParam, message.makeAjax, message.defaultMakeIfNotVehicle, message.defaultMakeIfNotVehicleValue);
    //    makeNotValidModelDropDown();
    //}
}

function timeoutForModel()
{
    updateModelDropDown('make', 'model');
}

function makeNotValidModelDropDown(){
    $("model").options.length = 0;
    var opt = $E({
        tag: "option"
    });
    opt.text = message.defaultModelDisplay;
    opt.value = message.defaultModelValue;
    $("model").options.add(opt);
    $("model").disabled = false;
}


/**
 * This function is used to update the Models Drop down.
 * @param {Object} dropDownName - this is the drop down that triggers the onchange even.
 * @param {Object} contentContainer - this is the drop down that will be update with new content.
 */
function updateModelDropDown(dropDownName, contentContainer){
    var reqParam = "selectedMake";
    var xmlNodeName = "model";
    var xmlNodeAttribute1 = "code";
    var xmlNodeAttribute2 = "description";
    
    if ($F(dropDownName) != "*") {
        updateDropDown(dropDownName, contentContainer, xmlNodeName, xmlNodeAttribute1, xmlNodeAttribute2, reqParam, message.modelAjax);
    }
}

/**
 * This function is used by both the model and State/Facility drop down update functions. This method makes
 * the ajax request for the the new collection, parses it and creates new options in the contentContainer.
 * @param {Object} dropDownName - the dropdown that triggered the function
 * @param {Object} contentContainer - the dropdown whose contents will be updated.
 * @param {Object} xmlNodeName - parent XML node name not root, ie: state
 * @param {Object} xmlNodeAttribute1 - attribute whose value we will use to display to the user, ie: description
 * @param {Object} xmlNodeAttribute2 - attribute whose value we will use as the value, ie: code
 * @param {Object} reqParam - request parameter that the controller is expecting.
 * @param (Object) ajaxURL - url to the controller for the ajax request.
 * @param (Object) defaultOptionValue - if a value is specified it is used as the first option in the drop down.
 */
function updateDropDown(dropDownName, contentContainer, xmlNodeName, xmlNodeAttribute1, xmlNodeAttribute2, reqParam, ajaxURL, defaultOption, defaultOptionValue){
    var selectedValue = $F(dropDownName);
    var xmlDoc;
    var nodeCounter = 0;
    var startCounterAt = 0;
    defaultOption = defaultOption ? defaultOption : "";
    defaultOptionValue = defaultOptionValue ? defaultOptionValue : "";
    if(defaultOption != "")
    {
      var firstOption = new Option(defaultOption, defaultOptionValue);
      startCounterAt = 1;
    }
    
    new Ajax.Request(ajaxURL, {
        method: "get",
        parameters: reqParam + "=" + trimWS(selectedValue),
        onSuccess: function(transport){
            xmlDoc = returnXMLDocument(transport.responseText);
            nodeCounter = xmlDoc.getElementsByTagName(xmlNodeName).length;
            if (nodeCounter > 0) {
                $(contentContainer).options.length = 0;
                if(startCounterAt > 0)
                {
                  $(contentContainer).options[0] = firstOption;
                }
                for (var i = 0; i < nodeCounter; i++) {
                    var desc = xmlDoc.getElementsByTagName(xmlNodeName)[i].attributes.getNamedItem(xmlNodeAttribute2).value;
                    var code = xmlDoc.getElementsByTagName(xmlNodeName)[i].attributes.getNamedItem(xmlNodeAttribute1).value;
                    var newOption = new Option(desc, code);
                    $(contentContainer).options[i+startCounterAt] = newOption;
                }
            }
        }
    });
}


function rememberZip(zip)
{
  document.cookie = 'user_zip=' + zip + ';path=/;domain=copart.com';
}

function getZip()
{
	var nameEQ = "user_zip=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0)
		{
			return c.substring(nameEQ.length,c.length);
		} 
	}
	return 0;
}