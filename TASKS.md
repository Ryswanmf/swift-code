# Daftar Tugas – Swift Code Lampung

Centang `[x]` saat selesai. Urutan mengikuti fase di `PRD.md`.

## Fase 1 – Fondasi
- [x] `laravel new swiftcode` (starter kit Vue), commit awal
- [x] Konfigurasi `.env`, database lokal, timezone `Asia/Jakarta`, locale `id`
- [x] Token brand di `app.css` (`@theme`) + font Plus Jakarta Sans
- [x] `PublicLayout.vue` (navbar, footer, tombol WhatsApp)
- [x] Halaman beranda statis: Hero, Layanan, Keunggulan, Alur, Kontak
- [x] Setup Pint, ESLint, Prettier, GitHub repo

## Fase 2 – Data dinamis
- [ ] Migration + model + factory + seeder: services, projects, packages, testimonials, faqs, leads, settings
- [ ] `HomeController` kirim props ke `Home.vue`
- [ ] Komponen: ServiceCard, ProjectCard, PricingCard, Testimonial, FaqItem
- [ ] Halaman detail portofolio `/portofolio/{slug}`
- [ ] `ContactController` + `StoreLeadRequest` + honeypot + throttle
- [ ] Notifikasi email lead baru (queue)

## Fase 3 – Panel admin
- [ ] `AdminLayout.vue` + sidebar
- [ ] Dashboard (jumlah lead baru, total proyek)
- [ ] CRUD Projects (upload cover + galeri, WebP)
- [ ] CRUD Services, Packages, Testimonials, FAQs
- [ ] Manajemen Leads: filter status, detail, catatan, hapus
- [ ] Halaman Settings (WA, email, alamat, sosmed, meta)
- [ ] Batasi akses admin, nonaktifkan registrasi publik

## Fase 4 – Poles & SEO
- [ ] Meta tag, Open Graph, canonical per halaman
- [ ] JSON-LD LocalBusiness, sitemap.xml, robots.txt
- [ ] Opsional: Inertia SSR
- [ ] Optimasi gambar, lazy loading, cache beranda
- [ ] Dark mode toggle
- [ ] Uji responsif 360px–1920px, uji aksesibilitas
- [ ] Lighthouse mobile ≥ 90

## Fase 5 – Testing & rilis
- [ ] Feature test: beranda, form kontak, throttle, auth admin, CRUD
- [ ] Siapkan server, domain, SSL
- [ ] Deploy, `migrate --force`, `storage:link`, `optimize`
- [ ] Supervisor (queue) + cron scheduler
- [ ] Daftar Google Search Console + Google Business Profile
- [ ] Pasang analytics (GA4 atau Plausible)
- [ ] Backup database otomatis

## Fase 6 – Pengembangan lanjutan
- [ ] Blog / artikel SEO
- [ ] Export lead ke CSV
- [ ] Notifikasi lead ke WhatsApp/Telegram
- [ ] Kategori portofolio sebagai tabel terpisah
- [ ] Portal klien (progress proyek) – opsional
