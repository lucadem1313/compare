function $_GET(param) {
	var vars = {};
	window.location.href.replace( location.hash, '' ).replace( 
		/[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
		function( m, key, value ) { // callback
			vars[key] = value !== undefined ? value : '';
		}
	);

	if ( param ) {
		return vars[param] ? vars[param] : null;	
	}
	return vars;
}

var products = '';
$.ajax({
  type: "POST",
  url: "http://lucademian.com/compare/api.php",
  data: {
    "items": true
  },
  success: function(response){
    
    if(response != false)
    {

      products = '';
      products = JSON.parse(response);
      
      var productPair = 1;
      var itemId = 0;
      
      $('form').slideUp(0);
      $('#new').click(function(){
        var triggered = false;
        $('form').slideToggle(200);

        $('#line1').toggleClass('active');
        $('#line2').toggleClass('active');
      });
		
		var item1 = products[productPair][0];
		var item2 = products[productPair][1];

		$('#container').html("<div id='product1' title='"+item1.name+"' class='product'><img draggable='false' src='"+item1.src+"' alt='"+item1.name+"'><h1><span class='votenumber'><span>"+item1.votes+" </span><i class=\"material-icons\">thumb_up</i></span></h1></div>\
							<div id='product2' title='"+item2.name+"' class='product'><img draggable='false' src='"+item2.src+"' alt='"+item2.name+"'><h1><span class='votenumber'><span>"+item2.votes+" </span><i class=\"material-icons\">thumb_up</i></span></h1></div>\
							<br><br><span id='productnames'></span><br><br><span class='votecount1'>"+item1.name+"</span><span class='votecount1'>"+item2.name+"</span><button id='next' class='button'><span>Next <i class=\"material-icons\">arrow_forward</i></span><div></div></button><button id='skip' class='button'><span>Skip&nbsp; <i class=\"material-icons\">fast_forward</i></span><div></div></button>");
					
		$('#next').fadeOut(0);
		$('#skip').fadeIn(0);
    	$('#productnames').text(products[productPair][0].name+' or '+products[productPair][1].name);

    	itemId = item1.id;

      $(document).on('click', '#skip', function(){
      	productPair++;
        if(productPair >= products.length)
          window.location.reload();
          var item1 = products[productPair][0];
		  var item2 = products[productPair][1];

		$('#container').html("<div id='product1' title='"+item1.name+"' class='product'><img draggable='false' src='"+item1.src+"' alt='"+item1.name+"'><h1><span class='votenumber'><span>"+item1.votes+" </span><i class=\"material-icons\">thumb_up</i></span></h1></div>\
							<div id='product2' title='"+item2.name+"' class='product'><img draggable='false' src='"+item2.src+"' alt='"+item2.name+"'><h1><span class='votenumber'><span>"+item2.votes+" </span><i class=\"material-icons\">thumb_up</i></span></h1></div>\
							<br><br><span id='productnames'></span><br><br><span class='votecount1'>"+item1.name+"</span><span class='votecount1'>"+item2.name+"</span><button id='next' class='button'><span>Next <i class=\"material-icons\">arrow_forward</i></span><div></div></button><button id='skip' class='button'><span>Skip&nbsp; <i class=\"material-icons\">fast_forward</i></span><div></div></button>");
        $('#next').fadeOut(0);
		$('#skip').fadeIn(0);
    	$('#productnames').text(products[productPair][0].name+' or '+products[productPair][1].name);
        itemId = item1.id;
	  });
	  
	  
      $(document).on('click', '#next', function(){  
          var item1 = products[productPair][0];
		  var item2 = products[productPair][1];
		itemId = item1.id;
		  
        itemNum = 0;
        if($('#product1').hasClass('chosen'))
        {
          itemNum = 1;
          
        }
        else
        {
          itemNum = 2;
        }
		  
        $.ajax({
			type: "POST",
			url: "http://lucademian.com/compare/api.php",
			data: {
				"vote": true,
				"itemid": itemId,
				"item": itemNum
			},
			success: function(response){
			}
		});
        productPair++;
        if(productPair >= products.length)
          window.location.reload();

        var item1 = products[productPair][0];
		var item2 = products[productPair][1];

		$('#container').html("<div id='product1' title='"+item1.name+"' class='product'><img draggable='false' src='"+item1.src+"' alt='"+item1.name+"'><h1><span class='votenumber'><span>"+item1.votes+" </span><i class=\"material-icons\">thumb_up</i></span></h1></div>\
							<div id='product2' title='"+item2.name+"' class='product'><img draggable='false' src='"+item2.src+"' alt='"+item2.name+"'><h1><span class='votenumber'><span>"+item2.votes+" </span><i class=\"material-icons\">thumb_up</i></span></h1></div>\
							<br><br><span id='productnames'></span><br><br><span class='votecount1'>"+item1.name+"</span><span class='votecount1'>"+item2.name+"</span><button id='next' class='button'><span>Next <i class=\"material-icons\">arrow_forward</i></span><div></div></button><button id='skip' class='button'><span>Skip&nbsp; <i class=\"material-icons\">fast_forward</i></span><div></div></button>");
        $('#next').fadeOut(0);
		$('#skip').fadeIn(0);
    	$('#productnames').text(products[productPair][0].name+' or '+products[productPair][1].name);
        itemId = item1.id;
      });
      
      
      $(document).on('click', '.product:not(.hasPicked)', function(){
        element = $(this);
        $('.product').each(function(){$(this).addClass('hasPicked')});
        $('.product').removeClass('chosen');
        $(this).toggleClass('chosen');
        $('#next').appendTo(element);
        $('#next').fadeIn(200);
		$('#skip').fadeOut(200);
		  
		
      });

      

      $('form').submit(function(e){
        e.preventDefault();
        element = $(this);
        // products.push([{votes: 0, name: element.children('input[name="name1"]').val(), src:element.children('input[name="url1"]').val()}, {votes: 0,name: element.children('input[name="name2"]').val(), src:element.children('input[name="url2"]').val()}]);
        $.ajax({
          type: "POST",
          url: "http://lucademian.com/compare/api.php",
          data: {
            "newitems": true,
            "name1": element.children('input[name="name1"]').val(),
            "url1": element.children('input[name="url1"]').val(),
            "name2": element.children('input[name="name2"]').val(),
            "url2": element.children('input[name="url2"]').val()
          },
          success: function(response){
            element.children('input[name="name1"]').val('');
            element.children('input[name="url1"]').val('');
            element.children('input[name="name2"]').val('');
            element.children('input[name="url2"]').val('');
          }
        });
      });
    }
    else
    {
      $('form').submit(function(e){
        e.preventDefault();
        element = $(this);
        // products.push([{votes: 0, name: element.children('input[name="name1"]').val(), src:element.children('input[name="url1"]').val()}, {votes: 0,name: element.children('input[name="name2"]').val(), src:element.children('input[name="url2"]').val()}]);
        $.ajax({
          type: "POST",
          url: "http://lucademian.com/compare/api.php",
          data: {
            "newitems": true,
            "name1": element.children('input[name="name1"]').val(),
            "url1": element.children('input[name="url1"]').val(),
            "name2": element.children('input[name="name2"]').val(),
            "url2": element.children('input[name="url2"]').val()
          },
          success: function(response){
            element.children('input[name="name1"]').val('');
            element.children('input[name="url1"]').val('');
            element.children('input[name="name2"]').val('');
            element.children('input[name="url2"]').val('');
          }
        });
      });
      $('#container').empty();
      $('#container').append('There are no polls left. Why don\'t you make one?');
      $('form').css('top', '500px');
      $('#new').css('top', '300px');
      $('form').slideUp(0);
      $('#new').click(function(){
        var triggered = false;
        $('form').slideToggle(200);

        $('#line1').toggleClass('active');
        $('#line2').toggleClass('active');
      });
      
    }
  }});

  $.ajax({
    type: "POST",
    url: "http://lucademian.com/compare/api.php",
    data: {
      "voteditems": true
    },
    success: function(response){
      
      if(response != false)
      {
        var voteditems = JSON.parse(response);
        for(var i = 1; i < voteditems.length; i++)
        {
			item1 = voteditems[i][0];
			item2 = voteditems[i][1];
			total = item1.votes + item2.votes;
			size1 = (130+((item1.votes/(total))*220));
			size2 = (130+((item2.votes/(total))*220));
			
			if(item1.votes > item2.votes)
			{
				color1 = "#27C727";
				color2 = "#FF0000";
			}
			else
			{
				color2 = "#27C727";
				color1 = "#FF0000";
			}
			

              $('#voteditems').append("<div class='pair'>\
                <div class='staticproduct' style='border-color:"+color1+";width:"+size1+"px;height:"+size1+"px'><img draggable='false' src='"+item1.src+"' alt='"+item1.name+"'><h1 style='width:"+size1+"px;height:"+size1+"px;margin-top:"+(-1*(size1+40))+"px;margin-left:"+(-1*(40))+"px;'><span class='votenumber'>"+item1.votes+"</span><i class=\"material-icons\">thumb_up</i><br><span class='votecount2' style='background:"+color1+"'>"+item1.name+"</span></h1></div>\
                <div class='staticproduct' style='border-color:"+color2+";width:"+size2+"px;height:"+size2+"px;'><img draggable='false' src='"+item2.src+"' alt='"+item2.name+"'><h1 style='width:"+size2+"px;height:"+size2+"px;margin-top:"+(-1*(size2+40))+"px;margin-left:"+(-1*(40))+"px;'><span class='votenumber'>"+item2.votes+"</span><i class=\"material-icons\">thumb_up</i><br><span class='votecount1' style='background:"+color2+"'>"+item2.name+"</span></h1></div>\
                <br><br><span id='productnames'></span><br></div>");
         // }
//          else {
//            //if(voteditems[i][0].votedfor == 1)
//            //{
//            //  $('#voteditems').append("<div class='pair'>\
//            //    <div id='product1' class='product'><img draggable='false' src='"+voteditems[i][1].src+"' alt='"+voteditems[i][1].name+"'><h1><span class='votenumber'>"+voteditems[i][1].votes+"</span><i class=\"material-icons\">thumb_up</i><br><span id='votecount2'>"+voteditems[i][1].name+"</span></h1></div>\
//            //    <div id='product2' class='product votedfor'><img draggable='false' src='"+voteditems[i][0].src+"' alt='"+voteditems[i][0].name+"'><h1><span class='votenumber'>"+voteditems[i][0].votes+"</span><i class=\"material-icons\">thumb_up</i><br><span id='votecount1'>"+voteditems[i][0].name+"</span></h1></div>\
//            //    <br><br><span id='productnames'></span><br><br><br><br></div>");
//            //}
//            //else
//            //{
//            //  $('#voteditems').append("<div class='pair'>\
//            //    <div id='product1' class='product votedfor'><img draggable='false' src='"+voteditems[i][1].src+"' alt='"+voteditems[i][1].name+"'><h1><span class='votenumber'>"+voteditems[i][1].votes+"</span><i class=\"material-icons\">thumb_up</i><br><span id='votecount2'>"+voteditems[i][1].name+"</span></h1></div>\
//            //    <div id='product2' class='product'><img draggable='false' src='"+voteditems[i][0].src+"' alt='"+voteditems[i][0].name+"'><h1><span class='votenumber'>"+voteditems[i][0].votes+"</span><i class=\"material-icons\">thumb_up</i><br><span id='votecount1'>"+voteditems[i][0].name+"</span></h1></div>\
//            //    <br><br><span id='productnames'></span><br><br><br><br></div>");
//            //}
//              
//			  $('#voteditems').append("<div class='pair'>\
//                <div class='staticproduct' style='width:"+size2+"px;height:"+size2+"px;'><img draggable='false' src='"+voteditems[i][1].src+"' alt='"+voteditems[i][1].name+"'><h1 style='width:"+size2+"px;height:"+size2+"px;margin-top:-"+size2+40+"px;'><span class='votenumber'>"+voteditems[i][1].votes+"</span><i class=\"material-icons\">thumb_up</i><br><span class='votecount2'>"+voteditems[i][1].name+"</span></h1></div>\
//                <div class='staticproduct' style='width:"+size1+"px;height:"+size1+"px;'><img draggable='false' src='"+voteditems[i][0].src+"' alt='"+voteditems[i][0].name+"'><h1 style='width:"+size1+"px;height:"+size1+"px'><span class='votenumber'>"+voteditems[i][0].votes+"</span><i class=\"material-icons\">thumb_up</i><br><span class='votecount1'>"+voteditems[i][0].name+"</span></h1></div>\
//                <br><br><span id='productnames'></span><br></div>");
//          }
        }
      }
    }
  });
  
  
  
$('header .material-icons').click(function(){
  $.ajax({
    type: "POST",
    url: "http://lucademian.com/compare/api.php",
    data: {
      "acceptcookies": true
    },
    success: function(response){
      $('header').slideDown(300, function(){$('header').remove();});
    }
  });
});