<template>
    <div>
        <div class="card">
            <div class="card-header">
                <router-link class="text-primary" :to="{ name: 'burial.index' }">Burial</router-link>
                /
                <a class="text-secondary">Create New Burial</a>
            </div>
            <div class="card-body">
                <div v-if="ifReady">
                    <form v-on:submit.prevent="createNewBurial()">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Person</label>
                                    <vue-select label="name" :filterable="false" v-model="person" @input="selectPerson()" :options="persons" @search="onSearch">
                                        <template slot="no-options">
                                            Search Persons
                                        </template>
                                        <template slot="option" slot-scope="person">
                                            <div class="d-center">
                                                {{ person.first_name }} {{ person.last_name }}
                                            </div>
                                        </template>
                                        <template slot="selected-option" slot-scope="person">
                                            <div class="selected d-center">
                                                {{ person.first_name }} {{ person.last_name }}
                                            </div>
                                        </template>
                                    </vue-select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Requesters Name</label>
                                    <input type="text" class="form-control" v-model="requesters_name" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Relation To The Deceased Person</label>
                                    <input type="text" class="form-control" v-model="relation_to_the_deceased_person" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Name Of Deceased Person</label>
                                    <input type="text" class="form-control" v-model="name_of_deceased_person" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Place Of Wake</label>
                                    <input type="text" class="form-control" v-model="place_of_wake" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Date and Time of Burial</label>
                                    <input type="text" class="form-control" v-model="date_of_burial" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Place Of Burial</label>
                                    <input type="text" class="form-control" v-model="place_of_burial" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <br>

                        <router-link class="btn btn-outline-secondary btn-sm" :to="{ name: 'burial.index' }"><i class="fas fa-chevron-left"></i>&nbsp; Back</router-link>
                        <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-plus"></i>&nbsp; Create New Burial</button>
                    </form>
                </div>

                <div v-else>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                ifReady: true,
                persons: [],
                person: null,
                person_id: null,
                requesters_name: '',
                relation_to_the_deceased_person: '',
                address: '',
                contact_number: '',
                name_of_deceased_person: '',
                place_of_wake: '',
                date_of_burial: '',
                time_of_burial: '',
                place_of_burial: ''
            };
        },

        methods: {
            onSearch(search, loading) {
                loading(true);
                this.search(loading, search, this);
            },
            search: _.debounce((loading, search, vm) => {
                axios.get(`/api/persons/search?search=${escape(search)}`).then((res) => {
                    vm.persons = res.data;
                    loading(false);
                });
            }, 250),
            selectPerson() {
                this.person_id   = this.person.id;
                this.first_name  = this.person.first_name;
                this.middle_name = this.person.middle_name;
                this.last_name   = this.person.last_name;
                this.address     = this.person.address;
            },
            createNewBurial() {
                this.ifReady = false;

                axios.post('/api/burial', this.$data).then(res => {
                    this.$router.push({ name: 'burials.index' });
                }).catch(err => {
                    this.ifReady = true;
                    console.log(err);
                });
            }
        }
    }
</script>
