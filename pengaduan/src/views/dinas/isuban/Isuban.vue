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
                <li class="nav-item ">
                    <a class="nav-link" href="/dinas/pengaduan-masuk">
                       <div class="px-2 -mb-2 text-gray-900">
                           <i class="fas fa-sign-in-alt text-gray-900"></i>
                            <span>Pengaduan Masuk</span>
                       </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dinas/pengaduan-verifikasi">
                        <div class="px-2 -mb-2 text-gray-900">
                            <i class="fas fa-clipboard-list text-gray-900"></i>
                            <span>Pengaduan Verifikasi</span>
                        </div>
                    </a>
                </li>
                 <li class="nav-item active">
                    <a class="nav-link" href="/dinas/pengaduan-ban">
                        <div class="bg-green-200 md:w-48 md:h-10 px-2 py-2 rounded-sm text-green-700 -mb-4">
                            <i class="fas fa-ban" style="color:#127456"></i>
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
                    <h1 class="h3 mb-2 text-gray-800">Pengaduan Ban</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 mt-5">
                        <div class="card-header py-3">
                            <div class="flex flex-col md:flex-row justify-between mt-2 ">
                                <div>
                                    <h6 class="mt-2 font-weight-bold text-black">Daftar Pengaduan Ban</h6>
                                </div>
                               <div class="flex flex-row">
                                   <div class="md:mt-0 mt-2">
                                       <button @click="openModal" class="bg-blue-500 hover:bg-blue-700 text-white py-1 -mt-2 px-4 rounded"><i class="fas fa-download mt-2 text-white mr-2"></i>Unduh</button>
                                        <modal v-show="isModalVisible" @close-modal="closeModal" />
                                        <!-- <a href="/dinas/pengaduan-verifikasi/export-excel" title="Unduh Excel">
                                            <i class="fas fa-download mt-2"></i>
                                        </a> -->
                                        <!-- <button class="btn btn-primary btn-sm pull-right" @click="exportData">Export</button> -->
                                    </div>
                                    <div class="mr-3 md:ml-0 ml-2">
                                        <form @submit.prevent="view" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                                            <div class="input-group">
                                                <input type="text" v-model="search" class="input form-control bg-light small bg-white border" placeholder="Cari Nama"
                                                    aria-label="Search" aria-describedby="basic-addon2">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit">
                                                        <i class="fas fa-search fa-sm"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                               </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div v-if="isu.length==0" class="text-gray-900 italic text-center mb-4">Tidak ada data pengaduan yang tidak di verifikasi</div>
                            <div v-else class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="text-black">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Pihak Terduga</th>
                                            <th>Masalah</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-black">
                                        <tr v-for="(i, index) in isu.data" :key="i.id">
                                            <td>{{index+begin+1}}.</td>
                                            <td>{{i.nama}}</td>
                                            <td>{{i.pihak_terduga}}</td>
                                            <td>{{i.masalah}}</td>
                                            <td class="text-red-600 font-weight-bold">{{i.status}}</td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="mt-4 flex justify-end">
                                    <Pagination :data="isu" @pagination-change-page="view" />
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
import modal from '../../../components/Modalban.vue'

import LaravelVuePagination from 'laravel-vue-pagination';

import { onMounted } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'
export default {
    components: {
        Metaadmin,
        Topbar,
        Footeradmin,
        modal,
        'Pagination': LaravelVuePagination
    },
    mounted() {
        this.view();

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
            isu: [],
            search: '',
            batas: 5,
            isModalVisible: false,  
        }
    },
    methods : { 
         view(page=1){
            const token = localStorage.getItem('token')
            axios.defaults.headers.common.Authorization = `Bearer ${token}`
  
            axios.get(`http://localhost:8000/api/dinas/isuban?page=${page}&search=${this.search}`)
            .then(response => { 
            //   this.isu = response.data.data;
                if(page==1){
                    this.begin = 0;
                    this.isu = response.data;
                }
                else if(page >=1){
                    this.halaman = page;
                    this.posisi = this.halaman - 1;
                    this.begin = this.posisi * this.batas;
                    this.isu = response.data;
                }
                else{
                    this.begin = 0;
                    this.isu = response.data;
                }
          })
          .catch(error => {
              console.error(error);
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
      },
        openModal() { 
            this.isModalVisible = true;
        }, 
        closeModal() {
            this.isModalVisible = false;
        },
    },
       setup(){
          const token = localStorage.getItem('token')
          const router = useRouter()

            onMounted(() =>{

                //check Token exist
                if(!token) {
                    return router.push({
                        name: 'dinas'
                    })
                }
            })
            return {
                token
            }
      }
   
}
</script>