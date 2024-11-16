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
                <li class="nav-item active">
                    <a class="nav-link" href="/dinas/pengaduan-verifikasi">
                        <div class="bg-green-200 md:w-48 md:h-10 px-2 py-2 rounded-sm text-green-700 -mb-4">
                            <i class="fas fa-clipboard-list "   style="color:#127456"></i>
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
                    <h1 class="h3 mb-2 text-gray-800">Pengaduan Verifikasi</h1>

                    <div class="row mt-5">
                        <div class="col-xl-12 col-lg-7">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-black">Form Edit Pengaduan Verifikasi</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <form @submit.prevent="update">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama<span style="color:red">*</span></label>
                                            <input type="text" class="form-control" placeholder="Masukkan nama" readonly v-model="post.nama">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tanggal Mulai<span style="color:red">*</span></label>
                                            <input type="date" class="form-control" placeholder="Masukkan Tanggal Mulai" readonly v-model="post.tanggal_mulai" >
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tanggal Selesai<span style="color:red">*</span></label>
                                            <input type="date" class="form-control" placeholder="Masukkan Tanggal Selesai" required v-model="post.tanggal_selesai">
                                        </div>
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                        <a href="/dinas/pengaduan-verifikasi" class="btn btn-default border-secondary pull-right ml-2 hover:bg-gray-200 hover:text-white">Kembali</a>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row mt-5" v-if="pengaduan.tanggal_selesai == null">
                        <div class="col-xl-12 col-lg-7">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-black">Form Aktifitas Penanganan</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <form @submit.prevent="store" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="id_pengaduan" hidden>Id Pengaduan</label>
                                            <input type="text" class="form-control" v-model="form.id_pengaduan" placeholder="Masukkan id"  id="id_pengaduan" ref="id_pengaduan" hidden
                                           >
                                        </div>
                                        <div class="form-group">
                                            <label for="kode_lacak" hidden>Nama Pengadu</label>
                                            <input type="text" class="form-control" v-model="form.nama_pengadu" placeholder="Masukkan nama pengadu"   id="nama_pengadu" ref="nama_pengadu" hidden
                                            >
                                        </div>
                                        <div class="form-group">
                                            <label for="kode_lacak" hidden>Kode Lacak</label>
                                            <input type="text" class="form-control" v-model="form.kode_lacak" placeholder="Masukkan kode_lacak"   id="kode_lacak" ref="kode_lacak" hidden
                                            >
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Narasi Aktifitas<span style="color:red">*</span></label>
                                            <textarea class="form-control" placeholder="Masukkan Narasi Aktifitas" rows="3" v-model="form.narasi" required id="narasi" ref="narasi"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Status<span style="color:red">*</span></label>
                                            <select class="form-control" v-model="form.id_status" name="id_status" ref="id_status" @change="getStatus()">
                                            <option v-for="s in status1" :key="s.id" v-bind:value="s.id">{{ s.nama }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="photo">Foto<span style="color:red">*</span></label>
                                             <div class="input-group">
                                                <div class="custom-file mb-5 ">
                                                    <input type="file" class="form-control" id="file" ref="photo" @change='uploadPhoto' required>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success">Tambah Aktifitas</button>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="pengaduan.tanggal_selesai != null" style="visibility: hidden;"></div>

                    <div class="row mt-5">
                        <div class="col-xl-12 col-lg-7">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-black">Log Aktifitas Penanganan Isu Pengaduan</h6>
                                    <input type="text" v-model="id" class="form-control" placeholder="Masukkan Tahun" hidden>
                                    <button  type="submit"  @click.prevent="exportData()"  class="bg-blue-500 hover:bg-blue-700 text-white py-1  px-4 rounded"><i class="fas fa-download mt-2 text-white mr-2"></i>Unduh</button>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div v-if="aktivitas.length==0" class="text-gray-900 italic text-center mb-4">Tidak ada data aktifitas penanganan isu pengaduan</div>
                                    <div v-else class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="text-black">
                                        <tr >
                                            <th>No</th>
                                            <th>Narasi</th>
                                            <th>Status</th>
                                            <th>Tanggal</th>
                                            <th>Foto</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-black">
                                        <tr v-for="(a, index) in aktivitas" :key="a.id">
                                            <td>{{index+1}}.</td>
                                            <td>{{a.narasi}}</td>
                                            <td>{{a.get_status.nama}}</td>
                                            <td>{{dateTime(a.tanggal)}}</td>
                                            <td> <img :src="path + '/aktivitas/'+ a.foto" alt="Foto" style="width:150px"></td>
                                        </tr>
                                    </tbody>
                                    </table>
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
import Metaadmin from '../../../components/Metaadmin.vue'
import Topbar from '../../../components/Topbar.vue'
import Footeradmin from '../../../components/Footeradmin.vue'

// import { ref, onMounted } from 'vue'
// import { useRouter, useRoute } from 'vue-router'
import axios from 'axios'

import moment from 'moment';

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
            status: 0,
            status1: [],
            id: '',

            form: ({
                id_pengaduan: '',
                nama_pengadu: '',
                kode_lacak: '',
                narasi: '',
                id_status: '',
                photo: ''
            }),

            post: ({
                nama: '',
                tanggal_mulai: '',
                tanggal_selesai: ''
            }),

            path: 'http://localhost:8000',
            pengaduan: []
        }
    },
     beforeMount(){ 
          const token = localStorage.getItem('token')
          axios.defaults.headers.common.Authorization = `Bearer ${token}`
  
          axios.get(`http://localhost:8000/api/dinas/pengaduan/${this.$route.params.id}`)
          .then(response => { 
              this.id = response.data.data.id;
          })
          .catch(error => {
              console.error(error);
          }) 


           axios.get(`http://localhost:8000/api/dinas/pengaduan/${this.$route.params.id}`)
          .then(response => { 
              this.form.id_pengaduan = response.data.data.id;
              this.form.kode_lacak = response.data.data.kode_lacak;
              this.form.nama_pengadu = response.data.data.nama;
          })
          .catch(error => {
              console.error(error);
          }) 


           axios.get(`http://localhost:8000/api/dinas/aktivitas/${this.$route.params.id}`)
          .then(response => { 

                this.aktivitas = response.data.data;
          })
          .catch(error => {
              console.error(error);
          }) 

           axios.get(`http://localhost:8000/api/dinas/pengaduan/${this.$route.params.id}`)
          .then(response => { 
            this.post.nama    = response.data.data.get_isu.nama,
            this.post.tanggal_mulai    = response.data.data.tanggal_mulai  ,
            this.post.tanggal_selesai    = response.data.data.tanggal_selesai

                this.pengaduan = response.data.data;
          })
          .catch(error => {
              console.error(error);
          }) 
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
        getPhoto(){
            let photo = (this.form.photo.length > 100) ? this.form.photo : "aktivitas/"+ this.form.photo;
            return photo;
        },
        store(){
            // Code Baru
            let formData = new FormData();

            formData.append('id_pengaduan', this.form.id_pengaduan);
            formData.append('nama_pengadu', this.form.nama_pengadu);
            formData.append('kode_lacak', this.form.kode_lacak);
            formData.append('narasi', this.form.narasi);
            formData.append('id_status', this.form.id_status);
            formData.append('foto', this.form.file);
        

          const token = localStorage.getItem('token')
          axios.defaults.headers.common.Authorization = `Bearer ${token}`

            axios.post(`http://localhost:8000/api/dinas/aktivitas`, 
                formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
                }
            )
                .then(()=>{
                    this.$router.push({name: 'dinas-pengaduan-verifikasi'});  
                })
                .catch(()=>{
                alert('Format foto yang Anda masukkan tidak valid. Mohon masukkan foto dengan format JPG, PNG atau JPEG ')
                })
        },
          update(){
        
            let formData = new FormData();

            formData.append('tanggal_selesai', this.post.tanggal_selesai);

            
        
        

            const token = localStorage.getItem('token')
            axios.defaults.headers.common.Authorization = `Bearer ${token}`

            axios.post(`http://localhost:8000/api/dinas/pengaduan/${this.$route.params.id}`, 
                // Code Baru
                formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(()=>{ 
                    this.$router.push({name: 'dinas-pengaduan-verifikasi'});  
                })
                .catch((error)=>{
                    console.log(error)
                    alert('Format foto yang Anda masukkan tidak valid. Mohon masukkan foto dengan format JPG, PNG atau JPEG ')
                })
        },
        exportData() {
            
                window.open(`http://localhost:8000/api/aktivitas/export?id=${this.id}`, {
                })
        },
        getStatus: function() {
            const token = localStorage.getItem('token')
                axios.defaults.headers.common.Authorization = `Bearer ${token}`
                axios.get('http://localhost:8000/api/dinas/statuspengaduan')
                .then(function(response){
                    this.status1 = response.data.data;
                }.bind(this));
        },
        dateTime(value) {
            return moment(value).format('DD-MM-YYYY');
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
    created: function(){
            this.getStatus()
        },

    //  setup() {

    //      const token = localStorage.getItem('token')

    //     //state posts
    //     // const post = reactive({
    //     //     nama: '',
    //     //     tanggal_mulai: '',
    //     //     tanggal_selesai: ''
    //     // })

    //     // //state posts
    //     // const form = reactive({
    //     //     id_pengaduan: '',
    //     //     kode_lacak: '',
    //     //     narasi: '',
    //     //     id_status: '',
    //     //     // id: ''
    //     // })

    //     // const aktivitas = ref([])

    //     // const id_status = ref([])

    //     //state validation
    //     // const validation = ref([])

    //     // //vue router
    //     // const router = useRouter()

    //     // //vue router
    //     // const route = useRoute()

    //     //mounted
    //     onMounted(() => {

    //         //get edit 
    //         // axios.get(`http://localhost:8000/api/dinas/pengaduan/${route.params.id}`)
    //         // .then(response => {
              
    //         //   //assign state posts with response data
    //         //   post.nama    = response.data.data.get_isu.nama,
    //         //   post.tanggal_mulai    = response.data.data.tanggal_mulai  ,
    //         //   post.tanggal_selesai    = response.data.data.tanggal_selesai 

    //         // }).catch(error => {
    //         //     console.log(error.response.data)
    //         // })


    //         //get aktivitas
    //         // axios.get(`http://localhost:8000/api/dinas/pengaduan/${route.params.id}`)
    //         // .then(response => {
              
    //         //   //assign state posts with response data
    //         //   form.id_pengaduan = response.data.data.id;
    //         //   form.kode_lacak = response.data.data.kode_lacak; 
    //         //   form.nama_pengadu = response.data.data.nama; 

    //         // }).catch(error => {
    //         //     console.log(error.response.data)
    //         // })

    //         //get data aktivitas
    //             // axios.defaults.headers.common.Authorization = `Bearer ${token}`
    //             // axios.get(`http://localhost:8000/api/dinas/aktivitas/${route.params.id}`)
    //             // .then(response => {
    //             //     aktivitas.value = response.data.data
    //             //     // id_status.value = response.data.data.get_status

    //             // })
    //             // .catch(error => {
    //             //     console.log(error.response.data)
    //             // })

    //     })

    //     //method update
    //     // function update() {

    //     //     let tanggal_selesai   = post.tanggal_selesai
            
    //     //     axios.defaults.headers.common.Authorization = `Bearer ${token}`
    //     //     axios.post(`http://localhost:8000/api/dinas/pengaduan/${route.params.id}`, {
    //     //         tanggal_selesai: tanggal_selesai
    //     //     }).then(() => {
    //     //         router.push({
    //     //             name: 'dinas-pengaduan-verifikasi'
    //     //         })

    //     //     }).catch(error => {
    //     //         //assign state validation with error 
    //     //         console.log(error)
    //     //     })

    //     // }


    //     //return
    //     return {
    //         // post,
    //         // aktivitas,
    //         validation,
    //         router,
    //         // update
    //     }

    // },
}
</script>