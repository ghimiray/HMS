<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12">
			<a href="<?php echo base_url()?>departments/add" class="btn btn-small btn-primary"><i class="btn-icon-only icon-plus"></i>Add Department</a>
			<br><br>
			<table class="table table-striped table-bordered">
				<thead>
				  <tr>
				    <th> Department ID </th>
				    <th> Department Name </th>
				    <th> Department Budget </th>
				    <th class="td-actions"> Actions </th>
				  </tr>
				</thead>
				<tbody>
				<?php
				if(isset($departments) and is_array($departments)){
					foreach ($departments as $dc=>$dept) {
				?>
				  <tr>
				    <td> <?php echo $dept->department_id?> </td>
				    <td> <?php echo $dept->department_name?> </td>
				    <td> <?php echo $dept->department_budget?> </td>
				    <td class="td-actions"><a href="<?php echo base_url()?>departments/edit/<?php echo $dept->department_id?>" class="btn btn-small btn-primary"><i class="btn-icon-only icon-edit"> </i></a> | <a href="<?php echo base_url()?>departments/delete/<?php echo $dept->department_id?>" onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i></a></td>
				  </tr>
				<?php }
				} else {?>
				<tr>
					<td colspan="4"><i>There are no departments to show.</i></td>
				</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	  </div>
	</div>
  </div>
</div>