<?php

?>
<script type="text/javascript">
		$(document).ready(function(){
			$("#search_btn").click(function(){
				if($('#q').val()==''){
					alert('검색어를 입력해 주세요 Product Code');
					return false;
				}else{
					var act='/shop/index.php/products/lists/q/'+$("#q").val()+'/page/1';
					$("#search_form").attr('action',act).submit();
				}
			})
		});
</script>
<div class="container-fluid">

test page
<br><br><br><br><br>
<div class="row">
	<div class="col-sm-10">

	</div>

	<div class="col-sm-2" style="text-align:center">
			<?php echo($pagination); #echo $pagination ?>
	</div>

</div>
<div class="row">
	<div class="col-sm-9">
	</div>
	<div class="col-sm-3" style="text-align:center">

		<!-- 검색 폼  -->
		<form class="form-inline" role="form"  method="post" id="search_form">
			<div class="form-group">
				<label for="usr">Product Code</label>
				<input type="text" class="form-control" id="q" name="search_word">
				<input type="submit" name="name" value="검색" id="search_btn">
			</div>
		</form>

	</div>
</div>
<div class="row-fluid">
	<table class="table table-striped">
	 	<tr>
	 		<th>Product Code</th>
	 		<th>Image</th>
	 		<th>Price</th>
	 		<th>Status</th>
	 		<th>Business Group</th>
	 		<th>Product Group</th>
	 		<th>Stock</th>
	 		<th>Supplier</th>
	 		<th>MarketPlaces</th>
	 		<th>Added Time</th>
			<th>Added User</th>
	 		<th>Modified Time</th>
	 		<th>Modified User</th>

	 	</tr>

		<?php
		foreach($list as $keys => $val){
			echo "<tr>";
			foreach( $val as $key => $values){

				/*  만약   $key == 'Image' 일경우  $values  앞에  <img src="  뒤에 "> 넣는다. */

				echo  "<td>".$values. "</td>";


			}
			echo "</tr>";

		}
		#echo $a[0]->{'Product Code'};



		?>
	</table>
	<div class="">
		<?php
			#var_dump($a);
			#var_dump($data['pagination']);
		?>
	</div>
</div>
