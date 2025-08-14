
var today = new Date();



function appendZero(value) {
  return "0" + value;
}

function theTime() {
  var d = new Date();
  document.getElementById("time").innerHTML = d.toLocaleTimeString("ar-US");
}



document.getElementById("date").innerHTML = today;

var myVar = setInterval(function () {
  theTime();
}, 1000);




var monthNames = ["يناير", "فبراير", "مارس", "أبريل", "مايو", "يونيو",
  "يوليو", "اغسطس", "سبتمير", "أكتوير", "نوفمبر", "ديسمبر"
];
var dayNames = ["السبت", "الاحد", "الاثنين", "الثلاثاء", "الاربعاء", "الخميس",
  "الجمعة"
];


function dateFormat1(d) {
  var t = new Date(d);
  return dayNames[t.getDate()] + ' ' +t.getDate()   ;
}

function dateFormat2(d) {
  var t = new Date(d);
  return   monthNames[t.getMonth()] + ' ' + t.getFullYear();
}


document.getElementById("dayname").innerHTML = dateFormat1(new Date()) ;
document.getElementById("monthname").innerHTML = dateFormat2(new Date()) ;