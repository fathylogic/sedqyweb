
const months = ["يناير", "فبراير", "مارس", "أبريل", "مايو", "يونيو", "يوليو", "اغسطس", "سبتمير", "أكتوير", "نوفمبر", "ديسمبر"];
const days = ["الأحد", "الاثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة", "السبت"];


function theTime() {
  const today = new Date();
  document.getElementById("time").innerHTML = today.toLocaleTimeString("ar-US");
}

function dateFormat1() {
  const today = new Date();
  const dayName = days[today.getDay()];
  return dayName + ' ' + today.getDate()   ;
}

function dateFormat2() {
  const today = new Date();
  const monthName = months[today.getMonth()];
  return  monthName + ' ' + today.getFullYear();
}

let myTime = setInterval(function () {
  theTime();
}, 1000);

document.getElementById("dayname").innerHTML = dateFormat1(new Date()) ;
document.getElementById("monthname").innerHTML = dateFormat2(new Date()) ;