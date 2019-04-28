<template>
    <div class="w-75 border">
        <div class="w-25 ml-3">
            <h1>Přidat fotografii</h1>
            <form>
                <div class="form-group">
                    <label for="seo_name">
                        Název
                    </label>
                    <input
                        type="text"
                        class="form-control"
                        id="seo_name"
                        v-model="selectedName"
                    >
                </div>
                <div class="form-group">
                    <label for="image">
                        Nahrát soubor
                    </label>
                    <input
                        type="file"
                        class="form-control form-control-file"
                        id="image"
                        @change="imageSelected"
                    >
                </div>
                <button
                    type="submit"
                    class="btn btn-primary"
                    @click.prevent="addPhoto"
                >
                    Submit
                </button>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            selectedName: '',
            selectedFile: null,
        };
    },
    methods: {
        imageSelected(event) {
            this.$emit('change', this.selectedFile = event.target.files[0]);
        },
        addPhoto() {
            const formData = new FormData();
            const token = localStorage.getItem('admin_token');
            formData.append('seo_name', this.selectedName);
            formData.append('image', this.selectedFile);
            axios.post('/api/photo/add?token=' + token, formData,
                {headers: {'X-Requested-With': 'XMLHttpRequest'}});
        }
    }
};
</script>