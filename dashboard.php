<script type="text/javascript">
	function showSearch(str) {
    if (str.length == 0) { 
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();             //step 1. create XMLhttpRequest object
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {     //status is OK(200) and state is"finished and response is ready"
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "gethint.php?s=" + str, true);
        xmlhttp.send();
    }
	}
</script>
<?php
	error_reporting(E_ALL & ~E_WARNING);
	require_once('template/connect.php');

	require_once('template/startsession.php');
   	// Insert the page header
   	$page_title = 'Dashboard';
   	   	//apply this page's style
   	
   	$page_style='<link rel="stylesheet" type="text/css" href="style/dashboard_style.css" />';	//point to design specific files here! Dont alter main style.css
   	require_once('template/header.php');

   	require_once('template/navmenu.php');

   if (!isset($_SESSION['user_id']))      //redirect to dashboard if logged in
    {
      header('location:index1.php');
    }
   $query_retreive_username=mysqli_query($link,"select username from user_table where user_id='$_SESSION[user_id]'");
   $array_username=mysqli_fetch_array($query_retreive_username);
   $name=$array_username['username'];

?>	
	<div id="searchsuggestions">
		<form method="GET">
    <div class="dropdown">
			<input id="search" class="dropdown-toggle form-control" data-toggle="dropdown" type="text" placeholder="Search URLs or other users" autocomplete="off" onkeyup="showSearch(this.value)" /> <br />
			<ul id="txtHint" class="dropdown-menu" >
        
      </ul>
		</form>
	</div>
  </div>
<div class="row">
<div id="leftside" class="col-sm-4">

	<div id="dp" class="left">
		<p><img src="Users/<?php echo $name.'.jpg' ?>" width="100%" alt="profile pic" title="Edit/View details" /></p>
	</div>

	

	<div id="follow" class="left">
		<p>Follower <span class="badge"><?php 
		echo mysqli_num_rows(mysqli_query($link,"SELECT * FROM follow_table WHERE followed_id='$_SESSION[user_id]' ")); ?></span><br />		<!--Value by php-->
		Following <span class="badge"><?php 
		echo mysqli_num_rows(mysqli_query($link,"SELECT * FROM follow_table WHERE follower_id='$_SESSION[user_id]' ")); ?></span></p>
    </div>
  <div class="btn btn-link" id="category" class="left"><a href="dashboard.php?page=category">Category</a></div>
</div>

<div id="main" class="col-sm-6">
<h1>Dashboard</h1>
	<?php
     		switch ($_GET['page']) {
		case 'link_repo':
		   include('link_repo_ajax.php');	
			break;

		case 'category':
		  include('category.php');
		  break;	
			
		default:
			include('link_repo_ajax.php');
					break;
      }
     
   ?>
  </div>
  </div>
<?php
	require_once('template/footer.php');
?>
</body>
</html>