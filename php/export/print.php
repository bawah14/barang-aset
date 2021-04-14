<?php
require_once '../../config/db.php';
// header("Content-type: application/vnd-ms-excel");
// header("Content-Disposition: attachment; filename=hasil.xls");
$db = new db();
$q = "select * from aset inner join kategori on aset.id_kategori = kategori.id_kategori where tempat_aset = ".$_GET['tempat']."";
if (isset($_GET['filter'])) {
    # code...
    foreach ($_GET as $key => $value) {
        # code...
        $not_include  = array('filter' ,"content","tempat" );
        if ( !in_array($key, $not_include)) {
            # code...
            if ($value!="") {
                # code...
                $q.=" and ".$key." like '%".$value."%'";
            }
        }
    }
}
// echo "$q";
$aset = $db->manual_query($q);
$kategori = $db->manual_query("select * from kategori");
// print_r($aset);
if (isset($_GET['tempat'])) {
	# code...
	$tempat = $_GET['tempat'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<table class=" table table-bordered table-stripped datatable">
	<thead>
		<th>No Register</th>
		<th style="width: 10%">Nama Barang</th>
		<th>Merk</th>
        <th>Model</th>
		<th>Tahun</th>
		<!-- <th>Nilai Awal</th> -->
		<th>Fisik</th>
		<th>Kondisi</th>
		<th>Lokasi</th>
        <th>Kategori</th>
        <th>Gambar</th>
	</thead>
	<tbody>
		<?php foreach ($aset as $key => $value): ?>
		<tr>
			<td><?php echo $value['no_register_aset'] ?></td>
			<td><?php echo $value['nama_barang_aset'] ?></td>
			<td><?php echo $value['merk_aset'] ?></td>
            <td><?php echo $value['model_aset'] ?></td>
			<td><?php echo $value['tahun_awal_aset'] ?></td>
			<!-- <td><?php echo number_format((int)$value['nilai_awal_aset']) ?></td> -->
			<td><?php echo $value['fisik_aset'] ?></td>
			<td><?php echo $value['kondisi_aset'] ?></td>
			<td><?php echo $value['ruangan_aset'] ?></td>
            <td><?php echo $value['nama_kategori'] ?></td>
            <td><img src="../<?php echo $value['foto_aset'] ?>" style="max-width: 200px;max-height: 200px"></td>
					
		</tr>
		<?php endforeach ?>
	</tbody>
</table>
</body>
</html>