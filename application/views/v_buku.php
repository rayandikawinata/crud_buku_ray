<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> Aplikasi CRUD Buku</title>

	<!-- memanggil assets -->
	<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ;?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css') ;?>">

</head>
<body>

	<div class="container">
		<h1>Belajar Condeigniter</h1>
		<h3>Toko Buku</h3>

		<button class="btn btn-success" onclick="tambah_buku()"><i class="glyphicon glyphicon-plus"></i>Tambah Buku</button>
		<br>
		<br>
	

	<table id="id_table" class="table table-stripped table-bordered" >
		<thead>
			<tr>
				<th>ID Buku</th>
				<th>Judul Buku</th>
				<th>Kategori Buku</th>
				<th>ISBN Buku</th>
				<th>Aksi</th>
			</tr>
		</thead>

		<tbody>
		<?php 
		foreach($buku as $cb){

			?>
		
			<tr>
				<td><?php echo $cb->id_buku ;?></td>
				<td><?php echo $cb->judul_buku ;?></td>
				<td><?php echo $cb->kategori_buku ;?></td>
				<td><?php echo $cb->isbn_buku ;?></td>
				<td>
					<button class="btn btn-warning" onclick="edit_buku(<?php echo $cb->id_buku; ?>)"><i class="glyphicon glyphicon-pencil"></i></button>
					<button class="btn btn-danger" onclick="hapus_buku(<?php echo $cb->id_buku; ?>)"><i class="glyphicon glyphicon-remove"></i></button>
				</td>
			</tr>

			<?php 
			}
			?>
		</tbody>
	</table>

	</div>

	<!-- memanggil js -->
	<script src="<?php echo base_url('assets/jquery/jquery-3.3.1.min.js') ;?>"></script>
	<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ;?>"></script>
	<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js') ;?>"></script>
	<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js') ;?>"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#id_table').DataTable();
		});

		var simpan_method;
		var table;

		function tambah_buku(){
			simpan_method = 'add';
			$('#form')[0].reset();
			$('#modal_form').modal('show');
		}

		function save(){
			var url;
			 if(simpan_method == 'add'){
			 	url='<?php echo site_url('index.php/buku/add') ;?>';
			 } else {
			 	url='<?php echo site_url('index.php/buku/buku_update') ;?>';
			 }

		$.ajax({
			url: url,
			type: "POST",
			data: $('#form').serialize(),
			dataType: "JSON",
			success: function(data){
				$('#modal_form').modal('hide');
				location.reload();
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error adding/Update data');
			}
		}

			);
	}

	function edit_buku(id){
		simpan_method = 'update';
		$('form')[0].reset();

		//memanggil ajax edit

		$.ajax({
			url: "<?php echo site_url('index.php/buku/ajax_edit/'); ?>/"+id,
			type: "GET",
			dataType: "JSON",
			success: function(data){

				$('[name="id_buku"]').val(data.id_buku);
				$('[name="judul_buku"]').val(data.judul_buku);
				$('[name="kategori_buku"]').val(data.kategori_buku);
				$('[name="isbn_buku"]').val(data.isbn_buku);

				$('#modal_form').modal('show');

				$('.modal_title').text('Edit buku');
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error Get Data From Ajax');
			}
		});
	}

	function hapus_buku(id){
		if(confirm('Apakah ingin menghapus data ini?')){

			//menghapus data dari database
			$.ajax({
				url: "<?php echo site_url('index.php/buku/hapus');?>/"+id,
				type: "POST",
				dataType: "JSON",
				success: function(data){
					location.reload();
				},
				error: function(jqXHR, textStatus, errorThrown){
					alert('Error Deleting Data');
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
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body form">
      <form action="#" id="form" class="form-horizontal">
      	<input type="hidden" value="" name="id_buku">

      	<div class="form-body">
      		<div class="form-group">
      			<label class="control-label col-md-3"> Judul Buku </label>
      			<div class="col-md-9">
      				<input type="text" name="judul_buku" placeholder="Judul Buku" class="form-control" >
      			</div>
      		</div>
      	</div>

      	<div class="form-body">
      		<div class="form-group">
      			<label class="control-label col-md-3"> Kategori Buku </label>
      			<div class="col-md-9">
      				<input type="text" name="kategori_buku" placeholder="kategori Buku" class="form-control" >
      			</div>
      		</div>
      	</div>

      	<div class="form-body">
      		<div class="form-group">
      			<label class="control-label col-md-3"> ISBN Buku </label>
      			<div class="col-md-9">
      				<input type="text" name="isbn_buku" placeholder="ISBN Buku" class="form-control" >
       			</div>     			
      		</div>
      	</div>

      </form>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="save()" class="btn btn-primary" >Simpan</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

	
</body>
</html>