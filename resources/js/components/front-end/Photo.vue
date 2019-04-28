<template>
    <a
        :href="'storage/images/'+file_name"
        :data-at-450="'images/public/images/l_'+file_name"
        :data-at-800="'images/public/images/m_'+file_name"
        :data-at-1366="'images/public/images/m_'+file_name"
        :data-at-1920="'images/public/images/'+file_name"
        :data-caption="seo_name"
        class="selector"
    >
        <img
            :src="'images/public/images/p_'+file_name"
            :alt="seo_name"
        >
    </a>
</template>

<script>
export default {
    props: ['seo_name', 'file_name']
};
</script>
