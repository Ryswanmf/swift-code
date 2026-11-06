# Arsitektur & Teknis – Swift Code Lampung

## 1. Gambaran Arsitektur

```
Browser ──► Nginx ──► Laravel 12 ──► MySQL
              │          │
              │          └─ Inertia (kirim props JSON + render Vue)
              └─ Static: /build (Vite), /storage (gambar)
```

Laravel menangani routing, validasi, dan data. Inertia menjembatani ke halaman Vue tanpa membuat API terpisah.

## 2. Struktur Folder

```
app/
  Http/
    Controllers/
      HomeController.php
      ProjectController.php          # publik: detail portofolio
      ContactController.php          # publik: simpan lead
      Admin/
        DashboardController.php
        ProjectController.php
        ServiceController.php
        PackageController.php
        TestimonialController.php
        FaqController.php
        LeadController.php
        SettingController.php
    Requests/                        # Form Request validasi
  Models/                            # Project, Service, Package, Testimonial, Faq, Lead, Setting
  Notifications/NewLeadNotification.php
database/
  migrations/  seeders/  factories/
resources/
  css/app.css                        # Tailwind 4 + @theme brand
  js/
    app.ts
    layouts/  PublicLayout.vue  AdminLayout.vue
    pages/
      Home.vue
      Projects/Show.vue
      Admin/
        Dashboard.vue
        Projects/{Index,Form}.vue
        Services/{Index,Form}.vue
        Packages/{Index,Form}.vue
        Testimonials/{Index,Form}.vue
        Faqs/{Index,Form}.vue
        Leads/{Index,Show}.vue
        Settings.vue
    components/
      public/ Navbar.vue Hero.vue ServiceCard.vue ProjectCard.vue
              PricingCard.vue Testimonial.vue FaqItem.vue ContactForm.vue
              WhatsAppButton.vue Footer.vue
      ui/                            # tombol, input, modal, tabel
routes/web.php  routes/admin.php
tests/Feature/
```

## 3. Skema Database

### `users`
Bawaan Laravel (admin). Tambahan: `role` string default `admin`.

### `services`
| Kolom | Tipe | Catatan |
|---|---|---|
| id | bigint PK | |
| icon | string | emoji atau nama ikon |
| title | string | |
| description | text | |
| sort_order | unsigned int | default 0 |
| is_active | boolean | default true |
| timestamps | | |

### `projects`
| Kolom | Tipe | Catatan |
|---|---|---|
| id | bigint PK | |
| title | string | |
| slug | string unique | untuk URL detail |
| category | string | company, sekolah, toko, sistem |
| summary | string | teks kartu |
| description | longText nullable | halaman detail |
| client_name | string nullable | |
| live_url | string nullable | |
| cover_image | string nullable | path storage |
| gallery | json nullable | daftar path gambar |
| tech_stack | json nullable | mis. ["Laravel","Vue"] |
| is_featured | boolean | tampil di beranda |
| is_published | boolean | |
| sort_order | unsigned int | |
| timestamps | | |

### `packages`
| Kolom | Tipe | Catatan |
|---|---|---|
| id | bigint PK | |
| name | string | Basic / Business / Custom |
| price | unsigned bigint nullable | null = "Hubungi kami" |
| price_note | string nullable | mis. "mulai dari" |
| features | json | daftar fitur |
| is_highlighted | boolean | paket rekomendasi |
| sort_order | unsigned int | |
| is_active | boolean | |

### `testimonials`
`id, name, role, company, quote (text), avatar nullable, rating tinyint default 5, is_published, sort_order, timestamps`

### `faqs`
`id, question, answer (text), sort_order, is_published, timestamps`

### `leads`
| Kolom | Tipe | Catatan |
|---|---|---|
| id | bigint PK | |
| name | string | |
| phone | string nullable | |
| email | string nullable | |
| service_type | string | |
| budget | string nullable | rentang |
| message | text | |
| status | enum | `new`, `contacted`, `deal`, `lost` (default `new`) |
| notes | text nullable | catatan admin |
| ip_address | string nullable | |
| user_agent | string nullable | |
| timestamps | | |

