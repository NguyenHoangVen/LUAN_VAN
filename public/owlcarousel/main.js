$(document).ready(function(){
  $('.owl-carousel').owlCarousel({
  	loop:true,
  	margin:10,
  	nav:true,
  	responsive:{
  		0:{
  			items:1
  		},
  		600:{
  			items:1,
        nav:true
  		},
      768:{
        items:2
      },
  		1000:{
  			items:3,
        nav:true
        // loop:false
  		}

  	}
 	});
  // setInterval(function(){
  //       $('.owl-carousel .owl-next').click();
  // },2000);
});