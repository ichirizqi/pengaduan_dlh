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
                <img src="../../images/logo.png" alt="Logo" class="w-10">
                <div class="sidebar-brand-text ml-2 text-gray-900 ">Pegawai Dinas</div>
            </div>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
                <li class="nav-item active">
                    <a class="nav-link" href="/dinas/dashboard">
                        <div class="bg-green-200 md:w-48 md:h-10 px-2 py-2 rounded-sm text-green-700">
                            <i class="fas fa-fw fa-tachometer-alt" style="color:#127456"></i>
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
                <li class="nav-item ">
                    <a class="nav-link" href="/dinas/pengaduan-masuk">
                       <div class="px-2 -mb-2 text-gray-900">
                           <i class="fas fa-sign-in-alt text-gray-900"></i>
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

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Counter-->
                    <div class="row">
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Pengaduan Masuk
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{count.data}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <!-- <i class="fa-solid fa-arrow-right-to-bracket text-gray-300"></i> -->
                                            <i class="fas fa-sign-in-alt fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pengaduan Diproses
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{countProses.data}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Pengaduan Selesai</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{countSelesai.data}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Counter-->

                    <div class="row">
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-black">Profil Pegawai Dinas</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body" v-for="(a) in dinas" :key="a.id">
                                    <div class="flex flex-row " >
                                        <div class="md:mr-5">
                                            <img :src="path + '/dinas/'+ a.foto" alt="Foto" style="width:180px" class="md:ml-5 ml-3 rounded-md">
                                            <router-link :to="{name: 'dinas-edit-profile', params:{id: a.id }}">
                                                <button class="btn btn-light md:ml-1 border border-gray-300 w-52 mt-4">EDIT PROFIL</button>
                                            </router-link>
                                        </div>
                                        <div class="md:ml-5 ml-3 md:mt-4">
                                            <div class="grid md:grid-cols-2 w-96">
                                                <div>
                                                    <p>NIP</p>
                                                    <p class="-mt-3 text-gray-900"><strong>{{a.nip}}</strong></p>
                                                </div>
                                               <div>
                                                    <p>Nama</p>
                                                    <p class="-mt-3 text-gray-900"><strong>{{a.name}}</strong></p>
                                               </div>
                                            </div>
                                            <div class="grid md:grid-cols-2 w-96">
                                                <div>
                                                    <p>Email</p>
                                                    <p class="-mt-3 text-gray-900"><strong>{{a.email}}</strong></p>
                                                </div>
                                                <div class="">
                                                    <p>Peran</p>
                                                    <p class="-mt-3 text-gray-900"><strong>{{a.get_peran.nama}}</strong></p>
                                                </div>
                                            </div>
                                            <div class="grid md:grid-cols-2 w-96">
                                                <div>
                                                    <p>Nomor Telepon</p>
                                                    <p  v-if="a.notelp == null" class="-mt-3 italic text-gray-900"><strong>Belum Dilengkapi</strong></p>
                                                    <p class="-mt-3 text-gray-900" v-else><strong>{{a.notelp}}</strong></p>
                                                </div>
                                                <div>
                                                    <p>Alamat</p>
                                                    <p  v-if="a.alamat == null" class="-mt-3 italic text-gray-900"><strong>Belum Dilengkapi</strong></p>
                                                    <p class="-mt-3 text-gray-900" v-else><strong>{{a.alamat}}</strong></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
import Metaadmin from '../../components/Metaadmin.vue'
import Topbar from '../../components/Topbar.vue'
import Footeradmin from '../../components/Footeradmin.vue'

import { onMounted, ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'
export default {
    components: {
        Metaadmin,
        Topbar,
        Footeradmin,
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
     data(){
        return {
            path: 'http://localhost:8000',
            dinas: []
        }
    },
     methods : {  
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
    },
    beforeMount(){ 
          const token = localStorage.getItem('token')
          axios.defaults.headers.common.Authorization = `Bearer ${token}`
  
          axios.get('http://localhost:8000/api/user')
          .then(response => { 
              this.dinas = response.data.data;
          })
          .catch(error => {
              console.error(error);
          }) 
      },
    setup() {

            //state token
            const token = localStorage.getItem('token')

            //inisialisasi vue router on Composition API
            const router = useRouter()

            //state user
            const count = ref('')
            const countSelesai = ref('')
            const countProses = ref('')
            
            //mounted properti
            onMounted(() =>{

                //check Token exist
                if(!token) {
                    return router.push({
                        name: 'dinas'
                    })
                }

                //get data total
                axios.defaults.headers.common.Authorization = `Bearer ${token}`
                axios.get('http://localhost:8000/api/dinas/hitungisu')
                .then(response => {

                    count.value = response.data

                })
                .catch(error => {
                    console.log(error.response.data)
                })

                //get data total
                axios.defaults.headers.common.Authorization = `Bearer ${token}`
                axios.get('http://localhost:8000/api/dinas/hitungisuselesai')
                .then(response => {

                    countSelesai.value = response.data

                })
                .catch(error => {
                    console.log(error.response.data)
                })

                //get data total
                axios.defaults.headers.common.Authorization = `Bearer ${token}`
                axios.get('http://localhost:8000/api/dinas/hitungisuproses')
                .then(response => {

                    countProses.value = response.data

                })
                .catch(error => {
                    console.log(error.response.data)
                })

            })

            
            return {
                token,   
                count,
                countSelesai,
                countProses
            }

        }
}
</script>