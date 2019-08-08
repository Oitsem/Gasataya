<template>
    <div>
        <div class="card">
            <div class="card-header">
                <router-link class="text-primary" :to="{ name: 'persons.index' }">Persons</router-link>
                /
                <a class="text-secondary">Create New Person</a>
            </div>
            <div class="card-body">
                <div v-if="ifReady">
                    <form v-on:submit.prevent="createNewPerson()">
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
                            <i class="fas fa-plus"></i>&nbsp;
                            <strong>Create New Person</strong>
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
                city: 'Bacolod City',
                province: 'Negros Occidental',
                birthdate: '',
                place_of_birth: '',
                civil_status: 1,
                citizenship: 'Filipino',
                number_of_siblings: '',
                sex: '',
                email: '',
                mobile_number: '',
                telephone_number: '',
                occupation: '',
                zip_code: '6100',
                district: 'Lone'
            };
        },

        mounted() {
            let promise = new Promise((resolve, reject) => {
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

            promise.then(() => {
                this.ifReady = true;
            });
        },

        methods: {
            selectBarangay() {
                this.barangay_id = this.barangay.id;
            },
            createNewPerson() {
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

                axios.post('/api/persons', this.$data).then(res => {
                    this.$router.push({ name: 'persons.index' });
                }).catch(err => {
                    this.ifReady = true;
                    console.log(err);
                });
            }
        }
    }
</script>
