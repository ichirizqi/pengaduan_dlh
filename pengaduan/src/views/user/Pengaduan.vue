<template>
    <div>
        <Meta/>
        <div>
         <Navbar
         class="shadow-md z-50"
         name="Logo Name"
      :navLinks="[
        {
          name: 'Beranda', link: '/', dropdown: false,
        },
        { 
            name: 'Pengaduan', link: '/pengaduan', dropdown: false 
        },
        { 
            name: 'Lacak Isu', link: '/lacak-isu', dropdown: false 
        },
        { 
            name: 'Masuk', 
            dropdown: true,
            dropdownLinks: [ 
                { name: 'Admin', link: '/admin', dropdown: false },
                { name: 'Pegawai Dinas', link: '/dinas', dropdown: false },
            ],
        },
      ]"
    />
        </div>
    
    <!-- FORM -->
    <div class="mt-32 md:mt-40 ">
        <h5 class="font-poppins font-bold md:text-3xl text-xl text-gray-900  mt-14 md:mt-28 md:mb-3 mb-1 md:mx-28 mx-5">Pengaduan Online</h5>
        <p class="font-poppins font-normal md:text-base text-sm text-gray-500 md:mx-28 mx-5 md:mb-14 mb-8">Laporkan permasalahan Anda terkait isu lingkungan hidup di Kota Batu menggunakan bahasa yang santun dan baku.</p>
        
        <div class="my-10">
            <div class="bg-green-700 py-3 px-5 w-3/4 md:ml-40 ml-12 text-white font-poppins font-medium text-xl rounded-t-xl">Form Pengaduan</div>
            <form v-on:submit.prevent="SubmitPhoto" enctype="multipart/form-data">
                <div class="md:ml-40 ml-12 w-3/4 border-2 border-gray-100">
                    <div class="grid md:grid-cols-2 grid-cols-1">
                        <div class="mx-4 my-5">
                            <p class="font-poppins text-gray-800 font-medium text-base">Nama<span style="color:red">*</span></p>
                            <input type="text" class="form-control mt-3 shadow appearance-none bg-white border rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Masukkan Nama Anda" id="nama" required ref="nama" v-model="form.nama" >
                        </div>
                        <div class="mx-4 my-5">
                            <p class="font-poppins text-gray-800 font-medium text-base">Email<span style="color:red">*</span></p>
                            <input type="email" class="form-control mt-3 shadow appearance-none bg-white border rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Masukkan Email Anda" id="email" required ref="email" v-model="form.email">
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 grid-cols-1">
                        <div class="mx-4 my-5">
                            <p class="font-poppins text-gray-800 font-medium text-base">Nomor Hp<span style="color:red">*</span></p>
                            <input type="number" class="form-control mt-3 shadow appearance-none bg-white border rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="62xxxxxxxxxxx" id="nohp" required ref="nohp" v-model="form.nohp">
                        </div>
                        <div class="mx-4 my-5">
                            <p class="font-poppins text-gray-800 font-medium text-base">Pihak Terduga<span style="color:red">*</span></p>
                            <input type="text" class="form-control mt-3 shadow appearance-none bg-white border rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Masukkan Pihak yang Ingin Anda Laporkan" id="pihak_terduga" required ref="pihak_terduga" v-model="form.pihak_terduga">
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 grid-cols-1">
                        <div class="mx-4 my-5">
                            <p class="font-poppins text-gray-800 font-medium text-base">Masalah<span style="color:red">*</span></p>
                            <textarea class="form-control mt-3 shadow appearance-none bg-white border rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Masukkan Masalah yang Ingin Diadukan" rows="6" id="masalah" required ref="masalah" v-model="form.masalah"/>
                        </div>
                        <div class="mx-4 my-5">
                            <p class="font-poppins text-gray-800 font-medium text-base">Penyelesaian<span style="color:red">*</span></p>
                            <textarea class="form-control mt-3 shadow appearance-none bg-white border rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Masukkan Penyelesaian yang Anda Harapkan" rows="6" id="penyelesaian" required ref="penyelesaian" v-model="form.penyelesaian"/>
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 grid-cols-1">
                        <div class="mx-4 my-5">
                            <p class="font-poppins text-gray-800 font-medium text-base">Foto Kejadian<span style="color:red">*</span></p>
                            <div class="bg-primary-blue md:h-20 h-36 my-5 border-dashed border border-third-blue rounded-lg">
                                <div class="mx-5 my-3 flex flex-row">
                                    <i class="fas fa-check text-secondary-blue "></i><p class="font-poppins text-sm text-secondary-blue ml-2">Maksimal Ukuran Foto: 15 MB</p>
                                </div>
                                <div class="mx-5 my-3 flex flex-row">
                                    <i class="fas fa-check text-secondary-blue "></i><p class="font-poppins text-sm text-secondary-blue ml-2">Ekstensi Foto yang diperbolehkan: .png, .jpg, .jpeg</p>
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="custom-file mb-5 ">
                                    <input type="file" class="form-control" id="file" ref="photo" @change='uploadPhoto' required>
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="mb-7 mx-5 text-sm border-1 font-medium md:px-4 px-3 py-2 rounded-lg bg-green-500 text-white hover:bg-green-600">LAPORKAN ADUAN</button>
                </div>
            </form>
        </div>
    </div>

        <!-- FOOTER -->
       <Footer/>
    </div>
