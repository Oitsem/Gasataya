<template>
    <div>
        <div class="card">
            <div class="card-header clearfix">
                <div class="float-left">
                    <router-link class="text-primary" :to="{ name: 'medical-assistance.index' }">Medical Assistance</router-link>
                    /
                    <a class="text-secondary">View Medical Assistance</a>
                </div>
                <div class="float-right">
                    <a class="btn btn-success btn-sm" target="_blank" :href="medicalAssistance.file">
                        <i class="fas fa-eye"></i>&nbsp;
                        <strong>View Medical Assistance PDF</strong>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div v-if="ifReady">
                    <fieldset disabled>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">First Name</label>
                                    <input type="text" class="form-control" v-model="medicalAssistance.person.first_name" autocomplete="off" minlength="2" maxlength="255">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Middle Name</label>
                                    <input type="text" class="form-control" v-model="medicalAssistance.person.middle_name" autocomplete="off" minlength="2" maxlength="255">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Last Name</label>
                                    <input type="text" class="form-control" v-model="medicalAssistance.person.last_name" autocomplete="off" minlength="2" maxlength="255">
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Address</label>
                                    <textarea class="form-control" v-model="medicalAssistance.person.address" maxlength="1000"></textarea>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="hospital-bills" v-model="medicalAssistance.hospital_bills">
                                    <label class="form-check-label" for="hospital-bills">
                                        <h4>Hospital Bills</h4>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="medicines" v-model="medicalAssistance.medicines">
                                    <label class="form-check-label" for="medicines">
                                        <h4>Medicines</h4>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="consultation" v-model="medicalAssistance.consultation">
                                    <label class="form-check-label" for="consultation">
                                        <h4>Consultation</h4>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="medical-supplies" v-model="medicalAssistance.medical_supplies">
                                    <label class="form-check-label" for="medical-supplies">
                                        <h4>Medical Supplies</h4>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="minor-procedures" v-model="medicalAssistance.minor_procedures">
                                    <label class="form-check-label" for="minor-procedures">
                                        <h4>Minor Procedures</h4>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="laboratory" v-model="medicalAssistance.laboratory">
                                    <label class="form-check-label" for="laboratory">
                                        <h4>Laboratory</h4>
                                    </label>
                                </div>
                                <div class="form-check" v-if="medicalAssistance.laboratory">
                                    <input class="form-check-input" type="checkbox" value="1" id="laboratory-test" v-model="medicalAssistance.laboratory_test">
                                    <label class="form-check-label" for="laboratory-test">
                                        <h4>Laboratory Test</h4>
                                    </label>
                                </div>
                                <div class="form-check" v-if="medicalAssistance.laboratory">
                                    <input class="form-check-input" type="checkbox" value="1" id="blood-processing" v-model="medicalAssistance.blood_processing">
                                    <label class="form-check-label" for="blood-processing">
                                        <h4>Blood Processing</h4>
                                    </label>
                                </div>
                                <div class="form-check" v-if="medicalAssistance.laboratory">
                                    <input class="form-check-input" type="checkbox" value="1" id="biopsy" v-model="medicalAssistance.biopsy">
                                    <label class="form-check-label" for="biopsy">
                                        <h4>Biopsy</h4>
                                    </label>
                                </div>
                                <div class="form-check" v-if="medicalAssistance.laboratory">
                                    <input class="form-check-input" type="checkbox" value="1" id="others" v-model="medicalAssistance.laboratory_others">
                                    <label class="form-check-label" for="others">
                                        <h4>Others</h4>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="radiology" v-model="medicalAssistance.radiology">
                                    <label class="form-check-label" for="radiology">
                                        <h4>Radiology</h4>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="x-ray" v-model="medicalAssistance.xray">
                                    <label class="form-check-label" for="x-ray">
                                        <h4>X-Ray</h4>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="ct-scan" v-model="medicalAssistance.ct_scan">
                                    <label class="form-check-label" for="ct-scan">
                                        <h4>CT Scan</h4>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="utz" v-model="medicalAssistance.utz">
                                    <label class="form-check-label" for="utz">
                                        <h4>UTZ</h4>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="2d-echo" v-model="medicalAssistance.echo">
                                    <label class="form-check-label" for="2d-echo">
                                        <h4>2D Echo</h4>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="mri" v-model="medicalAssistance.mri">
                                    <label class="form-check-label" for="mri">
                                        <h4>MRI</h4>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="radiology-others" v-model="medicalAssistance.radiology_others">
                                    <label class="form-check-label" for="radiology-others">
                                        <h4>Others</h4>
                                    </label>
                                </div>
                                <div class="form-group" v-if="medicalAssistance.radiology_others">
                                    <label for="name">Other Details</label>
                                    <input type="text" class="form-control" v-model="medicalAssistance.radiology_others_details" autocomplete="off" minlength="2" maxlength="255">
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Amount</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">PHP</div>
                                        </div>
                                        <input type="text" class="form-control" v-model="medicalAssistance.amount" autocomplete="off" minlength="2" maxlength="255">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Amount in Words</label>
                                    <input type="text" class="form-control" v-model="medicalAssistance.amount_in_words" autocomplete="off" minlength="2" maxlength="255">
                                </div>
                            </div>
                        </div>

                    </fieldset>

                    <br>

                    <router-link class="btn btn-sm btn-outline-secondary" :to="{ name: 'medical-assistance.index' }">
                        <i class="fas fa-chevron-left"></i>&nbsp;
                        <strong>Back</strong>
                    </router-link>
                    <router-link class="btn btn-sm btn-primary" :to="{ name: 'medical-assistance.edit' , params: { id: medicalAssistance.id }}">
                        <i class="fas fa-edit"></i>&nbsp;
                        <strong>Edit Medical Assistance</strong>
                    </router-link>
                    <button type="button" class="btn btn-sm btn-danger" @click.prevent.default="openDeleteModal()">
                        <i class="fas fa-trash-alt"></i>&nbsp;
                        <strong>Delete Medical Assistance</strong>
                    </button>
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
                        <h5 class="modal-title" id="exampleModalLongTitle">You're about to delete this Medical Assistance?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this Medical Assistance?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-danger" @click.prevent.default="deleteMedicalAssistance()">Confirm Delete</button>
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
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
                medicalAssistance: null
            };
        },

        mounted() {
            let promise = new Promise((resolve, reject) => {
                axios.get('/api/medical-assistance/' + this.$route.params.id).then(res => {
                    this.medicalAssistance = res.data.medical_assistance;
                    this.medicalAssistance.file = '/storage/medical_records/' + this.medicalAssistance.file;

                    let amount = this.medicalAssistance.amount;
                    
                    if (amount.substr(amount.length - 3) == ".00") {
                        amount = amount.replace(".00", "");
                    }

                    this.medicalAssistance.amount = amount;
                    this.medicalAssistance.amount_in_words = amountConverter.convert(amount).toString().toUpperCase() + ' PESOS ONLY';

                    resolve();
                }).catch(err => {
                    this.ifReady = true;
                    console.log(err);
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
            deleteMedicalAssistance() {
                this.ifReady = false;

                $('#deleteModal').modal('hide');

                axios.delete('/api/medical-assistance/' + this.$route.params.id).then(res => {
                    this.$router.push({ name: 'medical-assistance.index' });
                }).catch(err => {
                    this.ifReady = true;
                    console.log(err);
                });
            }
        }
    }
</script>
