/*
 *   JS used to submit and validate search form
 */

    var initForm = false;
    function initializeForm() {
        var makes = getAllSelections('makeList');
        if ( makes != null && makes[0] != 'ALL' ) {
            initForm = true;
            var preSelectedModels = getCookieValue('manheim.powersearch.model').split('|');
            reloadAllModels(makes, preSelectedModels, '');
        }
    }

    function concatArrays( array1, array2 ) {
        if ( array1 != null ){
            if (array2 != null){
                for ( var i = 0; i < array2.length; i++ ) {
                    array1[array1.length] = array2[i];
                }
            }
            return array1;
        } else if ( array2 != null ) {
            return array2;
        }

         return new Array();
    }

  //  function reloadToYears( formElement ) {
  //      var fromYear = document.getElementById('year_begin').value;
  //      url = 'json.php?mode=year&fromYear=' + fromYear;
 //       loadXMLDoc(url, 'toYear', formElement.name);
 //   }

    var executeTrimAjax = true;
    function reloadAllTrims( makes, models, defaults, inventory ) {
        if ( executeTrimAjax ) {
            if ( makes.length == 0 || makes[0] == 'ALL' || models.length == 0 || models[0] == 'ALL' ) {
                var trimList = document.getElementById('trimList');
                trimList.innerHTML = '';
                trimList.appendChild(createTrimCheck(allLabel, 'ALL'));
            } else {
                var ajaxUrl = '/manheim/json.php?mode=trims&inventory=' + inventory;
                for (var i = 0; i < makes.length; i++) {
                    ajaxUrl += '&make=' + makes[i];
                }
                for (var i = 0; i < models.length; i++) {
                    ajaxUrl += '&model=' + models[i];
                }
                //alert(ajaxUrl);
                loadJSON( ajaxUrl, 'showTrims', concatArrays( defaults, getAllSelections('trimList') ) );
            }
        }
    }

    function showTrims( trimInfo, extraParams ) {
        var trimData = trimInfo.trims;
		
        var trimList = document.getElementById('trimList');
        showDebug( 'Clearing existing content for: ' + trimList.id);
        trimList.innerHTML = '';
        for ( i = 0; i < trimData.length; i++ ) {
            trimList.appendChild(createTrimCheck(trimData[i].label, trimData[i].value));
        }

        setAllChecked('trimList', true, extraParams);
    }

    function createTrimCheck( label, value ) {
                  //alert(label);
    
        var itemElement = document.createElement('li');
        //var labelElement = document.createElement('label');
        var checkbox = document.createElement('input');
        checkbox.id = value;
        checkbox.type = 'checkbox';
        checkbox.name = 'series';
        checkbox.className = 'checkbox';
        checkbox.value = value;
        checkbox.onclick = function() {
            toggleAllCheckbox(this, 'trimList');
        };

        //labelElement.appendChild(checkbox);
        //labelElement.appendChild(document.createTextNode(unescape(label)));
       // itemElement.appendChild(labelElement);

        return itemElement;
    }

    var executeModelAjax = true;
    function reloadAllModels( makes, defaults, inventory ) {
        if ( executeModelAjax ) {
            if ( makes.length == 0 || makes[0] == 'ALL' ) {
                var modelList = document.getElementById('modelList');
                modelList.innerHTML = '';
                modelList.appendChild(createModelCheck(allLabel, 'ALL'));
            } else {
                var ajaxUrl = '/manheim/json.php?mode=models&inventory=' + inventory;
                for (var i = 0; i < makes.length; i++) {
                    ajaxUrl += '&make=' + makes[i];
                }
                loadJSON( ajaxUrl, 'showModels', concatArrays( defaults, getAllSelections('modelList') ) );
            }
        }
    }

    var modelData = null;

    function showModels( modelInfo, extraParams ) {
        modelData = modelInfo.models;

        var modelList = document.getElementById('modelList');
        showDebug( 'Clearing existing content for: ' + modelList.id);
        modelList.innerHTML = '';

        for ( i = 0; i < modelData.length; i++ ) {
            modelList.appendChild(createModelCheck(modelData[i].label, modelData[i].value));
        }

        setAllChecked('modelList', true, extraParams, false);

        var trimDefaults = null;
        if ( initForm ) {
            var trimDefaults = getCookieValue('manheim.powersearch.trim').split('|');
            initForm = false;
        }

        reloadAllTrims(getAllSelections('makeList'), getAllSelections('modelList'), trimDefaults, '');
    }

    function createModelCheck( label, value ) {
        var itemElement = document.createElement('li');
        var labelElement = document.createElement('label');
        var checkbox = document.createElement('input');
        checkbox.id = value;
        checkbox.type = 'checkbox';
        checkbox.name = 'model';
        checkbox.className = 'checkbox';
        checkbox.value = value;
        checkbox.onclick = function() {
            if ( this.value == 'ALL' ) {
                executeTrimAjax=false;
            }
            toggleAllCheckbox(this, 'modelList');
            if ( this.value == 'ALL' ) {
                executeTrimAjax=true;
            }
            reloadAllTrims(getAllSelections('makeList'), getAllSelections('modelList'), null, '');
            //toggleModels(this);
        };

        labelElement.appendChild(checkbox);
        labelElement.appendChild(document.createTextNode(unescape(label)));
        itemElement.appendChild(labelElement);

        return itemElement;
    }

    function toggleModels( checkbox ) {
        if ( modelData != null ) {
            for ( i = 0; i < modelData.length; i++ ) {
                if ( modelData[i].value == checkbox.value ) {
                    if ( modelData[i].parentId > 0 ) {
                        var parentCheck = document.getElementById(modelData[i].parentId );
                        if ( parentCheck != null ) {
                            parentCheck.checked = false;
                        }
                    }
                    if ( modelData[i].childIds != null && modelData[i].childIds.length > 0 ) {
                        for ( var j = 0 ; j < modelData[i].childIds.length; j++ ) {
                            var childCheck = document.getElementById(modelData[i].childIds[j] );
                            if ( childCheck != null ) {
                                childCheck.checked = checkbox.checked;
                            }
                        }
                    }
                    break;
                }
            }
        }
    }

    function writeModelCookie() {
        document.cookie = 'manheim.powersearch.model=' + getAllSelections('modelList').join('|') + '; path=/;';
    }

    function writeTrimCookie() {
        document.cookie = 'manheim.powersearch.trim=' + getAllSelections('trimList').join('|') + '; path=/;';
    }

    function getCookieValue( cookieName ) {
        var cookieValue = '';
        if (document.cookie.length > 0) {
            var startIndex = document.cookie.indexOf(cookieName + '=');
            if (startIndex != -1) {
                startIndex = startIndex + cookieName.length + 1;
                var endIndex = document.cookie.indexOf(';', startIndex);
                if (endIndex == -1) {
                    endIndex = document.cookie.length;
                }
                cookieValue = document.cookie.substring(startIndex, endIndex);
            }
        }

        return cookieValue;
    }

    function submitSearch( newSearch ) {
        document.searchForm.submittedQstr.value = '';
        if ( validateForm() ) {
            if ( newSearch ) {
                //clearRefinementCookies(document.cookie);
                writeModelCookie();
                writeTrimCookie();
            }

            document.searchForm.newSort.value = false;
            document.searchForm.searchOperation.value = 'Search';
            document.searchForm.action = 'searchSubmit.do';
            document.searchForm.submit();
        }
    }

    function validateForm() {
        var valid = validateSaleDate();
        return valid;
    }

    function validateSaleDate() {
        var saleDateField = document.getElementById('saleDate');
        if ( saleDateField != null ) {
            saleDateField.value = saleDateField.value.trim();
            if ( saleDateField.value == '' || saleDateField.value == defaultSaleDateText ) {
                saleDateField.value = '';
            } else if ( saleDateField.value.length != 10 || isNaN(saleDateField.value.substring(0, 2)) || isNaN(saleDateField.value.substring(3, 5)) || isNaN(saleDateField.value.substring(6)) ) {
                // Format = MM/DD/YYYY
                saleDateField.select();
                alert(saleDateErrMsg);
                return false;
            } else {
                var oldestDate = new Date();
                oldestDate.setDate(oldestDate.getDate() - 1);

                var day = saleDateField.value.substring(3, 5);
                var month = saleDateField.value.substring(0, 2);
                var year = saleDateField.value.substring(6);

                var selectedDate = new Date();
                selectedDate.setFullYear(year, month - 1, day);

                if ( selectedDate < oldestDate ) {
                    saleDateField.select();
                    alert(saleDateErrMsg);
                    return false;
                }
            }
        }
        return true;
    }

    function validateSaveSearchForm() {
        var valid = validateSearchName();
        valid = valid && validatePhoneNumber();
        valid = valid && validateNotification();
        return valid;
    }

    function validateSearchName() {
        var nameField = document.getElementById('searchName');
        if ( nameField != null ) {
            nameField.value = nameField.value.trim();
            if (nameField.value == '') {
                nameField.focus();
                alert(nameRequiredMsg);
                return false;
            }
        }
        return true;
    }

    function validateNotification() {
        var format = document.getElementById('searchForm').emailFormat;
        if ( format != null ) {
           for ( var i = 0; i < format.length; i++ ) {
              if ( format[i].checked ) {
                 if ( format[i].value == 'T' ) {
                     var emailAddress = document.getElementById('emailAddress');
                     if ( emailAddress != null && (emailAddress.value == '' || emailAddress.value.indexOf('@') == -1) ) {
                         emailAddress.focus();
                         alert(emailRequiredMsg);
                         return false;
                     }
                 } else if ( format[i].value == 'S' ) {
                     var phoneNumber = document.getElementById('phone');
                     if ( phoneNumber != null && phoneNumber.value == '' ) {
                         phoneNumber.focus();
                         alert(phoneRequiredMsg);
                         return false;
                     }
                     var provider = document.getElementById('sms');
                     if ( provider != null && provider.value == '' ) {
                         provider.focus();
                         alert(providerRequiredMsg);
                         return false;
                     }
                 }
              }
           }
        }
        return true;
    }

    function validatePhoneNumber() {
        var phoneField = document.getElementById('phone');
        if ( phoneField != null ) {
            phoneField.value = phoneField.value.trim();
            if ( phoneField.value == '' || phoneField.value == defaultPhoneText ) {
                phoneField.value = '';
            } else {
                phoneField.value = phoneField.value.replace( /-/g, '' );
                if ( phoneField.value.length != 10 || isNaN(phoneField.value) ) {
                    phoneField.select();
                    alert(phoneErrMsg);
                    return false;
                }
            }
        }
        return true;
    }

    // enable/disable form elements as user selects different
    // notification types on the saved search form
    function chgNotify(obj) {
        // email
        if (obj == 'T') {
            document.getElementById('notificationEnabled').value = 'true';
            document.getElementById('emailAddress').className = '';
            document.getElementById('emailAddress').disabled = false;
            document.getElementById('phone').className = 'disabledText';
            document.getElementById('phone').disabled = true;
            document.getElementById('sms').disabled = true;
            document.getElementById('sms').className = 'disabledText';
            document.getElementById('emailAddress').focus();
        // sms
        } else if (obj == 'S') {
            document.getElementById('notificationEnabled').value = 'true';
            document.getElementById('emailAddress').className = 'disabledText';
            document.getElementById('emailAddress').disabled = true;
            document.getElementById('phone').className = '';
            document.getElementById('phone').disabled = false;
            document.getElementById('phone').className = '';
            document.getElementById('sms').disabled = false;
            document.getElementById('sms').className = '';
            document.getElementById('phone').focus();
        // none
        } else {
            document.getElementById('alertTo').checked = true;
            document.getElementById('notificationEnabled').value = 'false';
            document.getElementById('emailAddress').className = 'disabledText';
            document.getElementById('emailAddress').disabled = true;
            document.getElementById('phone').className = 'disabledText';
            document.getElementById('phone').disabled = true;
            document.getElementById('sms').disabled = true;
            document.getElementById('sms').className = 'disabledText';
        }
    }

    function clearSearchForm() {
        resetSearchForm(true);

        setChecked('vehicleTypes', true, vehicleTypeIdCar);
        setChecked('vehicleTypes', true, vehicleTypeIdTruck);
        setChecked('vehicleTypes', true, vehicleTypeIdSUV);
        setChecked('vehicleTypes', true, vehicleTypeIdVan);
    }

    function resetSearchForm( refreshAll ) {
        document.getElementById('searchForm').reset();

        if ( refreshAll ) {
            var sortElement = document.getElementById('sort');
            if ( sortElement != null ) {
                sortElement.value = '';
            }

            setOptions('vehicleType', 0);
            setChecks('vehicleTypes', false);

            reloadToYears( document.getElementById('searchForm') );
            setOptions('year_begin', defaultFromYearIndex);
            setOptions('year_end', 0);
            setChecks('makeList', false);
            setChecks('modelList', false);
            setChecks('trimList', false);

            setChecks('odometerList', false);
            setChecks('extColorList', false);

            setChecks('onlyWithPhoto', false);
            setChecks('onlyWithECR', false);

            clearAdvancedOptions();

            setChecks('regionList', false);
            setChecks('stateList', false);
            setChecks('locationList', false);

            toggleElements('regionList', true);
            toggleElements('stateList', true);
            toggleElements('locationList', true);

            setChecks('sellerList', false);
            setChecks('inventoryList', false);

            document.getElementById('saleDate').value = '';
        }

        showHideAdvancedOptions();

        if ( document.getElementById('makeList') != null ) {
            reloadAllModels(getAllSelections('makeList'), null, '');

            if ( document.getElementById('modelList') != null ) {
                reloadAllTrims(getAllSelections('makeList'), getAllSelections('modelList'), null, '');
            }
        }

        if ( document.getElementById('saleDate').value == '' ) {
            document.getElementById('saleDate').value = defaultSaleDateText;
        }
    }

    function clearAdvancedOptions() {
        setChecks('mmrList', false);
        setChecks('conditionList', false);
        setChecks('driveTrainList', false);
        setChecks('transList', false);
        setChecks('engineList', false);
        setChecks('intColorList', false);
        setChecks('topList', false);
        setChecks('intTypeList', false);
        setChecks('doorsList', false);
    }

    function toggleAllCheckbox( checkbox, containerId ) {
        if ( checkbox.value == 'ALL' ) {
            // check or uncheck all checkboxes
            setChecks(containerId, checkbox.checked)
        } else if ( !checkbox.checked ) {
            // uncheck 'ALL' option if checked
            var container = document.getElementById(containerId);
            var ifields = container.getElementsByTagName('input');
            for (var i = 0; i < ifields.length; i++) {
                if (ifields[i].value == 'ALL') {
                    ifields[i].checked = false;
                    break;
                }
            }
        }

        return false;
    }

    function toggleLocationElements( containerId ) {
        var selections = getAllSelections(containerId);

        if ( containerId != 'regionList' ) {
            toggleElements('regionList', selections.length == 0);
        }
        if ( containerId != 'stateList' ) {
            toggleElements('stateList', selections.length == 0);
        }
        if ( containerId != 'locationList' ) {
            toggleElements('locationList', selections.length == 0);
        }
    }

    /*
    function toggleRegionRelations() {
        var stateIds = getAllChildren( getAllSelections('regionList'), regionStates );
        enableElements( 'stateList', stateIds );

        var locationIds = getAllChildren( stateIds, stateAuctions )
        enableElements( 'locationList', locationIds );
    }

    function toggleStateRelations() {
        var stateIds = getAllSelections('stateList');
        enableElements( 'regionList', getAllParents( stateIds, regionStates ) );
        enableElements( 'locationList', getAllChildren( stateIds, stateAuctions ) );
    }

    function toggleLocationRelations() {
        var stateIds = getAllParents( getAllSelections('locationList'), stateAuctions );
        enableElements( 'stateList', stateIds );
        enableElements( 'regionList', getAllParents( stateIds, regionStates ) );
    }

    function getAllParents( children, relations ) {
        var parents = new Array();
        for ( var i = 0; i < relations.length; i++ ) {
            for (var j = 0; j < relations[i].childIds.length; j++) {
                for ( var k = 0; k < children.length; k++ ) {
                    if ( relations[i].childIds[j] == children[k] ) {
                        parents[parents.length] = relations[i].parentId;
                    }
                }
            }
        }
        return parents;
    }

    function getAllChildren( parents, relations ) {
        var children = new Array();
        for ( var i = 0; i < relations.length; i++ ) {
            for ( var j = 0; j < parents.length; j++ ) {
                if ( relations[i].parentId == parents[j] ) {
                    for ( var k = 0; k < relations[i].childIds.length; k++ ) {
                        children[children.length] = relations[i].childIds[k];
                    }
                }
            }
        }
        return children;
    }

    function enableElements( containerId, values ) {
        var container = document.getElementById(containerId);
        if ( container != null ) {
            var ifields = container.getElementsByTagName('input');
            for (var i = 0; i < ifields.length; i++) {
                var disable = true;
                if ( values == null || values.length == 0 ) {
                    disable = false;
                } else {
                    for (var j = 0; j < values.length; j++) {
                        if ( ifields[i].value == values[j] ) {
                            disable = false;
                            break;
                        }
                    }
                }

                ifields[i].disabled = disable;
            }
        }
    }
    */

    /*
    function toggleParentChild( checkbox, relations, containerId ) {
        var parentValue = checkbox.value;
        for ( var i = 0; i < relations.length; i++ ) {
            if ( parentValue == relations[i].parentId ) {
                var container = document.getElementById(containerId);
                var ifields = container.getElementsByTagName('input');
                for (var j = 0; j < ifields.length; j++) {
                    var childValue = ifields[j].value;
                    for (var k = 0; k < relations[i].childIds.length; k++) {
                        if (relations[i].childIds[k] == childValue) {
                            if ( ifields[j].checked != checkbox.checked ) {
                                ifields[j].click();
                            }
                            break;
                        }
                    }
                }
                break;
            }
        }

        return false;
    }
    */
    /*
    function toggleChildParent( checkbox, relations, containerId ) {
        if ( !checkbox.checked ) {
            var childValue = checkbox.value;
            for ( var i = 0; i < relations.length; i++ ) {
                var parentId = relations[i].parentId;
                for (var j = 0; j < relations[i].childIds.length; j++) {
                    if ( relations[i].childIds[j] == childValue ) {
                        var container = document.getElementById(containerId);
                        var ifields = container.getElementsByTagName('input');
                        for (var k = 0; k < ifields.length; k++) {
                            if ( ifields[k].value == parentId ) {
                                ifields[k].checked = false;
                                break;
                            }
                        }
                        break;
                    }
                }
            }
        }

        return false;
    }
    */

    function setOptions(elementId, optionIndex) {
        var container = document.getElementById(elementId);
        if ( container != null && optionIndex >= 0 ) {
            if ( container.nodeName.toUpperCase() == 'SELECT' && container.options.length > optionIndex ) {
                container.options[optionIndex].selected = true;
            }

            var selectFields = container.getElementsByTagName('select');
            for (var i = 0; i < selectFields.length; i++) {
                if ( selectFields[i].options.length > optionIndex ) {
                    selectFields[i].options[optionIndex].selected = true;
                }
            }
        }
    }

    // Finds all SELECT or INPUT tags within the specified element
    // and returns the values of all that are currently selected
    function getAllSelections(elementId) {
        var selectedValues = new Array();

        var container = document.getElementById(elementId);
        if ( container != null ) {
            if ( container.nodeName.toUpperCase() == 'SELECT' ) {
                for (var i = 0; i < container.options.length; i++) {
                    if ( container.options[i].selected ) {
                        selectedValues[selectedValues.length] = container.options[i].value;
                    }
                }
            }

            if ( container.nodeName.toUpperCase() == 'INPUT' ) {
                if ( container.checked ) {
                    selectedValues[selectedValues.length] = container.value;
                }
            }

            var ifields = container.getElementsByTagName('input');
            for (var i = 0; i < ifields.length; i++) {
                if ( ifields[i].checked ) {
                    selectedValues[selectedValues.length] = ifields[i].value;
                }
            }
        }

        return selectedValues;
    }

    // Finds a SELECT or INPUT tag with the specified values
    // and makes sure it is selected or unselected depending
    // on the isChecked parameter
    function setAllChecked(elementId, isChecked, itemValues, executeClick) {
        for (var i = 0; i < itemValues.length; i++) {
            setChecked(elementId, isChecked, itemValues[i], executeClick)
        }
    }

    // Finds a SELECT or INPUT tag with the specified value
    // and makes sure it is selected or unselected depending
    // on the isChecked parameter
    function setChecked(elementId, isChecked, itemValue, executeClick) {
        var container = document.getElementById(elementId);
        if ( container != null ) {
            if ( container.nodeName.toUpperCase() == 'SELECT' ) {
                if ( isChecked ) {
                    for (var i = 0; i < container.options.length; i++) {
                        if ( container.options[i].value == itemValue ) {
                            container.options[i].selected = isChecked;
                        }
                    }
                } else {
                    container.options[0].selected = true;
                }
            }

            if ( container.nodeName.toUpperCase() == 'INPUT' ) {
                if ( container.checked != isChecked && container.value == itemValue ) {
                    if ( typeof executeClick == 'undefined' || executeClick == true ) {
                        container.click();
                    } else {
                        container.checked = isChecked;
                    }
                }
            }

            var ifields = container.getElementsByTagName('input');
            for (var i = 0; i < ifields.length; i++) {
                if ( ifields[i].checked != isChecked && ifields[i].value == itemValue ) {
                    if ( typeof executeClick == 'undefined' || executeClick == true ) {
                        ifields[i].click();
                    } else {
                        ifields[i].checked = isChecked;
                    }
                }
            }
        }
    }

    // Finds all SELECT or INPUT tags within the specified element
    // and makes sure they are selected or unselected depending
    // on the isChecked parameter
    function setChecks(elementId, isChecked) {
        var container = document.getElementById(elementId);
        if ( container != null ) {
            if ( container.nodeName.toUpperCase() == 'SELECT' && !isChecked ) {
                container.options[0].selected = true;
            }

            if ( container.nodeName.toUpperCase() == 'INPUT' ) {
                if ( container.checked != isChecked ) {
                    container.click();
                }
            }

            var ifields = container.getElementsByTagName('input');
            for (var i = 0; i < ifields.length; i++) {
                if ( ifields[i].checked != isChecked ) {
                    ifields[i].click();
                }
            }
        }
    }

    // Was used to enable/disable form elements within a specified element
    function toggleElements(elementId, enabled) {
        var element = document.getElementById(elementId);

        if (element != null) {
            if (enabled) {
                element.className = element.className.replace( /\sdisabledText/g, '');
            } else {
                element.className += ' disabledText';
            }

            // disable input fields
            var container = element;
            var ifields = container.getElementsByTagName('input');
            for (var i = 0; i < ifields.length; i++) {
                ifields[i].disabled = !enabled;
            }

            // disable select fields
            var sfields = container.getElementsByTagName('select');
            for (var i = 0; i < sfields.length; i++) {
                sfields[i].disabled = !enabled;
            }

            // disable links
            var afields = container.getElementsByTagName('a');
            for (var i = 0; i < afields.length; i++) {
                afields[i].disabled = !enabled;
            }
        }
    }
