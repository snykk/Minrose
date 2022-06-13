<main>
    <div class="container-fluid px-4 mt-4">

        <?php
        echo $this->session->flashdata('message');
        unset($_SESSION['message']);
        ?>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-fw fa-solid fa-money-check-dollar me-1"></i>
                Transaksi
            </div>
            <div class="card-body">
                <table id="tabelTransaksi">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Kategori</th>
                            <th>Keterangan</th>
                            <th>Pemasukan</th>
                            <th>Pengeluaran</th>
                            <th>Data dibuat</th>
                            <th>Interface</th>
                        </tr>
                    </thead>
                    <tbody>
                        <a href="<?= base_url("transaksi/tambah_pengeluaran"); ?>" title="ubah data" class="float-end mb-3"><button class='btn btn-secondary'>Tambah pengeluaran</button></a>
                        <?php
                        $inc = 0;
                        foreach ($transaksi as $row) :
                            $inc += 1;

                            $button = '<a href=" ' . base_url("transaksi/ubah_pengeluaran?id_transaksi=") . $row["id"] . '"title="ubah data"><button class="btn btn-secondary"><i class="fas fa-solid fa-marker"></i></button></a>';
                        ?>

                            <tr>
                                <td><?= $inc; ?></td>
                                <td><?= $row["kategori"]; ?></td>
                                <td><?= $row["keterangan"]; ?></td>
                                <td><?= $row["pemasukan"] ? $row["pemasukan"] : "----"; ?></td>
                                <td><?= $row["pengeluaran"] ? $row["pengeluaran"] : "----"; ?></td>
                                <td><?= date("d-M-Y", $row["data_dibuat"]); ?></td>
                                <td><?= $row["pemasukan"] ? "" : $button; ?></td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>