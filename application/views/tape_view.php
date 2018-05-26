<html>
<head lang="en">
	<meta charset="UTF-8">
	<title>Belajar Codeignter</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ;?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css') ;?>">
</head>
<body>
	<div class="container">
		<h1>Belajar Codeigniter</h1>
		<h3>Library Tape</h3>
		<button class="btn btn-primary" onclick="add_tape()" ><i class="glyphicon glyphicon-plus"></i>ADD Tape</button>
		<br>
		<br>
		<table id="table_id" class="table table-stripped table-bordered">
			<thead>
				<tr>
					<th>Tape ID</th>
					<th>Tape Title</th>
					<th>Tape Category</th>
					<th>Tape Quality</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach($tape as $t){ 
				?>
			<tr>
				<td><?php echo $t->tape_id ;?></td>
				<td><?php echo $t->tape_title ;?></td>
				<td><?php echo $t->tape_category ;?></td>
				<td><?php echo $t->tape_quality ;?></td>
				<td>
					<button class="btn btn-warning" onclick="edit_tape(<?php echo $t->tape_id; ?>)"><i class="glyphicon glyphicon-pencil"></i></button>
					<button class="btn btn-danger" onclick="delete_tape(<?php echo $t->tape_id; ?>)"><i class="glyphicon glyphicon-remove"></i></button>
				</td>	
			</tr>
			<?php
			}
			?>
			</tbody>
			
		</table>
	</div>


	<script src="<?php echo base_url('assets/jquery/jquery-3.3.1.min.js') ;?>"></script>
	<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ;?>"></script>
	<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js') ;?>"></script>
	<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js') ;?>"></script>


	<script type="text/javascript">
		$(document).ready(function() {
			$('#table_id').DataTable();
		});

		var save_method;
		var table;

		function add_tape() {
			save_method = 'add';
			$('#form')[0].reset();
			$('#modal_form').modal('show');
		}
		function save() {
		 	var url;

		 	if(save_method == 'add'){
		 		url= '<?php echo site_url('index.php/tape/tape_add') ;?>';
		 	}else {
		 		url = '<?php echo site_url('index.php/tape/tape_update') ;?>';

		 	}

		 	$.ajax({
		 		url: url,
		 		type: "POST",
		 		data: $('#form').serialize(),
		 		dataType: "JSON",
		 		success: function(data) {
		 			$('#modal_form').modal('hide');
		 			location.reload();
		 		},
		 		error: function(jqXHR, textStatus, errorThrown) {
		 			alert('Error update data');
		 		}
		 	});

		 }

		 	function edit_tape(id){
		 		save_method = 'update';
		 		$('#form')[0].reset();

		 		$.ajax({
		 			url: "<?php echo site_url('index.php/tape/ajax_edit/') ;?>/"+id,
		 			type: "GET",
		 			dataType: "JSON",
		 			success: function(data) {
		 				$('[name="tape_id"]').val(data.tape_id);
		 				$('[name="tape_title"]').val(data.tape_title);
		 				$('[name="tape_category"]').val(data.tape_category);
		 				$('[name="tape_quality"]').val(data.tape_quality);

		 				$('#modal_form').modal('show');

		 				$('.modal-title').text('Edit Tape');
		 			},
		 			error: function(jqXHR, textStatus, errorThrown){
		 				alert('Error Get Data From Ajax');
		 		}	
		 	});
		 }

		 	function delete_tape(id){
		 		if(confirm('Are You sure Delete this data')){

		 			$.ajax({
		 				url: "<?php echo site_url('index.php/tape/tape_delete/') ;?>/"+id,
		 			type: "POST",
		 			dataType: "JSON",
		 			success: function(data) {
		 				location.reload();
		 		},
		 		error: function(jqXHR, textStatus, errorThrown){
		 				alert('Error Deleting data');
		 		}

		 	});
		 }
	 }
	</script>

<div class="modal fade" id="modal_form" role="dialog">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">Content Tape</h4>
</div>

<div class="modal-body form">
<form action="#" id="form" class="form-horizontal">
	<input type="hidden" value="" name="tape_id">

	<div class="form-body">
		<div class="form-group">
			<label class="control-label col-md-3">Tape Title</label>
			<div class="col-md-9">
				<input type="text" name="tape_title" placeholder="Tape_Title" class="form-control">
			</div>
		</div>
	</div>

	<div class="form-body">
		<div class="form-group">
			<label class="control-label col-md-3">Tape Category</label>
			<div class="col-md-9">
				<input type="text" name="tape_category" placeholder="Tape_Category" class="form-control">
			</div>
		</div>
	</div>

	<div class="form-body">
		<div class="form-group">
			<label class="control-label col-md-3">Tape Quality</label>
			<div class="col-md-9">
				<input type="text" name="tape_quality" placeholder="Tape_Quality" class="form-control">
			</div>
		</div>
	</div>
	
</form>

</div>

<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="button" onclick="save()" class="btn btn-primary">Input</button>
</div>
</div>
</div>
</div>

</body>
</html>