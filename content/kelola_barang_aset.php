<?php 
require_once 'config/db.php';
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
<div class="row">
	<div class="col-lg-12">
		<div class="card mb-12">
	        <div class="card-header">
	            <button class="btn btn-secondary float-left" data-toggle="modal" data-target="#modal-insert"><i class="fas fa-plus"></i> Tambah Data</button>&nbsp;
                <!-- <button class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-filter"><i class="fas fa-setting"></i>Filter</button> -->
                <div class="float-right">
                    <a href="php/export/print.php?tempat=<?php echo $_GET['tempat'] ?>">Export</a>
                </div>
	        </div>
	        <div class="card-body">
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
	        			<th>Action</th>
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
                            <td><img src="php/<?php echo $value['foto_aset'] ?>" class="gambar"></td>
							<td> <button class="btn btn-primary" data-toggle="modal" data-target="#modal-view-<?php echo $value['id_aset'] ?>"><i class="fas fa-eye"></i></button> | <button class="btn btn-primary" data-toggle="modal" data-target="#modal-edit-<?php echo $value['id_aset'] ?>"><i class="fas fa-edit"></i></button> | <button class="btn btn-primary" onclick="window.location.href='php/aset.php?hapus=&id=<?php echo($value['id_aset']) ?>&tempat_aset=<?php echo($tempat)?>'" >
								<a
								class="fas fa-trash" 
								></a></button></td>			
	        			</tr>
	        			<?php endforeach ?>
	        		</tbody>
	        	</table>
	        </div>
		</div>
    </div>
