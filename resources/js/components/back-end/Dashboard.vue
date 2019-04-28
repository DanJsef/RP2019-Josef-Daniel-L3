<template>
    <div class="d-flex">
        <div class="w-25 border">
            <div class="btn-group-vertical w-100">
                <button
                    class="btn btn-primary"
                    @click="componentToShow = 'change-texts'"
                >
                    Upravit texty
                </button>
                <button
                    class="btn btn-primary"
                    @click="componentToShow = 'show-reservations'"
                >
                    Rezervace
                </button>
                <button
                    class="btn btn-primary"
                    @click="componentToShow = 'add-photo'"
                >
                    Přidat fotografii
                </button>
                <button
                    class="btn btn-primary"
                    @click="componentToShow = 'delete-photo'"
                >
                    Odstranit fotografii
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
import Texts from './dashboard/Texts';
import Reservations from './dashboard/Reservations';
import AddPhoto from './dashboard/AddPhoto';
import DeletePhoto from './dashboard/DeletePhoto';

export default {
    components: {
        'change-texts': Texts,
        'show-reservations': Reservations,
        'add-photo': AddPhoto,
        'delete-photo': DeletePhoto,
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
