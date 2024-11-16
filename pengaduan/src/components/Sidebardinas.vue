<template>
    <div>
         <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color:#62B192">

            <!-- Sidebar - Brand -->
            <div class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-text mx-3">Pegawai Dinas</div>
            </div>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
                <li class="nav-item active">
                    <a class="nav-link" href="/dinas/dashboard">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Pengaduan
            </div>
                <li class="nav-item active">
                    <a class="nav-link" href="/dinas/pengaduan-masuk">
                       <i class="fas fa-sign-in-alt"></i>
                        <span>Pengaduan Masuk</span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/dinas/isu-pengaduan">
                        <i class="fas fa-clipboard-list"></i>
                        <span>Isu Pengaduan</span>
                    </a>
                </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            
                <li class="nav-item active">
                    <a @click="logout" class="nav-link">
                       <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>
        </ul>
        <!-- End of Sidebar -->
    </div>
</template>

<script>
export default {
  methods : {  
      getData(){  
          this.isLoggedIn = localStorage.getItem('token') !== null;  
      },
      logout(){
          localStorage.removeItem('token')
          this.getData()  
          this.$router.push('/dinas')
      }
    }
}
</script>