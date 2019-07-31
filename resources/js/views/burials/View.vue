<template>
    <div>
        <div class="card">
            <div class="card-header">
                <router-link class="text-primary" :to="{ name: 'burials.index' }">Burials</router-link>
                /
                <span class="text-secondary">View Burials</span>
            </div>
            <div class="card-body">
                <div v-if="ifReady">
                    <fieldset disabled>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Requesters Name</label>
                                    <input type="text" class="form-control" v-model="burial.requesters_name">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Relation To The Deceased Person</label>
                                    <input type="text" class="form-control" v-model="burial.relation_to_the_deceased_person">
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Name Of Deceased Person</label>
                                    <input type="text" class="form-control" v-model="burial.name_of_deceased_person">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Place Of Wake</label>
                                    <input type="text" class="form-control" v-model="burial.place_of_wake">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Date Of Burial</label>
                                    <input type="text" class="form-control" v-model="burial.date_of_burial">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Time Of Burial</label>
                                    <input type="text" class="form-control" v-model="burial.time_of_burial">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Place Of Burial</label>
                                    <input type="text" class="form-control" v-model="burial.place_of_burial">
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <br>

                    <router-link class="btn btn-outline-secondary btn-sm" :to="{ name: 'burial.index' }"><i class="fas fa-chevron-left"></i>&nbsp; Back</router-link>
                    <router-link class="btn btn-primary btn-sm" :to="{ name: 'burial.edit' , params: { id: burial.id }}"><i class="fas fa-edit"></i>&nbsp; Edit Burial</router-link>
                    <button type="button" class="btn btn-danger btn-sm" @click.prevent.default="openDeleteModal()"><i class="fas fa-trash-alt"></i>&nbsp; Delete Burial</button>
                </div>
                <div v-else>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">You're about to delete this Burial?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this Burial?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" @click.prevent.default="deleteBurial()">Confirm Delete</button>
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
                burial: ''
            };
        },

        mounted() {
            let promise = new Promise((resolve, reject) => {
                axios.get('/api/burials/' + this.$route.params.id).then(res => {
                    this.burial = res.data.burial;
                    this.burial.requesters_name = res.data.burial.person.first_name + ' ' + res.data.burial.person.middle_name + ' ' + res.data.burial.person.last_name;
                    resolve();
                });
            });

            promise.then(() => {
                this.ifReady = true;
            });
        },

        methods: {
            openDeleteModal() {
                $('#deleteModal').modal('show');
            },
            deleteBurial() {
                this.ifReady = false;

                $('#deleteModal').modal('hide');

                axios.delete('/api/burials/' + this.$route.params.id).then(res => {
                    this.$router.push({ name: 'burials.index' });
                }).catch(err => {
                    this.ifReady = true;
                    console.log(err);
                });
            }
        }
    }
</script>
