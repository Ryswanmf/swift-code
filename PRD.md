# PRD – Website Swift Code Lampung

| | |
|---|---|
| **Produk** | Website company profile & lead generation Swift Code Lampung |
| **Versi** | 1.0 (Draft) |
| **Tanggal** | 6 November 2026 |
| **Owner** | Swift Code Lampung |
| **Tech Stack** | Laravel 12, Inertia.js, Vue 3, Tailwind CSS 4, MySQL |

---

## 1. Ringkasan

Swift Code Lampung adalah penyedia jasa pembuatan website (landing page, company profile, website sekolah, toko online, sistem custom) di Lampung. Saat ini kanal utama promosi adalah Instagram (`@swiftcode.lpg`) dan WhatsApp. Website resmi dibutuhkan untuk meningkatkan kredibilitas, ditemukan lewat Google, memamerkan portofolio, dan mengumpulkan calon klien (lead) secara terstruktur.

## 2. Latar Belakang & Masalah

| Masalah | Dampak |
|---|---|
| Calon klien hanya bisa menilai dari Instagram | Kredibilitas terbatas, portofolio sulit dijelajahi |
| Tidak ada halaman yang muncul di Google | Kehilangan calon klien yang mencari "jasa pembuatan website Lampung" |
| Permintaan masuk lewat chat tanpa format | Kebutuhan klien tidak jelas, follow-up tidak terlacak |
| Portofolio dan harga tidak terpusat | Penjelasan berulang ke setiap calon klien |

## 3. Tujuan & Metrik Keberhasilan

| Tujuan | Metrik | Target (3 bulan setelah rilis) |
|---|---|---|
| Menghasilkan lead | Jumlah pengisian form / klik WhatsApp | ≥ 30 lead/bulan |
| Muncul di pencarian | Posisi kata kunci "jasa pembuatan website Lampung" | Halaman 1 Google |
| Performa | Skor Lighthouse (mobile) | ≥ 90 untuk Performance, SEO, Accessibility |
| Efisiensi admin | Waktu update portofolio | < 5 menit tanpa developer |

## 4. Target Pengguna

**Pengunjung (publik)**
- Pemilik UMKM / bisnis lokal yang ingin go digital.
- Kepala sekolah / pengelola lembaga yang butuh website institusi.
- Perusahaan kecil–menengah yang butuh company profile.

**Admin (internal)**
- Owner / tim Swift Code yang mengelola konten dan lead.

## 5. Ruang Lingkup

### 5.1 In Scope (MVP)
- Website publik satu halaman utama + halaman detail portofolio.
- Panel admin untuk kelola konten dan lead.
- Form kontak dengan penyimpanan database dan redirect WhatsApp.
- SEO dasar, sitemap, responsif, dark mode.

### 5.2 Out of Scope (versi 1)
- Pembayaran online / invoice otomatis.
- Portal klien (login klien).
- Multi-bahasa (hanya Bahasa Indonesia).
- Blog (masuk fase 2).

## 6. Fitur & Prioritas

Prioritas: **P0** wajib MVP, **P1** penting, **P2** nice to have.

### 6.1 Website Publik

| ID | Fitur | Deskripsi | Prioritas |
|---|---|---|---|
| F-01 | Hero | Headline, CTA konsultasi, statistik | P0 |
| F-02 | Layanan | Daftar layanan dari database | P0 |
| F-03 | Keunggulan | "Alasan bisnis wajib punya website" | P1 |
| F-04 | Portofolio | Grid proyek, filter kategori, halaman detail | P0 |
| F-05 | Paket Harga | Tabel paket (Basic/Business/Custom), tombol pesan | P1 |
| F-06 | Alur Kerja | 4 langkah proses pengerjaan | P1 |
| F-07 | Testimoni | Kutipan klien dengan nama dan foto | P1 |
| F-08 | FAQ | Accordion pertanyaan umum | P1 |
| F-09 | Form Kontak | Nama, WhatsApp, jenis website, budget, pesan | P0 |
| F-10 | Tombol WhatsApp melayang | Link wa.me dengan pesan otomatis | P0 |
| F-11 | Dark/Light mode | Mengikuti preferensi sistem + toggle | P2 |
| F-12 | SEO | Meta, Open Graph, sitemap.xml, schema LocalBusiness | P0 |
| F-13 | Blog / artikel | Konten edukasi untuk SEO | P2 |

### 6.2 Panel Admin

| ID | Fitur | Deskripsi | Prioritas |
|---|---|---|---|
| A-01 | Login admin | Autentikasi (starter kit Laravel) | P0 |
| A-02 | Dashboard | Ringkasan lead baru, total proyek | P1 |
| A-03 | CRUD Portofolio | Judul, kategori, deskripsi, URL, gambar, urutan, status | P0 |
| A-04 | CRUD Layanan | Ikon, judul, deskripsi, urutan | P0 |
| A-05 | CRUD Paket Harga | Nama, harga, fitur (list), highlight | P1 |
| A-06 | CRUD Testimoni & FAQ | Kelola konten | P1 |
| A-07 | Manajemen Lead | Daftar pesan, ubah status (baru / dihubungi / deal / batal), catatan | P0 |
| A-08 | Pengaturan Situs | Nomor WA, email, alamat, sosial media, meta default | P1 |
| A-09 | Export lead | CSV | P2 |

