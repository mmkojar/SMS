<?php  require("include/header.php"); 
?>

	<section id="index_list">
		<div id="tabs">
			<ul class="nav nav-tabs fixed-top m-t-62" id="myTab" role="tablist">
			  <li class="nav-item">
			    <a class="nav-link active font-weight-bold" data-toggle="tab" aria-selected="true" 
			    href="#working" id="working-tab">Working</a>								    
			  </li>
			  <li class="nav-item">
			    <a class="nav-link font-weight-bold" data-toggle="tab" aria-selected="false" 
			    href="#counts" id="counts-tab">Counts</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link font-weight-bold" data-toggle="tab" aria-selected="false" 
			    href="#holiday" id="holiday-tab">Holiday</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link font-weight-bold" data-toggle="tab" aria-selected="false" 
			    href="#Left" id="Left-tab">Left</a>
			  </li>
			</ul>
		</div>
		<div class="tab-content top-content" id="myTabContent">
		  	<div class="tab-pane show active" id="working" role="tabpanel" 
		  		aria-labelledby="working-tab">
				<a href="user_detail.php?id=1">
				  	<div class="card">
					  <div class="card-body">
					    <div class="media">
						  <img src="user.png" class="align-self-center mr-3" alt="user-image" height="50px" width="50px">
						  <div class="media-body">
						    <h6 class="mt-0 font-weight-bold">MOHAMMED KOJAR</h6>
						    <h6>DEVELOPER</h6>
						  </div>	
						  	<div class="float-right">
						    	<span class="fs-12">Tech</span><br>    	
						    	<i class="text-success fas fa-phone float-right"></i>
							</div>
						</div>
					  </div>
					</div>
				</a>
				<a href="user_detail.php?id=2">
					<div class="card">
					  <div class="card-body">
					    <div class="media">
						  <img src="user.png" class="align-self-center mr-3" alt="user-image" height="50px" width="50px">
						  <div class="media-body">
						    <h6 class="mt-0 font-weight-bold">JAVED DADUJI</h6>
						    <h6>MANAGER</h6>
						  </div>	
						  	<div class="float-right">
						    	<span class="fs-12">Tech</span><br>
						    	<i class="text-success fas fa-phone float-right"></i>
							</div>
						</div>
					  </div>
					</div>
				</a>
		  	</div>
		   	<div class="tab-pane" id="counts" role="tabpanel" aria-labelledby="counts-tab">		
		   		<div class="card">
				  <div class="card-body">
				    <ul class="list-group">
					  <li class="list-group-item">Tech Total : 76</li>
					  <li class="list-group-item">Working : 55</li>
					  <li class="list-group-item">On Holiday : 21</li>
					  <li class="list-group-item">Left : 97</li>
					  <li class="list-group-item">Hold : 0</li>
					</ul>
				  </div>
				</div>
		  	</div>
		  	<div class="tab-pane" id="holiday" role="tabpanel" aria-labelledby="holiday-tab">		
		   	Lorem ipsum dolor, sit amet consectetur adipisicing, elit. Similique harum assumenda rerum omnis inventore minima officiis illo veniam exercitationem in iusto, laboriosam natus ipsam labore, neque expedita cum aperiam maxime.
		  	</div>
		  	<div class="tab-pane" id="Left" role="tabpanel" aria-labelledby="Left-tab">		
		   	Lorem ipsum dolor sit amet consectetur adipisicing, elit. Qui libero modi nemo assumenda dolores eius corporis, debitis, architecto illo, cum officia repellendus dicta, adipisci. Molestiae architecto dolorem libero perspiciatis expedita.
		  	</div>
		</div>
		<div class="clearfix"></div>
	</section>

<?php require("include/footer.php"); ?>
