<template>
  <div>
    
   <Metaadmin/>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
     <div class="border-r-2 bg-green-50 border-green-100 hover:text-green-600">
            <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <div class="sidebar-brand d-flex align-items-center justify-content-center">
                <img src="../../../images/logo.png" alt="Logo" class="w-10">
                <div class="sidebar-brand-text ml-2 text-gray-900 ">Pegawai Dinas</div>
            </div>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
                <li class="nav-item ">
                    <a class="nav-link" href="/dinas/dashboard">
                        <div class="px-2 -mb-2 text-gray-900">
                            <i class="fas fa-fw fa-tachometer-alt text-gray-900"></i>
                            <span>Dashboard</span>
                        </div>
                    </a>
                </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Pengaduan
            </div>
                <li class="nav-item active">
                    <a class="nav-link" href="/dinas/pengaduan-masuk">
                       <div class="bg-green-200 md:w-48 md:h-10 px-2 py-2 rounded-sm text-green-700 -mb-4">
                           <i class="fas fa-sign-in-alt "  style="color:#127456"></i>
                            <span>Pengaduan Masuk</span>
                       </div>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="/dinas/pengaduan-verifikasi">
                        <div class="px-2 -mb-2 text-gray-900">
                            <i class="fas fa-clipboard-list text-gray-900"></i>
                            <span>Pengaduan Verifikasi</span>
                        </div>
                    </a>
                </li>
                 <li class="nav-item ">
                    <a class="nav-link" href="/dinas/pengaduan-ban">
                        <div class="px-2 -mb-2 text-gray-900">
                            <i class="fas fa-ban text-gray-900"></i>
                            <span>Pengaduan Ban</span>
                        </div>
                    </a>
                </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            
                <li class="nav-item ">
                    <a @click="logout" class="nav-link">
                       <div class="px-2 -mb-2 text-gray-900">
                           <i class="fas fa-sign-out-alt text-gray-900"></i>
                            <span>Logout</span>
                       </div>
                    </a>
                </li>
        </ul>
       </div>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <Topbar/>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                 <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Detail Pengaduan</h1>

                    <div class="row mt-5">
                        <div class="col-xl-12 col-lg-7">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-black">Form Detail Pengaduan</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                        <form @submit.prevent="update">
                                            <div class="form-group">
                                                <label for="id" hidden>id</label>
                                                <input type="text" class="form-control" v-model="form.id" placeholder="Masukkan id" hidden
                                                id="id" ref="id">
                                            </div>
                                            <div class="form-group">
                                                <label for="nama">Nama</label>
                                                <input type="text" class="form-control" v-model="form.nama" placeholder="Masukkan nama" readonly
                                                id="nama" ref="nama">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" class="form-control" v-model="form.email" placeholder="Masukkan email" readonly
                                                id="email" ref="email">
                                            </div>
                                            <div class="form-group">
                                                <label for="nohp">Nomor HP</label>
                                                <input type="text" class="form-control" v-model="form.nohp" placeholder="Masukkan nomor HP" readonly
                                                id="nohp" ref="nohp">
                                            </div>
                                            <div class="form-group">
                                                <label for="pihak_terduga">Pihak Terdugga</label>
                                                <input type="text" class="form-control" v-model="form.pihak_terduga" placeholder="Masukkan pihak terduga" readonly
                                                id="pihak_terduga" ref="pihak_terduga">
                                            </div>
                                            <div class="form-group">
                                                <label for="masalah">Masalah</label>
                                                <textarea class="form-control" v-model="form.masalah" placeholder="Masukkan masalah" rows="6" readonly
                                                id="masalah" ref="masalah"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="penyelesaian">Penyelesaian</label>
                                                <textarea class="form-control" v-model="form.penyelesaian" placeholder="Masukkan penyelesaian" rows="6" readonly
                                                id="penyelesaian" ref="penyelesaian"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="status" hidden>Status</label>
                                                <input type="text" class="form-control" v-model="form.status" placeholder="Masukkan status"
                                                id="status" ref="status" hidden>
                                            </div>
                                            <div class="form-group">
                                                <label for="foto">Foto Kejadian</label>
                                                <img :src="path + '/isu/'+ verifikasi.foto" alt="Foto Kejadian" style="width:300px">
                                            </div>
                                             <!-- <button type="submit" class="btn btn-success ">Verifikasi</button> -->
                                       <div class="flex flex-row">
                                            <button type="submit" class="bg-green-500 h-10 rounded-lg text-white py-2 px-3 mt-3 mr-2">Verifikasi</button>
                                            <div>
                                                <form @submit.prevent="updateBan">
                                                    <div class="form-group">
                                                        <label for="nama" class="hidden">Nama</label>
                                                        <input type="text" class="form-control" v-model="form.nama" placeholder="Masukkan nama" hidden
                                                        id="nama" ref="nama">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email" class="hidden">Email</label>
                                                        <input type="text" class="form-control" v-model="form.email" placeholder="Masukkan email" hidden
                                                        id="email" ref="email">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nohp" class="hidden">Nomor HP</label>
                                                        <input type="text" class="form-control" v-model="form.nohp" placeholder="Masukkan nomor HP" hidden
                                                        id="nohp" ref="nohp">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pihak_terduga" class="hidden">Pihak Terdugga</label>
                                                        <input type="text" class="form-control" v-model="form.pihak_terduga" placeholder="Masukkan pihak terduga" hidden
                                                        id="pihak_terduga" ref="pihak_terduga">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="masalah" class="hidden">Masalah</label>
                                                        <textarea class="form-control" v-model="form.masalah" placeholder="Masukkan masalah" rows="6" hidden
                                                        id="masalah" ref="masalah"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="penyelesaian" class="hidden">Penyelesaian</label>
                                                        <textarea class="form-control" v-model="form.penyelesaian" placeholder="Masukkan penyelesaian" rows="6" hidden
                                                        id="penyelesaian" ref="penyelesaian"></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-danger">Ban</button>
                                                    <a href="/dinas/pengaduan-masuk" class="btn btn-default border-secondary pull-right ml-2 hover:bg-gray-200 hover:text-white">Kembali</a>
                                                </form>
                                            </div>
                                       </div>
                                      
                                        </form>
                                </div>
                                    
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <Footeradmin/>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

