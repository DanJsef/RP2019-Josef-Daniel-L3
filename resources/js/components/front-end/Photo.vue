<template>
    <a
        :href="'directus/uploads/_/originals/'+filename"
        :data-caption="filename"
        class="selector"
    >
        <img
            :src="'http://rp.dv/directus/thumbnail/_/400/400/crop/good/'+filename"
            :alt="filename"
        >
    </a>
</template>

<script>
export default {
    props: ['filename']
};
</script>
