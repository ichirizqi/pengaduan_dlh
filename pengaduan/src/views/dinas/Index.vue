<template>
    <div>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <div class="bg-login bg-cover h-bg">
         <div class="flex justify-end pr-6 pt-6 -mb-8">
            <a href="/" class="font-semibold text-gray-800"><i class="fas fa-home mx-2 mt-px text-gray-800 text-xl"></i>Kembali ke Beranda</a>
        </div>
        <div class="flex justify-center items-center">
            <div class="bg-white md:w-2/5 md:mt-7 mt-10 border-2 border-gray-100 px-10 rounded-lg">
                <div class="flex flex-row">
                    <img src="../../images/logo.png" alt="Logo" class="w-20 mt-10">
                    <div class="flex flex-col mt-12 mx-7">
                        <p class="font-inter font-semibold">Sistem Informasi Pengaduan</p>
                        <p class="font-inter font-semibold">Dinas Lingkungan Hidup Kota Batu</p>
                    </div>
                </div>
                <div class="border w-full h-line bg-gray-100 border-gray-100 mt-5"></div>
                <div>
                    <form @submit.prevent="login">
                        <div>
                            <div class="mb-2">
                                <p class="font-worksans text-center mt-3">Selamat Datang!</p>
                                <p class="font-worksans text-center">Silahkan Masuk Sebagai Pegawai Dinas</p>
                            </div>
                            <div v-if="loginFailed" class="text-center bg-red-300 p-2 mt-2 rounded-md">
                                NIP atau Password Anda salah.
                            </div>
                            <div class="mx-4 mt-5">
                                <p class="font-poppins text-gray-800 font-medium text-sm">NIP</p>
                                <input type="text" class="form-control mt-3 shadow appearance-none bg-white border rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="Masukkan NIP Anda" v-model="user.nip" required>
                            </div>
                            <div class="mx-4 mt-5">
                                <p class="font-poppins text-gray-800 font-medium text-sm">Password</p>
                                <input type="password" class="form-control mt-3 shadow appearance-none bg-white border rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="Masukkan Password Anda" v-model="user.password" required>
                            </div>
                            <button type="submit" class="mx-4 w-100  text-sm border-1 font-medium md:px-4 px-3 py-2 rounded-lg bg-green-500 text-white hover:bg-green-600 mt-10">LOGIN</button>
                        </div>
                    </form>
                    <div class="border w-full h-line bg-gray-100 border-gray-100 my-5"></div>
                    <div class="ml-24 my-5">
                        <a class="hover:text-green-400" href="/admin">Klik Untuk Masuk Sebagai Admin</a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    </div>
</template>
<script>

import axios from 'axios'
import { useRouter } from 'vue-router'
import { reactive, ref } from 'vue'

export default {
    setup() {

            //inisialisasi vue router on Composition API
            const router = useRouter()

            //state user
            const user = reactive({
                nip: '',
                password: '',
            })

            //state validation
            const validation = ref([])

            //state loginFailed
            const loginFailed = ref(null)

            //method login
            function login() {

                //define variable 
                let nip = user.nip
                let password = user.password

                //send server with axios
                axios.post('http://localhost:8000/api/dinas/login', {
                        nip,
                        password,
                })
                .then(response => {

                    if(response.data.success) {

                        //set token
                        localStorage.setItem('token', response.data.data.token)

                        //redirect ke halaman dashboard
                        return router.push({
                            name: 'dinas-dashboard'
                        })
                    }

                    //set state loggedIn to true
                    loginFailed.value = true


                }).catch(error => {
                    //set validation dari error response
                    validation.value = error.response.data
                })

            }

            return {
                user,           // <-- state user
                validation,     // <-- state validation 
                loginFailed,    // <-- state loggedIn
                login           // <-- method login
            }

        }
}
</script>