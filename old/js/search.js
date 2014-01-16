
var makesById = new Array();
var makesByName = new Array();

// used car make
function K(makeId, makeName)
{
    var makeRecord = new Array();
    makeRecord[0] = makeId;
    makeRecord[1] = makeName;
    makeRecord[2] = new Array();

    makesById[makeId] = makeRecord;
    makesByName[makeName] = makeRecord;
}

// used car model
function D(makeId, modelName)
{
    var makeRecord = makesById[makeId];
    // do the old fashioned way because of the lack of support for push in ie 5 mac
    makeRecord[2][makeRecord[2].length] = modelName    
    //makeRecord[2].push(modelName);
}

// new car make
var newMakes = new Array();
function A(makeId, makeName)
{
    var makeRecord = new Array();
    makeRecord[0] = makeId;
    makeRecord[1] = makeName;
    makeRecord[2] = new Array();
    newMakes[makeId] = makeRecord;
}

// new car model (ignore for now)
function L(makeId, modelId, modelName)
{
    var modelRecord = new Array();
    modelRecord[0] = modelId;
    modelRecord[1] = modelName;
    // do the old fashioned way because of the lack of support for push in ie 5 mac
    newMakes[makeId][2][newMakes[makeId][2].length]=modelRecord;
    //newMakes[makeId][2].push(modelRecord);
}

function init()
{
    // Initialize used cars javascript
    initCars();
    // Initialize new car javascript
    initNewMakes();

    // Add used car makes
    var makeSel = document.usedForm.usedMakeSelect;
    makeSel.options.length = 0;
    var optionNum = 0;
    for (ii in makesById)
    {
        var makeRecord = makesById[ii];
        var option = new Option(makeRecord[1], makeRecord[1]);
        makeSel.options[optionNum] = option;
        optionNum++;
    }        
    selectUsedMake(makeSel.value);


    // Add new car makes
    var makeSel = document.newForm.newMakeSelect;
    makeSel.options.length = 0;
    var optionNum = 0;
    for (ii in newMakes)
    {
        var makeRecord = newMakes[ii];
        var option = new Option(makeRecord[1], makeRecord[0]);
        makeSel.options[optionNum] = option;
        optionNum++;
    }
}

function selectUsedMake(makeName)
{
    // Choose the specified make if it isn't already selected
    var makeSel = document.usedForm.usedMakeSelect;
    var hasMake = false;

    if (!makeName || (makeName == ""))
        makeName = makeSel.value;

    if (makeName && (makeName != makeSel.value))
    {
        for (ii=0; ii < makeSel.options.length; ii++)
        {
            if (makeSel.options[ii].value == makeName){
                makeSel.options[ii].selected = true;
                hasMake = true;
            } else {
                makeSel.options[ii].selected = false;
            }
        }
    }
    if (!hasMake) makeName=document.usedForm.mknm.options[document.usedForm.mknm.selectedIndex].value; //fix non-existent make-name bug
    var makeRecord = makesByName[makeName];

    var modelSel = document.usedForm.usedModelSelect;
    modelSel.options.length = 0;
    var optionNum = 1;
    var option = new Option("All", "all");
    modelSel.options[0] = option;

    for (ii in makeRecord[2])
    {
        var modelName = makeRecord[2][ii];
        var option = new Option(modelName);
        modelSel.options[optionNum] = option;
        optionNum++;
    }        
}

function selectUsedModel(modelName)
{
    // Choose the specified model if it isn't already selected
    var modelSel = document.usedForm.usedModelSelect;

    if (modelName && (modelName != modelSel.value))
    {
        for (ii=0; ii < modelSel.options.length; ii++)
        {
            if (modelSel.options[ii].text == modelName)
                modelSel.options[ii].selected = true;
            else
                modelSel.options[ii].selected = false;
        }
    }
}

function selectNewMake(makeId)
{
    // Choose the specified make if it isn't already selected
    var makeSel = document.newForm.newMakeSelect;
    var modelSel = document.newForm.newModelSelect;

    if (!makeId || (makeId == ""))
        makeId = makeSel.value;

    if (makeId && (makeId != makeSel.value))
    {
        for (ii=0; ii < makeSel.options.length; ii++)
        {
            if (makeSel.options[ii].value == makeId)
                makeSel.options[ii].selected = true;
            else
                makeSel.options[ii].selected = false;
        }
    }
    makeId = makeSel.value;
	modelSel.options.length = 0;
    modelSel.options[0] = new Option("All", "");
    var makeRecord = newMakes[makeId];
    var optionNum = 1;
    for (ii in makeRecord[2])
    {
        var modelName = makeRecord[2][ii][1];
        var modelId = makeRecord[2][ii][0];
        var option = new Option(modelName, modelId);
        modelSel.options[optionNum] = option;
        optionNum++;
    }        
}

function selectNewModel(modelId)
{
    // Choose the specified model if it isn't already selected
    var modelSel = document.newForm.newModelSelect;

    if (modelId && (modelId != modelSel.value))
    {
        for (ii=0; ii < modelSel.options.length; ii++)
        {
            if (modelSel.options[ii].value == modelId)
                modelSel.options[ii].selected = true;
            else
                modelSel.options[ii].selected = false;
        }
    }
}

function dealerInit(){
    var makeSel = document.QuickForm.mkid;
    makeSel.options.length = 0;
    var optionNum = 0;
    var option = new Option("Any", "ALL");
	makeSel.options[optionNum] = option;
    optionNum++;
    for (ii in newMakes)
    {
        var makeRecord = newMakes[ii];
        var option = new Option(makeRecord[1], makeRecord[0]);
        makeSel.options[optionNum] = option;
        optionNum++;
    }
    var option = new Option("Used", "USED");
	makeSel.options[optionNum] = option;
}

function dealerNewMake(makeId)
{
    // Choose the specified make if it isn't already selected
    var makeSel = document.QuickForm.mkid;

    if (!makeId || (makeId == ""))
        makeId = makeSel.value;

    if (makeId && (makeId != makeSel.value))
    {
        for (ii=0; ii < makeSel.options.length; ii++)
        {
            if (makeSel.options[ii].value == makeId){
                makeSel.options[ii].selected = true;
				}
            else{
                makeSel.options[ii].selected = false;
				}
        }
    }
}
















function Validate() {
with (document.QuickForm) {
if (zc.value == "")
	{
	alert("Please enter a valid ZIP code.");
	return false;
	}

}
}

function openPopup(url, name, properties)
{
    var popupWin = window.open(url, name, properties);
    popupWin.focus();
}