</div>
<?php foreach ($aset as $key => $value): ?>
<div class="modal" tabindex="-1" role="dialog" id="modal-view-<?php echo $value['id_aset'] ?>">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal View </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        	<div class="col-lg-12">
        		<img class="img-responsive" src="php/<?php echo $value['foto_aset'] ?>" style="max-width: 100%">
        	</div>
        </div>
      </div>
      <div class="modal-footer"> 
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal modal fade bd-example-modal-lg " tabindex="-1" role="dialog" id="modal-edit-<?php echo $value['id_aset'] ?>">
  <div class="modal-dialog modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="php/aset.php" enctype="multipart/form-data" method="post">
        <input type="hidden" name="id" value="<?php echo $value['id_aset'] ?>">
        <input type="hidden" name="edit">
    	<input type="hidden" name="tempat_aset" value="<?php echo $tempat ?>">		
        <div class="row">
        	<div class="col-lg-6">
        		<div class="form-group">
        			<label>No Register</label>
        			<input type="text" class="form-control" name="no_register_aset" value="<?php echo $value['no_register_aset'] ?>">
        		</div>
        		<div class="form-group">
        			<label>Nama Barang</label>
        			<input type="text" class="form-control" name="nama_barang_aset" value="<?php echo $value['nama_barang_aset'] ?>">
        		</div>
                <div class="form-group">
                    <label>Kategori Aset</label>
                    <select class="form-control" name="id_kategori">
                        
                        <?php foreach ($kategori as $k => $v): ?>
                            <option value="<?php echo $v['id_kategori'] ?>" <?php if ($value['id_kategori'] == $v['id_kategori']): ?>
                                selected
                            <?php endif ?>><?php echo $v['nama_kategori'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
        		<div class="form-group">
        			<label>Merk</label>
        			<input type="text" class="form-control" name="merk_aset" value="<?php echo $value['merk_aset'] ?>">
        		</div>
        		<div class="form-group">
        			<label>Tahun Awal</label>
        			<input type="text" class="form-control" name="tahun_awal_aset" value="<?php echo $value['tahun_awal_aset'] ?>">
        		</div>
        	</div>
        	<div class="col-lg-6">
        		<div class="form-group">
        			<label>Nilai Awal</label>
        			<input type="text" class="form-control" name="nilai_awal_aset" value="<?php echo $value['nilai_awal_aset'] ?>">
        		</div>
        		<div class="form-group">
        			<label>Fisik Aset</label>
    				<select class="form-control" name="fisik_aset">
	        			<option><?php echo $value['fisik_aset'] ?></option>
	        			<option>Ada</option>
	        			<option>Tidak Ada</option>
    				</select>
        		</div>
        		<div class="form-group">
        			<label>Kondisi</label>
        			<select class="form-control" name="kondisi_aset">
        				<option><?php echo $value['kondisi_aset'] ?></option>
        				<option>Baik</option>
        				<option>Sedang</option>
        				<option>Rusak</option>
        			</select>
        		</div>
        		<div class="form-group">
        			<label>Jumlah</label>
        			<input type="number" class="form-control" name="jumlah_aset" value="<?php echo $value['jumlah_aset'] ?>">
        		</div>
                <div class="form-group">
                    <label>Ruangan</label>
                    <input type="text" class="form-control" name="ruangan_aset" value="<?php echo $value['ruangan_aset'] ?>">
                </div>
        	</div>
            <div class="col-lg-12">

            <div class="form-group">
                <label>Model</label>
                <input type="text" name="model_aset" class="form-control" value="<?php echo $value['model_aset'] ?>">
            </div>    
            <label>Foto Aset</label> 
                <div class="form-group">
                    <input type="file" name="foto_aset" class="form-control">
                </div>  
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save changes</button>
      </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>	
<?php endforeach ?>
<div class="modal modal fade bd-example-modal " tabindex="-1" role="dialog" id="modal-insert">
  <div class="modal-dialog modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal Insert</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="php/aset.php" enctype='multipart/form-data' method="post">
        <div class="row">
        	<input type="hidden" name="insert">
        	<input type="hidden" name="tempat_aset" value="<?php echo $tempat ?>">		
        	<div class="col-lg-6">
        		<div class="form-group">
        			<label>No Register</label>
        			<input type="text" class="form-control" name="no_register_aset" >
        		</div>
        		<div class="form-group">
        			<label>Nama Barang</label>
        			<input type="text" class="form-control" name="nama_barang_aset" >
        		</div>
                <div class="form-group">
                    <label>Kategori Aset</label>
                    <select class="form-control" name="id_kategori">
                        <?php foreach ($kategori as $k => $v): ?>
                            <option value="<?php echo $v['id_kategori'] ?>"><?php echo $v['nama_kategori'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
        		<div class="form-group">
        			<label>Merk</label>
        			<input type="text" class="form-control" name="merk_aset" >
        		</div>
        		<div class="form-group">
        			<label>Tahun Awal</label>
        			<input type="text" class="form-control" name="tahun_awal_aset" >
        		</div>
        	</div>
        	<div class="col-lg-6">
        		<div class="form-group">
        			<label>Nilai Awal</label>
        			<input type="text" class="form-control" name="nilai_awal_aset" >
        		</div>
        		<div class="form-group">
        			<label>Fisik Aset</label>
    				<select class="form-control" name="fisik_aset">
	        			<option disabled="" selected>Pilih ...</option>
	        			<option>Ada</option>
	        			<option>Tidak Ada</option>
    				</select>
        		</div>
        		<div class="form-group">
        			<label>Kondisi</label>
        			<select class="form-control" name="kondisi_aset">
        				<option disabled="" selected>Pilih ...</option>
        				<option>Baik</option>
        				<option>Sedang</option>
        				<option>Rusak</option>
        			</select>
        		</div>
        		<div class="form-group">
        			<label>Jumlah</label>
        			<input type="number" class="form-control" name="jumlah_aset" >
        		</div>
                <div class="form-group">
                    <label>Ruangan</label>
                    <input type="text" class="form-control" name="ruangan_aset" >
                </div>
        	</div>
        	<div class="col-lg-12">
            <div class="form-group">
                <label>Model</label>
                <input type="text" name="model_aset" class="form-control" >
            </div>
        	<label>Foto Aset</label> 
        		<div class="form-group">
        			<input type="file" name="foto_aset" class="form-control">
        		</div>	
        	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>	
<div class="modal modal fade bd-example-modal " tabindex="-1" role="dialog" id="modal-filter">
  <div class="modal-dialog modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal Filter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="index.php" method="get">
        <input type="hidden" name="filter" >
        <input type="hidden" name="content" value="kelola_barang_aset">

        <input type="hidden" name="tempat" value="<?php echo $tempat ?>">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Nama barang</label>
                    <input type="text" class="form-control" name="nama_barang_aset" value="<?php echo isset($_GET['nama_barang_aset'])?$_GET['nama_barang_aset']:'';?>">
                </div>    
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>  