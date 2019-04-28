<template>
    <div class="all">
        <heading />
        <router-view />
        <footing />
    </div>
</template>
<script>
import Heading from './front-end/base-components/Heading';
import Footing from './front-end/base-components/Footing';

export default {
    components: {
        Heading,
        Footing,
    },
    mounted() {}
};
</script>

<style>
</style>