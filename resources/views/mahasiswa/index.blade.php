<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body shadow-sm" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-white" href="#">
                <i class="bi bi-mortarboard-fill me-2"></i>PNC
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav nav-underline">
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="{{ route('home') }}"><i class="bi bi-house-door-fill me-1"></i>Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('dosen.index') }}"><i class="bi bi-people-fill me-1"></i>Dosen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('mahasiswa.index') }}"><i class="bi bi-people-fill me-1"></i>Mahasiswa</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-semibold">Daftar Mahasiswa</h3>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahMahasiswa">
                <i class="bi bi-plus-circle me-1"></i>Tambah Mahasiswa
            </button>
        </div>

        <div class="table-responsive shadow-sm rounded">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>NPM</th>
                        <th>ID User</th>
                        <th>ID Dosen</th>
                        <th>ID Kajur</th>
                        <th>Nama Mahasiswa</th>
                        <th>Tempat Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Agama</th>
                        <th>Angkatan</th>
                        <th>Program Studi</th>
                        <th>Semester</th>
                        <th>No HP</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mahasiswa as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item['npm'] }}</td>
                        <td>{{ $item['id_user'] }}</td>
                        <td>{{ $item['id_dosen'] }}</td>
                        <td>{{ $item['id_kajur'] }}</td>
                        <td>{{ $item['nama_mahasiswa'] }}</td>
                        <td>{{ $item['tempat_tanggal_lahir'] }}</td>
                        <td>{{ $item['jenis_kelamin'] }}</td>
                        <td>{{ $item['alamat'] }}</td>
                        <td>{{ $item['agama'] }}</td>
                        <td>{{ $item['angkatan'] }}</td>
                        <td>{{ $item['program_studi'] }}</td>
                        <td>{{ $item['semester'] }}</td>
                        <td>{{ $item['no_hp'] }}</td>
                        <td>{{ $item['email'] }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning edit-btn"
                                data-bs-toggle="modal"
                                data-bs-target="#editModal"
                                data-id="{{ $item['npm'] }}"
                                data-user="{{ $item['id_user'] }}"
                                data-dosen="{{ $item['id_dosen'] }}"
                                data-kajur="{{ $item['id_kajur'] }}"
                                data-nama="{{ $item['nama_mahasiswa'] }}"
                                data-ttl="{{ $item['tempat_tanggal_lahir'] }}"
                                data-jk="{{ $item['jenis_kelamin'] }}"
                                data-alamat="{{ $item['alamat'] }}"
                                data-agama="{{ $item['agama'] }}"
                                data-angkatan="{{ $item['angkatan'] }}"
                                data-prodi="{{ $item['program_studi'] }}"
                                data-semester="{{ $item['semester'] }}"
                                data-hp="{{ $item['no_hp'] }}"
                                data-email="{{ $item['email'] }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>

                            <form action="{{ route('mahasiswa.destroy', $item['npm']) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah Mahasiswa -->
    <div class="modal fade" id="tambahMahasiswa" tabindex="-1" aria-labelledby="tambahMahasiswaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form class="modal-content" action="{{ route('mahasiswa.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahMahasiswaLabel">Tambah Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <label>NPM</label>
                        <input type="text" name="npm" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>ID User</label>
                        <input type="text" name="id_user" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>ID Dosen</label>
                        <input type="text" name="id_dosen" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>ID Kajur</label>
                        <input type="text" name="id_kajur" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Nama Mahasiswa</label>
                        <input type="text" name="nama_mahasiswa" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Tempat & Tanggal Lahir</label>
                        <input type="text" name="tempat_tanggal_lahir" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="">Pilih</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Agama</label>
                        <input type="text" name="agama" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Angkatan</label>
                        <input type="text" name="angkatan" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Program Studi</label>
                        <input type="text" name="program_studi" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Semester</label>
                        <input type="text" name="semester" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>No HP</label>
                        <input type="text" name="no_hp" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal Edit Mahasiswa -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="editForm" method="POST" class="modal-content">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <label>NPM</label>
                        <input type="text" name="npm" id="edit-npm" class="form-control" readonly>
                    </div>
                    <div class="col-md-6">
                        <label>ID User</label>
                        <input type="text" name="id_user" id="edit-id_user" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>ID Dosen</label>
                        <input type="text" name="id_dosen" id="edit-id_dosen" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>ID Kajur</label>
                        <input type="text" name="id_kajur" id="edit-id_kajur" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Nama Mahasiswa</label>
                        <input type="text" name="nama_mahasiswa" id="edit-nama" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Tempat & Tanggal Lahir</label>
                        <input type="text" name="tempat_tanggal_lahir" id="edit-ttl" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="edit-jk" class="form-control">
                            <option value="">Pilih</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Alamat</label>
                        <input type="text" name="alamat" id="edit-alamat" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Agama</label>
                        <input type="text" name="agama" id="edit-agama" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Angkatan</label>
                        <input type="text" name="angkatan" id="edit-angkatan" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Program Studi</label>
                        <input type="text" name="program_studi" id="edit-prodi" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Semester</label>
                        <input type="text" name="semester" id="edit-semester" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>No HP</label>
                        <input type="text" name="no_hp" id="edit-hp" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Email</label>
                        <input type="email" name="email" id="edit-email" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>


    <!-- JavaScript -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const editButtons = document.querySelectorAll(".edit-btn");
            const editForm = document.getElementById("editForm");

            editButtons.forEach(button => {
                button.addEventListener("click", function() {
                    document.getElementById("edit-npm").value = this.dataset.id;
                    document.getElementById("edit-id_user").value = this.dataset.user;
                    document.getElementById("edit-id_dosen").value = this.dataset.dosen;
                    document.getElementById("edit-id_kajur").value = this.dataset.kajur;
                    document.getElementById("edit-nama").value = this.dataset.nama;
                    document.getElementById("edit-ttl").value = this.dataset.ttl;
                    document.getElementById("edit-jk").value = this.dataset.jk;
                    document.getElementById("edit-alamat").value = this.dataset.alamat;
                    document.getElementById("edit-agama").value = this.dataset.agama;
                    document.getElementById("edit-angkatan").value = this.dataset.angkatan;
                    document.getElementById("edit-prodi").value = this.dataset.prodi;
                    document.getElementById("edit-semester").value = this.dataset.semester;
                    document.getElementById("edit-hp").value = this.dataset.hp;
                    document.getElementById("edit-email").value = this.dataset.email;

                    editForm.action = `/mahasiswa/${this.dataset.id}`;
                });
            });
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>