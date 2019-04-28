import Home from './components/front-end/Landingpage';
import SignUp from './components/back-end/SignUp';
import SignIn from './components/back-end/SignIn';
import Admin from './components/back-end/AdminSignIn';
import Dashboard from './components/back-end/Dashboard';
import Booking from './components/front-end/Booking';
import ForgotPassword from './components/back-end/ForgotPassword';
import ResetPassword from './components/back-end/ResetPassword';
import Gallery from './components/front-end/Gallery';
import Verify from './components/front-end/Verify';

import axios from 'axios';
const routes = [{
    path: '/',
    component: Home
},
{
    path: '/registration',
    component: SignUp
},
{
    path: '/log-in',
    component: SignIn,
    beforeEnter: (to, from, next) => {
        const token = localStorage.getItem('user_token');
        axios.post('/api/user/data?token=' + token, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        }).then(response => {
            if (response.data.user !== false) {
                next('/reservation');
            }
        }).catch(error => {
            next();
        });
    }
},
{
    path: '/verify',
    component: Verify
},
{
    path: '/reservation',
    component: Booking,
    beforeEnter: (to, from, next) => {
        const token = localStorage.getItem('user_token');

        axios.post('/api/user/data?token=' + token, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        }).then((response) => {
            if (response.data.user.token == null) {
                next();
            } else {
                next('/verify');
            }
        }).catch(error => {
            localStorage.removeItem('user_token');
            next('/log-in');
        });
    }
},
{
    path: '/admin',
    component: Admin,
    beforeEnter: (to, from, next) => {
        const token = localStorage.getItem('admin_token');
        axios.post('/api/admin/data?token=' + token,
            {headers: {'X-Requested-With': 'XMLHttpRequest'}}).then((response) => {
            if (response.data.user !== false) {
                next('/dashboard');
            }
        }).catch(error => {
            next();
        });
    }
},
{
    path: '/dashboard',
    component: Dashboard,
    beforeEnter: (to, from, next) => {
        const token = localStorage.getItem('admin_token');

        axios.post('/api/admin/data?token=' + token, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        }).then((response) => {
            next();
        }).catch(error => {
            next('/admin');
        });
    }
},
{
    path: '/forgot-password',
    component: ForgotPassword
},
{
    path: '/reset-password/:resetToken',
    component: ResetPassword
},
{
    path: '/gallery',
    component: Gallery
},
];

export default routes;