## 7. User Stories

**Pengunjung**
1. Sebagai pemilik UMKM, saya ingin melihat contoh website yang pernah dibuat agar yakin dengan kualitasnya.
2. Sebagai calon klien, saya ingin melihat kisaran harga agar bisa menyesuaikan anggaran.
3. Sebagai calon klien, saya ingin menghubungi tim dengan cepat lewat WhatsApp.
4. Sebagai pengunjung mobile, saya ingin halaman cepat dan nyaman dibaca.

**Admin**
1. Sebagai admin, saya ingin menambah proyek baru ke portofolio tanpa menyentuh kode.
2. Sebagai admin, saya ingin melihat semua pesan masuk dan menandai yang sudah ditindaklanjuti.
3. Sebagai admin, saya ingin mengubah nomor WhatsApp dan harga paket kapan saja.

## 8. Alur Utama

```
Pengunjung → Google/Instagram → Landing page
   → Lihat portofolio & harga
   → Isi form kontak
   → Data tersimpan (status: baru) + notifikasi email ke admin
   → Redirect ke WhatsApp dengan pesan terisi
   → Admin follow-up → ubah status lead
```

## 9. Kebutuhan Non-Fungsional

| Kategori | Kebutuhan |
|---|---|
| Performa | LCP < 2,5 detik di 4G; gambar WebP, lazy loading |
| Responsif | Mobile-first, diuji di 360px hingga 1920px |
| SEO | Server-side rendering via Inertia SSR atau pre-render meta, sitemap, robots.txt |
| Keamanan | Validasi server, CSRF, rate limiting form (5/menit/IP), honeypot anti-spam, password hash |
| Aksesibilitas | Kontras WCAG AA, label form, navigasi keyboard |
| Ketersediaan | Uptime ≥ 99%, backup database harian |
| Maintainability | Komponen Vue modular, Pint + ESLint, test untuk alur kritis |

## 10. Rekomendasi Teknis

| Lapisan | Pilihan |
|---|---|
| Backend | Laravel 12 (PHP 8.3+) |
| Frontend | Vue 3 + Inertia.js + TypeScript |
| Styling | Tailwind CSS 4 (token warna brand di `@theme`) |
| Database | MySQL 8 / MariaDB |
| Admin panel | Halaman Inertia sendiri (starter kit) atau Filament v4 sebagai alternatif cepat |
| Upload gambar | Laravel Storage + Intervention Image (konversi WebP) |
| Email | SMTP / Resend untuk notifikasi lead |
| Hosting | VPS (Nginx + PHP-FPM) atau shared hosting yang mendukung Laravel |
| CI | GitHub Actions: Pint, test, build |

Detail arsitektur dan skema database ada di `ARCHITECTURE.md`.

## 11. Identitas Visual

- Warna utama merah `#E11D2E`, turunan `#A50F1D` dan `#7A0A14`, latar putih atau gelap.
- Font: Plus Jakarta Sans.
- Gaya: modern, tegas, banyak ruang kosong, kartu dengan sudut membulat.
- Logo: logo Swift Code yang sudah ada (tab "S" dengan tag `</>`).

## 12. Risiko & Mitigasi

| Risiko | Mitigasi |
|---|---|
| Spam di form kontak | Honeypot, rate limit, opsional Cloudflare Turnstile |
| Gambar portofolio berat | Kompres otomatis ke WebP, ukuran maksimum upload |
| Konten tidak diperbarui | Panel admin sederhana, pengingat bulanan |
| SEO lambat naik | Fase blog, Google Business Profile, backlink dari portofolio klien |
| Scope melebar | Patuhi prioritas P0 dulu, fitur P2 setelah rilis |

## 13. Milestone

| Fase | Isi | Estimasi |
|---|---|---|
| 1. Fondasi | Setup project, desain sistem, halaman publik statis | 1 minggu |
| 2. Dinamis | Database, CRUD admin, form kontak + lead | 1–2 minggu |
| 3. Poles | SEO, performa, uji lintas perangkat, QA | 1 minggu |
| 4. Rilis | Deploy, domain, SSL, analytics | 2–3 hari |
| 5. Fase 2 | Blog, testimoni lanjutan, export lead | Setelah rilis |

## 14. Kriteria Penerimaan MVP

- [ ] Semua fitur P0 berfungsi di Chrome, Safari, dan Firefox versi terbaru.
- [ ] Form kontak menyimpan data, mengirim email ke admin, dan membuka WhatsApp.
- [ ] Admin dapat menambah/mengubah/menghapus portofolio dan layanan.
- [ ] Lighthouse mobile ≥ 90 pada halaman utama.
- [ ] Sitemap dan meta tag terpasang, terdaftar di Google Search Console.
- [ ] Tidak ada error di log produksi selama 48 jam pertama.

## 15. Pertanyaan Terbuka

1. Apakah harga paket ditampilkan terbuka, atau hanya "mulai dari"?
2. Domain yang akan dipakai (mis. `swiftcode.id`)?
3. Apakah perlu notifikasi lead ke WhatsApp/Telegram selain email?
4. Hosting yang tersedia: VPS atau shared hosting?
