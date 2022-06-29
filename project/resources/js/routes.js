
//front
import Website from "./pages/Website";
import Home from "./pages/Home";
import product from "./pages/front/product";
import cart from './pages/front/cart'
import about from "./components/front/about";

// admin
import AdminWebsite from "./pages/Admin-Webiste";
import admin from "./pages/admin/admin"
import adminAddEdit from "./pages/admin/add-edit";
import orders from "./components/admin/orders";
import products from "./pages/front/products";

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
                path: 'products',
                name: 'products',
                component: products
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
                path: 'about',
                name: 'about',
                component: about
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
