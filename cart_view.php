<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
	        		<h1 class="page-header">YOUR CART</h1>
	        		<div class="box box-solid">
	        			<div class="box-body">
		        		<table class="table table-bordered">
		        			<thead>
		        				<th></th>
		        				<th>Photo</th>
		        				<th>Name</th>
		        				<th>Price</th>
		        				<th width="20%">Quantity</th>
		        				<th>Subtotal</th>
		        			</thead>
		        			<tbody id="tbody">
		        			</tbody>
		        		</table>

	        			</div>
	        		</div>
	        		

	        		<?php
	        			if(isset($_SESSION['user'])){
	        				echo "<button onclick='instructions()' type='button' class='btn btn-primary btn-lg btn-block'>Submit</button>";
	        				echo "<p id='demo'></p>";

	        			}

	        			else{
	        				echo "
	        					<h4>You need to <a href='login.php'>Login</a> to checkout.</h4>
	        				";
	        			}
	        		?>
	        	</div>



	        	<div class="col-sm-3">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div>


	        </div>
	      </section>

	    </div>
	  </div>
  	<?php $pdo->close(); ?>
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
var total = 0;
$(function(){
	$(document).on('click', '.cart_delete', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		$.ajax({
			type: 'POST',
			url: 'cart_delete.php',
			data: {id:id},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	$(document).on('click', '.minus', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var qty = $('#qty_'+id).val();
		if(qty>1){
			qty--;
		}
		$('#qty_'+id).val(qty);
		$.ajax({
			type: 'POST',
			url: 'cart_update.php',
			data: {
				id: id,
				qty: qty,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	$(document).on('click', '.add', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var qty = $('#qty_'+id).val();
		qty++;
		$('#qty_'+id).val(qty);
		$.ajax({
			type: 'POST',
			url: 'cart_update.php',
			data: {
				id: id,
				qty: qty,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	getDetails();
	getTotal();

});

function getDetails(){
	$.ajax({
		type: 'POST',
		url: 'cart_details.php',
		dataType: 'json',
		success: function(response){
			$('#tbody').html(response);
			getCart();
		}
	});
}

function getTotal(){
	$.ajax({
		type: 'POST',
		url: 'cart_total.php',
		dataType: 'json',
		success:function(response){
			total = response;
		}
	});
}
</script>

    <script>
      function instructions() {
        document.getElementById("demo").innerHTML = "<br> <h2> <b>Thank you for submitting your order!</b> <br></h3> <h4> Please follow the instructions below to complete your purchase:<br><br> 1. Call ShipleyGoods Pay Line on 01274 327 222 <br> 2. Provide the agent with the following customer ID - <br> 3. Get your card details ready to pay over the phone <br> 4. Congratualtions, your order is on the way!" ;
      }
    </script>

    <script>
      function instructions() {
        document.getElementById("demo").innerHTML = "<br> <h2> <b>Thank you for submitting your order!</b> <br></h3> <h4> Please follow the instructions below to complete your purchase:<br><br> 1. Call ShipleyGoods Pay Line on 01274 327 222 <br> 2. Provide the agent with your customer ID <b> (<?php echo $user['id']; ?>) </b><br> 3. Get your card details ready to pay over the phone <br> 4. Congratualtions, your order is on the way!" ;
      }
    </script>

  	
    
</body>
</html>