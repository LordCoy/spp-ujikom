<!DOCTYPE html>
<html>
<head>
	<title>Data Petugas | SPP</title>
</head>
<body>
	<br><br><br><br>

	<div class="content-home" style="align-content: left; margin-left: 5%; margin-right: 5%;">
		<a href="<?php echo site_url('Admin/Tambah_Data_Petugas') ?>"class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Data Petugas</a><br><br>

		<form method="post" action="<?php echo site_url('Admin/Data_Petugas') ?>" class="form-control">
			<p>Filter Pencarian</p>
			<div class="row">
				<div class="col">
					<input type="text" name="nama_petugas" placeholder="Cari Nama Petugas..." class="form-control">
				</div>
				<div class="col">
					<select name="level" class="form-control">
						<option value="">- Cari Level</option>
						<option value="admin">Admin</option>
						<option value="petugas">Petugas</option>
					</select>
				</div>
				<div class="col-md-1">
					<button class="btn btn-sm btn-success"><i class="fa fa-search"></i>&nbsp;&nbsp;Cari</button>
				</div>
			</div>
		</form><br>

		<table class="table table-striped">
			<tr class="thead-light">
				<th>NO</th>
				<th>NAMA PETUGAS</th>
				<th>LEVEL</th>
				<th>USERNAME</th>
				<th>OPTION</th>
			</tr>
			<?php $no=1; foreach($petugas as $p){ ?>
			<tr>
				<td><?php echo $no++ ?></td>
				<td><?php echo $p['nama_petugas'] ?></td>
				<td><?php echo $p['level'] ?></td>
				<td><?php echo $p['username'] ?></td>
				<td>
					<a href="<?php echo site_url('Admin/Edit_Data_Petugas/'.$p['id_petugas']) ?>"class="btn btn-sm btn-success"><i class="fa fa-pencil"></i>&nbsp;&nbspEdit</a>&nbsp;&nbsp;
					<a href="<?php echo site_url('Admin/Hapus_Data_Petugas/'.$p['id_petugas']) ?>"class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;Hapus</a>
				</td>
			</tr>
			<?php } ?>
		</table>
	</div>
</body>
</html>