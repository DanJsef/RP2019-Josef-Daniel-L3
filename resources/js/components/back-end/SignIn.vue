<template>
    <div>
        <div class="formwrapper">
            <form class="m-5">
                <h2>přihlášení</h2>
                <div class="form-group">
                    <input
                        oninput="this.setAttribute('value', this.value);"
                        autocomplete="email"
                        value
                        autofocus
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        v-model="email"
                    >
                    <label for="email">
                        Email
                    </label>
                </div>
                <div class="form-group">
                    <input
                        oninput="this.setAttribute('value', this.value);"
                        autocomplete="password"
                        value
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        v-model="password"
                        required
                    >
                    <label for="password">
                        Heslo
                    </label>
                </div>
                <a href="/forgot-password">
                    Zapoměnli jste heslo?
                </a>
                <button
                    class="btn btn-primary"
                    type="submit"
                    @click.prevent="signIn"
                >
                    přihlásit
                </button>
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
            password: '',
            allErrors: []
        };
    },
    methods: {
        signIn: function() {
            axios
                .post(
                    '/api/user/sign-in',
                    { email: this.email, password: this.password },
                    { headers: { 'X-Requested-With': 'XMLHttpRequest' } }
                )
                .then(response => {
                    const token = response.data.token;
                    localStorage.setItem('user_token', token);
                    this.$router.go();
                })
                .catch(error => {
                    const data = error.response.data.errors;
                    this.allErrors = [];
                    if (data !== undefined) {
                        for (let key in data) {
                            if (data.hasOwnProperty(key)) {
                                this.allErrors.push(data[key][0]);
                            }
                        }
                    } else {
                        this.allErrors.push(error.response.data.error);
                    }
                });
        },
    },
    mounted() {}
};
</script>