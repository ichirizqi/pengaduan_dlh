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

        <div class="flex justify-center">
            <img src="../../images/notfound.jpg" alt="404 Not Found" class="w-3/5 mt-20">
            
        </div>
        <p class="text-5xl font-montserrat font-extrabold text-gray-900 text-center -mt-10 mb-10">PAGE NOT FOUND</p>
        
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