import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Home from './Pages/Home.vue';
import Blog from './Pages/Blog.vue';
import About from './Pages/About.vue';
import NotFound from './Pages/NotFound.vue';
import PostDetails from './Pages/PostDetails.vue';



const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home
        },
        {
            path: "/blog",
            name: "blog",
            component: Blog
        },
        {
            path: "/blog/:slug",
            name: "post-details",
            component: PostDetails
        },
        {
            path: "/about",
            name: "about",
            component: About
        },
        
        {
            path: "/*",
            name: "not-found",
            component: NotFound
        }
    ]
});

export default router