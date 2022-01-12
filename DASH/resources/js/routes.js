export const routes = [
    {
        path: '/',
        component: ()=>import('./components/Dashboard'),
        redirect: '/dashboard',
        children:[
            {
               path: '/dashboard',
                name: 'dashboard',
                meta: {
                    title: 'My Dashboard | Pharmacist Dashboard'
                },
                component:()=>import('./components/Dashboard'),
            },       
        ]
    },
];
