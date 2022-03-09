import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Home from './Pages/Home.vue';
import Blog from './Pages/Blog.vue';
import About from './Pages/About.vue';
import NotFound from './Pages/NotFound.vue';
import PostDetails from './Pages/PostDetails.vue';
import TagDetails from './Pages/TagDetails.vue';
import ContactUs from './Pages/ContactUs.vue';


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
            path: "/tags/:slug",
            name: "tag-details",
            component: TagDetails
        },
        {
            path: "/contact-us",
            name: "contact-us",
            component: ContactUs
        },
        {
            path: "/*",
            name: "not-found",
            component: NotFound
        }
    ]
});

export default router