<template>
    <div class="sticky-top">
        <ul class="nav flex-column background py-1 mt-3 sidebar-nav">
            <li class="nav-item">
                <span class="nav-link main-title">Dashboards</span>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'home' }">Home</router-link>
            </li>

            <li class="nav-item">
                <span class="nav-link main-title">Records</span>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#persons" data-toggle="collapse" aria-expanded="false" aria-controls="persons">
                    Persons <i class="float-right fas fa-caret-down"></i>
                </a>
            </li>
            <div class="collapse" id="persons">
                <ul class="nav flex-column nav-sub-menu">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'persons.create' }">Create New Person</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'persons.index' }">View Persons</router-link>
                    </li>
                </ul>
            </div>

            <li class="nav-item">
                <a class="nav-link" href="#ched-scholars" data-toggle="collapse" aria-expanded="false" aria-controls="ched-scholars">
                    CHED Scholars <i class="float-right fas fa-caret-down"></i>
                </a>
            </li>
            <div class="collapse" id="ched-scholars">
                <ul class="nav flex-column nav-sub-menu">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'ched-scholars.create' }">Create New Ched Scholar</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'ched-scholars.index' }">View Ched Scholars</router-link>
                    </li>
                </ul>
            </div>

            <li class="nav-item">
                <a class="nav-link" href="#medical-assistance" data-toggle="collapse" aria-expanded="false" aria-controls="medical-assistance">
                    Medical Assistance <i class="float-right fas fa-caret-down"></i>
                </a>
            </li>
            <div class="collapse" id="medical-assistance">
                <ul class="nav flex-column nav-sub-menu">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'medical-assistance.create' }">Create New Medical Assistance</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'medical-assistance.index' }">View Medical Assistance</router-link>
                    </li>
                </ul>
            </div>

            <li class="nav-item">
                <a class="nav-link" href="#burials" data-toggle="collapse" aria-expanded="false" aria-controls="burials">
                    Burials <i class="float-right fas fa-caret-down"></i>
                </a>
            </li>
            <div class="collapse" id="burials">
                <ul class="nav flex-column nav-sub-menu">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'burials.create' }">Create New Burial</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'burials.index' }">View Burials</router-link>
                    </li>
                </ul>
            </div>


            <li class="nav-item">
                <span class="nav-link main-title">Queuing</span>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'queues.ched' }">CHED</router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'queues.medical' }">Medical</router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'queues.solicitation' }">Solicitation</router-link>
            </li>

            <li class="nav-item">
                <span class="nav-link main-title">Administration</span>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#users" data-toggle="collapse" aria-expanded="false" aria-controls="users">
                    Users <i class="float-right fas fa-caret-down"></i>
                </a>
            </li>
            <div class="collapse" id="users">
                <ul class="nav flex-column nav-sub-menu">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'users.create' }">Create New User</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'users.index' }">View Users</router-link>
                    </li>
                </ul>
            </div>
            <li class="nav-item">
                <a class="nav-link" href="#roles" data-toggle="collapse" aria-expanded="false" aria-controls="roles">
                    Roles <i class="float-right fas fa-caret-down"></i>
                </a>
            </li>
            <div class="collapse" id="roles">
                <ul class="nav flex-column nav-sub-menu">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'roles.create' }">Create New Role</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'roles.index' }">View Roles</router-link>
                    </li>
                </ul>
            </div>
        </ul>
    </div>
</template>

<script>
    export default {
        data() {
            return {}
        }
    }
</script>
