import AppForm from '../app-components/Form/AppForm';

Vue.component('new-post-calculator-form', {
    mixins: [AppForm],
    props: [
        'cities',
        'serviceTypes',
        'cargoTypes'
    ],
    data: function() {
        return {
            form: {
                CitySender:  '' ,
                CityRecipient :  '' ,
                ServiceType : '',
                CargoType : '',
            }
        }
    }
});
