@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.admin-user.actions.index'))

@section('body')

    <new-post-calculator-form
        :action="'{{ url('admin/admin-users') }}'"
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
                    <div class="col-5">
                        <label for="city_sender"
                               class="text-md-right">{{ trans("post-calculator.form.city-sender") }}</label>
                        <div>
                            <multiselect v-model="form.CitySender" @search-change="setCitySenders($event)"
                                         placeholder="{{ trans("post-calculator.form.city-placeholder") }}"
                                         :options="senderCitiesLocal" label="Description"
                                         track-by="Ref" open-direction="bottom"></multiselect>
                            <div v-if="errors.has('CitySender')" class="form-control-feedback form-text" v-cloak>@{{
                                errors.first('CitySender')
                                }}
                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <label for="city_recipient"
                               class="text-md-right">{{ trans("post-calculator.form.city-recipient") }}</label>
                        <div>
                            <multiselect v-model="form.CityRecipient" @search-change="setCityRecipients($event)"
                                         placeholder="{{ trans("post-calculator.form.city-placeholder") }}"
                                         :options="recipientCitiesLocal" label="Description"
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
                    <div class="col-5">
                        <div>
                            <multiselect v-model="form.ServiceType"
                                         placeholder="{{trans("placeholders.select_category")}}" :options="serviceTypes"
                                         label="Description"
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
                    <div class="col-5">
                        <multiselect v-model="form.CargoType" placeholder="{{trans("placeholders.select_category")}}"
                                     :options="cargoTypes" label="Description"
                                     track-by="Ref" open-direction="bottom"></multiselect>
                        <div v-if="errors.has('CargoType')" class="form-control-feedback form-text" v-cloak>@{{
                            errors.first('CargoType')
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
            </div>

        </form>

    </new-post-calculator-form>

@endsection
