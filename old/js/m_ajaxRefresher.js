
var debugEnabled = false;

var zip, miles;

function getDebugWindow() {
   if (!("jsDebugWindow" in window) || window.jdDebugWindow.closed) {
      debugWindow = window.open('/jsConsole.html', 'AJAX_DEBUG', 'toolbar=no,location=no,directories=no,status=no,menubar=no,resizable=yes,copyhistory=no,scrollbars=yes,width=800,height=200');
      if (!debugWindow.opener) {
         debugWindow.opener = self;
      }

      if (window.ActiveXObject) {
         while ( debugWindow.document.readyState != 'complete' ) {
            // wait for window to be ready
         }
      }
      window.jsDebugWindow = debugWindow;
   }

   return window.jsDebugWindow;
}

function showDebug(debugMessage) {
  // if ( console ) {
  //    console.log(debugMessage);
  // }

   if ( debugEnabled ) {
      var messageWindow = getDebugWindow();
      if (messageWindow && !messageWindow.closed && messageWindow.logConsole) {
         messageWindow.logConsole.warn(debugMessage);
      }
   }
   return false;
}

function getQueryVariable(variable, url) {
  var query = url.split('?')[1];
  if (query) {
  	  var vars = query.split("&");
	  for (var i=0;i<vars.length;i++) {
	    var pair = vars[i].split("=");
	    if (pair[0] == variable) {
	      return pair[1];
	    }
	  }
  }
  showDebug( 'Query Variable ' + variable + ' not found' );
  return "";
}

function loadJSON( url, callback, params ) {
   var request;
   if ( window.XMLHttpRequest ) {
      request = new XMLHttpRequest();
   } else if ( window.ActiveXObject ) {
      request = new ActiveXObject("Microsoft.XMLHTTP");
   }

   if ( request ) {
      request.onreadystatechange = function() {
         processJSON( request, callback, params );
      };
      showDebug( 'Sending request: ' + callback );
      try {
         request.open( 'GET', url, true );
      } catch (e) {
        alert(e);
      }

      if ( window.XMLHttpRequest ) {
         request.send(null);
      } else if ( window.ActiveXObject ) {
         request.send();
      }
   }
}

function processJSON( request, callback, params ) {
   if ( !request ) {
      showDebug( 'ERROR - FAILED TO FIND REQUEST OBJECT: ' + callback);
   } else {
      //showDebug( 'ProcessStateChange executed: ' + callback+ ' - readyState:' + request.readyState );

      if ( request.readyState == 4 ) {
         // only if "OK"
         if ( request.status != 200 ) {
            showDebug( 'ERROR - UNABLE TO RETRIEVE XML DATA: ' + callback+ ' - ' + request.readyState + ':' + request.status + ':' + escape(request.statusText) );
         } else {
            showDebug( 'Processing response: ' + callback+ ' - ' + request.readyState + ':' + request.status + ':' + escape(request.statusText) );
            //showDebug( 'Response text: ' + escape(request.responseText) );
            var responseString = request.responseText;
            if ( responseString != null && responseString.indexOf('LoginPortletForm') != -1 ) {
               if ( typeof getHomePageUrl != 'undefined' ) {
                  window.location.href = getHomePageUrl();
               } else if ( typeof parent.getHomePageUrl != 'undefined' ) {
                  parent.location.href = parent.getHomePageUrl();
               }
            } else {
               if ( responseString == null ) {
                  showDebug( 'ERROR - RESPONSE TEXT IS NULL: ' + callback );
               } else {
                  // execute callback
                  eval( callback + '(' + responseString + ', params)' );
               }
            }
         }
      }
   }
}

function loadXMLDoc( url, elementKey, formName ) {

   showDebug( 'Generating request: form:' + formName + ', elementKey:' + elementKey + ', URL:' + url );

   zip = getQueryVariable('zip', url);
   miles = getQueryVariable('miles', url);

   // branch for native XMLHttpRequest object
   if ( window.XMLHttpRequest ) {
      var request = new XMLHttpRequest();
      request.onreadystatechange = function() {
         processStateChange( request, elementKey, formName );
      };
      showDebug( 'Sending request: ' + elementKey );
      try {
        request.open( 'GET', url, true );
      } catch (e) {
        alert(e);
      }
      request.send(null);
   // branch for IE/Windows ActiveX version
   } else if ( window.ActiveXObject ) {
      var request = new ActiveXObject("Microsoft.XMLHTTP");
      if ( request ) {
         request.onreadystatechange = function() {
            processStateChange( request, elementKey, formName );
         };
         showDebug( 'Sending request: ' + elementKey );
         request.open( 'GET', url, true );
         request.send();
      }
   }
}

