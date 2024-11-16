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

        <!-- HERO -->
        <div class="md:mx-20 mt-20">
            <div class="flex md:flex-row flex-col">
                <img src="../../images/hero.png" alt="Hero" >
                <div class="md:ml-20 mx-5">
                    <h2 class="uppercase md:text-5xl text-4xl font-semibold md:mt-36 font-worksans text-gray-800 md:text-left text-center">Pengaduan</h2>
                    <div class="text-center md:text-left">
                        <p class="md:my-5 my-3 font-montserrat text-primary-black md:text-lg text-base">Laporkan aduanmu seputar permasalahan lingkungan hidup di Kota Batu sekarang lebih mudah lewat aplikasi!</p>
                        <router-link to="/pengaduan" class="text-lg font-medium border-1 md:px-4 px-3 py-2 rounded-lg bg-green-600 text-white hover:bg-green-500">Adukan Sekarang</router-link>
                    </div>
                </div>
            </div>
        </div>

        <!-- ALUR -->
        <div class="my-20">
            <p class="font-worksans text-gray-800 md:text-4xl text-2xl font-bold text-center">Alur Pengaduan Online</p>
            <div class="flex md:ml-96 ml-10 justify-center items-center bg-primary-green h-1 rounded-md md:w-2/5 w-4/5 mt-4"></div>   
            <div>
                    <div class="flex md:flex-row flex-col md:mx-20 mt-20">
                        <img src="../../images/ilus1.png" alt="Illustration1" class="md:w-4/12">
                        <div class="mx-10 md:mt-14 mt-5">
                            <h5 class="font-worksans md:text-2xl text-lg font-medium">Adukan masalah seputar lingkungan hidup dengan mudah!</h5>
                            <p class="font-montserrat md:text-lg text-sm mt-3">Masyarakat Kota Batu dapat dengan mudah melaporkan segala masalah seputar lingkungan hidup secara online melalui aplikasi ini.</p>
                        </div>
                    </div>
                    <!-- mobile -->
                    <div class="md:hidden">
                        <div class="flex md:flex-row flex-col md:mx-20 mt-5">
                            <img src="../../images/ilus2.png" alt="Illustration1" class="md:w-4/12">
                            <div class="mx-10 md:mt-14 mt-5">
                                <h5 class="font-worksans md:text-2xl text-lg font-medium">Petugas akan melakukan verifikasi atas aduan yang telah dikirim.</h5>
                                <p class="font-montserrat md:text-lg text-sm mt-3">Aduan yang telah diverifikasi oleh petugas akan mendapatkan kode unik khusus yang dikirimkan ke email Anda.</p>
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="flex md:flex-row flex-col md:mx-20 mt-5">
                            <div class="mx-10 mt-14">
                                <h5 class="font-worksans text-2xl font-medium">Petugas akan melakukan verifikasi atas aduan yang telah dikirim.</h5>
                                <p class="font-montserrat text-lg mt-3">Aduan yang telah diverifikasi oleh petugas akan mendapatkan kode unik khusus yang dikirimkan ke email Anda.</p>
                            </div>
                            <img src="../../images/ilus2.png" alt="Illustration1" class="w-4/12">
                        </div>
                    </div>
                    <div class="flex md:flex-row flex-col md:mx-20 mt-5">
                        <img src="../../images/ilus3.png" alt="Illustration1" class="md:w-4/12">
                        <div class="mx-10 md:mt-14 mt-5">
                            <h5 class="font-worksans md:text-2xl text-lg font-medium">Pantau aduanmu secara rutin melalui aplikasi!</h5>
                            <p class="font-montserrat text-sm md:text-lg mt-3">Melalui kode unik khusus, Anda dapat memantau penanganan masalah yang dilakukan oleh petugas.</p>
                        </div>
                    </div>
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
export default {
    components: {
    Meta,
    Navbar,
    Footer
  },
}
</script>