<template>
    <section>
        <div class="container">
            <h1>{{ tag.name }}</h1>

            <h3>Post Correlati</h3>

            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center"
                    v-for="post in tag.posts" 
                    :key="post.id"
                > 
                    <router-link class="nav-link" :to="{ name: 'post-details', params: { slug: post.slug } }">
                        {{ post.title }}
                    </router-link>    
                </li>
            </ul>
        </div>
    </section>
</template>

<script>
export default {
    name: 'TagDetails',
    data: function() {
        return {
            tag: false
        }
    },
    methods: {
        getTag: function() {
            axios.get('/api/tags/' + this.$route.params.slug)
            .then((response) => {
                if(response.data.success) {
                    this.tag = response.data.results;
                } else {
                    this.$router.push({ name: 'not-found' });
                }
            });
        }
    },
    created: function() {
        this.getTag();
    }
}
</script>