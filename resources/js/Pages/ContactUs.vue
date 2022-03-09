
<template>
    <div>
        <section>
            <div class="container">
                <h1>Contattaci</h1>

                <div v-if="success">Email inviata con successo!</div>

                <form>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input v-model="email" type="email" class="form-control" id="email">
                    </div>

                    <div v-if="errors.email">
                        <p v-for="(error, index) in errors.email" :key="index">{{ error }}</p>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input v-model="name" type="text" class="form-control" id="name">
                    </div>

                    <div v-if="errors.name">
                        <p v-for="(error, index) in errors.name" :key="index">{{ error }}</p>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Messaggio</label>
                        <textarea v-model="content" id="content" class="form-control" cols="30" rows="10"></textarea>
                    </div>

                    <div v-if="errors.content">
                        <p v-for="(error, index) in errors.content" :key="index">{{ error }}</p>
                    </div>

                    <button :disabled="disabled" type="submit" @click.prevent="sendMail()" class="btn btn-primary">Invia</button>
                </form>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    name: "ContactUs",
    data: function() {
        return {
            email: '',
            name: '',
            content: '',
            success: false,
            errors: {},
            disabled: false
        };
    },
    methods: {
        sendMail: function() {
            this.disabled = true;

            axios.post('/api/leads/store', {
                email: this.email,
                name: this.name,
                content: this.content
            })
            .then((response) => {
                if(response.data.success) {
                    this.name = '';
                    this.email = '';
                    this.message = '';
                    this.success = true;
                    this.error = {};
                } else {
                    this.success = false;
                    this.errors = response.data.errors
                }

                this.disabled = false;
            })
        }
    }
}
</script>