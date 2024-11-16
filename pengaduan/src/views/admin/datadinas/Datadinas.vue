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
                <div class="sidebar-brand-text mx-3 text-gray-900">Admin</div>
            </div>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
                <li class="nav-item  ">
                    <a class="nav-link " href="/admin/dashboard" >
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
                Pengguna
            </div>
                <li class="nav-item ">
                    <a class="nav-link" href="/admin/peran-pengguna">
                       <div class="px-2 -mb-2 text-gray-900">
                           <i class="fas fa-users-cog text-gray-900" ></i>
                            <span>Peran Pengguna</span>
                       </div>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="/admin/akun-admin">
                        <div class="px-2 -mb-2 text-gray-900">
                            <i class="fas fa-user text-gray-900"  ></i>
                            <span>Daftar Akun Admin</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/admin/akun-dinas">
                        <div class="bg-green-200 md:w-48 md:h-10 px-2 py-2 rounded-sm text-green-700 -mb-4 -mt-2">
                            <i class="fas fa-user-tie" style="color:#127456"></i>
                            <span>Daftar Akun Dinas</span>
                        </div>
                    </a>
                </li>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Data Master
            </div>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/status">
                       <div class="px-2 -mb-2 text-gray-900">
                            <i class="fas fa-clipboard-list text-gray-900"></i>
                            <span>Status Pengaduan</span>
                       </div>
                    </a>
                </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            
                <li class="nav-item">
                    <a  @click="logout" class="nav-link">
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
                <Topbaradmin/>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                 <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Akun Dinas</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 mt-5">
                        <div class="card-header py-3">
                            <div class="flex flex-col md:flex-row justify-between mt-2 ">
                                <div>
                                    <h6 class="mt-2 font-weight-bold text-black">Daftar Akun Dinas</h6>
                                </div>
                                <div class="flex flex-row ">
                                    <div class="mr-3">
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
                                    <div>
                                        <a href="/admin/akun-dinas/tambah" class="btn btn-primary btn-icon-split">
                                            <span class="text">Tambah Akun Dinas</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="text-black">
                                        <tr>
                                            <th>No</th>
                                            <th>NIP</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Peran</th>
                                            <th>Foto</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-black">
                                        <tr v-for="(a, index) in dinas.data" :key="a.id">
                                            <td>{{index+begin+1}}.</td>
                                            <td>{{a.nip}}</td>
                                            <td>{{a.name}}</td>
                                            <td>{{a.email}}</td>
                                            <td>{{a.get_peran.nama}}</td>
                                            <td><img :src="require('../../../../../public/dinas/'+a.foto)" alt="Foto" style="width:100px"></td>
                                            <td>
                                                <router-link :to="{name: 'admin-akun-dinas-edit', params:{id: a.id }}"
                                                    class="mr-2" title="Sunting"><i class="fas fa-edit text-yellow-500 text-lg"></i>
                                                </router-link>
                                                <button @click.prevent="Delete(a.id)"
                                                    title="Hapus"><i class="fas fa-trash text-red-600 text-lg"></i>
                                                </button> 
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="mt-4 flex justify-end">
                                    <Pagination :data="dinas" @pagination-change-page="view" />
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
import Topbaradmin from '../../../components/Topbaradmin.vue'
import Footeradmin from '../../../components/Footeradmin.vue'

import LaravelVuePagination from 'laravel-vue-pagination';

import { onMounted } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

export default {
    components: {
        Metaadmin,
        Topbaradmin,
        Footeradmin,
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
            dinas: {},
            search: '',
            batas: 5
        }
    },
    methods : { 
        view(page=1){
            const token = localStorage.getItem('token')
            axios.defaults.headers.common.Authorization = `Bearer ${token}`
  
            axios.get(`http://localhost:8000/api/admin/dashboarddinas?page=${page}&search=${this.search}`)
            .then(response => { 
                if(page==1){
                    this.begin = 0;
                    this.dinas = response.data;
                }
                else if(page >=1){
                    this.halaman = page;
                    this.posisi = this.halaman - 1;
                    this.begin = this.posisi * this.batas;
                    this.dinas = response.data;
                }
                else{
                    this.begin = 0;
                    this.dinas = response.data;
                }
            //   this.dinas = response.data;
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
          this.$router.push('/admin')
      },
       Delete(id){
          const token = localStorage.getItem('token')
          axios.defaults.headers.common.Authorization = `Bearer ${token}`
        
         if(! confirm ('Anda yakin ingin menghapus data ini?')){
              return;
          }

            axios.delete(`http://localhost:8000/api/admin/hapusdinas/${id}`)
            .then(() => {
               this.view();
               alert('Data Berhasil Dihapus!');
            }).catch(() => {
              alert('system error!');
            });
      }
    },
   
      setup(){
          const token = localStorage.getItem('token')
          const router = useRouter()

            onMounted(() =>{

                //check Token exist
                if(!token) {
                    return router.push({
                        name: 'admin'
                    })
                }
            })
            return {
                token
            }
      }
    
}
</script>