<template>
    <div class="d-flex">
        <div class="w-25 border">
            <div class="btn-group-vertical w-100">
                <button
                    class="btn btn-primary"
                    @click="componentToShow = 'show-reservations'"
                >
                    Rezervace
                </button>
                <button
                    class="btn btn-primary"
                    @click="logOut"
                >
                    Odhlásit se
                </button>
            </div>
        </div>
        <component :is="componentToShow" />
    </div>
</template>

<script>
import Reservations from './dashboard/Reservations';

export default {
    components: {
        'show-reservations': Reservations,
    },
    data() {
        return {
            user: '',
            componentToShow: '',
        };
    },
    methods: {
        logOut() {
            localStorage.removeItem('admin_token');
            this.$router.go();
        }
    }

};
</script>

<style>
    @import "~bootstrap/dist/css/bootstrap.css";
</style>