</body>
  </div>
</template>

<script>
import Metaadmin from '../../../components/Metaadmin.vue'
import Topbar from '../../../components/Topbar.vue'
import Footeradmin from '../../../components/Footeradmin.vue'

import axios from 'axios'

export default {
    components: {
        Metaadmin,
        Topbar,
        Footeradmin
    },
    mounted() {
        let script1 = document.createElement("script");
        script1.setAttribute(
        "src",
        "https://startbootstrap.github.io/startbootstrap-sb-admin-2/vendor/jquery/jquery.min.js"
        );
        document.head.appendChild(script1);

        let script2 = document.createElement("script");
        script2.setAttribute(
        "src",
        "https://startbootstrap.github.io/startbootstrap-sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js"
        );
        document.head.appendChild(script2);
        
        let script3 = document.createElement("script");
        script3.setAttribute(
        "src",
        "https://startbootstrap.github.io/startbootstrap-sb-admin-2/vendor/jquery-easing/jquery.easing.min.js"
        );
        document.head.appendChild(script3);

        let script4 = document.createElement("script");
        script4.setAttribute(
        "src",
        "https://startbootstrap.github.io/startbootstrap-sb-admin-2/js/sb-admin-2.min.js"
        );
        document.head.appendChild(script4);
    },
     data() {
        return {
        // ref
            form: ({
                id:'',
                nama: '',
                email: '',
                nohp: '',
                pihak_terduga: '',
                masalah: '',
                penyelesaian: '',
                status: 'Sudah Diverifikasi'
            }),
             path: 'http://localhost:8000',
            verifikasi: []
        }
    },
     beforeMount(){ 
          const token = localStorage.getItem('token')
          axios.defaults.headers.common.Authorization = `Bearer ${token}`
  
          axios.get(`http://localhost:8000/api/dinas/isumasuk/${this.$route.params.id}`)
          .then(response => { 
              this.form.id = response.data.data.id;
              this.form.nama = response.data.data.nama;
              this.form.email = response.data.data.email;
              this.form.nohp = response.data.data.nohp;
              this.form.pihak_terduga = response.data.data.pihak_terduga;
              this.form.masalah = response.data.data.masalah;
              this.form.penyelesaian = response.data.data.penyelesaian;

              this.verifikasi = response.data.data;
          })
          .catch(error => {
              console.error(error);
          }) 
      },
      methods: {
        update(){
            let id_isu   = this.form.id;
            let nama   = this.form.nama;
            let email   = this.form.email;
            let nohp   = this.form.nohp;
            let pihak_terduga   = this.form.pihak_terduga;
            let masalah   = this.form.masalah;
            let penyelesaian   = this.form.penyelesaian;
            let status   = this.form.status;

            axios.post(`http://localhost:8000/api/dinas/pengaduan`, {
                id_isu: id_isu,
                nama: nama,
                masalah: masalah,
                email: email,
            }).then(() => {
                this.$router.push({name: 'dinas-pengaduan-verifikasi'});
                alert("Data pengaduan berhasil di verifikasi")

            }).catch(error => {
                console.log(error)
            })

            // UPDATE
            const token = localStorage.getItem('token')
            axios.defaults.headers.common.Authorization = `Bearer ${token}`
            axios.post(`http://localhost:8000/api/dinas/isumasuk/${this.$route.params.id}`, {
                nama: nama,
                email: email,
                nohp: nohp,
                pihak_terduga: pihak_terduga,
                masalah: masalah,
                penyelesaian: penyelesaian,
                status: status 
            }).then(() => {
                this.$router.push({name: 'dinas-pengaduan-verifikasi'});

            }).catch(error => {
                console.log(error)
            })
        },
        updateBan(){
            let nama   = this.form.nama;
            let email   = this.form.email;
            let nohp   = this.form.nohp;
            let pihak_terduga   = this.form.pihak_terduga;
            let masalah   = this.form.masalah;
            let penyelesaian   = this.form.penyelesaian;

            // UPDATE
            if(! confirm ('Anda yakin tidak ingin memverifikasi data ini?')){
              return;
            }
            const token = localStorage.getItem('token')
            axios.defaults.headers.common.Authorization = `Bearer ${token}`
            axios.post(`http://localhost:8000/api/dinas/banisu/${this.$route.params.id}`, {
                nama: nama,
                email: email,
                nohp: nohp,
                pihak_terduga: pihak_terduga,
                masalah: masalah,
                penyelesaian: penyelesaian
            }).then(() => {
                alert("Data pengaduan berhasil di ban")
                this.$router.push({name: 'dinas-pengaduan-ban'});
                

            }).catch(error => {
                console.log(error)
            })
        },
         getData(){  
          this.isLoggedIn = localStorage.getItem('token') !== null;  
        },
        logout(){
            if(! confirm ('Anda yakin ingin keluar dari aplikasi?')){
              return;
            }
            localStorage.removeItem('token')
            this.getData()  
            this.$router.push('/dinas')
        }
        
    }
}
</script>