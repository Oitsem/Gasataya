<template>
    <div>
        <div class="card">
            <div class="card-header">
                <div class="float-left">
                    <router-link class="text-primary" :to="{ name: 'ched-scholars.index' }">CHED Scholars</router-link>
                    /
                    <span class="text-secondary">View CHED Scholar</span>
                </div>
                <div class="float-right">
                    <a class="btn btn-success btn-sm" target="_blank" :href="chedScholar.file">
                        <i class="fas fa-eye"></i>&nbsp;
                        <strong>View CHED Scholar PDF</strong>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div v-if="ifReady">
                    <fieldset disabled>
                        <legend>Personal Information</legend>
                        <div class="row">
                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label for="name">First Name</label>
                                    <input type="text" class="form-control" v-model="chedScholar.person.first_name" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label for="name">Middle Name</label>
                                    <input type="text" class="form-control" v-model="chedScholar.person.middle_name" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label for="name">Last Name</label>
                                    <input type="text" class="form-control" v-model="chedScholar.person.last_name" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label for="name">Extension Name</label>
                                    <input type="text" class="form-control" v-model="chedScholar.person.extension_name" autocomplete="off" maxlength="255">
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label>Barangay</label>
                                    <input type="text" class="form-control" v-model="chedScholar.person.barangay" autocomplete="off" maxlength="255">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label for="name">Address</label>
                                    <input type="text" class="form-control" v-model="chedScholar.person.address" autocomplete="off" maxlength="255">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label for="name">City</label>
                                    <input type="text" class="form-control" v-model="chedScholar.person.city" autocomplete="off" maxlength="255">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label for="name">Province</label>
                                    <input type="text" class="form-control" v-model="chedScholar.person.province" autocomplete="off" maxlength="255">
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Birthdate</label>
                                    <input type="date" class="form-control" v-model="chedScholar.person.birthdate" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Place of Birth</label>
                                    <input type="text" class="form-control" v-model="chedScholar.person.place_of_birth" autocomplete="off" required>
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label>Civil Status</label>
                                    <select class="form-control" v-model="chedScholar.person.civil_status">
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
                                    <input type="text" class="form-control" v-model="chedScholar.person.citizenship" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label>Number of Siblings</label>
                                    <input type="text" class="form-control" v-model="chedScholar.person.number_of_siblings" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <label>Sex</label>
                                <div class="row">
                                    <div class="col">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="sex-male" class="custom-control-input" v-model="chedScholar.person.sex" value="1">
                                            <label class="custom-control-label" for="sex-male">Male</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="sex-female" class="custom-control-input" v-model="chedScholar.person.sex" value="0">
                                            <label class="custom-control-label" for="sex-female">Female</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="email" class="form-control" v-model="chedScholar.person.email" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label>Mobile Number</label>
                                    <input type="text" class="form-control" v-model="chedScholar.person.mobile_number" autocomplete="off" maxlength="255">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label>Telephone Number</label>
                                    <input type="text" class="form-control" v-model="chedScholar.person.telephone_number" autocomplete="off" maxlength="255">
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label>Occupation</label>
                                    <input type="text" class="form-control" v-model="chedScholar.person.occupation" autocomplete="off" minlength="2" maxlength="255">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label>Zip Code</label>
                                    <input type="text" class="form-control" v-model="chedScholar.person.zip_code" autocomplete="off" maxlength="255">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label>District</label>
                                    <input type="text" class="form-control" v-model="chedScholar.person.district" autocomplete="off" maxlength="255">
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <br><hr><br>

                    <fieldset disabled>
                        <legend>Educational Information</legend>
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="name">Name of School Last Attented</label>
                                    <input type="text" class="form-control" v-model="chedScholar.school_last_attended" autocomplete="off" maxlength="255">
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name">School Last Attented Address</label>
                                    <textarea class="form-control" v-model="chedScholar.school_last_attended_address" maxlength="1000"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="name">Highest Attained Grade</label>
                                    <select class="form-control" v-model="chedScholar.highest_attained_grade">
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
                                            <input type="radio" id="school_last_attended_sector_public" class="custom-control-input" v-model="chedScholar.school_last_attended_sector" @click="toggleSchoolLastAttendedSector(0)" value="0">
                                            <label class="custom-control-label" for="school_last_attended_sector_public">Public</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="school_last_attended_sector_private" class="custom-control-input" v-model="chedScholar.school_last_attended_sector" @click="toggleSchoolLastAttendedSector(1)" value="1">
                                            <label class="custom-control-label" for="school_last_attended_sector_private">Private</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="name">School Intended to Enroll</label>
                                    <select class="form-control" v-model="chedScholar.school_intended_to_enroll" required>
                                        <option value="1">University of Saint La Salle Bacolod</option>
                                    </select>
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name">School Intended to Enroll Address</label>
                                    <textarea class="form-control" v-model="chedScholar.school_intended_to_enroll_address" maxlength="1000" required></textarea>
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="name">Degree Program</label>
                                    <input type="text" class="form-control" v-model="chedScholar.degree_program" autocomplete="off" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <label>School Intended to Enroll Sector</label>
                                <div class="row">
                                    <div class="col">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="type_of_school_public" class="custom-control-input" v-model="chedScholar.school_intended_to_enroll_sector" @click="toggleTypeOfSchool(0)" value="0" required>
                                            <label class="custom-control-label" for="type_of_school_public">Public</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="type_of_school_private" class="custom-control-input" v-model="chedScholar.school_intended_to_enroll_sector" @click="toggleTypeOfSchool(1)" value="1" required>
                                            <label class="custom-control-label" for="type_of_school_private">Private</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <br><hr><br>

                    <fieldset disabled>
                        <legend>Father's Information</legend>
                        <div class="row">
                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label for="name">First Name</label>
                                    <input type="text" class="form-control" v-model="chedScholar.fathers_first_name" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label for="name">Middle Name</label>
                                    <input type="text" class="form-control" v-model="chedScholar.fathers_middle_name" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label for="name">Last Name</label>
                                    <input type="text" class="form-control" v-model="chedScholar.fathers_last_name" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label for="name">Extension Name</label>
                                    <input type="text" class="form-control" v-model="chedScholar.fathers_extension_name" autocomplete="off" minlength="2" maxlength="255">
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label for="name">Address</label>
                                    <input type="text" class="form-control" v-model="chedScholar.fathers_address" autocomplete="off" maxlength="255">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label for="name">City</label>
                                    <input type="text" class="form-control" v-model="chedScholar.fathers_city" autocomplete="off" maxlength="255">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label for="name">Province</label>
                                    <input type="text" class="form-control" v-model="chedScholar.fathers_province" autocomplete="off" maxlength="255">
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Occupation</label>
                                    <input type="text" class="form-control" v-model="chedScholar.fathers_occupation" autocomplete="off" maxlength="255">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Contact Number</label>
                                    <input type="text" class="form-control" v-model="chedScholar.fathers_contact_number" autocomplete="off" maxlength="15">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Annual Gross Income</label>
                                    <input type="text" class="form-control" v-model="chedScholar.fathers_annual_gross_income" autocomplete="off" maxlength="255">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Name of Employer / Company</label>
                                    <input type="text" class="form-control" v-model="chedScholar.fathers_name_of_employer" autocomplete="off" maxlength="255">
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Employer Address / Company Address</label>
                                    <textarea class="form-control" v-model="chedScholar.fathers_employer_address" maxlength="1000" required></textarea>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <br><hr><br>

                    <fieldset disabled>
                        <legend>Mother's Information</legend>
                        <div class="row">
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label for="name">First Name</label>
                                    <input type="text" class="form-control" v-model="chedScholar.mothers_first_name" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label for="name">Middle Name</label>
                                    <input type="text" class="form-control" v-model="chedScholar.mothers_middle_name" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label for="name">Last Name</label>
                                    <input type="text" class="form-control" v-model="chedScholar.mothers_last_name" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label for="name">Address</label>
                                    <input type="text" class="form-control" v-model="chedScholar.mothers_address" autocomplete="off" maxlength="255">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label for="name">City</label>
                                    <input type="text" class="form-control" v-model="chedScholar.mothers_city" autocomplete="off" maxlength="255">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label for="name">Province</label>
                                    <input type="text" class="form-control" v-model="chedScholar.mothers_province" autocomplete="off" maxlength="255">
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Occupation</label>
                                    <input type="text" class="form-control" v-model="chedScholar.mothers_occupation" autocomplete="off" maxlength="255">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Contact Number</label>
                                    <input type="text" class="form-control" v-model="chedScholar.mothers_contact_number" autocomplete="off" maxlength="15">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Annual Gross Income</label>
                                    <input type="text" class="form-control" v-model="chedScholar.mothers_annual_gross_income" autocomplete="off" maxlength="255">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Name of Employer / Company</label>
                                    <input type="text" class="form-control" v-model="chedScholar.mothers_name_of_employer" autocomplete="off" maxlength="255">
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Employer Address / Company Address</label>
                                    <textarea class="form-control" v-model="chedScholar.mothers_employer_address" maxlength="1000" required></textarea>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <br><hr><br>

                    <fieldset disabled>
                        <legend>Legal Guardian's Information</legend>
                        <div class="row">
                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label for="name">First Name</label>
                                    <input type="text" class="form-control" v-model="chedScholar.legal_guardian_first_name" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label for="name">Middle Name</label>
                                    <input type="text" class="form-control" v-model="chedScholar.legal_guardian_middle_name" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label for="name">Last Name</label>
                                    <input type="text" class="form-control" v-model="chedScholar.legal_guardian_last_name" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label for="name">Extension Name</label>
                                    <input type="text" class="form-control" v-model="chedScholar.legal_guardian_extension_name" autocomplete="off" minlength="2" maxlength="255">
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label for="name">Address</label>
                                    <input type="text" class="form-control" v-model="chedScholar.legal_guardian_address" autocomplete="off" maxlength="255">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label for="name">City</label>
                                    <input type="text" class="form-control" v-model="chedScholar.legal_guardian_city" autocomplete="off" maxlength="255">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label for="name">Province</label>
                                    <input type="text" class="form-control" v-model="chedScholar.legal_guardian_province" autocomplete="off" maxlength="255">
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Occupation</label>
                                    <input type="text" class="form-control" v-model="chedScholar.legal_guardian_occupation" autocomplete="off" maxlength="255">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Contact Number</label>
                                    <input type="text" class="form-control" v-model="chedScholar.legal_guardian_contact_number" autocomplete="off" maxlength="15">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Annual Gross Income</label>
                                    <input type="text" class="form-control" v-model="chedScholar.legal_guardian_annual_gross_income" autocomplete="off" maxlength="255">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Name of Employer / Company</label>
                                    <input type="text" class="form-control" v-model="chedScholar.legal_guardian_name_of_employer" autocomplete="off" maxlength="255">
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Employer Address / Company Address</label>
                                    <textarea class="form-control" v-model="chedScholar.legal_guardian_employer_address" maxlength="1000" required></textarea>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <br>

                    <router-link class="btn btn-outline-secondary btn-sm" :to="{ name: 'ched-scholars.index' }">
                        <i class="fas fa-chevron-left"></i>&nbsp;
                        <strong>Back</strong>
                    </router-link>
                    <router-link class="btn btn-primary btn-sm" :to="{ name: 'ched-scholars.edit' , params: { id: chedScholar.id }}">
                        <i class="fas fa-edit"></i>&nbsp;
                        <strong>Edit CHED Scholar</strong>
                    </router-link>
                    <button type="button" class="btn btn-danger btn-sm" @click.prevent.default="openDeleteModal()">
                        <i class="fas fa-trash-alt"></i>&nbsp;
                        <strong>Delete CHED Scholar</strong>
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
    </div>
</template>

<script>
    export default {
        data() {
            return {
                ifReady: false,
                barangays: [],
                chedScholar: ''
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
                    console.log(err);
                    reject();
                });
            });

            let promiseChedScholar = new Promise((resolve, reject) => {
                axios.get('/api/ched-scholars/' + this.$route.params.id).then(res => {
                    this.chedScholar = res.data.ched_scholar;
                    this.chedScholar.file = '/storage/ched_scholars/' + this.chedScholar.file;
                    resolve();
                });
            });

            Promise.all([promiseBarangays, promiseChedScholar]).then(() => {
                this.ifReady = true;

                let barangayId = this.person.barangay_id - 1;
                this.chedScholar.person.barangay = this.barangays[barangayId].name;
            });
        },

        methods: {
            openDeleteModal() {
                $('#deleteModal').modal('show');
            },
            deletePerson() {
                this.ifReady = false;
                $('#deleteModal').modal('hide');

                axios.delete('/api/ched-scholars/' + this.$route.params.id).then(res => {
                    this.$router.push({ name: 'ched-scholars.index' });
                }).catch(err => {
                    this.ifReady = true;
                    console.log(err);
                });
            }
        }
    }
</script>
