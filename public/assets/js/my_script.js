'use strict';

let picker=new Datepicker();
let pickElm=picker.getElement();
let pLeft=200;
let pWidth=300;
pickElm.style.position='absolute';
pickElm.style.left=pLeft+'px';
pickElm.style.top='172px';
picker.attachTo(document.body);





 function cdid(gdid){
	var gdf =gdid;
	var hdf =gdid + 'h';
	console.log(gdf);
	console.log(hdf);




/*
	let elements = document.querySelectorAll('.cal_con input:last-child');

	for (let elem of elements) {
		console.log(elem.classList);
		elem.classList.add('w3-hide');
		break;
	  }
	
*/


	
	





	  

picker.onPicked=function(){
	let elgd=document.getElementById(gdf);
	let elhd=document.getElementById(hdf);
	//let elhd=document.getElementsByClassName(hdf);
	console.log(elgd);
	console.log(elhd);
	if(picker.getPickedDate() instanceof Date){
		elgd.value=picker.getPickedDate().getDateString();
		elhd.value=picker.getOppositePickedDate().getDateString();
	}else{
		elhd.value=picker.getPickedDate().getDateString();
		elgd.value=picker.getOppositePickedDate().getDateString();
	}
	console.log(elgd.value);
	console.log(elhd.value);
};
return hdf;
};
function openSidebar(){
	document.getElementById("mySidebar").style.display = "block"
}

function closeSidebar(){
	document.getElementById("mySidebar").style.display = "none"
}

function dropdown(el){
	if(el.className.indexOf('expanded')==-1){
		el.className=el.className.replace('collapsed','expanded');
	}else{
		el.className=el.className.replace('expanded','collapsed');
	}
}

function selectLang(el){
	el.children[0].checked=true;
	picker.setLanguage(el.children[0].value)
}

function setFirstDay(fd){
	picker.setFirstDayOfWeek(fd)
}

function setYear(){
	let el=document.getElementById('valYear');
	picker.setFullYear(el.value)
}

function setMonth(){
	let el=document.getElementById('valMonth');
	picker.setMonth(el.value)
}

function updateWidth(el){
	pWidth=parseInt(el.value);
	if(!fixWidth()){
		document.getElementById('valWidth').value=pWidth;
		picker.setWidth(pWidth)
	}
}

function pickDate(ev){
	ev=ev||window.event;
	let el=ev.target||ev.srcElement;
	pLeft=ev.pageX;
	fixWidth();
	pickElm.style.top=ev.pageY+'px';
	picker.setHijriMode(el.className=='hijrDate');
	picker.show();
  el.blur();
}

function gotoToday(){
	picker.today()
}

function setTheme(){
	let el=document.getElementById('txtTheme');
	let n=parseInt(el.value);
	if(!isNaN(n))picker.setTheme(n);
	else picker.setTheme(el.value)
}

function newTheme(){
	picker.setTheme()
}

function fixWidth(){
	let docWidth=document.body.offsetWidth;
	let isFixed=false;
	if(pLeft+pWidth>docWidth)pLeft=docWidth-pWidth;
	if(docWidth>=992&&pLeft<200)pLeft=200;
	else if(docWidth<992&&pLeft<0)pLeft=0;
	if(pLeft+pWidth>docWidth){
		pWidth=docWidth-pLeft;
		picker.setWidth(pWidth);
		document.getElementById('valWidth').value=pWidth;
		document.getElementById('sliderWidth').value=pWidth;
		isFixed=true
	}
	pickElm.style.left=pLeft+'px';
	return isFixed
}




document.addEventListener("DOMContentLoaded", function(event) { 
	/*const elements = document.querySelectorAll('.hijrDate');

		elements.forEach((element) => {
  		element.classList.add('w3-hide');

});*/
	
  });
  function showcon(sh){
	var ghdate =sh;
	var hjdate =sh;
	
	document.getElementById(ghdate).style.display ='block';
	document.getElementById(hjdate).style.display = 'none';
  }


  function gdcon(showdiv){
	var willshowdiv =showdiv ;
	var willhidediv =showdiv +'h';

	//alert(willshowdiv);
	
	document.getElementById(willshowdiv).style.display ='block';
	document.getElementById(willhidediv).style.display = 'none';
	document.getElementsByClassName(willhidediv)[0].style.display = 'block';
	document.getElementsByClassName(willshowdiv)[0].style.display = 'none';
  }

  function hjowcon(showdiv){


	var willshowdiv =showdiv +'h';
	var willhidediv =showdiv;

	//alert(willshowdiv);



	document.getElementById(willshowdiv).style.display ='block';
	document.getElementById(willhidediv).style.display = 'none';
	document.getElementsByClassName(willshowdiv)[0].style.display = 'none';
	document.getElementsByClassName(willhidediv)[0].style.display = 'block';


  }

