
//codul pentru sidebar

toggleNav2();
document.getElementById("a").addEventListener("click", toggleNav); 
var x = window.matchMedia("(max-width: 800px)");

x.addListener(toggleNav1);


function toggleNav(){
    navSize = document.getElementById("mySidenav").style.width;
    if (navSize =="250px") {
        return closeNav();
    }
    return openNav();
}
function toggleNav1(){
    if (x.matches) {
        return closeNav();
    }
    return openNav();
}
function toggleNav2(){
    var x = window.matchMedia("(max-width: 800px)");
    if (x.matches) {
        return closeNav();
    }
    return openNav();
}


function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
}

(function(){
    $('.form-prevent-multiple-submit').on('submit',function(){
        $('.button-prevent-multiple-submit').attr('disabled',true);
    })
})();
  
  