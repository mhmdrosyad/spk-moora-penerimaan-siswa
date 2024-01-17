<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use App\Models\HasilModel;
use App\Models\AkunModel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\KriteriaModel;
use App\Models\AtributKriteriaModel;


class Home extends BaseController
{
    private function authenticate()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login'); // Ganti '/login' dengan URL login Anda
        }
    }

    public function index()
    {
        $this->authenticate();

        $siswaModel = new SiswaModel();
        $kriteriaModel = new KriteriaModel();

        $data['siswa'] = $siswaModel->getSiswaWithAtributKriteria();
        $data['kriteria'] = $kriteriaModel->findAll(); // Ambil semua data kriteria

        return view('index', $data);
    }

    public function login()
    {
        $session = session();

        if ($this->request->getMethod() === 'post') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            // Validasi apakah username dan password diisi
            if (empty($username) || empty($password)) {
                $session->setFlashdata('error', 'Username and password are required');
                $session->setFlashdata('error_color', 'red');
                return redirect()->to('/login');
            }

            // Cek ke database untuk verifikasi login menggunakan model
            $akunModel = new AkunModel();
            $user = $akunModel->where('username', $username)->first();

            if ($user) {
                $hashedPassword = $user['password'];
                // Periksa apakah password yang dimasukkan cocok dengan password yang di-hash
                if ($password == $hashedPassword) {
                    // Jika login berhasil, set session dan arahkan ke halaman utama
                    $session->set('username', $username);
                    return redirect()->to(base_url('/'));
                } else {
                    // Jika password tidak cocok, beri pesan kesalahan
                    $session->setFlashdata('error', 'Invalid username or password');
                    $session->setFlashdata('error_color', 'red');
                }
            } else {
                // Jika user tidak ditemukan, beri pesan kesalahan
                $session->setFlashdata('error', 'Invalid username or password');
                $session->setFlashdata('error_color', 'red');
            }
        }

        return view('login');
    }


    public function logout()
    {
        // Lakukan proses logout di sini, seperti menghapus sesi atau token otentikasi

        // Contoh penghapusan sesi pada CodeIgniter
        $session = session();
        $session->destroy();

        // Redirect ke halaman login atau halaman lain yang sesuai
        return redirect()->to('/login');
    }

    public function datasiswa()
    {
        $siswaModel = new SiswaModel();
        $kriteriaModel = new KriteriaModel();

        $data['siswa'] = $siswaModel->getSiswaWithAtributKriteria();
        $data['kriteria'] = $kriteriaModel->findAll(); // Ambil semua data kriteria
        return view('datasiswa', $data);
    }

    public function tambahdata()
    {
        $kriteriaModel = new KriteriaModel();
        $data['kriteria'] = $kriteriaModel->findAll(); // Mengambil semua data kriteria

        return view('tambahdata', $data);
    }

    public function simpanData()
    {
        $siswaModel = new SiswaModel();
        $atributKriteriaModel = new AtributKriteriaModel();

        // Simpan data siswa
        $dataSiswa = [
            'nama' => $this->request->getPost('nama'),
        ];

        $siswaId = $siswaModel->insert($dataSiswa);

        // Simpan nilai kriteria
        $kriteria = $this->request->getPost('kriteria');
        foreach ($kriteria as $kriteriaId => $nilai) {
            $dataAtributKriteria = [
                'siswa_id' => $siswaId,
                'kriteria_id' => $kriteriaId,
                'nilai' => $nilai,
            ];

            $atributKriteriaModel->insert($dataAtributKriteria);
        }

        $session = session();
        $session->setFlashdata('success', 'Data berhasil disimpan.');

        return redirect()->to('');
    }

    public function edit($id)
    {
        $siswaModel = new SiswaModel();

        // Ambil data siswa berdasarkan ID
        $data['siswa'] = $siswaModel->find($id);
        // Tambahkan notifikasi "Edit berhasil" ke sesi flash
        session()->setFlashdata('success', 'Edit berhasil.');
        return view('edit', $data);
    }

    public function update($id)
    {
        $siswaModel = new SiswaModel();

        // Ambil data dari form
        $nama = $this->request->getPost('nama');
        $umur = $this->request->getPost('umur');
        $hafalan = $this->request->getPost('hafalan');
        $calistung = $this->request->getPost('calistung');
        $kb = $this->request->getPost('kb');

        // Update data berdasarkan ID
        $siswaModel->update($id, [
            'nama' => $nama,
            'umur' => $umur,
            'hafalan' => $hafalan,
            'calistung' => $calistung,
            'kb' => $kb,
        ]);

        return redirect()->to(base_url('/'))->with('success', 'Data berhasil diperbarui.');
    }

    public function import()
    {
        if ($this->request->getMethod() === 'post') {
            $file = $this->request->getFile('excel_file');

            // Validasi file
            if ($file->isValid() && !$file->hasMoved() && $file->getExtension() === 'xlsx') {
                try {
                    $spreadsheet = IOFactory::load($file->getTempName());
                    $sheet = $spreadsheet->getActiveSheet();
                    $data = $sheet->toArray();

                    $siswa = new SiswaModel();
                    $successCount = 0;

                    foreach ($data as $index => $row) {
                        if ($index === 0) {
                            continue;
                        }

                        $nama = $row[0];
                        $umur = !empty($row[1]) ? $row[1] : 0;
                        $hafalan = $row[2];
                        $calistung = $row[3];
                        $kb = $row[4];

                        $result = $siswa->insert([
                            'nama' => $nama,
                            'umur' => $umur,
                            'hafalan' => $hafalan,
                            'calistung' => $calistung,
                            'kb' => $kb,
                        ]);

                        if ($result) {
                            $successCount++;
                        }
                    }

                    if ($successCount > 0) {
                        session()->setFlashdata('message', 'Berhasil mengimpor ' . $successCount . ' data');
                        session()->setFlashdata('message_type', 'success');
                    } else {
                        session()->setFlashdata('message', 'Gagal mengimpor data, periksa struktur file Anda');
                        session()->setFlashdata('message_type', 'danger');
                    }

                    return redirect()->to(base_url(''));
                } catch (\Exception $e) {
                    session()->setFlashdata('message', 'Terjadi kesalahan dalam memproses file');
                    session()->setFlashdata('message_type', 'danger');
                    return redirect()->to('');
                }
            } else {
                session()->setFlashdata('message', 'Gagal mengunggah file atau format tidak didukung');
                session()->setFlashdata('message_type', 'danger');
                return redirect()->to('');
            }
        }

        return view('/');
    }


    public function delete($id)
    {
        // Load model untuk mengakses database
        $model = new SiswaModel();

        // Hapus data dengan ID yang diberikan
        $model->delete($id);
        // Tambahkan notifikasi "Sukses hapus data" ke sesi flash
        session()->setFlashdata('success', 'Data berhasil dihapus.');
        return redirect()->to('')->with('success', 'Data berhasil dihapus');
    }

    public function hitungMOORA()
    {
        $siswaModel = new SiswaModel();
        $kriteriaModel = new KriteriaModel(); // Sesuaikan dengan model yang digunakan
        $atributKriteriaModel = new AtributKriteriaModel(); // Sesuaikan dengan model yang digunakan

        $dataSiswa = $siswaModel->findAll();
        $kriteria = $kriteriaModel->findAll();

        $hasilMOORA = [];

        // Inisialisasi nilai maksimum dan minimum
        $nilaiMax = array_fill_keys(array_column($kriteria, 'nama_kriteria'), -PHP_INT_MAX);
        $nilaiMin = array_fill_keys(array_column($kriteria, 'nama_kriteria'), PHP_INT_MAX);

        if (empty($dataSiswa)) {
            return "Tidak ada data siswa yang ditemukan.";
        }

        // Langkah 1: Menghitung nilai max dan min untuk setiap kriteria
        foreach ($dataSiswa as $siswa) {
            foreach ($kriteria as $kriteriaRow) {
                $kriteriaKey = $kriteriaRow['nama_kriteria'];
                $nilaiAtribut = $atributKriteriaModel->getNilaiAtribut($siswa['id'], $kriteriaRow['id']); // Sesuaikan dengan metode yang benar di model Anda

                if ($nilaiAtribut !== null) {
                    $nilaiMax[$kriteriaKey] = max($nilaiMax[$kriteriaKey], $nilaiAtribut);
                    $nilaiMin[$kriteriaKey] = min($nilaiMin[$kriteriaKey], $nilaiAtribut);
                }
            }
        }
        // Langkah 2: Menghitung nilai MOORA untuk setiap siswa
        foreach ($dataSiswa as $siswa) {
            $score = 0;

            foreach ($kriteria as $kriteriaRow) {
                $kriteriaKey = $kriteriaRow['nama_kriteria'];
                $nilaiAtribut = $atributKriteriaModel->getNilaiAtribut($siswa['id'], $kriteriaRow['id']);

                if ($nilaiAtribut !== null) {
                    $minMaxDifference = $nilaiMax[$kriteriaKey] - $nilaiMin[$kriteriaKey];

                    // Menghindari pembagian oleh nol
                    if ($minMaxDifference != 0) {
                        $score += $kriteriaRow['bobot'] * (($nilaiAtribut - $nilaiMin[$kriteriaKey]) / $minMaxDifference);
                    }
                }
            }

            $hasilMOORA[] = [
                'nama' => $siswa['nama'],
                'nilai_total' => $score,
            ];
        }


        if (empty($hasilMOORA)) {
            return "Perhitungan MOORA gagal. Tidak ada hasil yang dihasilkan.";
        }

        // Langkah 3: Mengurutkan hasil peringkat dari yang tertinggi ke terendah
        usort($hasilMOORA, function ($a, $b) {
            return $b['nilai_total'] <=> $a['nilai_total'];
        });

        // Simpan hasil peringkat ke dalam tabel "hasil"
        $hasilModel = new HasilModel();
        $dataToInsert = [];
        foreach ($hasilMOORA as $rank => $siswa) {
            $dataToInsert[] = [
                'nama' => $siswa['nama'],
                'nilai_total' => $siswa['nilai_total'],
            ];
        }
        $inserted = $hasilModel->insertBatch($dataToInsert);

        if (!$inserted) {
            return "Gagal menyimpan hasil ke database.";
        }

        return redirect()->to(base_url('/hasil'));
    }

    public function hasil()
    {
        $hasilModel = new HasilModel();
        $data['hasil'] = $hasilModel->orderBy('nilai_total', 'DESC')->findAll();

        return view('hasil', $data);
    }



    public function generatePdf()
    {
        // Load HasilModel
        $hasilModel = new \App\Models\HasilModel();

        // Ambil data dari HasilModel
        $hasil = $hasilModel->findAll(); // Ini contoh, sesuaikan dengan metode yang sesuai di HasilModel

        // Load the view and pass the data
        $data['hasil'] = $hasil;
        $html = view('tabelmora', $data);

        // Setup dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);

        // Set paper size and orientation (e.g., 'A4' or 'letter')
        $dompdf->setPaper('A4', 'portrait');

        // Render the PDF (choose to save it, send it to the browser, or output it)
        $dompdf->render();

        // Output the PDF to the browser
        $dompdf->stream('table.pdf', ['Attachment' => false]);
    }

    public function clearData()
    {
        $siswaModel = new SiswaModel();
        $atributKriteriaModel = new AtributKriteriaModel();
        // Hapus semua data dari tabel atribut_kriteria
        $atributKriteriaModel->deleteAll();

        // Hapus semua data dari tabel siswa
        $siswaModel->deleteAll();

        // Hapus semua data dari tabel kriteria
        return redirect()->to(base_url('/datasiswa'));
    }


    public function clearhasil()
    {
        // Menghapus semua data dari tabel hasil
        $model = new HasilModel();
        $model->truncate(); // atau $model->emptyTable(); tergantung versi CodeIgniter

        // Contoh sederhana: redirect ke halaman hasil
        return redirect()->to(base_url('/hasil'));
    }

    // Di dalam fungsi histori() pada controller
    public function histori()
    {
        $model = new SiswaModel();
        $data['siswa'] = $model->findAll(); // Contoh pengambilan data siswa dari model

        return view('histori', $data); // Mengirimkan data siswa ke view histori.php
    }


    public function kriteria()
    {
        // Logika yang Anda inginkan untuk halaman kriteria
        return view('/kriteria'); // Sesuaikan dengan nama file view untuk halaman kriteria
    }

    public function simpankriteria()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'nama_kriteria' => 'required',
            'bobot' => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('/'))->withInput()->with('validation', $validation);
        }

        $kriteriaModel = new KriteriaModel();

        $data = [
            'nama_kriteria' => $this->request->getPost('nama_kriteria'),
            'bobot' => $this->request->getPost('bobot'),
        ];

        $kriteriaModel->insertKriteria($data);

        return redirect()->to(base_url('/'))->with('success', 'Data kriteria berhasil ditambahkan.');
    }
}
