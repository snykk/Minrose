<main>
    <div class="container-fluid px-4 mt-4">
        <!-- inisial value -->
        <input type="hidden" name="username" id="username" value="<?php if (isset($_GET["username"])) echo $_GET["username"]; else echo ""; ?>">

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-fw fa-solid fa-users me-1"></i>
                Customers
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Nama Lengkap</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Jenis Kelamin</th>
                            <th>Nomor HP</th>
                            <th>Alamat</th>
                            <th>Data Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($user_member->result() as $row) :?>
                            <tr>
                                <td><?= $row->nama_lengkap; ?></td>
                                <td><?= $row->username; ?></td>
                                <td><?= $row->email; ?></td>
                                <td><?= $row->jenis_kelamin; ?></td>
                                <td><?= $row->no_hp; ?></td>
                                <td><?= $row->alamat; ?></td>
                                <td><?= date('d F Y', $row->data_dibuat); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>