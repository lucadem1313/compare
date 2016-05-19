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


  $.ajax({
    type: "POST",
    url: "http://lucademian.com/compare/api.php",
    data: {
      "allitems": true
    },
    success: function(response){
      
      if(response != false)
      {
        var voteditemsUnsorted = JSON.parse(response);
		var voteditems = [];
		
		
		for(var i = 1; i < voteditemsUnsorted.length; i++)
		{
			voteditemsUnsorted[i][0].index = i;
			voteditemsUnsorted[i][1].index = i;
			voteditemsUnsorted[i][0].item = 0;
			voteditemsUnsorted[i][1].item = 1;
			voteditemsUnsorted[i][0].otherItem = 1;
			voteditemsUnsorted[i][1].otherItem = 0;
			
			voteditems.push(voteditemsUnsorted[i][0], voteditemsUnsorted[i][1]);
		}
		
		
		var sortBy = window.location.hash.replace('#', '');
		
		if(sortBy == 'sizeasc')
		{
			$('#firstoption').text('Sort Small To Large');
			voteditems.sort(function(a, b) {
				return parseFloat(a.votes) - parseFloat(b.votes);
			});
		}
		else if(sortBy == 'az')
		{
			$('#firstoption').text('Sort A-Z');
			voteditems.sort(function(b, a) {
				return b.name.localeCompare(a.name);
			});
		}
		else if(sortBy == 'za')
		{
			$('#firstoption').text('Sort Z-A');
			voteditems.sort(function(b, a) {
				return a.name.localeCompare(b.name);
			});
		}
		else
		{
			$('#firstoption').text('Sort Large To Small');
			voteditems.sort(function(b, a) {
				return parseFloat(a.votes) - parseFloat(b.votes);
			});
		}
		
		
		var total = 0;
		
		for(var i = 0; i < voteditems.length; i++)
        {
			item = voteditems[i];
			total += item.votes;
        }
        for(var i = 0; i < voteditems.length; i++)
        {
			item1 = voteditems[i];
			size1 = (60+((item1.votes/(total))*11800));
			color1 = "transparent";
            $('#voteditems').append("<div class='staticproduct' title='"+item1.name+" ("+item1.votes+" votes)  ||  Polled against "+voteditemsUnsorted[item1.index][item1.otherItem].name+" ("+(voteditemsUnsorted[item1.index][item1.otherItem].votes)+" votes)' style='border-color:"+color1+";width:"+size1+"px;height:"+size1+"px'><img draggable='false' src='"+item1.src+"' alt='"+item1.name+"'><h1 style='width:"+size1+"px;height:"+size1+"px;margin-top:"+(-1*(size1+40))+"px;margin-left:"+(-1*(40))+"px;'><span class='votenumber'>"+item1.votes+" <i class=\"material-icons\">thumb_up</i></span><br><span class='votecount2' style='background:"+color1+"'>"+item1.name+"</span></h1></div>");
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


