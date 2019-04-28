<template>
    <div class="color">
        <div class="booking">
            <transition name="fff">
                <div
                    class="booking-component"
                    v-show="this.place == ''"
                >
                    <h2>Místo</h2>
                    <button
                        class="btn btn-info"
                        @click="choosePlace('Liberec')"
                    >
                        Liberec
                    </button>
                    <button
                        class="btn btn-info"
                        @click="choosePlace('Krásná Lípa')"
                    >
                        Krásná Lípa
                    </button>
                </div>
            </transition>
            <transition name="fff">
                <div
                    class="booking-component"
                    v-show="this.date == '' && this.place != ''"
                >
                    <span
                        class="backarrow"
                        @click="removeHandler(removePlace, removeDate)"
                    />
                    <h2>Datum</h2>
                    <date-pick
                        v-model="date"
                        :has-input-element="false"
                        :is-date-disabled="isWeekend"
                        :next-month-caption="'Další měsíc'"
                        :weekdays="weekdays"
                        :months="months"
                    />
                </div>
            </transition>
            <transition name="fff">
                <div
                    class="booking-component booking-component--time"
                    v-show="this.hour == '' && this.date != ''"
                >
                    <span
                        class="backarrow"
                        @click="removeHandler(removeDate, removeHour)"
                    />
                    <h2>Čas</h2>
                    <button
                        :disabled="response.h_7 != 1"
                        class="btn btn-info"
                        @click="chooseHour('7')"
                    >
                        7:00
                    </button>
                    <button
                        :disabled="response.h_8 != 1"
                        class="btn btn-info"
                        @click="chooseHour('8')"
                    >
                        8:00
                    </button>
                    <button
                        :disabled="response.h_9 != 1"
                        class="btn btn-info"
                        @click="chooseHour('9')"
                    >
                        9:00
                    </button>
                    <button
                        :disabled="response.h_10 != 1"
                        class="btn btn-info"
                        @click="chooseHour('10')"
                    >
                        10:00
                    </button>
                    <button
                        :disabled="response.h_11 != 1"
                        class="btn btn-info"
                        @click="chooseHour('11')"
                    >
                        11:00
                    </button>
                    <button
                        :disabled="response.h_12 != 1"
                        class="btn btn-info"
                        @click="chooseHour('12')"
                    >
                        12:00
                    </button>
                    <button
                        :disabled="response.h_13 != 1"
                        class="btn btn-info"
                        @click="chooseHour('13')"
                    >
                        13:00
                    </button>
                    <button
                        :disabled="response.h_14 != 1"
                        class="btn btn-info"
                        @click="chooseHour('14')"
                    >
                        14:00
                    </button>
                    <button
                        :disabled="response.h_15 != 1 || new Date(this.date.split('-')).getDay() === 5"
                        class="btn btn-info"
                        @click="chooseHour('15')"
                    >
                        15:00
                    </button>
                </div>
            </transition>
            <transition name="fff">
                <div
                    class="booking-component"
                    v-show="this.type == '' && this.hour != ''"
                >
                    <span
                        class="backarrow"
                        @click="removeHandler(removeHour, removeType)"
                    />
                    <h2>Typ</h2>
                    <button
                        class="btn btn-info"
                        @click="chooseType('Analog')"
                    >
                        Analog
                    </button>
                    <button
                        class="btn btn-info"
                        @click="chooseType('Digitál')"
                    >
                        Digitál
                    </button>
                </div>
            </transition>
            <transition name="fff">
                <div
                    class="booking-component booking-component--revize"
                    v-show="this.type != ''"
                >
                    <span
                        class="backarrow"
                        @click="removeHandler(removeType)"
                    />
                    <h2>Revize</h2>
                    <span class="revize-span">
                        Místo: {{ this.place }}
                    </span>
                    <span class="revize-span">
                        Datum: {{ this.date }}
                        (Rok, měsíc, den)
                    </span>
                    <span class="revize-span">
                        Čas: {{ this.hour }}:00
                    </span>
                    <span class="revize-span">
                        Typ: {{ this.type }}
                    </span>
                    <button
                        class="btn btn-info"
                        @click="reserve"
                    >
                        Rezervovat
                    </button>
                    <span class="error">
                        {{ respmessage }}
                    </span>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import DatePick from 'vue-date-pick';
import 'vue-date-pick/dist/vueDatePick.css';

export default {
    components: {
        DatePick,
    },
    data: () => ({
        place: '',
        date: '',
        hour: '',
        type: '',
        name: '',
        phone: '',
        email: '',
        weekdays: ['Po', 'Út', 'St', 'Čt', 'Pá', 'So', 'Ne'],
        months: [
            'Leden',
            'Únor',
            'Březen',
            'Duben',
            'Květen',
            'Červen',
            'Červenec',
            'Srpen',
            'Září',
            'Říjen',
            'Listopad',
            'Prosinec'
        ],
        response: '',
        respmessage: ''
    }),
    methods: {
        isWeekend(date) {
            let currentDate = new Date();
            return date.getDay() === 0 || date.getDay() === 6 || date < currentDate;
        },
        choosePlace(place) {
            this.place = place;
        },
        chooseHour(hour) {
            this.hour = hour;
        },
        chooseType(type) {
            this.type = type;
            this.respmessage = '';
        },
        removePlace() {
            this.place = '';
        },
        removeDate() {
            this.date = '';
        },
        removeType() {
            this.type = '';
        },
        removeHour() {
            this.hour = '';
        },
        removeHandler(param1, param2) {
            param1();
            param2();
        },
        indexReservedHours() {
            const token = localStorage.getItem('user_token');
            if (this.place === 'Krásná Lípa') {
                axios.post('/api/booking/index/krasna-lipa?token=' + token,
                    { date: this.date, place: this.place },
                    { headers: { 'X-Requested-With': 'XMLHttpRequest' } }
                ).then(response => {
                    this.response = response.data;
                });
            } else if (this.place === 'Liberec') {
                axios.post('/api/booking/index/liberec?token=' + token,
                    { date: this.date, place: this.place },
                    { headers: { 'X-Requested-With': 'XMLHttpRequest' } }
                ).then(response => {
                    this.response = response.data;
                });
            }
        },
        getUserData() {
            const token = localStorage.getItem('user_token');
            axios
                .post('/api/user/data?token=' + token, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(response => {
                    this.name = response.data.user.first_name + ' ' + response.data.user.last_name;
                    this.phone = response.data.user.phone;
                    this.email = response.data.user.email;
                });
        },
        reserve() {
            const token = localStorage.getItem('user_token');
            axios.post(
                '/api/booking/reserve?token=' + token,
                {
                    date: this.date,
                    place: this.place,
                    hour: this.hour,
                    type: this.type,
                    name: this.name,
                    phone: this.phone,
                    email: this.email
                },
                { headers: { 'X-Requested-With': 'XMLHttpRequest' } }
            ).then(response => {
                this.respmessage = response.data.message;
            });
        }
    },
    watch: {
        date() {
            this.indexReservedHours();
        }
    },
    mounted() {
        this.getUserData();
    }
};
</script>

<style>
.fff-leave-active {
  transition: none;
}
.fff-enter-active {
  transition: opacity 0.8s;
}
.fff-enter, .fff-leave-to /* .fade-leave-active in <2.1.8 */ {
  opacity: 0;
}
</style>
