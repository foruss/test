// JavaScript Document

// Attach function showAdvOptSet() to searchResult.html to enable show/hide of advanced option set.

function showAdvOptSet(lang) {
    var list = document.getElementById('adv_option_set');
    var button = document.getElementById('adv_opt_button');
    
    if ( list.className == 'off' ) {
        list.className = 'on';
        button.src = '/imageserver/plumtree/portal/custom/Manheim/images/new/' + lang + '/adv_options_hover.gif';
    } else {
        list.className = 'off';
        button.src = '/imageserver/plumtree/portal/custom/Manheim/images/new/' + lang + '/adv_options.gif';
    }
}

//Show Hide Left panel

function infoToggle(elementid, tabCount, defaultTab) {
    tabOnID = 'tab-on-' + elementid;
    tabOffID = 'tab-' + elementid;

    for ( var i = 1; i <= tabCount; i++ ) {
        var currDiv = 'tab-on-' + i;
        var currH4 = 'tab-' + i;
        if ( currDiv != tabOnID ) {
            var labelElement = document.getElementById(currH4);
            if ( labelElement != null ) {
               labelElement.style.display = ''
            }
            
            var contentElement = document.getElementById(currDiv);
            if ( contentElement != null ) {
                contentElement.className = 'off';
            }
        }
    }

    if ( document.getElementById(tabOnID).className == 'off' ) {
        document.getElementById(tabOnID).className = '';
        document.getElementById(tabOffID).style.display = 'none';
        
        var position = findPos(document.getElementById(tabOnID));
        var currentX = (document.all) ? document.documentElement.scrollLeft : window.pageXOffset; 
        var currentY = (document.all) ? document.documentElement.scrollTop : window.pageYOffset;
        if ( position[0] < currentX || position[1] < currentY ) {
            window.scrollTo(position[0], position[1]);
        }
    } else {
        document.getElementById(tabOnID).className = 'off';
        document.getElementById(tabOffID).style.display = 'block';
        
        if ( defaultTab > 0 && defaultTab <= tabCount ) {
            infoToggle(defaultTab);
        }
    }
}

function findPos(obj) {
    var curleft = curtop = 0;
    if (obj.offsetParent) {
        curleft = obj.offsetLeft
        curtop = obj.offsetTop
        while (obj = obj.offsetParent) {
            curleft += obj.offsetLeft
            curtop += obj.offsetTop
        }
    }
    return [curleft,curtop];
}

//Show Hide VDP Detail TABS

var gPrevDivID = "1";

function toggleTabs(elementid){	
	tabOnID = "vdpTab_detail-"+elementid;
	parentTabOnID = "vdpTab-"+elementid;

	parentTabOffID = "vdpTab-"+gPrevDivID;
	tabOffID = "vdpTab_detail-"+gPrevDivID;

	var objParentTabOnID = document.getElementById(parentTabOnID);
	var objTabOnID = document.getElementById(tabOnID);

	var objParentTabOffID = document.getElementById(parentTabOffID);
	var objTabOffID = document.getElementById(tabOffID);

	if (gPrevDivID == elementid){
		return false;
	} 
	else{
		objTabOnID.style.display = "block";
		objParentTabOnID.className = 'current';
	
		objTabOffID.style.display = "none";
		objParentTabOffID.className = 'notCurrent';
	}
	gPrevDivID = elementid;
}

	