<template>
    <nav class="header">
        <a href="/">
            <h1>
                DEMO
                <span>APLIKACE</span>
            </h1>
        </a>
        <a
            class="trigger"
            @click="mobileMenu"
        >
            MENU
        </a>
        <ul
            class="ul"
            :class="{ active: showMobileMenu }"
        >
            <li>
                <a
                    @click="mobileMenuClose"
                    href="/#anchor-sluzby"
                >
                    služby
                </a>
            </li>
            <li>
                <a
                    @click="mobileMenuClose"
                    href="/#anchor-onas"
                >
                    o nás
                </a>
            </li>
            <li>
                <a
                    @click="mobileMenuClose"
                    href="/#anchor-kontakty"
                >
                    kontakt
                </a>
            </li>
            <li>
                <a
                    @click="mobileMenuClose"
                    href="/gallery"
                >
                    galerie
                </a>
            </li>
            <li>
                <a
                    v-if="user === null"
                    class="btn"
                    id="btn-in-header"
                    href="/registration"
                >
                    registrace
                </a>
                <button
                    v-if="user !== null"
                    @click="logOut"
                    class="btn"
                    id="btn-in-header"
                >
                    odhlásit se
                </button>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    name: 'Heading',
    data() {
        return {
            showMobileMenu: false,
            user: localStorage.getItem('user_token'),
        };
    },
    methods: {
        mobileMenu() {
            this.showMobileMenu = !this.showMobileMenu;
            document.querySelector('body').classList.toggle('hidden');
        },
        mobileMenuClose() {
            this.showMobileMenu = !this.showMobileMenu;
            document.querySelector('body').classList.remove('hidden');
        },
        logOut() {
            localStorage.removeItem('user_token');
            this.$router.go();
        }
    },
};
</script>

<style scoped>

</style>