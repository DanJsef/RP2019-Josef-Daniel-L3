<template>
    <div class="w-75 border">
        <table class="mt-5 table table-striped table-dark table-bordered">
            <thead>
                <tr>
                    <th scope="col">
                        Název
                    </th>
                    <th scope="col">
                        Odstranit
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="photo in photosDetails"
                    :key="photo.id"
                >
                    <td>{{ photo.seo_name }}</td>
                    <td>
                        <button
                            class="btn btn-danger"
                            @click="deletePhoto(photo.id)"
                        >
                            Odstranit
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            photosDetails: [],
        };
    },
    methods: {
        getPhotos() {
            axios.get('/api/photo/index').then(({data}) => {
                data.forEach(photo => {
                    this.photosDetails.push((photo));
                });
            });
        },
        deletePhoto(id) {
            const token = localStorage.getItem('admin_token');
            axios.post('/api/photo/delete?token=' + token, {id: id},
                {headers: {'X-Requested-With': 'XMLHttpRequest'}}).then((response) => {
                this.photosDetails = [];
                this.getPhotos();
            });
        }
    },
    mounted() {
        this.getPhotos();
    }
};
</script>

<style scoped>

</style>