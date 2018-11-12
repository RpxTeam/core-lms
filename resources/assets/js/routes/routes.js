import Home from '../pages/home'
import Login from '../pages/login'
import Register from '../pages/register'
import ForgotPassword from '../pages/forgotPassword'
import ResetPassword from '../pages/resetPassword'
import Courses from '../pages/courses'
import MyCourses from '../pages/myCourses'
import Dashboard from '../pages/admin/dashboard'
import AdminCourses from '../pages/admin/courses/list'
import CreateCourses from '../pages/admin/courses/create'
import NoMatch from '../pages/noMatch'

const routes = [
    {
        path: '/',
        exact: true,
        auth: false,
        component: Home
    },
    {
        path: '/login/:social',
        exact: false,
        auth: false,
        component: Home
    },
    {
        path: '/login',
        exact: true,
        auth: false,
        component: Login
    },
    {
        path: '/register',
        exact: true,
        auth: false,
        component: Register
    },
    {
        path: '/forgot-password',
        exact: true,
        auth: false,
        component: ForgotPassword
    },
    {
        path: '/reset-password/:token/:email',
        exact: true,
        auth: false,
        component: ResetPassword
    },
    {
        path: '/courses',
        exact: true,
        auth: false,
        component: Courses
    },
    {
        path: '/my-courses',
        exact: true,
        auth: true,
        component: MyCourses
    },
    {
        path: '/dashboard',
        exact: true,
        auth: true,
        component: Dashboard
    },
    {
        path: '/admin/courses',
        exact: true,
        auth: true,
        component: AdminCourses
    },
    {
        path: '/admin/courses/create',
        exact: true,
        auth: true,
        component: CreateCourses
    },
    {
        path: '',
        exact: true,
        auth: false,
        component: NoMatch
    },
];

export default routes;