<?php

?>
<div class="container-fluid">

test page
<br><br><br><br><br>
<div class="">
	<?php echo($pagination); #echo $pagination ?>
</div>
<div>
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