### `settings`
`id, key (unique), value (text nullable)`. Contoh key: `whatsapp`, `email`, `address`, `instagram`, `meta_title`, `meta_description`.

### Relasi
Tabel konten berdiri sendiri (tanpa relasi antar tabel) agar sederhana. Pengembangan lanjutan: `projects` ↔ `categories`, `leads` ↔ `users` (PIC).

## 4. Routing

### Publik
| Method | URI | Controller | Keterangan |
|---|---|---|---|
| GET | `/` | HomeController@index | Beranda (props: services, projects, packages, testimonials, faqs, settings) |
| GET | `/portofolio/{slug}` | ProjectController@show | Detail proyek |
| POST | `/kontak` | ContactController@store | Simpan lead + redirect WhatsApp (throttle:5,1) |
| GET | `/sitemap.xml` | SitemapController | Sitemap dinamis |

### Admin (prefix `/admin`, middleware `auth`)
| URI | Fungsi |
|---|---|
| `/admin` | Dashboard |
| `/admin/projects` | Resource CRUD |
| `/admin/services` | Resource CRUD |
| `/admin/packages` | Resource CRUD |
| `/admin/testimonials` | Resource CRUD |
| `/admin/faqs` | Resource CRUD |
| `/admin/leads` | Index, show, update status, delete |
| `/admin/settings` | Edit & simpan pengaturan |

## 5. Alur Form Kontak

1. Pengunjung mengisi `ContactForm.vue` (`useForm`).
2. `POST /kontak` → `StoreLeadRequest` (validasi + honeypot + throttle).
3. `Lead::create()` dengan status `new`.
4. Kirim `NewLeadNotification` (email, antrean queue) ke admin.
5. `Inertia::location()` ke `https://wa.me/{nomor}?text=...`.

## 6. Keamanan

- Validasi lewat Form Request, mass-assignment dilindungi `$fillable`.
- Rate limit `throttle:5,1` pada `/kontak`; honeypot field tersembunyi.
- Upload gambar: validasi `image|mimes:jpg,png,webp|max:2048`, nama file di-hash.
- Admin route di belakang `auth`; opsional 2FA (tersedia di starter kit).
- `APP_DEBUG=false` di produksi, `.env` tidak masuk repo.
- Header keamanan lewat Nginx (HSTS, X-Content-Type-Options).

## 7. SEO

- `<Head>` Inertia per halaman: title, description, canonical, Open Graph.
- Schema.org `LocalBusiness` (JSON-LD) di beranda.
- Sitemap dinamis dan `robots.txt`.
- Pertimbangkan **Inertia SSR** (`php artisan inertia:start-ssr`) agar konten terbaca crawler lebih baik.

## 8. Performa

- Gambar: konversi WebP, `loading="lazy"`, ukuran responsif.
- Cache query beranda (`Cache::remember`, invalidasi saat admin menyimpan).
- Vite code-splitting per halaman, `npm run build` di produksi.
- `php artisan optimize` (config, route, view cache).

## 9. Testing

| Jenis | Cakupan |
|---|---|
| Feature test | Beranda memuat data, form kontak valid/invalid, throttle, admin butuh login |
| Feature test | CRUD proyek (create, update, delete, upload) |
| Browser (opsional) | Pest v4 browser test alur kontak |
| Static | Laravel Pint, ESLint, `vue-tsc` |

## 10. Deployment

1. Server: Ubuntu, Nginx, PHP 8.3-FPM, MySQL, Node (hanya untuk build).
2. `git pull` → `composer install --no-dev -o` → `npm ci && npm run build`.
3. `php artisan migrate --force && php artisan storage:link && php artisan optimize`.
4. Queue worker via Supervisor, cron `schedule:run`.
5. SSL Let's Encrypt, backup database harian.
6. Monitoring: log Laravel, uptime check, Google Search Console, analytics.
