//import vue router
import { createRouter, createWebHistory } from 'vue-router'

//define a routes
const routes = [
    // USER
    {
        path: '/',
        name: 'beranda',
        component: () => import( /* webpackChunkName: "post.index" */ '@/views/user/Index.vue')
    },
    {
        path: '/pengaduan',
        name: 'pengaduan',
        component: () => import( /* webpackChunkName: "post.index" */ '@/views/user/Pengaduan.vue')
    },
    {
        path: '/lacak-isu',
        name: 'lacak-isu',
        component: () => import( /* webpackChunkName: "post.index" */ '@/views/user/Lacak.vue')
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'notfound',
        component: () => import( /* webpackChunkName: "post.index" */ '@/views/user/Notfound.vue')
    },

    // ADMIN
    {
        path: '/admin',
        name: 'admin',
        component: () => import( /* webpackChunkName: "post.index" */ '@/views/admin/Index.vue')
    },
    {
        path: '/admin/dashboard',
        name: 'admin-dashboard',
        component: () => import( /* webpackChunkName: "post.index" */ '@/views/admin/Dashboard.vue')
    },
    {
        path: '/admin/peran-pengguna',
        name: 'admin-peran-pengguna',
        component: () => import( /* webpackChunkName: "post.index" */ '@/views/admin/peran/Peranpengguna.vue')
    },
    {
        path: '/admin/akun-admin',
        name: 'admin-akun-admin',
        component: () => import( /* webpackChunkName: "post.index" */ '@/views/admin/dataadmin/Dataadmin.vue')
    },
    {
        path: '/admin/akun-admin/tambah',
        name: 'admin-akun-admin-tambah',
        component: () => import( /* webpackChunkName: "post.index" */ '@/views/admin/dataadmin/Tambah.vue')
    },
    {
        path: '/admin/akun-admin/edit/:id',
        name: 'admin-akun-admin-edit',
        component: () => import( /* webpackChunkName: "post.index" */ '@/views/admin/dataadmin/Edit.vue')
    },

    {
        path: '/admin/akun-dinas',
        name: 'admin-akun-dinas',
        component: () => import( /* webpackChunkName: "post.index" */ '@/views/admin/datadinas/Datadinas.vue')
    },
    {
        path: '/admin/akun-dinas/tambah',
        name: 'admin-akun-dinas-tambah',
        component: () => import( /* webpackChunkName: "post.index" */ '@/views/admin/datadinas/Tambah.vue')
    },
    {
        path: '/admin/akun-dinas/edit/:id',
        name: 'admin-akun-dinas-edit',
        component: () => import( /* webpackChunkName: "post.index" */ '@/views/admin/datadinas/Edit.vue')
    },

    {
        path: '/admin/status',
        name: 'admin-status',
        component: () => import( /* webpackChunkName: "post.index" */ '@/views/admin/status/Status.vue')
    },
    {
        path: '/admin/status/tambah',
        name: 'admin-status-tambah',
        component: () => import( /* webpackChunkName: "post.index" */ '@/views/admin/status/Tambah.vue')
    },
    {
        path: '/admin/status/edit/:id',
        name: 'admin-status-edit',
        component: () => import( /* webpackChunkName: "post.index" */ '@/views/admin/status/Edit.vue')
    },

    // DINAS
    {
        path: '/dinas',
        name: 'dinas',
        component: () => import( /* webpackChunkName: "post.index" */ '@/views/dinas/Index.vue')
    },
    {
        path: '/dinas/dashboard',
        name: 'dinas-dashboard',
        component: () => import( /* webpackChunkName: "post.index" */ '@/views/dinas/Dashboard.vue')
    },
    {
        path: '/dinas/edit-profile/:id',
        name: 'dinas-edit-profile',
        component: () => import( /* webpackChunkName: "post.index" */ '@/views/dinas/Editdinas.vue')
    },
    {
        path: '/dinas/pengaduan-masuk',
        name: 'dinas-pengaduan-masuk',
        component: () => import( /* webpackChunkName: "post.index" */ '@/views/dinas/pengaduanmasuk/Pengaduanmasuk.vue')
    },
    {
        path: '/dinas/pengaduan-detail/:id',
        name: 'dinas-pengaduan-detail',
        component: () => import( /* webpackChunkName: "post.index" */ '@/views/dinas/pengaduanmasuk/Verifikasi.vue')
    },
    {
        path: '/dinas/pengaduan-verifikasi',
        name: 'dinas-pengaduan-verifikasi',
        component: () => import( /* webpackChunkName: "post.index" */ '@/views/dinas/isupengaduan/Isupengaduan.vue')
    },
    
    {
        path: '/dinas/pengaduan-verifikasi/edit/:id',
        name: 'dinas-pengaduan-verifikasi-edit',
        component: () => import( /* webpackChunkName: "post.index" */ '@/views/dinas/isupengaduan/Edit.vue')
    },
    {
        path: '/dinas/pengaduan-ban',
        name: 'dinas-pengaduan-ban',
        component: () => import( /* webpackChunkName: "post.index" */ '@/views/dinas/isuban/Isuban.vue')
    },
]

//create router
const router = createRouter({
    history: createWebHistory(),
    routes  // config routes
})

export default router
