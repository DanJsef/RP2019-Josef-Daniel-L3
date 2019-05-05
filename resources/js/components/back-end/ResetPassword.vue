<template>
    <div>
        <div class="formwrapper">
            <form class="m-5">
                <h2>Obnova hesla</h2>
                <div class="form-group">
                    <input
                        type="password"
                        id="password"
                        value
                        name="password"
                        class="form-control"
                        v-model="password"
                    >
                    <label for="password">
                        Nové heslo
                    </label>
                </div>
                <button
                    type="submit"
                    class="btn btn-primary"
                    @click.prevent="resetPassword"
                >
                    Potvrdit
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
            password: '',
            response: '',
            token: this.$route.params.resetToken,
            allErrors: []
        };
    },
    methods: {
        resetPassword: function () {
            axios.post('/api/user/reset-password', {password: this.password, token: this.token},
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

<style>
</style>
