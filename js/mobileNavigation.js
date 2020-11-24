var burgerBtn = document.querySelector(".ham");
var navItem = document.querySelectorAll(".navItem");
var allLines = document.querySelectorAll(".line");
var bool = false;

burgerBtn.addEventListener("click",navigation);

function navigation(e){
    //nav visable on click
    if(bool == false){
        document.querySelector("nav").style.visibility = "visible";
        document.querySelector("header").classList.add("navBgd");
        document.querySelector("#navUl").classList.remove("navUl");
        //for (i=0;i<allLines.length;i++){
            //allLines[i].classList.remove("whiteLines");
            //allLines[i].classList.add("blackLines");
        //}
        
        bool = true;
    }else{ //nav hidden on click
        document.querySelector("nav").style.visibility = "hidden";
        document.querySelector("header").classList.remove("navBgd");
        document.querySelector("#navUl").classList.add("navUl");
        //for (i=0;i<allLines.length;i++){
            //allLines[i].classList.remove("blackLines");
            //allLines[i].classList.add("whiteLines");
        //}
        bool = false;
    }
    e.preventDefault();
}
//make nav hidden when click on navItems = all the li's
for(var i = 0; i < navItem.length;i++){
    navItem[i].addEventListener("click", function(){
        if(bool == true){
           
            document.querySelector("nav").style.visibility = "hidden";
            document.querySelector("header").classList.remove("navBgd");
            document.querySelector("#navUl").classList.add("navUl");
            document.querySelector(".hamB").classList.toggle("active");
            
            bool = false;
        }else{
            
            document.querySelector("nav").style.visibility = "visible";
            document.querySelector("header").classList.add("navBgd");
            document.querySelector("#navUl").classList.remove("navUl");
            
            bool = true;
    }
})
};
