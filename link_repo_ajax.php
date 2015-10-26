
	<h2>View, share, Explore</h2>
	<p>Paste your favourite links here to make your customised collection of links. Share your favourite links and explore what your friends shared!</p>
	<div id="pasteUrl" >
		<form method="post">
<script>
	

    function showHint(url) {
    	document.getElementById("ajax_url").innerHTML = "";
        console.log(url);
        $('.loader').show();

        if (url.length < 12) {            //http:// .com has 12 characters which are minimum to show a site.  
            document.getElementById("ajax_url").innerHTML = "";
            $('.loader').hide();
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("ajax_url").innerHTML = xmlhttp.responseText;
                  if(xmlhttp.responseText)
                  {
                     $('.loader').hide();
                  }
                }
            }
            xmlhttp.open("GET", "getdom.php?url=" + url, true);
            xmlhttp.send();
        }     
    }
    </script>
	<input id="theUrl" class="form-control" type="text" placeholder="Paste link here..."  name="theUrl" onblur="showHint(this.value)" /></br></br>
	</form>

	</div>
    <div class="loader">
   <center>
       <img class="loading-image" src="images/load.gif" alt="loading..">
   </center>
</div>
	<div id="ajax_url"></div>
	<h2 class="col-sm-12">Links Feed</h2></br>
	<!--5 to 6 linkFeed divs follow -->

	<div class="col-sm-12">
	<?php include("url_dom_display.php");?>
	</div>