function processStateChange( request, elementKey, formName ) {
   if ( !request ) {
      showDebug( 'ERROR - FAILED TO FIND REQUEST OBJECT: ' + elementKey );
   } else {
      //showDebug( 'ProcessStateChange executed: ' + elementKey + ' - readyState:' + request.readyState );

      if ( request.readyState == 4 ) {
         // only if "OK"
         if ( request.status != 200 ) {
            showDebug( 'ERROR - UNABLE TO RETRIEVE XML DATA: ' + elementKey + ' - ' + request.readyState + ':' + request.status + ':' + escape(request.statusText) );
         } else {
            showDebug( 'Processing response: ' + elementKey + ' - ' + request.readyState + ':' + request.status + ':' + escape(request.statusText) );
            //showDebug( 'Response text: ' + escape(request.responseText) );
            var responseString = request.responseText;
            if ( responseString != null && responseString.indexOf('LoginPortletForm') != -1 ) {
               if ( typeof getHomePageUrl != 'undefined' ) {
                  window.location.href = getHomePageUrl();
               } else if ( typeof parent.getHomePageUrl != 'undefined' ) {
                  parent.location.href = parent.getHomePageUrl();
               }
            } else {
               responseXml = request.responseXML;

               if ( responseXml == null ) {
                  showDebug( 'ERROR - RESPONSE XML IS NULL: ' + elementKey );
               } else {
                  var pageElement = null;
                  if ( formName ){
                     var pageForm = document.forms[formName];
                     if ( pageForm == null ) {
                        showDebug( 'ERROR - UNABLE TO FIND FORM: ' + formName );
                     } else {
                        var formElement = pageForm.elements[elementKey];
                        if ( formElement == null ) {
                           showDebug( 'ERROR - UNABLE TO FIND FORM ELEMENT: ' + formName + '.' +elementKey );
                        } else {
                          pageElement = formElement;
                        }
                     }
                  } else {
                     var docElement = document.getElementById(elementKey);
                     if (docElement == null) {
                        showDebug( 'ERROR - UNABLE TO FIND DOCUMENT ELEMENT BY ID: ' + elementKey );
                     } else {
                        pageElement = docElement;
                     }
                  }

                  updatePageElement( pageElement, responseXml, responseString );
               }
            }
         }
      }
   }
}

function updatePageElement( pageElement, xml, text ) {
   if ( pageElement != null ) {
      if ( pageElement.nodeName.toUpperCase() == 'SELECT' ) {
         // if updating a SELECT element
         showDebug( 'UPDATING SELECT ELEMENT' );
         updateFormOptions( pageElement, xml );
      } else if ( pageElement.nodeName.toUpperCase() == 'UL' || pageElement.nodeName.toUpperCase() == 'OL' ) {
         // if updating a UL/OL element
         showDebug( 'UPDATING UL/OL ELEMENT' );
         updateDocumentList( pageElement, xml );
      } else if ( pageElement.nodeName.toUpperCase() == 'DIV' ) {
         // if updating a DIV element
         showDebug( 'UPDATING DIV ELEMENT' );
         updateDiv( pageElement, xml, text );
      } else if ( /.*bidBuy.*/.test(pageElement.id) ) {
         // if updating bid/buy pricing on either the results or details page
         showDebug( 'UPDATING PRICING ELEMENT' );
         updateBidBuy( pageElement, xml );
      }
   }
}

function updateFormOptions( optionElement, xml ) {
   var newOptions = xml.getElementsByTagName( 'OPTION' );
   var newValues = xml.getElementsByTagName( 'VALUE' );
   showDebug( 'Processing new options: ' + optionElement.id + ' - Options:' + newOptions.length + ', Values:' + newValues.length );

   showDebug( 'Clearing existing options: ' + optionElement.id );
   optionElement.options.length = 0;

   for ( i = 0; i < newOptions.length; i++ ) {
      var newOption = document.createElement('option');
      if ( newValues[i].firstChild != null ) {
         newOption.text = newOptions[i].firstChild.data;
         newOption.value = newValues[i].firstChild.data;

         //showDebug( 'Adding option: ' + optionElement.id + ' - ' + escape(newOption.text) + ':' + escape(newOption.value) );
         optionElement.options.add(newOption);
      } else {
         showDebug( 'Option not added, value was null: ' + optionElement.id );
      }
   }
}

