<template>
    <div>
        <div class="formwrapper">
            <form class="m-5">
                <h2>Obnova hesla</h2>
                <div class="form-group">
                    <input
                        type="text"
                        oninput="this.setAttribute('value', this.value);"
                        value
                        id="email"
                        name="email"
                        class="form-control"
                        v-model="email"
                    >
                    <label for="email">
                        E-mail
                    </label>
                </div>
                <button
                    type="submit"
                    class="btn btn-primary"
                    @click.prevent="sendForgotMail"
                >
                    Odeslat
                </button>
                <div
                    v-if="response !== ''"
                    class="alert alert-info mt-3 mr-5 ml-5"
                >
                    <p>{{ response }}</p>
                </div>
                <div
                    v-for="error in allErrors"
                    class="alert alert-danger mt-3 mr-5 ml-5"
                    :key="error.id"
                >
                    <p>{{ error }}</p>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            email: '',
            response: '',
            allErrors: []
        };
    },
    methods: {
        sendForgotMail: function () {
            axios.post('/api/user/forgot-password', {email: this.email},
                {headers: {'X-Requested-With': 'XMLHttpRequest'}}).then((response) => {
                this.response= response.data.message;
            }).catch(error => {
                const data = error.response.data.errors;
                for (let key in data) {
                    if (data.hasOwnProperty(key)) {
                        this.allErrors.push(data[key][0]);
                    }
                }
            });
        }
    },
};
</script>
