<template>
    <div>
        <section class="hero">
            <div class="objednat-se">
                <span class="objednat-se--text">
                    {{ this.data.welcome_text }}
                </span>
                <a
                    href="/reservation"
                    class="btn"
                >
                    <span>objednat se</span>
                </a>
            </div>
        </section>
        <div class="content">
            <section
                class="sekce"
                id="anchor-sluzby"
            >
                <div class="nadpis full">
                    <h2>služby</h2>
                </div>
                <div class="text">
                    <ul class="sluzby">
                        <li
                            v-for="service in this.data.services"
                            class="blok"
                            :key="service.id"
                        >
                            <h3>{{ service.service_name }}</h3>
                            <p>{{ service.service_text }}</p>
                        </li>
                    </ul>
                    <a
                        href="/reservation"
                        class="btn"
                    >
                        <span>objednat se</span>
                    </a>
                </div>
            </section>
            <section
                class="sekce konatktyonas"
                id="anchor-onas"
            >
                <div
                    v-for="info in this.data.info"
                    class="blok"
                    :key="info.id"
                >
                    <div class="nadpis">
                        <h2>{{ info.info_name }}</h2>
                    </div>
                    <div class="text">
                        <p>{{ info.info_text }}</p>
                    </div>
                </div>
            </section>
            <section
                class="sekce kontakty"
                id="anchor-kontakty"
            >
                <div class="nadpis full">
                    <h2>kontakt</h2>
                </div>
                <div class="text">
                    <div class="kontaktwrapper">
                        <div>
                            <h3>{{ this.data.address1_name }}</h3>
                            <ul class="kontaktyUl">
                                <li>
                                    <i class="fas fa-map-marked-alt" />
                                    <a
                                        href=""
                                    >
                                        {{ this.data.address1_palce_name }}
                                        <br>{{ this.data.address1_street }}
                                        <br>{{ this.data.address1_town }}
                                    </a>
                                </li>
                                <li>
                                    <i class="fas fa-envelope" />
                                    <a href="mailto:">
                                        {{ this.data.address1_email }}
                                    </a>
                                </li>
                                <li>
                                    <i class="fas fa-phone" />
                                    <a href="">
                                        {{ this.data.address1_tel }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h3>{{ this.data.address2_name }}</h3>
                            <ul class="kontaktyUl">
                                <li>
                                    <i class="fas fa-map-marked-alt" />
                                    <a
                                            href=""
                                    >
                                        {{ this.data.address2_palce_name }}
                                        <br>{{ this.data.address2_street }}
                                        <br>{{ this.data.address2_town }}
                                    </a>
                                </li>
                                <li>
                                    <i class="fas fa-envelope" />
                                    <a href="mailto:">
                                        {{ this.data.address2_email }}
                                    </a>
                                </li>
                                <li>
                                    <i class="fas fa-phone" />
                                    <a href="">
                                        {{ this.data.address2_tel }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>


<script>
import axios from 'axios';

export default {
    data() {
        return {
            data: '',
        };
    },
    methods: {
        getTexts() {
            axios.get('/directus/_/items/landing_page?fields=*.*').then(response => {
                this.data = response.data.data[0];
            });
        },
    },
    created() {
        this.getTexts();
    }
};
</script>