function updateDocumentList( ulElement, xml ) {
   var newListItems = xml.getElementsByTagName( 'LI' );
   showDebug( 'Processing new list items: ' + ulElement.id + ' - ListItems:' + newListItems.length );

   var listId = ulElement.id;
   showDebug( 'Clearing existing list items for: ' + listId + '; length:' + newListItems.length);
   ulElement.innerHTML = '';

   for ( i = 0; i < newListItems.length; i++ ) {
      var newListItem = newListItems[i];
      var newLI = document.createElement('li');
      if ( newListItems[i].firstChild != null) {
         var data = newListItems[i].firstChild;
         showDebug( 'data: ' + data );
	     if ( listId.substring(0,22) == 'browseAuctionsPerState' ) {
	     	var label = newListItem.getElementsByTagName('LABEL')[0].firstChild.data;
	       	var value = newListItem.getElementsByTagName('VALUE')[0].firstChild.data;
	       	if (label != 'ALL') {
	            newLI.innerHTML = '<a href="javascript:browseAuction(\'' + value + '\')">' + label + '</a>';

	            showDebug( 'Adding list item for: ' + newLI.innerHTML );
	            ulElement.appendChild(newLI);
			}
	     } else if ( listId == 'browseStates' ) {
	       	var label = newListItem.getElementsByTagName('LABEL')[0].firstChild.data;
	       	var value = newListItem.getElementsByTagName('VALUE')[0].firstChild.data;
	       	if (label != 'ALL') {
	            newLI.innerHTML = ' <a href="javascript:showPanelItem(\'states-' + i + '\'); ' +
	                              '                     reloadPage(\'browseAuctionsPerState-' + i + '\', \'' + value + '\')"> ' +
	                              '    <span>' + label + '</span></a> ' +
	                              ' <ul id="browseAuctionsPerState-' + i + '" class="tier1"></ul> ';
	            newLI.id = 'panelItem-states-' + i;

	            showDebug( 'Adding list item for: ' + newLI.innerHTML );
	            ulElement.appendChild(newLI);
	        }
	     } else if ( listId == 'browseMakes' ) {
	      	var label = newListItem.getElementsByTagName('LABEL')[0].firstChild.data;
	       	var value = newListItem.getElementsByTagName('VALUE')[0].firstChild.data;
	       	if (label != 'ALL') {
	             newLI.innerHTML = ' <a href="javascript:browseMake(\'' + value + '\');"> ' +
	                               '    <span>' + label + '</span></a> ';

	             showDebug( 'Adding list item for: ' + newLI.innerHTML );
	             ulElement.appendChild(newLI);
	        }
	     } else if ( listId.substring(0,5) == 'rlist' ) {
	      	var refId = newListItem.getElementsByTagName('REFID')[0].firstChild.data;
	      	var refNme = newListItem.getElementsByTagName('REFNAME')[0].firstChild.data;
	       	var refQry = newListItem.getElementsByTagName('REFQUERY')[0].firstChild.data;
	        var refCnt = newListItem.getElementsByTagName('REFCOUNT')[0].firstChild.data;
	        addRefinement( ulElement, refId, refNme, refQry, refCnt, zip, miles, false, newListItems.length, i );
	     }
      } else {
         showDebug( 'List not added, value was null: ' + ulElement.id );
      }
   }
}

