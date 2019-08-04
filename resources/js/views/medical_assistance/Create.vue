<template>
    <div>
        <div class="card">
            <div class="card-header">
                <router-link class="text-primary" :to="{ name: 'medical-assistance.index' }">Medical Assistance</router-link>
                /
                <a class="text-secondary">Create New Medical Assistance</a>
            </div>
            <div class="card-body">
                <div v-if="ifReady">
                    <form v-on:submit.prevent="createNewMedicalAssistance()">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Search Person</label>
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
                                <div class="col-lg-3 col-md-12">
                                    <div class="form-group">
                                        <label for="name">First Name</label>
                                        <input type="text" class="form-control" v-model="first_name">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Middle Name</label>
                                        <input type="text" class="form-control" v-model="middle_name">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Last Name</label>
                                        <input type="text" class="form-control" v-model="last_name">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Extension Name</label>
                                        <input type="text" class="form-control" v-model="extension_name">
                                    </div>
                                </div>

                                <div class="w-100"></div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Address</label>
                                         <textarea class="form-control" v-model="address" maxlength="1000"></textarea>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <hr>

                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="hospital-bills" v-model="hospital_bills">
                                    <label class="form-check-label" for="hospital-bills">
                                        <h4>Hospital Bills</h4>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="medicines" v-model="medicines">
                                    <label class="form-check-label" for="medicines">
                                        <h4>Medicines</h4>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="consultation" v-model="consultation">
                                    <label class="form-check-label" for="consultation">
                                        <h4>Consultation</h4>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="medical-supplies" v-model="medical_supplies">
                                    <label class="form-check-label" for="medical-supplies">
                                        <h4>Medical Supplies</h4>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="minor-procedures" v-model="minor_procedures">
                                    <label class="form-check-label" for="minor-procedures">
                                        <h4>Minor Procedures</h4>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="laboratory" v-model="laboratory">
                                    <label class="form-check-label" for="laboratory">
                                        <h4>Laboratory</h4>
                                    </label>
                                </div>
                                <div class="form-check" v-if="laboratory">
                                    <input class="form-check-input" type="checkbox" value="1" id="laboratory-test" v-model="laboratory_test">
                                    <label class="form-check-label" for="laboratory-test">
                                        <h4>Laboratory Test</h4>
                                    </label>
                                </div>
                                <div class="form-check" v-if="laboratory">
                                    <input class="form-check-input" type="checkbox" value="1" id="blood-processing" v-model="blood_processing">
                                    <label class="form-check-label" for="blood-processing">
                                        <h4>Blood Processing</h4>
                                    </label>
                                </div>
                                <div class="form-check" v-if="laboratory">
                                    <input class="form-check-input" type="checkbox" value="1" id="biopsy" v-model="biopsy">
                                    <label class="form-check-label" for="biopsy">
                                        <h4>Biopsy</h4>
                                    </label>
                                </div>
                                <div class="form-check" v-if="laboratory">
                                    <input class="form-check-input" type="checkbox" value="1" id="others" v-model="laboratory_others">
                                    <label class="form-check-label" for="others">
                                        <h4>Others</h4>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="radiology" v-model="radiology">
                                    <label class="form-check-label" for="radiology">
                                        <h4>Radiology</h4>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="x-ray" v-model="xray">
                                    <label class="form-check-label" for="x-ray">
                                        <h4>X-Ray</h4>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="ct-scan" v-model="ct_scan">
                                    <label class="form-check-label" for="ct-scan">
                                        <h4>CT Scan</h4>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="utz" v-model="utz">
                                    <label class="form-check-label" for="utz">
                                        <h4>UTZ</h4>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="2d-echo" v-model="echo">
                                    <label class="form-check-label" for="2d-echo">
                                        <h4>2D Echo</h4>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="mri" v-model="mri">
                                    <label class="form-check-label" for="mri">
                                        <h4>MRI</h4>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="radiology-others" v-model="radiology_others">
                                    <label class="form-check-label" for="radiology-others">
                                        <h4>Others</h4>
                                    </label>
                                </div>
                                <div class="form-group" v-if="radiology_others">
                                    <label for="name">Other Details</label>
                                    <input type="text" class="form-control" v-model="radiology_others_details" autocomplete="off" minlength="2" maxlength="255">
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
                                        <input type="number" class="form-control" v-model="amount" @input="convertAmount()" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Amount in Words</label>
                                    <input type="text" class="form-control" v-model="amount_in_words" required disabled>
                                </div>
                            </div>
                        </div>

                        <br>

                        <router-link class="btn btn-outline-secondary btn-sm" :to="{ name: 'medical-assistance.index' }">
                            <i class="fas fa-chevron-left"></i>&nbsp;
                            <strong>Back</strong>
                        </router-link>
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i>&nbsp;
                            <strong>Create New Medical Assistance</strong>
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
                ifReady: true,
                persons: [],
                person: null,
                person_id: null,
                first_name: '',
                middle_name: '',
                last_name: '',
                address: '',
                amount: '',
                amount_in_words: '',
                hospital_bills: false,
                medicines: false,
                consultation: false,
                medical_supplies: false,
                minor_procedures: false,
                laboratory: false,
                laboratory_test: false,
                blood_processing: false,
                biopsy: false,
                laboratory_others: false,
                radiology: false,
                xray: false,
                ct_scan: false,
                utz: false,
                echo: false,
                mri: false,
                radiology_others: false,
                radiology_others_details: ''
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
            convertAmount() {
                if (this.amount > 0) {
                    let string = amountConverter.convert(this.amount).toString().toUpperCase();
                    this.amount_in_words = string.trim() + ' PESOS ONLY';
                } else {
                    this.amount_in_words = '';
                }
            },
            createNewMedicalAssistance() {
                this.ifReady = false;

                axios.post('/api/medical-assistance', this.$data).then(res => {
                    this.$router.push({ name: 'medical-assistance.index' });
                }).catch(err => {
                    this.ifReady = true;
                    console.log(err);
                });
            }
        }
    }
</script>
