<template>
    <div>
        <div class="card">
            <div class="card-header">
                <router-link class="text-primary" :to="{ name: 'ched-scholars.index' }">CHED Scholars</router-link>
                /
                <a class="text-secondary">Create New CHED Scholar</a>
            </div>
            <div class="card-body">
                <div v-if="ifReady">
                    <form v-on:submit.prevent="createNewCHEDScholar()">
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
                            <legend>Personal Information</legend>
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

                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Address</label>
                                        <textarea class="form-control" v-model="address" maxlength="1000"></textarea>
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
                        </fieldset>

                        <br><hr><br>

                        <fieldset>
                            <legend>Educational Information</legend>
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Name of School Last Attented</label>
                                        <input type="text" class="form-control" v-model="school_last_attended" autocomplete="off" maxlength="255">
                                    </div>
                                </div>

                                <div class="w-100"></div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="name">School Last Attented Address</label>
                                        <textarea class="form-control" v-model="school_last_attended_address" maxlength="1000"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Highest Attained Grade</label>
                                        <select class="form-control" v-model="highest_attained_grade">
                                            <option value="1">Grade 1</option>
                                            <option value="2">Grade 2</option>
                                            <option value="3">Grade 3</option>
                                            <option value="4">Grade 4</option>
                                            <option value="5">Grade 5</option>
                                            <option value="6">Grade 6</option>
                                            <option value="7">Grade 7</option>
                                            <option value="8">First Year High School</option>
                                            <option value="9">Second Year High School</option>
                                            <option value="10">Third Year High School</option>
                                            <option value="12">Fourth Year High School</option>
                                            <option value="12">Junior High</option>
                                            <option value="13">Senior High</option>
                                            <option value="14">First Year College</option>
                                            <option value="15">Second Year College</option>
                                            <option value="16">Third Year College</option>
                                            <option value="17">Fourth Year College</option>
                                            <option value="18">Fifth Year College</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <label>School Last Attended Sector</label>
                                    <div class="row">
                                        <div class="col">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="school_last_attended_sector_public" class="custom-control-input" v-model="school_last_attended_sector" @click="toggleSchoolLastAttendedSector(0)" value="0">
                                                <label class="custom-control-label" for="school_last_attended_sector_public">Public</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="school_last_attended_sector_private" class="custom-control-input" v-model="school_last_attended_sector" @click="toggleSchoolLastAttendedSector(1)" value="1">
                                                <label class="custom-control-label" for="school_last_attended_sector_private">Private</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="name">School Intended to Enroll <small class="text-danger">*Required</small></label>
                                        <select class="form-control" v-model="school_intended_to_enroll" required>
                                            <option value="1">University of Saint La Salle Bacolod</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="w-100"></div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="name">School Intended to Enroll Address <small class="text-danger">*Required</small></label>
                                        <textarea class="form-control" v-model="school_intended_to_enroll_address" maxlength="1000" required></textarea>
                                    </div>
                                </div>

                                <div class="w-100"></div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Degree Program <small class="text-danger">*Required</small></label>
                                        <input type="text" class="form-control" v-model="degree_program" autocomplete="off" maxlength="255" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <label>School Intended to Enroll Sector <small class="text-danger">*Required</small></label>
                                    <div class="row">
                                        <div class="col">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="type_of_school_public" class="custom-control-input" v-model="school_intended_to_enroll_sector" @click="toggleSchoolIntendedSector(0)" value="0" required>
                                                <label class="custom-control-label" for="type_of_school_public">Public</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="type_of_school_private" class="custom-control-input" v-model="school_intended_to_enroll_sector" @click="toggleSchoolIntendedSector(1)" value="1" required>
                                                <label class="custom-control-label" for="type_of_school_private">Private</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        
                        <br><hr><br>

                        <fieldset>
                            <legend>Father's Information</legend>
                            <div class="row">
                                <div class="col-lg-3 col-md-12">
                                    <div class="form-group">
                                        <label for="name">First Name</label>
                                        <input type="text" class="form-control" v-model="fathers_first_name" autocomplete="off" minlength="2" maxlength="255" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Middle Name</label>
                                        <input type="text" class="form-control" v-model="fathers_middle_name" autocomplete="off" minlength="2" maxlength="255" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Last Name</label>
                                        <input type="text" class="form-control" v-model="fathers_last_name" autocomplete="off" minlength="2" maxlength="255" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Extension Name</label>
                                        <input type="text" class="form-control" v-model="fathers_extension_name" autocomplete="off" minlength="2" maxlength="255">
                                    </div>
                                </div>

                                <div class="w-100"></div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Address</label>
                                        <textarea class="form-control" v-model="fathers_address" maxlength="1000" required></textarea>
                                    </div>
                                </div>

                                <div class="w-100"></div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Occupation</label>
                                        <input type="text" class="form-control" v-model="fathers_occupation" autocomplete="off" maxlength="255">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Contact Number</label>
                                        <input type="text" class="form-control" v-model="fathers_contact_number" autocomplete="off" maxlength="15">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Annual Gross Income</label>
                                        <input type="text" class="form-control" v-model="fathers_annual_gross_income" autocomplete="off" maxlength="255">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Name of Employer / Company</label>
                                        <input type="text" class="form-control" v-model="fathers_name_of_employer" autocomplete="off" maxlength="255">
                                    </div>
                                </div>

                                <div class="w-100"></div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Employer Address / Company Address</label>
                                        <textarea class="form-control" v-model="fathers_employer_address" maxlength="1000" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <br><hr><br>

                        <fieldset>
                            <legend>Mother's Information</legend>
                            <div class="row">
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label for="name">First Name</label>
                                        <input type="text" class="form-control" v-model="mothers_first_name" autocomplete="off" minlength="2" maxlength="255" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Middle Name</label>
                                        <input type="text" class="form-control" v-model="mothers_middle_name" autocomplete="off" minlength="2" maxlength="255" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Last Name</label>
                                        <input type="text" class="form-control" v-model="mothers_last_name" autocomplete="off" minlength="2" maxlength="255" required>
                                    </div>
                                </div>

                                <div class="w-100"></div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Address</label>
                                        <textarea class="form-control" v-model="mothers_address" maxlength="1000" required></textarea>
                                    </div>
                                </div>

                                <div class="w-100"></div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Occupation</label>
                                        <input type="text" class="form-control" v-model="mothers_occupation" autocomplete="off" maxlength="255">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Contact Number</label>
                                        <input type="text" class="form-control" v-model="mothers_contact_number" autocomplete="off" maxlength="15">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Annual Gross Income</label>
                                        <input type="text" class="form-control" v-model="mothers_annual_gross_income" autocomplete="off" maxlength="255">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Name of Employer / Company</label>
                                        <input type="text" class="form-control" v-model="mothers_name_of_employer" autocomplete="off" maxlength="255">
                                    </div>
                                </div>

                                <div class="w-100"></div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Employer Address / Company Address</label>
                                        <textarea class="form-control" v-model="mothers_employer_address" maxlength="1000" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <br><hr><br>

                        <fieldset>
                            <legend>Legal Guardian's Information</legend>
                            <div class="row">
                                <div class="col-lg-3 col-md-12">
                                    <div class="form-group">
                                        <label for="name">First Name</label>
                                        <input type="text" class="form-control" v-model="legal_guardian_first_name" autocomplete="off" minlength="2" maxlength="255" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Middle Name</label>
                                        <input type="text" class="form-control" v-model="legal_guardian_middle_name" autocomplete="off" minlength="2" maxlength="255" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Last Name</label>
                                        <input type="text" class="form-control" v-model="legal_guardian_last_name" autocomplete="off" minlength="2" maxlength="255" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Extension Name</label>
                                        <input type="text" class="form-control" v-model="legal_guardian_extension_name" autocomplete="off" minlength="2" maxlength="255">
                                    </div>
                                </div>

                                <div class="w-100"></div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Address</label>
                                        <textarea class="form-control" v-model="legal_guardian_address" maxlength="1000" required></textarea>
                                    </div>
                                </div>

                                <div class="w-100"></div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Occupation</label>
                                        <input type="text" class="form-control" v-model="legal_guardian_occupation" autocomplete="off" maxlength="255">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Contact Number</label>
                                        <input type="text" class="form-control" v-model="legal_contact_number" autocomplete="off" maxlength="15">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Annual Gross Income</label>
                                        <input type="text" class="form-control" v-model="legal_guardian_annual_gross_income" autocomplete="off" maxlength="255">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Name of Employer / Company</label>
                                        <input type="text" class="form-control" v-model="legal_guardian_name_of_employer" autocomplete="off" maxlength="255">
                                    </div>
                                </div>

                                <div class="w-100"></div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Employer Address / Company Address</label>
                                        <textarea class="form-control" v-model="legal_guardian_employer_address" maxlength="1000" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <br>
                        
                        <router-link class="btn btn-outline-secondary btn-sm" :to="{ name: 'ched-scholars.index' }">
                            <i class="fas fa-chevron-left"></i>&nbsp;
                            <strong>Back</strong>
                        </router-link>
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i>&nbsp;
                            <strong>Create New CHED Scholar</strong>
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
                extension_name: '',
                address: '',
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
                district: '',
                school_last_attended: '',
                school_last_attended_address: '',
                highest_attained_grade: '',
                school_last_attended_sector: '',
                school_intended_to_enroll: '',
                school_intended_to_enroll_address: '',
                degree_program: '',
                school_intended_to_enroll_sector: '',
                fathers_first_name: '',
                fathers_middle_name: '',
                fathers_last_name: '',
                fathers_extension_name: '',
                fathers_address: '',
                fathers_occupation: '',
                fathers_contact_number: '',
                fathers_annual_gross_income: '',
                fathers_name_of_employer: '',
                fathers_employer_address: '',
                mothers_first_name: '',
                mothers_middle_name: '',
                mothers_last_name: '',
                mothers_extension_name: '',
                mothers_address: '',
                mothers_occupation: '',
                mothers_contact_number: '',
                mothers_annual_gross_income: '',
                mothers_name_of_employer: '',
                mothers_employer_address: '',
                legal_guardian_first_name: '',
                legal_guardian_middle_name: '',
                legal_guardian_last_name: '',
                legal_guardian_extension_name: '',
                legal_guardian_address: '',
                legal_guardian_occupation: '',
                legal_contact_number: '',
                legal_guardian_annual_gross_income: '',
                legal_guardian_name_of_employer: '',
                legal_guardian_employer_address: ''
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
            }, 350),
            selectPerson() {
                this.person_id          = this.person.id;
                this.first_name         = this.person.first_name;
                this.middle_name        = this.person.middle_name;
                this.last_name          = this.person.last_name;
                this.extension_name     = this.person.extension_name;
                this.address            = this.person.address;
                this.birthdate          = this.person.birthdate;
                this.place_of_birth     = this.person.place_of_birth;
                this.civil_status       = this.person.civil_status;
                this.citizenship        = this.person.citizenship;
                this.number_of_siblings = this.person.number_of_siblings;
                this.sex                = this.person.sex;
                this.email              = this.person.email;
                this.mobile_number      = this.person.mobile_number;
                this.telephone_number   = this.person.telephone_number;
                this.occupation         = this.person.occupation;
                this.zip_code           = this.person.zip_code;
                this.district           = this.person.district;
            },
            toggleSchoolLastAttendedSector(value) {
                if (value == 0) {
                    this.school_last_attended_sector = '';
                }

                if (value == 1) {
                    this.school_last_attended_sector = '';
                }
            },
            toggleSchoolIntendedSector(value) {
                if (value == 0) {
                    this.type_of_school = '';
                }

                if (value == 1) {
                    this.type_of_school = '';
                }
            },
            createNewCHEDScholar() {
                this.ifReady = false;

                axios.post('/api/ched-scholars', this.$data).then(res => {
                    this.$router.push({ name: 'ched-scholars.index' });
                }).catch(err => {
                    this.ifReady = true;
                    console.log(err);
                });
            }
        }
    }
</script>
