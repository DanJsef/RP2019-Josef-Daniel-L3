<template>
    <div class="d-flex">
        <div class="w-25 border">
            <div class="btn-group-vertical w-100">
                <button
                    class="btn btn-primary"
                    @click="logOut"
                >
                    Odhlásit se
                </button>
            </div>
        </div>
        <reservations></reservations>
    </div>
</template>

<script>
import Reservations from './dashboard/Reservations';

export default {
    components: {
        'reservations': Reservations,
    },
    data() {
        return {
            user: '',
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
