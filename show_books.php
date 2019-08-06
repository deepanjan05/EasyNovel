<?php 
if(isset($_POST['genre'])){
	$genre = $_POST['genre'];
}
require_once("get_genres.php");
$genres = $res['genres'];

?>
<!DOCTYPE html>
<html>
<head>
	<title>EasyNovel</title>

	<!-- Styles -->
        <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
        <link href="assets/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

            
        <!-- Theme Styles -->
        <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>

</head>

<body>
	<script type="text/javascript">
		var books = [];
	</script>
	<div class="loader-bg"></div>
        <div class="loader">
            <div class="preloader-wrapper big active">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-spinner-teal lighten-1">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
	<main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                        <div class="page-title">Welcome to EasyNovel</div>
                    </div>
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">List of Books from <?php echo explode("/",urldecode($genre))[2]; ?></span>
                                <div class="row">
                				<div class="col s4"></div>
                    			<div class="col s4">
								<form method="POST" action="show_books.php">
                                <select name="genre" id="genre">
								<?php 
									foreach ($genres as $genr) {
								?>	
								<option value="<?php echo $genr['link']; ?>" ><?php echo $genr['name']; ?></option>
								<?php
								}
								?>
								</select>
								<input id="submit" type="submit" name="submit" class="waves-effect waves-light btn teal" value="Submit"></form>
								<div class="col s4"></div>
								</div>
								<table style="width:100%" id="example" class="display responsive-table ">
									<thead>
										<tr>
											<th>#</th>
											<th>Name of Book</th>
											<th>Download book</th>
											<th>About</th>
										</tr>
									</thead>	
									<tbody>
									<script type="text/javascript">
										for (var i = 0; i < books.length; i++) {
											document.write(" \
											<tr> \
											<td>"+(i+1)+"</td> \
											<td>"+book[i]['name']+"</td> \
											<td><a href='download_book.php?link="+books[i]['link']+"&name="+books[i]['name']+"'>Download</a></td> \
											<td><a href='http://readfreenovelsonline.com/"+encodeURL(books[i]['link'])+"' target='_blank'>View</a></td> \
											</tr>");
										}
									</script>
									</tbody>
								</table>
							</div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
</body>
<script type="text/javascript">
</script>
        <!-- Javascripts -->
        <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/alpha.min.js"></script>
        <script src="assets/js/pages/table-data.js"></script>

<script type="text/javascript">
        	$(function(){
        		$("#submit").click(function(e) {
        			e.preventDefault();
	        		var genre = document.getElementById("genre").value;
	        		console.log("test");
	        		$.post("http://localhost/scrapers/Online_to_Book/api/get_books.php",
	        			{
        					genre: genre
        				},
        				function(status, data){
        					console.log("Response:");
        					if (status=='success') {
        						console.log(data['status']);
        						if (data['status']=='Ok') {
        							books = data['books'];
        						} else {
        							<?php die("Error fetching data!"); ?>
        						}
        					} else {
        						console.log("error!");
        						<?php die("Error fetching data!"); ?>
        					}
        				},
        				'json');
	        	});


        	});	



</script>
        
</html>
