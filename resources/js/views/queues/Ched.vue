<template>
    <div>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Queuing CHED
                    </div>
                    <div class="card-body">
                        <form v-on:submit.prevent="addToQueue()">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Name</label>
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

                            <fieldset disabled>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="name">First Name</label>
                                            <input type="text" class="form-control" v-model="first_name" autocomplete="off" minlength="2" maxlength="255" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="name">Middle Name</label>
                                            <input type="text" class="form-control" v-model="middle_name" autocomplete="off" minlength="2" maxlength="255" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="name">Last Name</label>
                                            <input type="text" class="form-control" v-model="last_name" autocomplete="off" minlength="2" maxlength="255" required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="row">
                                <div class="col">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="queue-ched" class="custom-control-input" v-model="queueType" value="CHED">
                                        <label class="custom-control-label" for="queue-ched">CHED</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="queue-medical" class="custom-control-input" v-model="queueType" value="Medical">
                                        <label class="custom-control-label" for="queue-medical">Medical</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="queue-solicitation" class="custom-control-input" v-model="queueType" value="Solicitation">
                                        <label class="custom-control-label" for="queue-solicitation">Solicitation</label>
                                    </div>
                                </div>
                            </div>

                            <br>

                            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-plus"></i>&nbsp; Add to Queue</button>
                        </form>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                Current Person Details
                            </div>
                            <div class="card-body">
                                <fieldset disabled>
                                    <div class="form-group">
                                        <label for="name">First Name</label>
                                        <input type="text" class="form-control" v-model="first_name" autocomplete="off" minlength="2" maxlength="255" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Middle Name</label>
                                        <input type="text" class="form-control" v-model="middle_name" autocomplete="off" minlength="2" maxlength="255" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Last Name</label>
                                        <input type="text" class="form-control" v-model="last_name" autocomplete="off" minlength="2" maxlength="255" required>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                Next Person Details
                            </div>
                            <div class="card-body">
                                <fieldset disabled>
                                    <div class="form-group">
                                        <label for="name">First Name</label>
                                        <input type="text" class="form-control" v-model="first_name" autocomplete="off" minlength="2" maxlength="255" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Middle Name</label>
                                        <input type="text" class="form-control" v-model="middle_name" autocomplete="off" minlength="2" maxlength="255" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Last Name</label>
                                        <input type="text" class="form-control" v-model="last_name" autocomplete="off" minlength="2" maxlength="255" required>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-danger btn-lg text-white" style="width: 100% !important"><i class="fas fa-arrow-left"></i>&nbsp; Prev Queue</button>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-info btn-lg text-white" style="width: 100% !important"><i class="fas fa-arrow-right"></i>&nbsp; Next Queue</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Queuing List
                    </div>
                    <div class="card-body" style="max-height: 600; overflow-y: scroll;">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Gether Kestrel Medel
                                <span class="badge badge-info text-white badge-pill">12</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Irah Sichon
                                <span class="badge badge-info text-white badge-pill">13</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Eazylle Concepcion
                                <span class="badge badge-info text-white badge-pill">14</span>
                            </li>
                        </ul>
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
                ifReady: false,
                persons: [],
                person_id: null,
                person: null,
                first_name: '',
                middle_name: '',
                last_name: '',
                queueType: ''
            }
        },

        mounted() {
            let promise = new Promise((resolve, reject) => {
                let data = {
                    type: 1
                };

                axios.get('/api/queues', { params: data }).then((res) => {
                    console.log(res.data);
                }).catch((err) => {
                    console.log(err);
                });
            });

            promise.then(() => {
                this.ifReady = true;
            });
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
            }, 350),
            selectPerson() {
                this.first_name  = this.person.first_name;
                this.middle_name = this.person.middle_name;
                this.last_name   = this.person.last_name;
            },
            addToQueue() {
                let data = {
                    person_id: this.person_id,
                    number: this.number
                };

                axios.post('/api/queues/', data).then((res) => {
                    console.log(res.data);
                }).catch((err) => {
                    console.log(err);
                });
            }
        }
    }
</script>

<style>
.d-center {
    display: flex;
    align-items: center;
}

.selected img {
    width: auto;
    max-height: 23px;
    margin-right: 0.5rem;
}

.v-select .dropdown li {
    border-bottom: 1px solid rgba(112, 128, 144, 0.1);
}

.v-select .dropdown li:last-child {
    border-bottom: none;
}

.v-select .dropdown li a {
    padding: 10px 20px;
    width: 100%;
    font-size: 1.25em;
    color: #3c3c3c;
}

.v-select .dropdown-menu .active > a {
    color: #fff;
}

.list-group-item {
    font-size: 16px;
}

.badge-pill {
    padding: 0.6em;
    font-size: 16px;
    border-radius: 10rem;
}
</style>
