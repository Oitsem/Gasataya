import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

const Home = () => import('./views/Home');

/**
 * Medical Assistance
 * 
 */
const MedicalAssistanceIndex = () => import('./views/medical_assistance/Index');
const MedicalAssistanceCreate = () => import('./views/medical_assistance/Create');
const MedicalAssistanceView = () => import('./views/medical_assistance/View');
const MedicalAssistanceEdit = () => import('./views/medical_assistance/Edit');

/**
 * Users
 * 
 */
const UsersIndex = () => import('./views/users/Index');
const UsersCreate = () => import('./views/users/Create');
const UsersView = () => import('./views/users/View');
const UsersEdit = () => import('./views/users/Edit');

/**
 * Persons
 * 
 */
const PersonsIndex = () => import('./views/persons/Index');
const PersonsCreate = () => import('./views/persons/Create');
const PersonsView = () => import('./views/persons/View');
const PersonsEdit = () => import('./views/persons/Edit');

/**
 * Queues
 * 
 */
const QueuesChed = () => import('./views/queues/Ched');
const QueuesMedical = () => import('./views/queues/Medical');
const QueuesSolicitation = () => import('./views/queues/Solicitation');

const router = new Router({
  mode: 'history',
  routes: [
    // Home
    { path: '/', name: 'home', component: Home },

    // Medical Assistance
    { path: '/medical-assistance', name: 'medical-assistance.index', component: MedicalAssistanceIndex },
    { path: '/medical-assistance/create', name: 'medical-assistance.create', component: MedicalAssistanceCreate },
    { path: '/medical-assistance/:id', name: 'medical-assistance.view', component: MedicalAssistanceView },
    { path: '/medical-assistance/:id/edit', name: 'medical-assistance.edit', component: MedicalAssistanceEdit },

    // Persons
    { path: '/persons', name: 'persons.index', component: PersonsIndex },
    { path: '/persons/create', name: 'persons.create', component: PersonsCreate },
    { path: '/persons/:id', name: 'persons.view', component: PersonsView },
    { path: '/persons/:id/edit', name: 'persons.edit', component: PersonsEdit },

    // Queues
    { path: '/queues/ched', name: 'queues.ched', component: QueuesChed },
    { path: '/queues/medical', name: 'queues.medical', component: QueuesMedical },
    { path: '/queues/solicitation', name: 'queues.solicitation', component: QueuesSolicitation },

    // Users
    { path: '/users', name: 'users.index', component: UsersIndex },
    { path: '/users/create', name: 'users.create', component: UsersCreate },
    { path: '/users/:id', name: 'users.view', component: UsersView },
    { path: '/users/:id/edit', name: 'users.edit', component: UsersEdit }
  ]
});

export default router;
