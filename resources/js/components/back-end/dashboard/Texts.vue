<template>
    <div class="w-75 border">
        <div>
            <form
                v-for="text in texts"
                :key="text.id"
            >
                <label>{{ text.name }}</label>
                <div class="form-group">
                    <label>Text</label>
                    <textarea
                        rows="6"
                        class="w-100"
                        :id="'long' + text.id"
                    >{{ text.long_text }}
                    </textarea>
                </div>
                <button
                    type="submit"
                    class="btn btn-primary"
                    @click.prevent="editText(text.id)"
                >
                    Upravit
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
            texts: [],
        };
    },
    methods: {
        getTexts() {
            axios.get('/api/text/index').then(({data}) => {
                data.forEach(text => {
                    this.texts.push((text));
                });
            });
        },
        editText(id) {
            let tId = id;
            let tLong = document.getElementById('long'+id).value;
            const token = localStorage.getItem('admin_token');
            axios.post('/api/text/update?token=' + token, {id: tId, short_text: 'X', long_text: tLong},
                {headers: {'X-Requested-With': 'XMLHttpRequest'}}).then((response) => {
                this.$router.go();
            });
        }
    },
    mounted() {
        this.getTexts();
    }
};
</script>