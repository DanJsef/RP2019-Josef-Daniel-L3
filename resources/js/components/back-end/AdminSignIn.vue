<template>
    <div>
        <form class="m-5">
            <div class="form-group">
                <label for="name">
                    Jméno
                </label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    class="form-control"
                    v-model="name"
                >
            </div>
            <div class="form-group">
                <label for="password">
                    Heslo
                </label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control"
                    v-model="password"
                >
            </div>
            <button
                type="submit"
                class="btn btn-primary"
                @click.prevent="signIn"
            >
                Sign in
            </button>
        </form>
        <div
            v-for="error in allErrors"
            class="alert alert-danger mt-3 mr-5 ml-5"
            :key="error.id"
        >
            <p>{{ error }}</p>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            name: '',
            password: '',
            allErrors: []
        };
    },
    methods: {
        signIn: function () {
            axios.post('/api/admin', {name: this.name, password: this.password},
                {headers: {'X-Requested-With': 'XMLHttpRequest'}}).then((response) => {
                const token = response.data.token;
                localStorage.setItem('admin_token', token);
                this.$router.push('/dashboard');
            }).catch(error => {
                const data = error.response.data.errors;
                this.allErrors = [];
                for (let key in data) {
                    if (data.hasOwnProperty(key)) {
                        this.allErrors.push(data[key][0]);
                    }
                }
            });
        },
    },
    mounted() {}
};
</script>

<style>
    @import "~bootstrap/dist/css/bootstrap.css";
</style>