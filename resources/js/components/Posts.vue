<template>
    <section>
        <h1>Lista dei post</h1>

        <!-- Posts  -->
        <div class="row row-cols-4">
            <!-- Single Post  -->
            <div class="card mb-3 " v-for="post in posts" :key="post.id">
                <!-- <img src="..." class="card-img-top" alt="..."> -->
                <div class="card-body">
                    <h5 class="card-title">{{ post.title }}</h5>
                    <p class="card-text">{{ getTrimmedText(post.content, 50) }}</p>
                    <router-link class="nav-link" :to="{ name: 'post-details', params: { slug: post.slug } }">Leggi articolo</router-link>
                </div>
            </div>

        </div>

        <!-- Pagination Buttons  -->
        <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item"  :class="{ 'disabled': currentPage === 1 }" >
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true" @click="getPosts(currentPage - 1)">Previous</a>
            </li>
            <li class="page-item" v-for="n in lastPage" :key="n" :class="{ 'active': currentPage == n }">
                <a class="page-link" href="#" @click="getPosts(n)">{{n}}</a>
            </li>
            <li class="page-item" :class="{ 'disabled': currentPage === lastPage }" >
                <a class="page-link" href="#" @click="getPosts(currentPage + 1)" >Next</a>
            </li>
        </ul>
        </nav>
    </section>

</template>

<script>
export default {
    name: 'Posts',
    data: function () {
        return {
            posts: [],
            currentPage: false,
            lastPage: false
        }
    },
    methods: {
        getPosts: function(pageNumber) {
            axios.get('/api/posts', {
                params: {
                    page: pageNumber
                }
            })
            .then((response) => {
                this.posts = response.data.posts.data;
                this.currentPage = response.data.posts.current_page;
                this.lastPage = response.data.posts.last_page;
            });
        },
        getTrimmedText: function(text, maxNumChar) {
            if (text.length > maxNumChar) {
                return text.substr(0, maxNumChar) + '...';
            }

            return text;            
        }
    },
    created: function() {
        this.getPosts(1);
    }
}
</script>