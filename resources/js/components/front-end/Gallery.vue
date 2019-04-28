<template>
    <div>
        <div class="gallery">
            <h2>galerie</h2>
            <div class="gallery-content">
                <div class="pic">
                    <photo
                        v-for="photo in photos"
                        v-bind="photo"
                        :key="photo.id"
                    />
                </div>
            </div>
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
            photos: []
        };
    },
    methods: {
        read() {
            axios.get('/api/photo/index').then(({ data }) => {
                let x = this.photos.length;
                let reversed = data.reverse();
                let y = reversed.length;
                for (x; x < y; x++) {
                    this.photos.push(reversed[x]);
                }
                this.$nextTick(function() {
                    this.initializeGallery();
                });
            });
        },
        initializeGallery() {
            baguetteBox.run('.gallery');
        }
    },
    created() {
        this.read();
    }
};
</script>