function select_innerHTML(objeto,innerHTML){
	IE='\v'=='v';
	if (!IE){
		objeto.innerHTML = innerHTML;
	} else {
		//alert('IE mode'); 
    objeto.innerHTML = "";
    var selTemp = document.createElement("micoxselect");
    var opt;
    selTemp.id="micoxselect1";
    document.body.appendChild(selTemp);
    selTemp = document.getElementById("micoxselect1");
    selTemp.style.display="none";
    if(innerHTML.toLowerCase().indexOf("<option")<0){
        innerHTML = "<option>" + innerHTML + "</option>";
    }
    innerHTML = innerHTML.toLowerCase().replace(/<option/g,"<span").replace(/<\/option/g,"</span");
    selTemp.innerHTML = innerHTML;
      
    
    for(var i=0;i<selTemp.childNodes.length;i++){
  var spantemp = selTemp.childNodes[i];
  
        if(spantemp.tagName){     
            opt = document.createElement("OPTION");
    
   if(document.all){ //IE
    objeto.add(opt);
    
   }else{
    objeto.appendChild(opt);
   }       
    
   //getting attributes
   for(var j=0; j<spantemp.attributes.length ; j++){
    var attrName = spantemp.attributes[j].nodeName;
    var attrVal = spantemp.attributes[j].nodeValue;
    if(attrVal){
     try{
      opt.setAttribute(attrName,attrVal);
      opt.setAttributeNode(spantemp.attributes[j].cloneNode(true));
     }catch(e){}
    }
   }
   //getting styles
   if(spantemp.style){
    for(var y in spantemp.style){
     try{opt.style[y] = spantemp.style[y];}catch(e){}
    }
   }
   //value and text
   opt.value = spantemp.getAttribute("value");
   opt.text = spantemp.innerHTML;
   //IE
   opt.selected = spantemp.getAttribute('selected');
   opt.className = spantemp.className;
  } 
 }    
 document.body.removeChild(selTemp);
 selTemp = null;
	}
}


