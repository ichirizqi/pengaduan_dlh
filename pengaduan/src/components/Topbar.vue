<template>
    <div>
        <nav class="navbar navbar-expand navbar-light bg-green-50 topbar mb-4 static-top shadow">

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
                                <span class="mr-2 d-none d-lg-inline text-gray-900  uppercase font-bold text-sm">{{dinas.name}}</span>
                                <img class="img-profile rounded-circle"
                                    :src="path + '/dinas/'+ dinas.foto" alt="Foto">
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
            const dinas = ref('')
            
            //mounted properti
            onMounted(() =>{

                //check Token exist
                if(!token) {
                    return router.push({
                        name: 'dinas'
                    })
                }
                
                //get data admin
                axios.defaults.headers.common.Authorization = `Bearer ${token}`
                axios.get('http://localhost:8000/api/user')
                .then(response => {

                    // console.log(response.data.foto)
                    dinas.value = response.data.data[0]
                    // this.imagepath = response.data;

                })
                .catch(error => {
                    console.log(error.response.data)
                })

                

            })

            
            return {
                token,      // <-- state token
                dinas, 
            }

        }
}
</script>