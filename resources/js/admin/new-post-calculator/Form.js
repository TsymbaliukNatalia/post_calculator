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
                CitySender:  null,
                CityRecipient :  null,
                ServiceType : null,
                CargoType : null,
                Weigth: 0.1,
                NumberSeats: 1,
                Cost : 600
            },
            senderCitiesLocal: this.senderCities,
            recipientCitiesLocal: this.recipientCities,
            showCost : false,
            cost : null,
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
        },
        onSuccess: function onSuccess(data) {
            this.submiting = false;
            if(data.result[0].Cost){
                this.showCost = true;
                this.cost = data.result[0].Cost;
            }
        },
        reset: function () {
            this.setDefaultServiceTypeValue();
            this.setDefaultCargoTypeValue();
            this.form.CitySender = null;
            this.form.CityRecipient = null;
            this.form.Weigth = 0.1;
            this.form.NumberSeats = 1;
            this.form.Cost = 600;
            this.showCost = false;
            this.submiting = false;
            this.$validator.reset();
        },
        setDefaultServiceTypeValue: function () {
            this.form.ServiceType = this.serviceTypes.find(option => option.Description === 'Відділення-Відділення');
        },
        setDefaultCargoTypeValue: function () {
            this.form.CargoType = this.cargoTypes.find(option => option.Description === 'Посилка');
        }
    },
    mounted() {
        this.setDefaultServiceTypeValue();
        this.setDefaultCargoTypeValue();
    }
});
