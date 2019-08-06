<template>
    <div>
        <div class="card">
            <div class="card-header clearfix">
                <div class="float-left">
                    <router-link class="text-primary" :to="{ name: 'persons.index' }">Persons</router-link>
                    /
                    <span class="text-secondary">View Persons</span>
                </div>
                <div class="float-right">
                    <router-link class="btn btn-success btn-sm" :to="{ name: 'persons.create' }">
                        <i class="fas fa-plus"></i>&nbsp;
                        <strong>Create New Person</strong>
                    </router-link>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover table-sm">
                    <caption>
                        <div class="row">
                            <div class="col-md-9">
                                List of Persons - <strong>Total Items {{ this.meta.total }}</strong>
                            </div>
                            <div class="col-md-3">
                                <div class="progress" height="30px;" v-if="showProgress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </caption>
                    <thead>
                        <tr>
                            <th scope="col">First Name</th>
                            <th scope="col">Middle Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody v-if="persons">
                        <tr v-for="person in persons">
                            <td>{{ person.first_name }}</td>
                            <td>{{ person.middle_name }}</td>
                            <td>{{ person.last_name }}</td>
                            <td>
                                <router-link class="text-secondary" :to="{ name: 'persons.view', params: { id: person.id } }">
                                    <i class="fas fa-eye"></i>
                                    <strong>View</strong>
                                </router-link>
                                &nbsp; | &nbsp;
                                <router-link class="text-secondary" :to="{ name: 'persons.edit', params: { id: person.id }}">
                                    <i class="fas fa-edit"></i>
                                    <strong>Edit</strong>
                                </router-link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br>

        <div class="clearfix">
            <div v-if="pageCount">
                <nav class="float-left">
                    <ul class="pagination">
                        <li class="page-item" v-bind:class="isPrevDisabled">
                            <a class="page-link" href="#" @click.prevent="goToPreviousPage" disabled><strong>Previous</strong></a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#" @click.prevent="goToFirstPage"><strong>First</strong></a>
                        </li>
                        <li class="page-item" v-for="pageNumber in pageNumbers" v-bind:class="isPageActive(pageNumber)">
                            <a class="page-link" href="#" @click.prevent="goToPage(pageNumber)">{{ pageNumber }}</a>
                        </li>
                        <li class="page-item" v-bind:class="isNextDisabled">
                            <a class="page-link" href="#" @click.prevent="goToLastPage"><strong>Last</strong></a>
                        </li>
                        <li class="page-item" v-bind:class="isNextDisabled">
                            <a class="page-link" href="#" @click.prevent="goToNextPage"><strong>Next</strong></a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div v-else>
                <nav class="float-left">
                    <ul class="pagination">
                        <li class="page-item" v-bind:class="isPrevDisabled">
                            <a class="page-link" href="#" @click.prevent="goToPreviousPage" disabled><strong>Previous</strong></a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#" @click.prevent="goToFirstPage"><strong>First</strong></a>
                        </li>
                        <li class="page-item" v-for="pageNumber in pageNumbers" v-bind:class="isPageActive(pageNumber)">
                            <a class="page-link" href="#" @click.prevent="goToPage(pageNumber)">{{ pageNumber }}</a>
                        </li>
                        <li class="page-item" v-bind:class="isNextDisabled">
                            <a class="page-link" href="#" @click.prevent="goToLastPage"><strong>Last</strong></a>
                        </li>
                        <li class="page-item" v-bind:class="isNextDisabled">
                            <a class="page-link" href="#" @click.prevent="goToNextPage"><strong>Next</strong></a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="float-right">
                <form class="form-inline">
                    <button type="button" class="btn btn-primary mr-2" @click.prevent.default="openSearchModal()">
                        <i class="fas fa-search"></i>&nbsp;
                        <strong>Search Persons</strong>
                    </button>
                    <label class="sr-only" for="Number of Items">Number of Items</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Items per page</div>
                        </div>
                        <select class="custom-select" id="number_of_items" v-model="meta.per_page" v-on:change="changePerPage">
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                        </select>
                    </div>
                </form>
            </div>

            <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="filterPersons" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Search Persons</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
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
                            <div class="form-group">
                                <label>Order By</label>
                                <select class="form-control" v-model="order_by">
                                    <option value="desc">Newest</option>
                                    <option value="asc">Oldest</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-sm" @click.prevent.default="clear">Clear</button>
                            <button type="button" class="btn btn-success btn-sm" @click.prevent.default="search">Search</button>
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    const getPersons = (
        page,
        per_page,
        first_name,
        middle_name,
        last_name,
        extension_name,
        address,
        birthdate,
        place_of_birth,
        civil_status,
        citizenship,
        number_of_siblings,
        sex,
        email,
        mobile_number,
        telephone_number,
        occupation,
        zip_code,
        district,
        order_by,
        callback
    ) => {
        const params = {
            page,
            per_page,
            first_name,
            middle_name,
            last_name,
            extension_name,
            address,
            birthdate,
            place_of_birth,
            civil_status,
            citizenship,
            number_of_siblings,
            sex,
            email,
            mobile_number,
            telephone_number,
            occupation,
            zip_code,
            district,
            order_by
        };

        axios.get('/api/persons', { params }).then(res => {
            callback(null, res.data);
        }).catch(error => {
            if (error.response.status == 401) {
                location.reload();
            }

            if (error.response.status == 500) {
                alert('Kindly report this issue to the devs.');
            }
        });
    };

    export default {
        data() {
            return {
                persons: null,
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
                order_by: '',
                meta: {
                    current_page: null,
                    from: null,
                    last_page: null,
                    path: null,
                    per_page: 10,
                    to: null,
                    total: null
                },
                links: {
                    first: null,
                    last: null,
                    next: null,
                    prev: null,
                },
                error: null,
                showProgress: false,
                pageNumbers: []
            };
        },

        beforeRouteEnter (to, from, next) {
            if (to.query.per_page == null) {
                getPersons(
                    to.query.page,
                    10,
                    to.query.first_name,
                    to.query.middle_name,
                    to.query.last_name,
                    to.query.extension_name,
                    to.query.address,
                    to.query.birthdate,
                    to.query.place_of_birth,
                    to.query.civil_status,
                    to.query.citizenship,
                    to.query.number_of_siblings,
                    to.query.sex,
                    to.query.email,
                    to.query.mobile_number,
                    to.query.telephone_number,
                    to.query.occupation,
                    to.query.zip_code,
                    to.query.district,
                    to.query.order_by,
                    (err, data) => {
                        next(vm => vm.setData(err, data));
                    }
                );
            } else {
                getPersons(
                    to.query.page,
                    to.query.per_page,
                    to.query.first_name,
                    to.query.middle_name,
                    to.query.last_name,
                    to.query.extension_name,
                    to.query.address,
                    to.query.birthdate,
                    to.query.place_of_birth,
                    to.query.civil_status,
                    to.query.citizenship,
                    to.query.number_of_siblings,
                    to.query.sex,
                    to.query.email,
                    to.query.mobile_number,
                    to.query.telephone_number,
                    to.query.occupation,
                    to.query.zip_code,
                    to.query.district,
                    to.query.order_by,
                    (err, data) => {
                        next(vm => vm.setData(err, data));
                    }
                );
            }
        },

        beforeRouteUpdate (to, from, next) {
            getPersons(
                to.query.page,
                this.meta.per_page,
                this.first_name,
                this.middle_name,
                this.last_name,
                this.extension_name,
                this.address,
                this.birthdate,
                this.place_of_birth,
                this.civil_status,
                this.citizenship,
                this.number_of_siblings,
                this.sex,
                this.email,
                this.mobile_number,
                this.telephone_number,
                this.occupation,
                this.zip_code,
                this.district,
                this.order_by,
                (err, data) => {
                    this.setData(err, data);
                    next();
                }
            );
        },

        computed: {
            nextPage() {
                return this.meta.current_page + 1;
            },
            prevPage() {
                return this.meta.current_page - 1;
            },
            paginatonCount() {
                if (! this.meta) {
                    return;
                }

                const { current_page, last_page } = this.meta;

                return `${current_page} of ${last_page}`;
            },
            pageCount() {
                if (this.meta.last_page > 10) {
                    return false;
                }

                return true;
            },
            isPrevDisabled() {
                if (this.links.prev == null) {
                    return 'disabled';
                }

                return;
            },
            isNextDisabled() {
                if (this.links.next == null) {
                    return 'disabled';
                }

                return;
            }
        },

        methods: {
            goToFirstPage() {
                this.showProgress = true;
                this.$router.push({
                    name: 'persons.index',
                    query: {
                        page: 1,
                        per_page: this.meta.per_page,
                        first_name: this.first_name,
                        middle_name: this.middle_name,
                        last_name: this.last_name,
                        extension_name: this.extension_name,
                        address: this.address,
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
                        district: this.district,
                        order_by: this.order_by
                    },
                });
            },
            goToPage(page = null) {
                this.showProgress = true;
                this.$router.push({
                    name: 'persons.index',
                    query: {
                        page,
                        per_page: this.meta.per_page,
                        first_name: this.first_name,
                        middle_name: this.middle_name,
                        last_name: this.last_name,
                        extension_name: this.extension_name,
                        address: this.address,
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
                        district: this.district,
                        order_by: this.order_by
                    },
                });
            },
            goToLastPage() {
                this.showProgress = true;
                this.$router.push({
                    name: 'persons.index',
                    query: {
                        page: this.meta.last_page,
                        per_page: this.meta.per_page,
                        first_name: this.first_name,
                        middle_name: this.middle_name,
                        last_name: this.last_name,
                        extension_name: this.extension_name,
                        address: this.address,
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
                        district: this.district,
                        order_by: this.order_by
                    }
                });
            },
            goToNextPage() {
                this.showProgress = true;
                this.$router.push({
                    name: 'persons.index',
                    query: {
                        page: this.nextPage,
                        per_page: this.meta.per_page,
                        first_name: this.first_name,
                        middle_name: this.middle_name,
                        last_name: this.last_name,
                        extension_name: this.extension_name,
                        address: this.address,
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
                        district: this.district,
                        order_by: this.order_by
                    }
                });
            },
            goToPreviousPage() {
                this.showProgress = true;
                this.$router.push({
                    name: 'persons.index',
                    query: {
                        page: this.prevPage,
                        per_page: this.meta.per_page,
                        first_name: this.first_name,
                        middle_name: this.middle_name,
                        last_name: this.last_name,
                        extension_name: this.extension_name,
                        address: this.address,
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
                        district: this.district,
                        order_by: this.order_by
                    }
                });
            },
            setData(err, { data: persons, links, meta }) {
                this.pageNumbers = [];

                if (err) {
                    this.error = err.toString();
                } else {
                    this.persons = persons;
                    this.links = links;
                    this.meta = meta;
                }

                this.showProgress = false;
                this.populatePages();
            },
            populatePages() {
                if (this.pageCount) {
                    for (let i = 1; i <= this.meta.last_page; i++) {
                        this.pageNumbers.push(i);
                    }
                } else if (this.meta.current_page <= 6) {
                    let page = 1;
                    this.pageNumbers.push(page);
                    this.pageNumbers.push(page + 1);
                    this.pageNumbers.push(page + 2);
                    this.pageNumbers.push(page + 3);
                    this.pageNumbers.push(page + 4);
                    this.pageNumbers.push(page + 5);
                    this.pageNumbers.push(page + 6);
                    this.pageNumbers.push('...');
                    this.pageNumbers.push(this.meta.last_page - 1);
                    this.pageNumbers.push(this.meta.last_page);
                } else if ((this.meta.current_page + 6) >= this.meta.last_page) {
                    this.pageNumbers.push(1);
                    this.pageNumbers.push(2);
                    this.pageNumbers.push('...');
                    this.pageNumbers.push(this.meta.last_page - 7);
                    this.pageNumbers.push(this.meta.last_page - 6);
                    this.pageNumbers.push(this.meta.last_page - 5);
                    this.pageNumbers.push(this.meta.last_page - 4);
                    this.pageNumbers.push(this.meta.last_page - 3);
                    this.pageNumbers.push(this.meta.last_page - 2);
                    this.pageNumbers.push(this.meta.last_page - 1);
                    this.pageNumbers.push(this.meta.last_page);
                } else {
                    this.pageNumbers.push(1);
                    this.pageNumbers.push(2);
                    this.pageNumbers.push('...');
                    this.pageNumbers.push(this.meta.current_page - 2);
                    this.pageNumbers.push(this.meta.current_page - 1);
                    this.pageNumbers.push(this.meta.current_page);
                    this.pageNumbers.push(this.meta.current_page + 1);
                    this.pageNumbers.push(this.meta.current_page + 2);
                    this.pageNumbers.push('...');
                    this.pageNumbers.push(this.meta.last_page - 1);
                    this.pageNumbers.push(this.meta.last_page);
                }
            },
            isPageActive(page) {
                if (page == this.$route.query.page || (page == 1 && this.$route.query.page == null)) {
                    return 'active';
                }

                return;
            },
            changePerPage() {
                this.showProgress = true;
                this.$router.push({
                    name: 'persons.index',
                    query: {
                        page: 1,
                        per_page: this.meta.per_page,
                        first_name: this.first_name,
                        middle_name: this.middle_name,
                        last_name: this.last_name,
                        extension_name: this.extension_name,
                        address: this.address,
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
                        district: this.district,
                        order_by: this.order_by
                    }
                });
            },
            search() {
                $('#searchModal').modal('hide');

                this.showProgress = true;
                this.$router.push({
                    name: 'persons.index',
                    query: {
                        page: 1,
                        per_page: this.meta.per_page,
                        first_name: this.first_name,
                        middle_name: this.middle_name,
                        last_name: this.last_name,
                        extension_name: this.extension_name,
                        address: this.address,
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
                        district: this.district,
                        order_by: this.order_by
                    }
                });
            },
            clear() {
                this.first_name = '';
                this.middle_name = '';
                this.last_name = '';
                this.extension_name = '';
                this.address = '';
                this.birthdate = '';
                this.place_of_birth = '';
                this.civil_status = '';
                this.citizenship = '';
                this.number_of_siblings = '';
                this.sex = '';
                this.email = '';
                this.mobile_number = '';
                this.telephone_number = '';
                this.occupation = '';
                this.zip_code = '';
                this.district = '';
                this.order_by = 'desc';
            },
            openSearchModal() {
                $('#searchModal').modal('show');
            }
        }
    }
</script>
