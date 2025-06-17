<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
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
                        <a class="nav-link active text-white" aria-current="page" href="{{ route('home') }}"><i class="bi bi-house-door-fill me-1"></i>Beranda</a>
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
            <h3 class="fw-semibold">Daftar Dosen</h3>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahDosen">
                <i class="bi bi-plus-circle me-1"></i>Tambah Dosen
            </button>
        </div>

        <div class="table-responsive shadow-sm rounded">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIDN</th>
                        <th>ID User</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dosen as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item['nama_dosen'] }}</td>
                        <td>{{ $item['nidn'] }}</td>
                        <td>{{ $item['id_user'] }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning edit-btn"
                                data-bs-toggle="modal"
                                data-bs-target="#editModal"
                                data-id="{{ $item['id_dosen'] }}"
                                data-nama="{{ $item['nama_dosen'] }}"
                                data-nidn="{{ $item['nidn'] }}"
                                data-user="{{ $item['id_user'] }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>

                            <form action="{{ route('dosen.destroy', $item['id_dosen']) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>

                            <a href="{{ route('dosen.exportPdfPerData', $item['id_dosen']) }}" class="btn btn-sm btn-danger">
                                <i class="bi bi-file-earmark-pdf-fill"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah Dosen -->
    <div class="modal fade" id="tambahDosen" tabindex="-1" aria-labelledby="tambahDosenLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('dosen.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahDosenLabel">Tambah Dosen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Dosen</label>
                        <input type="text" class="form-control" name="nama_dosen" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">NIDN</label>
                        <input type="number" class="form-control" name="nidn" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ID User</label>
                        <input type="text" class="form-control" name="id_user" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Dosen -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editForm" method="POST" class="modal-content">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Dosen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="mb-3">
                        <label>Nama Dosen</label>
                        <input type="text" name="nama_dosen" id="edit-nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>NIDN</label>
                        <input type="text" name="nidn" id="edit-nidn" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>ID User</label>
                        <input type="text" name="id_user" id="edit-user" class="form-control" required>
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
                    const id = this.dataset.id;
                    const nama = this.dataset.nama;
                    const nidn = this.dataset.nidn;
                    const user = this.dataset.user;

                    document.getElementById("edit-id").value = id;
                    document.getElementById("edit-nama").value = nama;
                    document.getElementById("edit-nidn").value = nidn;
                    document.getElementById("edit-user").value = user;

                    editForm.action = `/dosen/${id}`;
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>