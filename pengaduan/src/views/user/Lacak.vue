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

        <!-- LACAK -->
        <div class="mb-10 mt-32 md:mt-40">
            <h5 class="font-poppins font-bold md:text-3xl text-xl text-gray-900  mt-14 md:mt-28 md:mb-3 mb-1 md:mx-28 mx-5">Lacak Isu</h5>
            <p class="font-poppins font-normal md:text-base text-sm text-gray-500 md:mx-28 mx-5 md:mb-14 mb-8">Gunakan kode lacak isu untuk memantau penanganan masalah atas isu yang telah Anda adukan.</p>

            <div class="w-10/12 md:mx-28 mx-7 border shadow-md mb-10">
                <div class="flex flex-row my-6 mx-10">
                    <input type="text" v-model="search" class="form-control mt-3 w-full h-10 shadow appearance-none bg-white border rounded-l-md py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    placeholder="Masukkan Kode Lacak Isu" >
                    <button @click.prevent="searchIsu()" @click="searchPengaduan()" class=" text-sm border-1 font-medium md:px-4 px-3 py-px h-10 mt-3 rounded-r-md bg-green-500 text-white hover:bg-green-600">LACAK</button>
                </div>
            </div>

           <div v-if="showsearch==true">
                <p class="text-center font-poppins font-bold text-lg text-gray-800 mb-7">Keterangan</p>
                <div  class="border border-gray-200 w-10/12 md:mx-28 mx-7 h-full">
                    <div class="md:m-10 m-5">
                        <p class="font-poppins font-normal md:text-base text-sm text-gray-700 mb-7">Berikut daftar aktivitas penanganan berdasarkan kode lacak yang Anda cari</p>
                            <div class="mb-10" v-for="p in pengaduans" v-bind:key="p.id">
                               <div class="grid md:grid-cols-2 grid-cols-1">
                                   <div>
                                        <div class="flex flex-row">
                                            <div class="md:mr-16 mr-20">
                                                <p class="font-bold text-gray-900">Kode Lacak</p>
                                            </div>
                                            <div class="bg-red-500 text-white text-center rounded-xl text-sm w-28">{{p.kode_lacak}}</div>
                                        </div>
                                        <div class="flex flex-row mt-2">
                                            <div class="md:mr-9 mr-14">
                                                <p class="font-bold text-gray-900">Nama Pengadu</p>
                                            </div>
                                            <div>
                                                <p class="text-gray-800">{{p.nama}}</p>
                                            </div>
                                        </div>
                                   </div>
                                    <div class="md:mt-0 mt-2">
                                        <div class="flex flex-row">
                                            <div class="mr-16">
                                                <p class="font-bold text-gray-900">Tanggal Mulai</p>
                                            </div>
                                            <div>
                                                <p>{{dateTime(p.tanggal_mulai)}}</p>
                                            </div>
                                        </div>
                                        <div class="flex flex-row mt-2">
                                            <div class="mr-14">
                                                <p class="font-bold text-gray-900">Tanggal Selesai</p>
                                            </div>
                                            <div>
                                                <p class="text-gray-800">{{dateTime(p.tanggal_selesai)}}</p>
                                            </div>
                                        </div>
                                   </div>
                               </div>
                            </div>
                            <div v-for="(cari) in caris" v-bind:key="cari.id" class="mt-5">
                               <div class="flex flex-row">
                                    <!-- <i class="far fa-circle text-green-600 text-xs mt-0.5"></i> -->
                                    <p class="text-gray-600 text-xs">{{dateTime(cari.tanggal)}}</p>
                                    <div class="ml-6">
                                       <img :src="path + '/aktivitas/'+ cari.foto" alt="Foto" style="width:250px" class="mb-4">
                                        <p class="text-gray-700 text-base  -mt-1">{{cari.narasi}}</p>
                                         <p class="text-gray-700 text-base  mt-0.5"><strong>Status</strong> : {{cari.get_status.nama}}</p>
                                    </div>
                               </div>
                               <div class="h-48 bg-gray-300 w-px ml-9 flex md:ml-9 -mt-48 mb-3"></div>
                            </div>
                            <!-- <div class="table-responsive">
                                    <table class="table border border-gray-200" id="dataTable" width="100%" cellspacing="0">
                                        <thead class="text-black">
                                            <tr class="border border-gray-200 py-2">
                                                <th class="border border-gray-200 py-2 w-10">No</th>
                                                <th class="border border-gray-200 py-2 w-44">Tanggal Penanganan</th>
                                                <th class="border border-gray-200 py-2 w-96">Aktivitas Penanganan</th>
                                                <th class="border border-gray-200 py-2 w-44">Status Penanganan</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-black text-center">
                                            <tr v-for="(cari,index) in caris" v-bind:key="cari.id">
                                                <td class="border border-gray-200 py-2">{{index+1}}</td>
                                                <td class="border border-gray-200 py-2">{{dateTime(cari.tanggal)}}</td>
                                                <td class="border border-gray-200 py-2">{{cari.narasi}}</td>
                                                <td class="border border-gray-200 py-2">{{cari.get_status.nama}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                            </div> -->
                    </div>
                </div>
           </div>
            <div v-if="showsearch==false"></div>
        </div>
        
        <!-- FOOTER -->
       <Footer/>
    </div>
</template>

<script>
import Meta from '../../components/Meta.vue'
import Navbar from '../../components/Navbar.vue'
import Footer from '../../components/Footer.vue'

import moment from 'moment';
export default {
    components: {
    Meta,
    Navbar,
    Footer
  },
  data(){
      return {
          search : '',
          showsearch: false,
          caris: [],
          pengaduans: [],
          path: 'http://localhost:8000',
      }
  },
  methods: {
      searchIsu(){
          if(this.search===""){
            this.showsearch = false;
            this.caris= []
          }
          else{
               fetch('http://localhost:8000/api/aktivitas/search?q='+this.search)
                .then(res => res.json())
                .then( res => {
                    this.caris = res;
                    this.search= '';
                    this.showsearch = true;
                })
                .catch (err => {
                    console.log(err);
                });
          }
         
      },
      searchPengaduan(){
          if(this.search===""){
            this.showsearch = false;
            this.pengaduans= []
          }
          else{
              fetch('http://localhost:8000/api/pengaduan/search?q='+this.search)
                .then(res => res.json())
                .then( res => {
                    this.pengaduans = res;
                    this.search= '';
                    this.showsearch = true;
                })
                .catch (err => {
                    console.log(err);
                });
          }
      },
      dateTime(value) {
            return moment(value).format('DD MMM YYYY');
        },
  }
}
</script>