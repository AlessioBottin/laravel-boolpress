<template>
    <section>
        <Header />

        <main>
            <router-view></router-view>
        </main>
    </section>
</template>

<script>
import Header from '../components/Header.vue';


export default {
    name: 'App',
    components: {
        Header
    }
}
</script>