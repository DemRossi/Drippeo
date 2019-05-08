  /*---Navigatie---*/



  window.addEventListener('resize', ()=>{

    let  mq = window.matchMedia("(min-width: 768px)");

    if (mq.matches){
      document.getElementById("mySidenav").style.width = "20%";
      console.log('open');
     
    }else{
    console.log('hamburger');
     openNav();
     closeNav();
    }

  });

  function openNav() {
    document.getElementById("mySidenav").style.width = "50%";
  }
  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  }
  
  
  
 