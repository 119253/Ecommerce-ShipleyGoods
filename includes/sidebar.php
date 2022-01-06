<div class="row">
	<div class="box box-solid">
	  	<div class="box-header with-border">
	    	<h3 class="box-title"><b>Most Viewed Today</b></h3>
	  	</div>
	  	<div class="box-body">
	  		<ul id="trending">
	  		<?php
	  			$now = date('Y-m-d');
	  			$conn = $pdo->open();

	  			$stmt = $conn->prepare("SELECT * FROM products WHERE date_view=:now ORDER BY counter DESC LIMIT 10");
	  			$stmt->execute(['now'=>$now]);
	  			foreach($stmt as $row){
	  				echo "<li><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></li>";
	  			}

	  			$pdo->close();
	  		?>
	    	<ul>
	  	</div>
	</div>
</div>



<div class="row">
	<div class='box box-solid'>
	  	<div class='box-header with-border'>
	    	<h3 class='box-title'><b>ShipleyGoods Socials</b></h3>
	  	</div>
	  	<div class='box-body'>
	    	<a class="btn btn-social-icon btn-linkedin"><i class="fa fa-linkedin"></i></a>
	    	<a class="btn btn-social-icon btn-github"><i class="fa fa-github"></i></a>
	    	<a class="btn btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></a>
	  	</div>
	</div>
</div>
