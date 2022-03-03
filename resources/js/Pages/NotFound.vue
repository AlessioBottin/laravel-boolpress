<template>
    <section>
        <div class="container">
            <h2>Spiacenti non siamo riusciti a trovare ciò che cercavi</h2>

            <router-link class="nav-link" :to="{ name: 'home' }">Torna alla Home</router-link>
        </div>
    </section>
</template>

<script>
export default {
    name: "NotFound"
}
</script>