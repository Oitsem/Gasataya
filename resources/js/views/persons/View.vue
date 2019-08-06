<template>
    <div>
        <div class="card">
            <div class="card-header">
                <router-link class="text-primary" :to="{ name: 'persons.index' }">Persons</router-link>
                /
                <span class="text-secondary">View Person</span>
            </div>
            <div class="card-body">
                <div v-if="ifReady">
                    <fieldset disabled>
                        <div class="row">
                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label for="name">First Name</label>
                                    <input type="text" class="form-control" v-model="person.first_name" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label for="name">Middle Name</label>
                                    <input type="text" class="form-control" v-model="person.middle_name" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label for="name">Last Name</label>
                                    <input type="text" class="form-control" v-model="person.last_name" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label for="name">Extension Name</label>
                                    <input type="text" class="form-control" v-model="person.extension_name" autocomplete="off" maxlength="255">
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Address</label>
                                    <textarea class="form-control" v-model="person.address" maxlength="1000"></textarea>
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Birthdate</label>
                                    <input type="date" class="form-control" v-model="person.birthdate" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Place of Birth</label>
                                    <input type="text" class="form-control" v-model="person.place_of_birth" autocomplete="off" required>
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label>Civil Status</label>
                                    <select class="form-control" v-model="person.civil_status">
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
                                    <input type="text" class="form-control" v-model="person.citizenship" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label>Number of Siblings</label>
                                    <input type="text" class="form-control" v-model="person.number_of_siblings" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <label>Sex</label>
                                <div class="row">
                                    <div class="col">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="sex-male" class="custom-control-input" v-model="person.sex" value="1">
                                            <label class="custom-control-label" for="sex-male">Male</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="sex-female" class="custom-control-input" v-model="person.sex" value="0">
                                            <label class="custom-control-label" for="sex-female">Female</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="email" class="form-control" v-model="person.email" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label>Mobile Number</label>
                                    <input type="text" class="form-control" v-model="person.mobile_number" autocomplete="off" maxlength="255">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label>Telephone Number</label>
                                    <input type="text" class="form-control" v-model="person.telephone_number" autocomplete="off" maxlength="255">
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label>Occupation</label>
                                    <input type="text" class="form-control" v-model="person.occupation" autocomplete="off" minlength="2" maxlength="255">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label>Zip Code</label>
                                    <input type="text" class="form-control" v-model="person.zip_code" autocomplete="off" maxlength="255">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label>District</label>
                                    <input type="text" class="form-control" v-model="person.district" autocomplete="off" maxlength="255">
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <br>

                    <router-link class="btn btn-outline-secondary btn-sm" :to="{ name: 'persons.index' }">
                        <i class="fas fa-chevron-left"></i>&nbsp;
                        <strong>Back</strong>
                    </router-link>
                    <router-link class="btn btn-primary btn-sm" :to="{ name: 'persons.edit' , params: { id: person.id }}">
                        <i class="fas fa-edit"></i>&nbsp;
                        <strong>Edit Person</strong>
                    </router-link>
                    <button type="button" class="btn btn-danger btn-sm" @click.prevent.default="openDeleteModal()">
                        <i class="fas fa-trash-alt"></i>&nbsp;
                        <strong>Delete Person</strong>
                    </button>
                </div>
                <div v-else>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deletePersonModal" tabindex="-1" role="dialog" aria-labelledby="deletePersonTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">You're about to delete this Person?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this Person?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" @click.prevent.default="deletePerson()">
                            <strong>Confirm Delete</strong>
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                            <strong>Close</strong>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="card" v-if="medicalAssistance">
            <div class="card-header">
                Medical Assistance History
            </div>
            <div class="card-body">
                <table class="table table-hover table-sm">
                    <caption>
                        <div class="row">
                            <div class="col-md-9">
                                List of Medical Assistance - Total Items
                            </div>
                        </div>
                    </caption>
                    <thead>
                        <tr>
                            <th scope="col">Amount</th>
                            <th scope="col">Issued Date</th>
                        </tr>
                    </thead>
                    <tbody v-if="medicalAssistance">
                        <tr v-for="medicalAssist in medicalAssistance">
                            <td>{{ medicalAssist.amount }}</td>
                            <td>{{ medicalAssist.created_at }}</td>
                        </tr>
                    </tbody>
                </table>
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
                medicalAssistance: null
            };
        },

        mounted() {
            let promise = new Promise((resolve, reject) => {
                axios.get('/api/persons/' + this.$route.params.id).then(res => {
                    this.person            = res.data.person;
                    this.medicalAssistance = res.data.person.medical_assistance;
                    
                    resolve();
                });
            });

            promise.then(() => {
                this.ifReady = true;
            });
        },

        methods: {
            openDeleteModal() {
                $('#deletePersonModal').modal('show');
            },
            deletePerson() {
                this.ifReady = false;
                $('#deletePersonModal').modal('hide');

                axios.delete('/api/persons/' + this.$route.params.id).then(res => {
                    this.$router.push({ name: 'persons.index' });
                }).catch(err => {
                    this.ifReady = true;
                    console.log(err);
                });
            }
        }
    }
</script>
