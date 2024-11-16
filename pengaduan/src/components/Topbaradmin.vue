<template>
    <div class="bg-green-50">
        <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <!-- <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars text-green-500"></i>
                    </button> -->


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-900  uppercase font-bold text-sm">{{admin.name}}</span>
                                <img class="img-profile rounded-circle"
                                    :src="path + '/admin/'+ admin.foto" alt="Foto">
                            </a>
                        </li>

                    </ul>

                </nav>
    </div>
</template>
<script>

import { onMounted, ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

export default {
    data(){
        return {
            path: 'http://localhost:8000'
        }
    },
    
    setup() {

            //state token
            const token = localStorage.getItem('token')

            //inisialisasi vue router on Composition API
            const router = useRouter()

            //state user
            const admin = ref('')
            
            //mounted properti
            onMounted(() =>{

                //check Token exist
                if(!token) {
                    return router.push({
                        name: 'admin'
                    })
                }
                
                //get data admin
                axios.defaults.headers.common.Authorization = `Bearer ${token}`
                axios.get('http://localhost:8000/api/admin')
                .then(response => {

                    // console.log(response.data.foto)
                    admin.value = response.data[0]

                })
                .catch(error => {
                    console.log(error.response.data)
                })

              

                

            })

            
            return {
                token,      // <-- state token
                admin,  
            }

        }
}
</script>