function updateDiv( divElement, xml, text ) {
   var newOptions = xml.getElementsByTagName( 'OPTION' );
   var newValues = xml.getElementsByTagName( 'VALUE' );
   showDebug( 'Processing new div content: ' + divElement.id + ' - Options:' + newOptions.length + ', Values:' + newValues.length );

   showDebug( 'Clearing existing content for: ' + divElement.id);
   divElement.innerHTML = '';

   if ( divElement.id == 'modelList' ) {
      for ( i = 0; i < newOptions.length; i++ ) {
         if ( newValues[i].firstChild != null ) {
            var newElement = document.createElement('label');
            newElement.innerHTML = '<input type="checkbox" name="model" value="' + newValues[i].firstChild.data + '" class="checkbox" onclick="toggleAllCheckbox(this, \'modelList\');">' + newOptions[i].firstChild.data + '</label>';
            divElement.appendChild(newElement);
         }
      }
   } else if ( divElement.id == 'stateList' ) {
      for ( i = 0; i < newOptions.length; i++ ) {
         if ( newValues[i].firstChild != null ) {
            var newElement = document.createElement('label');
            newElement.innerHTML = '<input type="checkbox" name="state" value="' + newValues[i].firstChild.data + '" class="checkbox" onclick="toggleAllCheckbox(this, \'stateList\');">' + newOptions[i].firstChild.data + '</label>';
            divElement.appendChild(newElement);
         }
      }
   } else if ( divElement.id == 'savedSearches' ) {
      var contentElement = xml.getElementsByTagName( 'SSCONTENT' );
      var content = contentElement[0].firstChild.data;
   	  divElement.innerHTML = content;

      var countElement = xml.getElementsByTagName( 'SSCOUNT' );
      var count = countElement[0].firstChild.data;

	  var ssCount = document.getElementById('savedSearchesCount1');
      if ( ssCount ) {
      	ssCount.innerHTML = count;
      }
      ssCount = document.getElementById('savedSearchesCount2');
      if ( ssCount ) {
      	ssCount.innerHTML = count;
      }
   }
}

function updateBidBuy( bidBuyElement, xml ) {
   var vinElement = xml.getElementsByTagName( 'VIN' );
   var bidPriceElement = xml.getElementsByTagName( 'BIDPRICE' );
   var buyNowPriceElement = xml.getElementsByTagName( 'BUYNOWPRICE' );

   showDebug( 'Processing new pricing content: ' + bidBuyElement.id + ' bidPrice:' + bidPriceElement[0].firstChild.data + ', buyNowPrice:' + buyNowPriceElement[0].firstChild.data );
   var vin = vinElement[0].firstChild.data;
   var bidPrice = bidPriceElement[0].firstChild.data;
   var buyNowPrice = buyNowPriceElement[0].firstChild.data;
   if ( bidPrice == 'null' ) { bidPrice = ''; }
   if ( buyNowPrice == 'null' ) {  buyNowPrice = ''; }

   showDebug( 'Clearing existing content for: ' + bidBuyElement.id );
   bidBuyElement.innerHTML = '';
   if ( /.*Results.*/.test(bidBuyElement.id) ) {
      updateResultsPricing(bidBuyElement, vin, bidPrice, buyNowPrice);
   } else if ( /.*Details.*/.test(bidBuyElement.id) ) {
      updateDetailsPricing(bidBuyElement, vin, bidPrice, buyNowPrice);
   }
}

function updateResultsPricing (bidBuyElement, vin, bidPrice, buyNowPrice) {
   var pricesHtml = '';
   if (bidPrice != '') {
      pricesHtml = '<label>Current Bid:</label>' + bidPrice;
   }
   if (pricesHtml != '' && buyNowPrice != '') {
      pricesHtml += ' / ';
   }
   if (buyNowPrice != '') {
      pricesHtml += '<label>Buy Now:</label>' + buyNowPrice;
   }
   bidBuyElement.innerHTML = pricesHtml;
}

function updateDetailsPricing (bidBuyElement, vin, bidPrice, buyNowPrice) {
   var pricesHtml = '';
   if (bidPrice != '') {
      pricesHtml = '<p class="odd"><label>Current Bid:</label>' + bidPrice + '</p>';
   }
   pricesHtml += '<p><span class="buyBid';
   if (bidPrice == '') {
      pricesHtml += ' noCurrentBid';
   }
   pricesHtml += '">';
   pricesHtml += '<a class="btnUpdatePrice"  href="javascript:updatePrice(\'bidBuyDetails\', \'' + vin + '\')"><span>Update Pricing</span></a>';
   pricesHtml += '</span>';
   if (buyNowPrice != '') {
      pricesHtml += '<label>Buy Now:</label>' + buyNowPrice;
   }
   pricesHtml += '</p>';
   bidBuyElement.innerHTML = pricesHtml;
}
