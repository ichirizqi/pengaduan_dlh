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

                    <div class="row mt-5">
                        <div class="col-xl-12 col-lg-7">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-black">Edit Profil Pegawai Dinas</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                   <form @submit.prevent="update">
                                            <div class="flex md:flex-row flex-col ">
                                                <div class="w-72 bg-gray-200 rounded-lg h-72 mr-16">
                                                <img :src="path + '/dinas/'+ dinas.foto" alt="Foto" class="px-4 h-44 mx-auto mt-3 ">
                                                <div class="input-group mt-2 px-3">
                                                    <div class="custom-file mb-5">
                                                        <input type="file" class="form-control" id="file" ref="photo" @change='uploadPhoto'>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="flex flex-row md:mt-0 mt-5">
                                                    <div class="form-group mr-10">
                                                        <label for="nip" class="font-semibold">NIP</label>
                                                        <input type="number" class="form-control" v-model="form.nip" placeholder="Masukkan NIP" readonly
                                                        id="nip" ref="nip">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name" class="font-semibold">Nama<span style="color:red">*</span></label>
                                                        <input type="text" class="form-control" v-model="form.name" placeholder="Masukkan nama" required
                                                        id="name" ref="name">
                                                    </div>
                                                </div>
                                                 <div class="flex flex-row">
                                                    <div class="form-group mr-10">
                                                        <label for="email" class="font-semibold">Email<span style="color:red">*</span></label>
                                                        <input type="email" class="form-control" v-model="form.email" placeholder="Masukkan email" required
                                                        id="email" ref="email">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nomor" class="font-semibold">Nomor Telepon</label>
                                                        <input type="number" class="form-control" v-model="form.notelp" placeholder="Masukkan nomor telepon"
                                                        id="notelp" ref="notelp">
                                                    </div>
                                                </div>
                                                <div class="flex flex-row">
                                                     <div class="form-group mr-10">
                                                        <label for="password" class="font-semibold">Password Baru</label>
                                                        <input type="password" class="form-control"  v-model="form.password" placeholder="Masukkan Password"
                                                        id="password" ref="password">
                                                        <p class="text-xs mt-2">kosongi bila tidak ingin mengubah password</p>
                                                    </div>
                                                    <div class="form-group mr-10">
                                                        <label for="alamat" class="font-semibold">Alamat</label>
                                                        <textarea rows="3" class="form-control" v-model="form.alamat" placeholder="Masukkan alamat"
                                                        id="alamat" ref="alamat"></textarea>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                       <div class="flex justify-end">
                                            <a href="/dinas/dashboard" class="btn btn-default border-secondary pull-right mr-2 hover:bg-gray-200 hover:text-white">Kembali</a>
                                            <button type="submit" class="btn btn-success">Simpan</button>
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
import Metaadmin from '../../components/Metaadmin.vue'
import Topbar from '../../components/Topbar.vue'
import Footeradmin from '../../components/Footeradmin.vue'

// import { onMounted, ref } from 'vue'
// import { useRouter } from 'vue-router'
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
        data() {
        return {
        // ref
            form: ({
                nip: '',
                name: '',
                email: '',
                password: '',
                notelp: '',
                alamat: '',
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
        // formData.append('notelp', this.form.notelp);
        // formData.append('alamat', this.form.alamat);
        // formData.append('password', this.form.password);
       
        if(this.form.notelp != null){
             formData.append('notelp', this.form.notelp);
        }
        if(this.form.alamat != null){
             formData.append('alamat', this.form.alamat);
        }
        if(this.form.password != null){
          formData.append('password', this.form.password);   
        }
        if(this.form.file != null){
            formData.append('foto', this.form.file);
        }
        
        

        const token = localStorage.getItem('token')
        axios.defaults.headers.common.Authorization = `Bearer ${token}`

        axios.post(`http://localhost:8000/api/dinas/editprofile/${this.$route.params.id}`, 
            // Code Baru
            formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
            }
        )
            .then(()=>{
                this.$router.push({name: 'dinas-dashboard'});  
            })
            .catch((error)=>{
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
    },
     beforeMount(){ 
          const token = localStorage.getItem('token')
          axios.defaults.headers.common.Authorization = `Bearer ${token}`
  
          axios.get(`http://localhost:8000/api/dinas/editprofile/${this.$route.params.id}`)
          .then(response => { 
              this.form.nip = response.data.data.nip;
              this.form.name = response.data.data.name;
              this.form.email = response.data.data.email;
              this.form.notelp = response.data.data.notelp;
              this.form.alamat = response.data.data.alamat;

               this.dinas = response.data.data;
          })
          .catch(error => {
              console.error(error);
          }) 
      },
}
</script>