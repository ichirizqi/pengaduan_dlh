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
                <li class="nav-item">
                    <a class="nav-link" href="/admin/akun-dinas">
                        <div class="px-2 -mb-2 text-gray-900">
                            <i class="fas fa-user-tie text-gray-900"></i>
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
                <li class="nav-item active">
                    <a class="nav-link" href="/admin/status">
                       <div class="bg-green-200 md:w-48 md:h-10 px-2 py-2 rounded-sm text-green-700 -mb-4 -mt-2">
                            <i class="fas fa-clipboard-list"  style="color:#127456"></i>
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
                    <h1 class="h3 mb-2 text-gray-800">Status Pengaduan</h1>

                    <div class="row mt-5">
                        <div class="col-xl-12 col-lg-7">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-black">Form Tambah Status Pengaduan</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <form @submit.prevent="store">
                                        <div class="form-group">
                                            <label for="nama">Nama<span style="color:red">*</span></label>
                                            <input type="text" class="form-control" placeholder="Masukkan nama" required v-model="post.nama">
                                            <div v-if="validation.nama" class="mt-2 alert alert-danger">
                                                {{ validation.nama[0] }}
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                        <a href="/admin/status" class="btn btn-default border-secondary pull-right ml-2 hover:bg-gray-200 hover:text-white">Kembali</a>
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
import Topbaradmin from '../../../components/Topbaradmin.vue'
import Footeradmin from '../../../components/Footeradmin.vue'

import { reactive, ref, onMounted,  } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

export default {
    components: {
        Metaadmin,
        Topbaradmin,
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
          this.$router.push('/admin')
      }
    },
    setup() {
        // state token
            const token = localStorage.getItem('token')

        //state posts
        const post = reactive({
            nama: ''
        })
        

        //state validation
        const validation = ref([])

        //vue router
        const router = useRouter()

        //mounted properti
            onMounted(() =>{

                //check Token exist
                if(!token) {
                    return router.push({
                        name: 'admin'
                    })
                }

            })

        //method store
        function store() {

            let nama   = post.nama

            axios.defaults.headers.common.Authorization = `Bearer ${token}`
            axios.post('http://localhost:8000/api/admin/statuspengaduan', {
                nama: nama
            }).then(() => {

                //redirect ke post index
                router.push({
                    name: 'admin-status'
                })

            }).catch(error => {
                //assign state validation with error 
                validation.value = error.response.data
            })

        }

        //return
        return {
            token,
            post,
            validation,
            router,
            store
        }

    }
}
</script>