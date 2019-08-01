<template>
    <div>
        <div class="card">
            <div class="card-header">
                <router-link class="text-primary" :to="{ name: 'persons.index' }">Persons</router-link>
                /
                <span class="text-secondary">Edit Person</span>
            </div>
            <div class="card-body">
                <div v-if="ifReady">
                    <form v-on:submit.prevent="updatePerson()">
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

                            <div class="w-100"></div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Address</label>
                                    <textarea class="form-control" v-model="address" maxlength="1000"></textarea>
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col">
                                <div class="form-group">
                                    <label>Birthdate</label>
                                    <input type="date" class="form-control" v-model="birthdate" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col"></div>
                            <div class="col"></div>

                            <div class="w-100"></div>

                            <div class="col">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="email" class="form-control" v-model="email" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" class="form-control" v-model="phone_number" autocomplete="off" maxlength="255">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Telephone Number</label>
                                    <input type="text" class="form-control" v-model="telephone_number" autocomplete="off" maxlength="255">
                                </div>
                            </div>
                        </div>

                        <br>

                        <router-link class="btn btn-outline-secondary btn-sm" :to="{ name: 'persons.index' }">
                            <i class="fas fa-chevron-left"></i>&nbsp;
                            <strong>Back</strong>
                        </router-link>
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fas fa-edit"></i>&nbsp;
                            <strong>Update Person</strong>
                        </button>
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
                first_name: '',
                middle_name: '',
                last_name: '',
                address: '',
                birthdate: '',
                email: '',
                phone_number: '',
                telephone_number: ''
            };
        },

        mounted() {
            let promise = new Promise((resolve, reject) => {
                axios.get('/api/persons/' + this.$route.params.id).then(res => {
                    this.first_name       = res.data.person.first_name;
                    this.middle_name      = res.data.person.middle_name;
                    this.last_name        = res.data.person.last_name;
                    this.address          = res.data.person.address;
                    this.birthdate        = res.data.person.birthdate;
                    this.email            = res.data.person.email;
                    this.phone_number     = res.data.person.phone_number;
                    this.telephone_number = res.data.person.telephone_number;

                    resolve();
                });
            });

            promise.then(() => {
                this.ifReady = true;
            });
        },

        methods: {
            updatePerson() {
                this.ifReady = false;

                let formData = new FormData();

                formData.append('_method', 'PATCH');
                formData.append('first_name', this.first_name);
                formData.append('middle_name', this.middle_name);
                formData.append('last_name', this.last_name);
                formData.append('birthdate', this.birthdate);
                formData.append('email', this.email);
                formData.append('phone_number', this.phone_number);
                formData.append('telephone_number', this.telephone_number);

                axios.post('/api/persons/' + this.$route.params.id, formData).then(res => {
                    this.$router.push({
                        name: 'persons.view',
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
