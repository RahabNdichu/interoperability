export const routes = [
    {
        path: '/',
        component: ()=>import('./components/Auth/Auth'),
        redirect: '/login',
        children:[
            {
                path: '/login',
                name:'Login',
                meta:{
                    title: 'Login | PharmacistsDashboard'
                },
                component:()=>import('./components/Auth/Login')
            },
            {
                path: '/register',
                name:'register',
                meta:{
                    title: 'Register | PharmacistDashboard'
                },
                component:()=>import('./components/Auth/Register')
            },
            {
                path: '/forgot-password',
                name:'forgot-password',
                meta:{
                    title: 'Forgot Password | PharmacistDashboard'
                },
                component:()=>import('./components/Auth/ForgotPassword')
            }
        ]
    },
    {
        path: '/verify-email/:key',
        name:'Verify-Email',
        meta:{
            title: 'Verify Email | PharmacistDashboard'
        },
        component:()=>import('./components/Auth/VerifyEmail')
    },
    {
        path: '/reset_password/:key',
        name:'Reset-Password',
        meta:{
            title: 'Reset Password | PharmacistDashboard'
        },
        component:()=>import('./components/Auth/ResetPassword')
    },
    {
        path: '/',
        redirect: '/login',
        component:()=>import('./components/Layout/Layout'),
        children: [
            {
                path: '/dashboard',
                name: 'dashboard',
                meta: {
                    title: 'My Dashboard | Pharmacist Dashboard'
                },
                component:()=>import('./components/Dashboard'),
            },
            {
                path: '/project',
                name: 'project',
                meta: {
                    title: 'Project | Pharmacist Dashboard'
                },
                component:()=>import('./components/Project/Project'),
            },
            {
                path: '/task',
                name: 'task',
                meta: {
                    title: 'Task | Vue Dashboard'
                },
                component:()=>import('./components/Task/Task'),
            },
            {
                path: '/profile',
                name: 'profile',
                meta: {
                    title: 'Profile | Vue Dashboard'
                },
                component:()=>import('./components/Profile/Profile'),
            },
         
            {
                path: '/logout',
                name: 'logout',
                meta: {
                    title: 'Logout |  Dashboard'
                },
                component:()=>import('./components/Logout'),
            },

        ]
    },
    {
        path:'*',
        component: () => import('./components/Errors/NotFound')
    }
];