</template>

<script>
import Meta from '../../components/Meta.vue'
import Navbar from '../../components/Navbar.vue'
import Footer from '../../components/Footer.vue'

import axios from 'axios'
export default {
    components: {
        Meta,
        Navbar,
        Footer
    },
    data() {
    return {
        // ref
        form: ({
          nama: '',
          email: '',
          nohp: '',
          pihak_terduga: '',
          masalah: '',
          penyelesaian: '',
          photo: ''
        })
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

        // Code Baru
        // this.file = this.$refs.file.files[0];       
        },
        //For getting Instant Uploaded Photo
        getPhoto(){
        let photo = (this.form.photo.length > 100) ? this.form.photo : "isu/"+ this.form.photo;
        return photo;
        },
        //Insert Photo
        SubmitPhoto(){
        // Code Baru
        let formData = new FormData();

        formData.append('nama', this.form.nama);
        formData.append('email', this.form.email);
        formData.append('nohp', this.form.nohp);
        formData.append('pihak_terduga', this.form.pihak_terduga);
        formData.append('masalah', this.form.masalah);
        formData.append('penyelesaian', this.form.penyelesaian);
        formData.append('foto', this.form.file);
        

        //   const token = localStorage.getItem('token')
        //   axios.defaults.headers.common.Authorization = `Bearer ${token}`

        axios.post(` http://localhost:8000/api/user/isumasuk`, 
            // form.photo = this.form.photo,
            // Code Baru
            formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
            }
        )
            .then(()=>{
                alert("Isu Pengaduan Berhasil Dikirim, Anda akan mendapatkan Kode Unik untuk lacak isu melalui email Anda! ")
               this.$router.push({name: 'lacak-isu'});
            })
            .catch(()=>{
            alert('Format foto yang Anda masukkan tidak valid. Mohon masukkan foto dengan format JPG, PNG atau JPEG ')
            // console.log(error)
            })
        },
    },
   
//     methods: {
//     uploadPhoto(e){
//       let file = e.target.files[0];
//       this.form.file = file;
//       let reader = new FileReader();  
//       reader.onloadend = () => {
//         this.form.photo = reader.result;
//       }              
//       reader.readAsDataURL(file);    

//       // Code Baru
//       // this.file = this.$refs.file.files[0];       
//     },
//      //For getting Instant Uploaded Photo
//     getPhoto(){
//       let photo = (this.form.photo.length > 100) ? this.form.photo : "isu/"+ this.form.photo;
//       return photo;
//     },
//     //Insert Photo
//     SubmitPhoto(){
//       // Code Baru
//       let formData = new FormData();

//       formData.append('nama', this.form.nama);
//       formData.append('email', this.form.email);
//       formData.append('nohp', this.form.nohp);
//       formData.append('pihak_terduga', this.form.pihak_terduga);
//       formData.append('masalah', this.form.masalah);
//       formData.append('penyelesaian', this.form.penyelesaian);
//       formData.append('foto', this.form.file);
      
      

//       const token = localStorage.getItem('token')
//       axios.defaults.headers.common.Authorization = `Bearer ${token}`

//       axios.post(` http://localhost:8000/api/user/isumasuk`, 
//         // form.photo = this.form.photo,
//         // Code Baru
//         formData, {
//           headers: {
//             'Content-Type': 'multipart/form-data'
//           }
//         }
//       )
//         .then(()=>{
//             alert("Isu Pengaduan Berhasil Dikirim, Anda akan mendapatkan Kode Unik untuk lacak isu melalui email Anda! ")
//             this.$router.push({name: 'lacak-isu'});
//             // alert("terkirim")  
//         })
//         .catch(()=>{
//          alert('Format foto yang Anda masukkan tidak valid. Mohon masukkan foto dengan format JPG, PNG atau JPEG ')
//         })
//     },
//   }
}
</script>