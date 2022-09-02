@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.admin-user.actions.index'))

@section('body')

    <new-post-calculator-form
        :action="'{{ url('admin/new-post-calculator/calculate') }}'"
        :sender-cities="{{ $cities }}"
        :recipient-cities="{{ $cities }}"
        :service-types="{{ $serviceTypes }}"
        :cargo-types="{{ $cargoTypes }}"

        inline-template>

        <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="action">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-2">
                        <h3>{{ trans("post-calculator.form.route") }}</h3>
                    </div>
                    <div class="col-5" :class="{'has-danger': errors.has(`CitySender`) }">
                        <label for="city_sender"
                               class="text-md-right">{{ trans("post-calculator.form.city-sender") }}</label>
                        <div>
                            <multiselect v-model="form.CitySender" @search-change="setCitySenders($event)"
                                         placeholder="{{ trans("post-calculator.form.city-placeholder") }}"
                                         v-validate="'required'"
                                         name="CitySender"
                                         :options="senderCitiesLocal" label="Description"
                                         track-by="Ref" open-direction="bottom"></multiselect>
                            <div v-if="errors.has('CitySender')" class="form-control-feedback form-text" v-cloak>@{{
                                errors.first('CitySender')
                                }}
                            </div>
                        </div>
                    </div>
                    <div class="col-5" :class="{'has-danger': errors.has(`CityRecipient`) }">
                        <label for="city_recipient"
                               class="text-md-right">{{ trans("post-calculator.form.city-recipient") }}</label>
                        <div>
                            <multiselect v-model="form.CityRecipient" @search-change="setCityRecipients($event)"
                                         placeholder="{{ trans("post-calculator.form.city-placeholder") }}"
                                         :options="recipientCitiesLocal" label="Description"
                                         v-validate="'required'"
                                         name="CityRecipient"
                                         track-by="Ref" open-direction="bottom"></multiselect>
                            <div v-if="errors.has('CityRecipient')" class="form-control-feedback form-text" v-cloak>@{{
                                errors.first('CityRecipient')
                                }}
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row mb-3">
                    <div class="col-2">
                        <h3>{{ trans("post-calculator.form.service-type") }}</h3>
                    </div>
                    <div class="col-5" :class="{'has-danger': errors.has(`ServiceType`) }">
                        <div>
                            <multiselect v-model="form.ServiceType"
                                         placeholder="{{ trans("post-calculator.form.service-type") }}" :options="serviceTypes"
                                         label="Description"
                                         v-validate="'required'"
                                         name="ServiceType"
                                         track-by="Ref" open-direction="bottom"></multiselect>
                            <div v-if="errors.has('ServiceType')" class="form-control-feedback form-text" v-cloak>@{{
                                errors.first('ServiceType')
                                }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-2">
                        <h3>{{ trans("post-calculator.form.cargo-type") }}</h3>
                    </div>
                    <div class="col-5" :class="{'has-danger': errors.has(`CargoType`) }">
                        <multiselect v-model="form.CargoType" placeholder="{{ trans("post-calculator.form.cargo-type") }}"
                                     :options="cargoTypes" label="Description"
                                     v-validate="'required'"
                                     name="CargoType"
                                     track-by="Ref" open-direction="bottom"></multiselect>
                        <div v-if="errors.has('CargoType')" class="form-control-feedback form-text" v-cloak>@{{
                            errors.first('CargoType')
                            }}
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-2">
                        <h3>{{ trans("post-calculator.form.weight") }}</h3>
                    </div>
                    <div class="col-5" :class="{'has-danger': errors.has(`Weigth`) }">
                        <input type="number" v-model="form.Weigth" v-validate="'required'" @input="validate($event)"
                               class="form-control"
                               min="0.1"
                               :step="0.1"
                               :class="{'form-control-danger': errors.has('Weigth'), 'form-control-success': fields.Weigth && fields.Weigth.valid}"
                               id="Weigth" name="Weigth" >
                        <div v-if="errors.has('Weigth')" class="form-control-feedback form-text" v-cloak>@{{
                            errors.first('Weigth')
                            }}
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-2">
                        <h3>{{ trans("post-calculator.form.number-seats") }}</h3>
                    </div>
                    <div class="col-5" :class="{'has-danger': errors.has(`NumberSeats`) }">
                        <input type="number" v-model="form.NumberSeats" v-validate="'required|integer'" @input="validate($event)"
                               class="form-control"
                               min="1"
                               :class="{'form-control-danger': errors.has('NumberSeats'), 'form-control-success': fields.NumberSeats && fields.NumberSeats.valid}"
                               id="NumberSeats" name="NumberSeats" >
                        <div v-if="errors.has('NumberSeats')" class="form-control-feedback form-text" v-cloak>@{{
                            errors.first('NumberSeats')
                            }}
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-2">
                        <h3>{{ trans("post-calculator.form.cost") }}</h3>
                    </div>
                    <div class="col-5" :class="{'has-danger': errors.has(`Cost`) }">
                        <input type="number" v-model="form.Cost" v-validate="'required'" @input="validate($event)"
                               class="form-control"
                               min="1"
                               :class="{'form-control-danger': errors.has('Cost'), 'form-control-success': fields.Cost && fields.Cost.valid}"
                               id="Cost" name="Cost" >
                        <div v-if="errors.has('Cost')" class="form-control-feedback form-text" v-cloak>@{{
                            errors.first('Cost')
                            }}
                        </div>
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn btn btn-outline-primary" :disabled="submiting">
                        {{ trans('post-calculator.buttons.calculate') }}
                    </button>
                    <button class="btn btn btn-outline-danger" :disabled="submiting">
                        {{ trans('post-calculator.buttons.clean') }}
                    </button>
                </div>
                <div>
                    <p class="h2 mt-3" v-if="showCost"> {{ trans('post-calculator.cost') }} - @{{ cost }} грн</p>
                </div>
            </div>
        </form>


    </new-post-calculator-form>

@endsection
