<template>
    <div>
        <div class="gallery">
            <h2>galerie</h2>
            <div class="gallery-content">
                <div class="pic">
                    <photo
                        v-for="photo in photos"
                        v-bind="photo"
                        :key="photo.filename"
                    />
                </div>
            </div>
            <button
                    @click="loadMore"
                    :disabled="this.btnOff === true"
                    class="btn"
            >další</button>
        </div>
    </div>
</template>
<script>
import baguetteBox from 'baguettebox.js';
import axios from 'axios';
import Photo from './Photo';

export default {
    components: {
        photo: Photo,
    },
    data() {
        return {
            photos: [],
            btnOff: false
        };
    },
    methods: {
        read() {
            axios.get('/directus/_/items/gallery_rel?fields=file_id.filename,file_id.id&sort=-file_id&limit=2').then(({ data }) => {
                data.data.forEach(photo => this.photos.push(photo.file_id));
                this.$nextTick(function() {
                    this.initializeGallery();
                });
            });
        },
        initializeGallery() {
            baguetteBox.run('.gallery');
        },
        loadMore() {
            axios.get('/directus/_/items/gallery_rel?fields=file_id.filename,file_id.id&sort=-file_id&limit=2&filter[file_id][lt]=' + this.photos[this.photos.length - 1].id).then(({ data }) => {
                if (data.data.length < 2) {
                    this.btnOff = true;
                }
                data.data.forEach(photo => this.photos.push(photo.file_id));
                this.$nextTick(function() {
                    this.initializeGallery();
                });
            });
        }
    },
    created() {
        this.read();
    }
};
</script>