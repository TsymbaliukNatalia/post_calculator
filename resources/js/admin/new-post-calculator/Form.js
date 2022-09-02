import AppForm from '../app-components/Form/AppForm';

Vue.component('new-post-calculator-form', {
    mixins: [AppForm],
    props: [
        'senderCities',
        'recipientCities',
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
            },
            senderCitiesLocal: this.senderCities,
            recipientCitiesLocal: this.recipientCities,
        }
    },
    methods: {
        setCitySenders: function (input) {
            this.setNewCitiesProp(input, 'senderCitiesLocal');
        },
        setCityRecipients: function (input) {
            this.setNewCitiesProp(input, 'recipientCitiesLocal');
        },
        setNewCitiesProp: function (input, prop) {
            var currentUrl = window.location.pathname;

            const newCities = axios
                .get(`${currentUrl}/search-cities?name=${input}`)
                .then(function (response) {
                    return response.data;
                });

            const getNewCitiesList = async () => {
                this[prop] = await newCities;
            };

            getNewCitiesList();
        }
    }
});
