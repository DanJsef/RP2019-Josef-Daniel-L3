<template>
    <div>
        <section class="hero">
            <div class="objednat-se">
                <span class="objednat-se--text">
                    Vzorový text na tomto místě
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
                            v-for="text in this.texts.slice(0, 7)"
                            class="blok"
                            :key="text.id"
                        >
                            <h3>{{ text.name }}</h3>
                            <p>{{ text.long_text }}</p>
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
                    v-for="text in this.texts.slice(7)"
                    class="blok"
                    :key="text.id"
                >
                    <div class="nadpis">
                        <h2>{{ text.name }}</h2>
                    </div>
                    <div class="text">
                        <p>{{ text.long_text }}</p>
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
                            <h3>Místo 1</h3>
                            <ul class="kontaktyUl">
                                <li>
                                    <i class="fas fa-map-marked-alt" />
                                    <a
                                        href=""
                                    >
                                        Název místa 1
                                        <br>Město 1
                                        <br>Adresa 1
                                    </a>
                                </li>
                                <li>
                                    <i class="fas fa-envelope" />
                                    <a href="mailto:">
                                        E-mail 1
                                    </a>
                                </li>
                                <li>
                                    <i class="fas fa-phone" />
                                    <a href="">
                                        Tel. čislo 1
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h3>Místo 2</h3>
                            <ul class="kontaktyUl">
                                <li>
                                    <i class="fas fa-map-marked-alt" />
                                    <a
                                        href="http://maps.google.com/?q=1200 TKV-Technická kontrola Vratislavice, Tanvaldská 1106, Liberec 30, 463 11"
                                    >
                                        Název místa 2
                                        <br>Město 2
                                        <br>Adresa 2
                                    </a>
                                </li>
                                <li>
                                    <i class="fas fa-envelope" />
                                    <a href="">
                                        E-mail 2
                                    </a>
                                </li>
                                <li>
                                    <i class="fas fa-phone" />
                                    <a href="">
                                        Tel. číslo 2
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
    },
    mounted() {
        this.getTexts();
    }
};
</script>