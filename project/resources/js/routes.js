import Website from "./pages/Website";
import Home from "./pages/Home";
import product from "./pages/product";
import Admin from "./pages/Admin";
import Todo from "./pages/Todo";
import ImageUpload from "./pages/ImageUpload";
import Meet from "./pages/Meet";
import MeetMain from "./pages/MeetMain";

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
                path: 'admin',
                name: 'admin',
                component: Admin
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
    }
]

export default routes
