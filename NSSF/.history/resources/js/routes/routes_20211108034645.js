import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const View = { template: '<router-view></router-view>' }

const routes = [
  {
    path: '/',
    component: () => import('@pages/Layout/DashboardLayout.vue'),
    redirect: 'dashboard',
    children: [
      {
        path: 'dashboard',
        name: 'dashboard',
        component: () => import('@pages/Dashboard.vue'),
        meta: { title: 'Dashboard' }
      },
      {
        path: 'user-management',
        name: 'user_management',
        component: View,
        redirect: { name: 'permissions.index' },
        children: [
          {
            path: 'permissions',
            name: 'permissions.index',
            component: () => import('@cruds/Permissions/Index.vue'),
            meta: { title: 'Permissions' }
          },
          {
            path: 'permissions/create',
            name: 'permissions.create',
            component: () => import('@cruds/Permissions/Create.vue'),
            meta: { title: 'Permissions' }
          },
          {
            path: 'permissions/:id',
            name: 'permissions.show',
            component: () => import('@cruds/Permissions/Show.vue'),
            meta: { title: 'Permissions' }
          },
          {
            path: 'permissions/:id/edit',
            name: 'permissions.edit',
            component: () => import('@cruds/Permissions/Edit.vue'),
            meta: { title: 'Permissions' }
          },
          {
            path: 'roles',
            name: 'roles.index',
            component: () => import('@cruds/Roles/Index.vue'),
            meta: { title: 'Roles' }
          },
          {
            path: 'roles/create',
            name: 'roles.create',
            component: () => import('@cruds/Roles/Create.vue'),
            meta: { title: 'Roles' }
          },
          {
            path: 'roles/:id',
            name: 'roles.show',
            component: () => import('@cruds/Roles/Show.vue'),
            meta: { title: 'Roles' }
          },
          {
            path: 'roles/:id/edit',
            name: 'roles.edit',
            component: () => import('@cruds/Roles/Edit.vue'),
            meta: { title: 'Roles' }
          },
          {
            path: 'users',
            name: 'users.index',
            component: () => import('@cruds/Users/Index.vue'),
            meta: { title: 'Users' }
          },
          {
            path: 'users/create',
            name: 'users.create',
            component: () => import('@cruds/Users/Create.vue'),
            meta: { title: 'Users' }
          },
          {
            path: 'users/:id',
            name: 'users.show',
            component: () => import('@cruds/Users/Show.vue'),
            meta: { title: 'Users' }
          },
          {
            path: 'users/:id/edit',
            name: 'users.edit',
            component: () => import('@cruds/Users/Edit.vue'),
            meta: { title: 'Users' }
          }
        ]
      },
      {
        path: 'students',
        name: 'students.index',
        component: () => import('@cruds/Students/Index.vue'),
        meta: { title: 'Students' }
      },
      {
        path: 'students/create',
        name: 'students.create',
        component: () => import('@cruds/Students/Create.vue'),
        meta: { title: 'Students' }
      },
      {
        path: 'students/:id',
        name: 'students.show',
        component: () => import('@cruds/Students/Show.vue'),
        meta: { title: 'Students' }
      },
      {
        path: 'students/:id/edit',
        name: 'students.edit',
        component: () => import('@cruds/Students/Edit.vue'),
        meta: { title: 'Students' }
      },
      {
        path: 'records',
        name: 'records.index',
        component: () => import('@cruds/Records/Index.vue'),
        meta: { title: 'Records' }
      },
      {
        path: 'records/create',
        name: 'records.create',
        component: () => import('@cruds/Records/Create.vue'),
        meta: { title: 'Records' }
      },
      {
        path: 'records/:id',
        name: 'records.show',
        component: () => import('@cruds/Records/Show.vue'),
        meta: { title: 'Records' }
      },
      {
        path: 'records/:id/edit',
        name: 'records.edit',
        component: () => import('@cruds/Records/Edit.vue'),
        meta: { title: 'Records' }
      },
    ]
  }
]

export default new VueRouter({
  mode: 'history',
  base: '/admin',
  routes
})
