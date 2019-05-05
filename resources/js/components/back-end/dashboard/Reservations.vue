<template>
    <div class="w-75">
        <div>
            <date-pick
                v-model="date"
                :has-input-element="false"
                :next-month-caption="'Další měsíc'"
                :weekdays="weekdays"
                :months="months"
            />
        </div>
        <div class="bootstrap-iso">
            <div class="w-100">
                <h2 class="w-100 text-center">Liberec</h2>
                <table class="table table-striped table-dark table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">
                            Hodina
                        </th>
                        <th scope="col">
                            Jméno
                        </th>
                        <th scope="col">
                            Tel. číslo
                        </th>
                        <th scope="col">
                            E-mail
                        </th>
                        <th scope="col">
                            Typ
                        </th>
                        <th scope="col">
                            Odstranit
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr
                            v-for="reserve in reservesLiberec"
                            :key="reserve.id"
                    >
                        <td scope="col">
                            {{ reserve.hour }}:00
                        </td>
                        <td scope="col">
                            {{ reserve.name }}
                        </td>
                        <td scope="col">
                            {{ reserve.phone }}
                        </td>
                        <td scope="col">
                            {{ reserve.email }}
                        </td>
                        <td scope="col">
                            {{ reserve.type }}
                        </td>
                        <td scope="col">
                            <button
                                    class="btn btn-danger"
                                    @click="removeReserved(reserve.id, reserve.place, reserve.date, reserve.hour)"
                            >
                                X
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="w-100">
                <h2 class="w-100 text-center">Krásná Lípa</h2>
                <table class="table table-striped table-dark table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">
                            Hodina
                        </th>
                        <th scope="col">
                            Jméno
                        </th>
                        <th scope="col">
                            Tel. číslo
                        </th>
                        <th scope="col">
                            E-mail
                        </th>
                        <th scope="col">
                            Typ
                        </th>
                        <th scope="col">
                            Odstranit
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr
                            v-for="reserve in reservesKrasnaLipa"
                            :key="reserve.id"
                    >
                        <td scope="col">
                            {{ reserve.hour }}:00
                        </td>
                        <td scope="col">
                            {{ reserve.name }}
                        </td>
                        <td scope="col">
                            {{ reserve.phone }}
                        </td>
                        <td scope="col">
                            {{ reserve.email }}
                        </td>
                        <td scope="col">
                            {{ reserve.type }}
                        </td>
                        <td scope="col">
                            <button
                                    class="btn btn-danger"
                                    @click="removeReserved(reserve.id, reserve.place, reserve.date, reserve.hour)"
                            >
                                X
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import DatePick from 'vue-date-pick';

export default {
    components: {DatePick},
    data: () => ({
        date: '',
        reservesLiberec: [],
        reservesKrasnaLipa: [],
        weekdays: ['Po', 'Út', 'St', 'Čt', 'Pá', 'So', 'Ne'],
        months: ['Leden', 'Únor', 'Březen', 'Duben',
            'Květen', 'Červen', 'Červenec', 'Srpen',
            'Září', 'Říjen', 'Listopad', 'Prosinec']
        ,
        response: '',
    }),
    methods: {
        getReserves() {
            this.reservesLiberec = [];
            this.reservesKrasnaLipa = [];
            const token = localStorage.getItem('admin_token');

            axios.post('/api/booking/reserved?token=' + token, {date: this.date},
                {headers: {'X-Requested-With': 'XMLHttpRequest'}}).then((response) => {
                let data = response.data;
                for (var i = 0; i < data.length; i++) {
                    if (data[i].place === 'Liberec') {
                        this.reservesLiberec.push(data[i]);
                    } else if (data[i].place === 'Krásná Lípa') {
                        this.reservesKrasnaLipa.push(data[i]);
                    }
                }

                this.reservesLiberec.sort(function(a, b) {
                    return Number(a.hour) - Number(b.hour);
                });
                this.reservesKrasnaLipa.sort(function(a, b) {
                    return Number(a.hour) - Number(b.hour);
                });

            });
        },
        removeReserved(id, place, date, hour) {
            const token = localStorage.getItem('admin_token');
            axios.post('/api/booking/remove?token=' + token, {id: id, place: place, date: date, hour: hour},
                {headers: {'X-Requested-With': 'XMLHttpRequest'}}).then((response) => {
                this.reservesLiberec = [];
                this.reservesKrasnaLipa = [];
                this.getReserves();
            });
        }
    },
    watch: {
        date() {
            this.getReserves();
        },
    }
};
</script>
