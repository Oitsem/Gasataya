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
                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label for="name">First Name</label>
                                    <input type="text" class="form-control" v-model="first_name" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label for="name">Middle Name</label>
                                    <input type="text" class="form-control" v-model="middle_name" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label for="name">Last Name</label>
                                    <input type="text" class="form-control" v-model="last_name" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label for="name">Extension Name</label>
                                    <input type="text" class="form-control" v-model="extension_name" autocomplete="off" maxlength="255">
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label>Barangay</label>
                                    <vue-select class="form-control" v-model="barangay" @input="selectBarangay()" label="name" :options="barangays"></vue-select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label for="name">Address</label>
                                    <input type="text" class="form-control" v-model="address" autocomplete="off" maxlength="255" placeholder="Blk 22 Lot 9 San Lucas Street. Villa Angela Subd.">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label for="name">City</label>
                                    <input type="text" class="form-control" v-model="city" autocomplete="off" maxlength="255">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label for="name">Province</label>
                                    <input type="text" class="form-control" v-model="province" autocomplete="off" maxlength="255">
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Birthdate</label>
                                    <input type="date" class="form-control" v-model="birthdate" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Place of Birth</label>
                                    <input type="text" class="form-control" v-model="place_of_birth" autocomplete="off" required>
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label>Civil Status</label>
                                    <select class="form-control" v-model="civil_status">
                                        <option value="1">Single</option>
                                        <option value="2">Married</option>
                                        <option value="3">Annulled</option>
                                        <option value="4">Widowed</option>
                                        <option value="5">Separated</option>
                                        <option value="6">Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label>Citizenship</label>
                                    <input type="text" class="form-control" v-model="citizenship" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label>Number of Siblings</label>
                                    <input type="text" class="form-control" v-model="number_of_siblings" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <label>Sex</label>
                                <div class="row">
                                    <div class="col">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="sex-male" class="custom-control-input" v-model="sex" value="1">
                                            <label class="custom-control-label" for="sex-male">Male</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="sex-female" class="custom-control-input" v-model="sex" value="0">
                                            <label class="custom-control-label" for="sex-female">Female</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="email" class="form-control" v-model="email" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label>Mobile Number</label>
                                    <input type="text" class="form-control" v-model="mobile_number" autocomplete="off" maxlength="255">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label>Telephone Number</label>
                                    <input type="text" class="form-control" v-model="telephone_number" autocomplete="off" maxlength="255">
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label>Occupation</label>
                                    <input type="text" class="form-control" v-model="occupation" autocomplete="off" minlength="2" maxlength="255">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label>Zip Code</label>
                                    <input type="text" class="form-control" v-model="zip_code" autocomplete="off" maxlength="255">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label>District</label>
                                    <input type="text" class="form-control" v-model="district" autocomplete="off" maxlength="255">
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
                barangays: [],
                barangay: '',
                first_name: '',
                middle_name: '',
                last_name: '',
                extension_name: '',
                barangay_id: '',
                address: '',
                city: '',
                province: '',
                birthdate: '',
                place_of_birth: '',
                civil_status: '',
                citizenship: '',
                number_of_siblings: '',
                sex: '',
                email: '',
                mobile_number: '',
                telephone_number: '',
                occupation: '',
                zip_code: '',
                district: ''
            };
        },

        mounted() {
            let promiseBarangays = new Promise((resolve, reject) => {
                axios.get('/api/persons/get-barangays').then(res => {
                    let total = res.data.barangays;

                    this.barangays = Object.keys(total).map((key) => {
                        return {id: Number(key), name: 'Barangay ' + total[key]}
                    });

                    resolve();
                }).catch(err => {
                    this.ifReady = true;
                    console.log(err);
                    reject();
                });
            });

            let promisePerson = new Promise((resolve, reject) => {
                axios.get('/api/persons/' + this.$route.params.id).then(res => {
                    this.first_name         = res.data.person.first_name;
                    this.middle_name        = res.data.person.middle_name;
                    this.last_name          = res.data.person.last_name;
                    this.extension_name     = res.data.person.extension_name;
                    this.barangay_id        = res.data.person.barangay_id;
                    this.address            = res.data.person.address;
                    this.city               = res.data.person.city;
                    this.province           = res.data.person.province;
                    this.birthdate          = res.data.person.birthdate;
                    this.place_of_birth     = res.data.person.place_of_birth;
                    this.civil_status       = res.data.person.civil_status;
                    this.citizenship        = res.data.person.citizenship;
                    this.number_of_siblings = res.data.person.number_of_siblings;
                    this.sex                = res.data.person.sex;
                    this.email              = res.data.person.email;
                    this.mobile_number      = res.data.person.mobile_number;
                    this.telephone_number   = res.data.person.telephone_number;
                    this.occupation         = res.data.person.occupation;
                    this.zip_code           = res.data.person.zip_code;
                    this.district           = res.data.person.district;

                    resolve();
                });
            });

            Promise.all([promiseBarangays, promisePerson]).then(() => {
                this.ifReady = true;

                let barangayId = this.barangay_id - 1;
                this.barangay = this.barangays[barangayId];
            });
        },

        methods: {
            selectBarangay() {
                this.barangay_id = this.barangay.id;
            },
            updatePerson() {
                this.ifReady = false;

                let data = {
                    first_name: this.first_name,
                    middle_name: this.middle_name,
                    last_name: this.last_name,
                    extension_name: this.extension_name,
                    barangay_id: this.barangay_id,
                    address: this.address,
                    city: this.city,
                    province: this.province,
                    birthdate: this.birthdate,
                    place_of_birth: this.place_of_birth,
                    civil_status: this.civil_status,
                    citizenship: this.citizenship,
                    number_of_siblings: this.number_of_siblings,
                    sex: this.sex,
                    email: this.email,
                    mobile_number: this.mobile_number,
                    telephone_number: this.telephone_number,
                    occupation: this.occupation,
                    zip_code: this.zip_code,
                    district: this.district
                };

                axios.patch('/api/persons/' + this.$route.params.id, data).then(res => {
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
