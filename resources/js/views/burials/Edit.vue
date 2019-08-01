<template>
    <div>
        <div class="card">
            <div class="card-header">
                <router-link class="text-primary" :to="{ name: 'burials.index' }">Burials</router-link>
                /
                <span class="text-secondary">Edit Burial</span>
            </div>
            <div class="card-body">
                <div v-if="ifReady">
                    <form v-on:submit.prevent="updateBurial()">
                        <div class="row">
                            <div class=col-md-6>
                                <div class="form-group">
                                    <label for="name">Requesters Name</label>
                                    <input type="text" class="form-control" v-model="requesters_name" autocomplete="off" minlength="2" maxlength="255" required disabled>
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Name Of Deceased Person</label>
                                    <input type="text" class="form-control" v-model="name_of_deceased_person" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Relation To The Deceased Person</label>
                                    <input type="text" class="form-control" v-model="relation_to_the_deceased_person" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Place Of Wake</label>
                                    <input type="text" class="form-control" v-model="place_of_wake" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Place Of Burial</label>
                                    <input type="text" class="form-control" v-model="place_of_burial" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>

                            <div class="w-100"></div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Date and Time of Burial</label>
                                    <input type="datetime-local" class="form-control" v-model="date_and_time_of_burial" autocomplete="off" required>
                                </div>
                            </div>
                        </div>

                        <br>

                        <router-link class="btn btn-outline-secondary btn-sm" :to="{ name: 'burials.index' }"><i class="fas fa-chevron-left"></i>&nbsp; Back</router-link>
                        <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-edit"></i>&nbsp; Update Burial</button>
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
                ifReady: false,
                person: '',
                id: '',
                requesters_name: '',
                relation_to_the_deceased_person: '',
                name_of_deceased_person: '',
                place_of_burial: '',
                place_of_wake: '',
                date_and_time_of_burial: ''
            };
        },

        mounted() {
            let promise = new Promise((resolve, reject) => {
                axios.get('/api/burials/' + this.$route.params.id).then(res => {
                    this.requesters_name                 = res.data.burial.person.first_name + ' ' + res.data.burial.person.middle_name + ' ' + res.data.burial.person.last_name;
                    this.relation_to_the_deceased_person = res.data.burial.relation_to_the_deceased_person;
                    this.name_of_deceased_person         = res.data.burial.name_of_deceased_person;
                    this.place_of_burial                 = res.data.burial.place_of_burial;
                    this.place_of_wake                   = res.data.burial.place_of_wake;
                    this.date_and_time_of_burial         = moment(res.data.burial.date_and_time_of_burial).format('YYYY-MM-DDThh:mm');

                    resolve();
                }).catch(err => {
                    console.log(err);
                    reject();
                });
            });

            promise.then(() => {
                this.ifReady = true;
            });
        },

        methods: {
            updateBurial() {
                this.ifReady = false;

                axios.patch('/api/burials/' + this.$route.params.id, this.$data).then(res => {
                    this.$router.push({
                        name: 'burials.view',
                        params: { id: this.$route.params.id }
                    });
                }).catch(err => {
                    this.ifReady = true;
                    console.log(err);
                });
            }
        }
    }
</script>
