<h1 class="mt-4">Laporan Peminjaman Buku</h1>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <a href="cetak.php" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Cetak Data</a>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>User</th>
                            <th>Buku</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Status Peminjaman</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM peminjaman 
                            LEFT JOIN user ON user.id_user = peminjaman.id_user 
                            LEFT JOIN buku ON buku.id_buku = peminjaman.id_buku");

                        while ($data = mysqli_fetch_array($query)) :
                        ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $data['username'] ?></td>
                                <td><?= $data['judul'] ?></td>
                                <td><?= $data['tanggal_peminjaman'] ?></td>
                                <td><?= $data['tanggal_pengembalian'] ?></td>
                                <td><?= $data['status_peminjaman'] ?></td>
                                <td>
                                    <?php if ($data['status_peminjaman'] != 'dikembalikan' && $_SESSION['user']['level'] != 'peminjam') : ?>
                                        <a href="?page=peminjaman_ubah&id=<?= $data['id_peminjaman']; ?>&user_id=<?= $data['id_user']; ?>" class="btn btn-success">Kembalikan</a>
                                        <a onclick="return confirm('Apakah anda yakin menghapus data ini?');" href="?page=peminjaman_hapus&id=<?= $data['id_peminjaman']; ?>" class="btn btn-danger">Hapus</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
