$(document).ready(function(){
	
	Site.init();

});

var Site = {
	

	
	init:function() {
		
			Site.ieNthChild();
			
			Site.fancyBoxInit();

	},
	
	//Add class to photo gallery
	ieNthChild:function(){

		$('ul li:nth-child(3n)').addClass('third-nth-child');
	
	},
	
	
	fancyBoxInit:function(){

			$("a[rel=gallery]").fancybox({
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'elastic',
				'titleShow'			: 'False',
				'overlayColor'		: '#000000',
				'overlayOpacity'	: '.7'
			});

	}


};

	