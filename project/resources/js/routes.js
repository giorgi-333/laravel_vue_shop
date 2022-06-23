import Todo from "./pages/Todo";
import ImageUpload from "./pages/ImageUpload";
import Meet from "./pages/Meet";
import MeetMain from "./pages/MeetMain";
//front
import Website from "./pages/Website";
import Home from "./pages/Home";
import product from "./pages/front/product";
import cart from './pages/front/cart'
// admin
import AdminWebsite from "./pages/Admin-Webiste";
import admin from "./pages/admin/admin"
import adminAddEdit from "./pages/admin/add-edit";
import orders from "./components/admin/orders";

const routes = [
    {
        path: "/",
        component: Website,
        children: [
            {
                path: '',
                name: 'home',
                component: Home
            },
            {
                path: 'products/:slug',
                name: 'product',
                component: product
            },
            {
                path: 'cart',
                name: 'cart',
                component: cart
            },
            {
                path: 'todo',
                name: 'todo',
                component: Todo
            },
            {
                path: 'image-upload',
                name: 'imageUpload',
                component: ImageUpload
            },
            {
                path: 'meet',
                name: 'meet',
                component: Meet,
            },
            {
                path: 'meet-home',
                name: 'MeetMain',
                component: MeetMain
            }
        ]
    },
    {
        path: "/admin",
        component: AdminWebsite,
        children: [
            {
                path: '',
                name: 'admin',
                component: admin
            },
            {
                path: 'add',
                name: 'adminAdd',
                component: adminAddEdit
            },
            {
                path: 'edit/:slug',
                name: 'adminEdit',
                component: adminAddEdit
            },
            {
                path: 'orders',
                name: 'orders',
                component: orders
            }
        ]
    }
]

export default routes
