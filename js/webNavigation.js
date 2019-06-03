  /*---Navigatie---*/

window.addEventListener('resize', (e)=>{

    let  mq = window.matchMedia("(min-width: 768px)");
    if (mq.matches){
      document.getElementById("mySidenav").style.width = "20%";
      console.log('open');
      $( ".closebtn").attr("onclick", "").unbind("click");
      $( ".sub-nav").attr("onclick", "").unbind("click");
      $( ".hamburger-icon").attr("onclick", "").unbind("click");

     
    }else{
  
      console.log('hamburger');
      openNav();
      closeNav();
      $( ".closebtn").attr("onclick", "").bind("click");
      $( ".sub-nav").attr("onclick", "").bind("click");
      $( ".hamburger-icon").attr("onclick", "").bind("click");
      
      
    }
    e.preventDefault;
  });

  function openNav() {
    document.getElementById("mySidenav").style.width = "50%";
  }
  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  }
  

    /****** smooth scroll ******/
		$(document).ready(function() {
			$("a").on('click', function(event) {

				if (this.hash !== "") {
					event.preventDefault();

					var hash = this.hash;

					$('html, body').animate({
						scrollTop: $(hash).offset().top
					}, 1500, function() {
						window.location.hash = hash;
					});
				}
			});
		});
  
  
 