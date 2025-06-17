<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data Dosen</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h3 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        td { padding: 8px; }
        .label { width: 30%; font-weight: bold; }
    </style>
</head>
<body>
    <h3>Data Dosen</h3>
    <table>
        <tr>
            <td class="label">Nama Dosen</td>
            <td>: {{ $dosen['nama_dosen'] }}</td>
        </tr>
        <tr>
            <td class="label">NIDN</td>
            <td>: {{ $dosen['nidn'] }}</td>
        </tr>
        <tr>
            <td class="label">ID User</td>
            <td>: {{ $dosen['id_user'] }}</td>
        </tr>
    </table>
</body>
</html>
