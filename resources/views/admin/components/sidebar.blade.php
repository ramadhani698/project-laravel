<div class="sidebar sidebar-dark sidebar-fixed d-flex flex-column border-end" id="sidebar" data-coreui="sidebar">
  <div class="sidebar-header border-bottom">
    <div class="sidebar-brand">
        <img src="{{ asset('coreui/assets/favicon/android-icon-36x36.png') }}" alt="Brand Logo">    
        SMKM2 TNG
    </div>
  </div>
  <ul class="sidebar-nav" data-coreui="navigation">
    <li class="nav-title">Content Management</li>
    <li class="nav-item nav-group">
      <a class="nav-link nav-group-toggle" href="#">
        <img src="{{ asset('coreui/assets/icons/home.svg') }}" class="nav-icon" alt="Home Icon" style="width: 1em; height: 1em;"> Home
      </a>
      <ul class="nav-group-items">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.carousel.index') }}">
            <span class="nav-icon"><span class="nav-icon-bullet"></span></span> Baner Carousel
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.keunggulan.index') }}">
            <span class="nav-icon"><span class="nav-icon-bullet"></span></span> Keunggulan Kami
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.statistik.index') }}">
            <span class="nav-icon"><span class="nav-icon-bullet"></span></span> Statistik Sekolah
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item nav-group">
      <a class="nav-link nav-group-toggle" href="#">
        <img src="{{ asset('coreui/assets/icons/user.svg') }}" class="nav-icon" alt="Profil Icon" style="width: 1em; height: 1em;"> Profil
      </a>
      <ul class="nav-group-items">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.histories.index') }}">
            <span class="nav-icon"><span class="nav-icon-bullet"></span></span> Sejarah Sekolah
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.vision.index') }}">
            <span class="nav-icon"><span class="nav-icon-bullet"></span></span> Visi Misi
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.principal-message.index') }}">
            <span class="nav-icon"><span class="nav-icon-bullet"></span></span> Kata Kepala Sekolah
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item nav-group">
      <a class="nav-link nav-group-toggle" href="#">
        <img src="{{ asset('coreui/assets/icons/school.svg') }}" class="nav-icon" alt="Jurusan Icon" style="width: 1em; height: 1em;"> Jurusan
      </a>
      <ul class="nav-group-items">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.jurusan.index') }}">
            <span class="nav-icon"><span class="nav-icon-bullet"></span></span> Kelola Jurusan
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item nav-group">
      <a class="nav-link nav-group-toggle" href="#">
        <img src="{{ asset('coreui/assets/icons/info.svg') }}" class="nav-icon" alt="Informasi Icon" style="width: 1em; height: 1em;"> Informasi Sekolah
      </a>
      <ul class="nav-group-items">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.berita.index') }}">
            <span class="nav-icon"><span class="nav-icon-bullet"></span></span> Berita
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.sarpras.index') }}">
            <span class="nav-icon"><span class="nav-icon-bullet"></span></span> Fasilitas
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.gallery.index') }}">
            <span class="nav-icon"><span class="nav-icon-bullet"></span></span> Galeri
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.prestasi.index') }}">
        <img src="{{ asset('coreui/assets/icons/star.svg') }}" class="nav-icon" alt="Prestasi Icon" style="width: 1em; height: 1em;"> Prestasi Siswa
      </a>
    </li>
    <li class="nav-title">Sistem PPDB</li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.beranda-setting.edit') }}">
        <img src="{{ asset('coreui/assets/icons/info.svg') }}" class="nav-icon" alt="Pengaturan Icon" style="width: 1em; height: 1em;"> Pengaturan Beranda
      </a>
    </li>
    <li class="nav-item nav-group">
      <a class="nav-link nav-group-toggle" href="#">
        <img src="{{ asset('coreui/assets/icons/address-book.svg') }}" class="nav-icon" alt="PPDB Icon" style="width: 1em; height: 1em;"> Penerimaan Siswa Baru
      </a>
      <ul class="nav-group-items">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.ppdb.pendaftar.index') }}">
            <span class="nav-icon"><span class="nav-icon-bullet"></span></span> Akun Pendaftar
          </a>
        </li> 
      </ul>
    </li>
  </ul>
  <div class="sidebar-footer border-top d-flex">
    <button class="sidebar-toggler" type="button"></button>
  </div>
</div>