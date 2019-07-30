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
                        <div class="form-group">
                            <label for="name">Encoded By</label>
                            <input type="text" class="form-control" v-model="person.user.name" autocomplete="off">
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">First Name</label>
                                    <input type="text" class="form-control" v-model="person.first_name" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Middle Name</label>
                                    <input type="text" class="form-control" v-model="person.middle_name" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Last Name</label>
                                    <input type="text" class="form-control" v-model="person.last_name" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col">
                                <div class="form-group">
                                    <label>Birthdate</label>
                                    <input type="date" class="form-control" v-model="person.birthdate" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col"></div>
                            <div class="col"></div>

                            <div class="w-100"></div>

                            <div class="col">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="email" class="form-control" v-model="person.email" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" class="form-control" v-model="person.phone_number" autocomplete="off" maxlength="255">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Telephone Number</label>
                                    <input type="text" class="form-control" v-model="person.telephone_number" autocomplete="off" maxlength="255">
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <br>

                    <router-link class="btn btn-outline-secondary btn-sm" :to="{ name: 'persons.index' }"><i class="fas fa-chevron-left"></i>&nbsp; Back</router-link>
                    <router-link class="btn btn-primary btn-sm" :to="{ name: 'persons.edit' , params: { id: person.id }}"><i class="fas fa-edit"></i>&nbsp; Edit Person</router-link>
                    <button type="button" class="btn btn-danger btn-sm" @click.prevent.default="openDeleteModal()"><i class="fas fa-trash-alt"></i>&nbsp; Delete Person</button>
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
                        <button type="button" class="btn btn-danger btn-sm" @click.prevent.default="deletePerson()">Confirm Delete</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
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
                person: ''
            };
        },

        mounted() {
            let promise = new Promise((resolve, reject) => {
                axios.get('/api/persons/' + this.$route.params.id).then(res => {
                    this.person = res.data.person;
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
