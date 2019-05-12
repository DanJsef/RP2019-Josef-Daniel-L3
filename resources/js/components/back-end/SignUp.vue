<template>
    <div>
        <div class="formwrapper">
            <form class="m-5">
                <h2>registrace</h2>
                <div class="form-group half">
                    <input
                        oninput="this.setAttribute('value', this.value);"
                        autofocus
                        autocomplete="given-name"
                        value
                        type="text"
                        id="firstName"
                        name="fistName"
                        class="form-control"
                        v-model="firstName"
                        required
                    >
                    <label for="firstName">
                        Jméno
                    </label>
                </div>
                <div class="form-group half">
                    <input
                        oninput="this.setAttribute('value', this.value);"
                        autocomplete="family-name"
                        value
                        type="text"
                        id="lastName"
                        name="lastName"
                        class="form-control"
                        v-model="lastName"
                        required
                    >
                    <label for="lastName">
                        Příjmení
                    </label>
                </div>
                <div class="form-group">
                    <input
                        oninput="this.setAttribute('value', this.value);"
                        autocomplete="tel"
                        value
                        type="tel"
                        id="phone"
                        name="phone"
                        class="form-control"
                        v-model="phone"
                        maxlength="9"
                        required
                    >
                    <label for="phone">
                        Telefonní číslo
                    </label>
                </div>
                <div class="form-group">
                    <input
                        oninput="this.setAttribute('value', this.value);"
                        autocomplete="email"
                        value
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
                        autocomplete="new-password"
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
                <button
                    class="btn btn-primary"
                    type="submit"
                    @click.prevent="signUp"
                >
                    registrovat
                </button>
                <div
                    v-for="error in respmessage"
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
            firstName: '',
            lastName: '',
            phone: '',
            email: '',
            password: '',
            respmessage: []
        };
    },
    methods: {
        signUp: function() {
            this.respmessage.push('Probíhá zpracování');
            axios.post('/api/user/sign-up',
                {
                    first_name: this.firstName,
                    last_name: this.lastName,
                    phone: this.phone,
                    email: this.email,
                    password: this.password
                },
                { headers: { 'X-Requested-With': 'XMLHttpRequest' } }
            ).then(response => this.$router.push('/verify'))
                .catch(error => {
                    const data = error.response.data.errors;
                    this.respmessage = [];
                    for (let key in data) {
                        if (data.hasOwnProperty(key)) {
                            this.respmessage.push(data[key][0]);
                        }
                    }
                });
        }
    }
};
</script>