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

                    <div class="row mt-5">
                        <div class="col-xl-12 col-lg-7">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-black">Form Edit Akun Dinas</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <form @submit.prevent="update">
                                        <div class="form-group">
                                            <label for="nip">NIP<span style="color:red">*</span></label>
                                            <input type="number" class="form-control" v-model="form.nip" placeholder="Masukkan NIP" required
                                            id="nip" ref="nip">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Nama<span style="color:red">*</span></label>
                                            <input type="text" class="form-control" v-model="form.name" placeholder="Masukkan nama" required
                                            id="name" ref="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email<span style="color:red">*</span></label>
                                            <input type="email" class="form-control" v-model="form.email" placeholder="Masukkan email" required
                                            id="email" ref="email">
                                        </div>
                                        <!-- <div class="form-group">
                                            <label for="old_password">Password Lama<span style="color:red">*</span></label>
                                            <input type="password" class="form-control" v-model="form.old_password" placeholder="Masukkan password lama" required
                                            id="old_password" ref="old_password">
                                        </div> -->
                                        <div class="form-group">
                                            <label for="password">Password Baru</label>
                                            <input type="password" class="form-control" v-model="form.password" placeholder="Masukkan password baru"
                                            id="password" ref="password">
                                            <p class="text-sm mt-2"><span style="color:red">*</span>kosongi bila tidak ingin mengubah password</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="photo">Foto</label>
                                             <div class="flex flex-row">
                                                <img :src="path + '/dinas/'+ dinas.foto" alt="Foto" style="width:150px; ">
                                                <div class="input-group ml-5 mt-4">
                                                    <div class="custom-file mb-5 ">
                                                        <input type="file" class="form-control" id="file" ref="photo" @change='uploadPhoto'>
                                                        <!-- <label class="custom-file-label" for="exampleInputFile">Choose file</label> -->
                                                    </div>
                                                </div>
                                             </div>
                                        </div>
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                        <a href="/admin/akun-dinas" class="btn btn-default border-secondary pull-right ml-2 hover:bg-gray-200 hover:text-white">Kembali</a>
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
    data() {
        return {
        // ref
            form: ({
                nip: '',
                name: '',
                email: '',
                password: '',
                photo: ''
            }),
            path: 'http://localhost:8000',
            dinas: []
        }
    },
    methods: {
        uploadPhoto(e){
            let file = e.target.files[0];
            this.form.file = file;
            let reader = new FileReader();  
            reader.onloadend = () => {
                this.form.photo = reader.result;
            }              
            reader.readAsDataURL(file);        
        },
        //For getting Instant Uploaded Photo
        getPhoto(){
            let photo = (this.form.photo.length > 100) ? this.form.photo : "dinas/"+ this.form.photo;
            return photo;
        },
        //Insert Photo
        update(){
        // Code Baru
            let formData = new FormData();

            formData.append('nip', this.form.nip);
            formData.append('name', this.form.name);
            formData.append('email', this.form.email);
            formData.append('password', this.form.password);

             if(this.form.password != null){
                formData.append('password', this.form.password);
            }
            if(this.form.file != null){
                formData.append('foto', this.form.file);
            }
            
        
        

        const token = localStorage.getItem('token')
        axios.defaults.headers.common.Authorization = `Bearer ${token}`

        axios.post(`http://localhost:8000/api/admin/editdinas/${this.$route.params.id}`, 
            // Code Baru
            formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(()=>{ 
                this.$router.push({name: 'admin-akun-dinas'});  
            })
            .catch((error)=>{
                console.log(error)
                alert('Format foto yang Anda masukkan tidak valid. Mohon masukkan foto dengan format JPG, PNG atau JPEG ')
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
        }
    },
     beforeMount(){ 
          const token = localStorage.getItem('token')
          axios.defaults.headers.common.Authorization = `Bearer ${token}`
  
          axios.get(`http://localhost:8000/api/admin/detaildinas/${this.$route.params.id}`)
          .then(response => { 
              this.form.nip = response.data.data.nip;
              this.form.name = response.data.data.name;
              this.form.email = response.data.data.email;

               this.dinas = response.data.data;
          })
          .catch(error => {
              console.error(error);
          }) 
      },
}
</script>