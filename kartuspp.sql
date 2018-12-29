select
	a.id as daftarsiswamaster_id
    , a.tahunajaran_id
    , a.sekolah_id
    , a.kelas_id
    , e.id as daftarsiswadetail_id
    , e.siswa_id
    , g.id as siswaspp_id
    , g.spp_id
    , i.id as bayarmaster_id
    , j.id as bayardetail_id
    , b.TahunAjaran
    , c.Sekolah
    , d.Kelas
    , f.NIS
    , f.Nama
    , g.Nilai
    , g.Terbayar
    , g.Potensi
    , h.SPP
    , h.Jenis
    , i.Tanggal
    , i.NomorBayar
    , i.Jumlah as bayarmaster_Jumlah
    , j.Keterangan
    , j.Keterangan2
    , j.Keterangan3
    , j.Jumlah as bayardetail_Jumlah
from
	t05_daftarsiswamaster a
    left join t01_tahunajaran b on a.tahunajaran_id = b.id
    left join t02_sekolah c on a.sekolah_id = c.id
    left join t03_kelas d on a.kelas_id = d.id
    left join t06_daftarsiswadetail e on a.id = e.daftarsiswamaster_id
    left join t04_siswa f on e.siswa_id = f.id
    left join t08_siswaspp g on a.tahunajaran_id = g.tahunajaran_id and e.siswa_id = g.siswa_id
    left join t07_spp h on g.spp_id = h.id
    left join t09_bayarmaster i on a.tahunajaran_id = i.tahunajaran_id and e.siswa_id = i.siswa_id
    left join t10_bayardetail j on i.id = j.bayarmaster_id