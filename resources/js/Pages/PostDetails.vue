<template>
    <section>
        <div class="container">
            <h1>{{ post.title }}</h1>

            <div v-if="post.category">Categoria: {{ post.category.name }}</div>

            <div v-if="post.tags.length > 0">    
                <router-link 
                    class="nav-link badge badge-pill badge-primary mr-2" 
                    :to="''"  
                    v-for="tag in post.tags" 
                    :key="tag.id"
                >
                    {{ tag.name }}
                </router-link>          
            </div>

            <p>{{ post.content }}</p>
        </div>
    </section>
</template>

<script>
export default {
    name: 'PostDetails',
    data: function() {
        return {
            post: false
        }
    },
    methods: {
        getPost: function() {
            axios.get('/api/posts/' + this.$route.params.slug)
            .then((response) => {
                if(response.data.success) {
                    this.post = response.data.results;
                } else {
                    this.$router.push({ name: 'not-found' });
                }
            });
        }
    },
    created: function() {
        this.getPost();
    }
}
</script>