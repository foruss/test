/*
 @Name: $RCSfile: home.js,v $
 @Version: $Revision: 1.33 $
 @Date: $Date: 2008/12/22 20:45:01 $
 
 Copyright (C) 2008 Copart, Inc. All rights reserved.
 */

function showUpTo(){
    var selectedValue = $F("location");
    var zip = getZip();
    if(zip == 0){  
    	$("zipPostalCode").value = "";
    }else{
    	$("zipPostalCode").value = zip;
    }
    var vis = "visible";
    if (selectedValue != "zip") {
        vis = "hidden";
    }
    
    $("zipPostalCode").style.visibility = vis;
    updateStateFacilityDropDown('location', 'stateFacility');
}

function homeUpdateModelDropDown(){
    updateModelDropDown('make', 'model');
}

function homeUpdateMakeDropDown(){
    if ($F("vehicleType") == message.validVehicleType) {
        $("model").disabled = false;
        updateMakeDropDown('vehicleType', 'make');
        updateModelDropDown('vehicleType', 'model');
    }
    else {
    	$("model").disabled = false;
        updateMakeDropDown('vehicleType', 'make');
        makeNotValidModelDropDown();
    }
}

function updateFeaturedListings(){
    var selectedType = $("featuredLotType").value;
    getFeaturedListings(selectedType, "featuredCompactList", message.ajaxError)
}

function initFeaturedList(){
    var initialFeaturedSelection = "F|C";
    getFeaturedListings(initialFeaturedSelection, "featuredCompactList", message.ajaxError)
}

function setLanguage(){
    var selectedLanguage = $F("siteLanguage");
    if (selectedLanguage != "*") {
        $("langForm").submit();
    }
}

function viewMoreFeaturedListings(userSelectedValue){
    $("categorySearchType").value = userSelectedValue;
    $("featuredListingsCompactForm").submit();
}

function hideZip(){
    $('zip_box').style.visibility = 'hidden';
}

function showZip(){
    $('zip_box').style.visibility = 'visible';
    var zip = getZip();
    if(zip > 0)
    {
      $("enteredZip").value = zip;
    }
    else
    {
      $("enteredZip").value = "";
    }
    $("enteredZip").focus();
}

function setPickup(){
    // Clears the error message in zip/postal code div If the user clicks on other image.
    clearErrorCode();
    setSpecialSearchValues("VV", "PICKUP");
}

function setSUV(){
    // Clears the error message in zip/postal code div If the user clicks on other image.
    clearErrorCode();
    setSpecialSearchValues("VV", "4DR WAGON/SPORT UT");
}

function setCars(){
    // Clears the error message in zip/postal code div If the user clicks on other image.
    clearErrorCode();
    setSpecialSearchValues("VV", "");
}

function setMarine(){
    // Clears the error message in zip/postal code div If the user clicks on other image.
    clearErrorCode();
    setSpecialSearchValues("VM", "");
}

function setClassics(){
    // Clears the error message in zip/postal code div If the user clicks on other image.
    clearErrorCode();
    setSpecialSearchValues("FC", "");
}

function setRecreational(){
    // Clears the error message in zip/postal code div If the user clicks on other image.
    clearErrorCode();
    setSpecialSearchValues("VR", "");
}

function setIndustrialEquipment(){
    // Clears the error message in zip/postal code div If the user clicks on other image.
    clearErrorCode();
    setSpecialSearchValues("VE", "");
}

function setMotorcycles(){
    // Clears the error message in zip/postal code div If the user clicks on other image.
    clearErrorCode();
    setSpecialSearchValues("VC", "");
}

function setJetSkis(){
    // Clears the error message in zip/postal code div If the user clicks on other image.
    clearErrorCode();
    setSpecialSearchValues("VJ", "");
}

function setSnowMobiles(){
    // Clears the error message in zip/postal code div If the user clicks on other image.
    clearErrorCode();
    setSpecialSearchValues("VS", "");
}// Modified for bug 5785 - Invalid zip code returns results by Phani

function validateSpecialSearch(){
    var isValid = checkAlphaNumeric($("enteredZip"), 0, 0, 1, message.specialSearch_zip_required, "errorSpan");
    var submitForm = false;
    if (isValid) {
        rememberZip($("enteredZip").value);
        $("specialZipPostalCode").value = $F("enteredZip");
        $("errorSpan").innerHTML = "&nbsp;";
        submitForm = true;
    }
    return submitForm;
}

function setSpecialSearchValues(catId, bodyStyle){
	clearForms();
    $("categoryId").value = catId;
    $("bodyStyle").value = bodyStyle;
    $("eventId").value = "specialSearch";
    showZip();
}

function setHotItemsSearch(){
    setSearchById(2);
}

function setNewListingsSearch(){
    setSearchById(1);
}

function setHighValueItems(){
    setSearchById(3);
}

function setSearchById(searchId){
	clearForms();
    $("eventId").value = "specialSearchById"
    $("categoryId").value = searchId;
    $("specialSearchForm").action = message.searchByIdURL;
    $("specialSearchForm").submit();
}


// This function is used to Clears the error message in zip/postal code div If the user clicks on other image.
function clearErrorCode(){
    $("errorSpan").innerHTML = "";
}


function MM_preloadImages() { //v3.0
	
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i]; }}
  	
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function clearForms()
{
	//Special Search Form (Car Images)
	$("specialZipPostalCode").value = "";
	$("categoryId").value = "";
	$("bodyStyle").value = "";
}

Event.observe(window, "load", function(){
//    Event.observe('searchCars', 'click', setCars);
//    Event.observe('searchClassics', 'click', setClassics);
//    Event.observe('searchSUV', 'click', setSUV);
//    Event.observe('searchMarine', 'click', setMarine);
//    Event.observe('searchRecreational', 'click', setRecreational);
//    Event.observe('searchPickupTruck', 'click', setPickup);
//    Event.observe('searchMotorcycles', 'click', setMotorcycles);
//    Event.observe('searchJetSkis', 'click', setJetSkis);
//    Event.observe('searchIndustrialEquipment', 'click', setIndustrialEquipment);
//    Event.observe('searchSnowMobiles', 'click', setSnowMobiles);
    Event.observe('location', 'change', showUpTo);						//+
    Event.observe('make', 'change', homeUpdateModelDropDown);			//+
    Event.observe('vehicleType', 'change', homeUpdateMakeDropDown);		//+

	// To show the error message in zip/postal code div.
    if (message.specialSearchServerSideError.length > 0) {
        setSpecialSearchValues(message.specialSearchVehicleType, message.specialSearchBodyStyle);
        showZip();
    }
    
    //if ($F("vehicleType") != message.validVehicleType) {
    //    makeNotValidModelDropDown();
    //}
    
    updateMakeDropDown("vehicleType", "make");
    updateModelDropDown("make", "model");
});