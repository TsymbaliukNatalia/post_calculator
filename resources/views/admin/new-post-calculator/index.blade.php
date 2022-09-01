@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.admin-user.actions.index'))

@section('body')

    <new-post-calculator-form
        :action="'{{ url('admin/admin-users') }}'"
        :cities="{{ $cities }}"
        :service-types="{{ $serviceTypes }}"
        :cargo-types="{{ $cargoTypes }}"

        inline-template>

        <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="action">
            <div class="card-body">

                <div class="form-group row align-items-center"
                     :class="{'has-danger': errors.has('CitySender'), 'has-success': fields.CitySender && fields.CitySender.valid }">
                    <label for="city_sender" class="col-form-label text-md-right"
                           :class="isFormLocalized ? 'col-md-2' : 'col-md-1'">{{ trans('admin.investigation.columns.category') }}</label>
                    <div :class="isFormLocalized ? 'col-md-2' : 'col-md-5 col-xl-4'">
                        <multiselect v-model="form.CitySender" placeholder="{{trans("placeholders.select_category")}}" :options="cities" label="Description"
                                     track-by="Ref" open-direction="bottom"></multiselect>
                        <div v-if="errors.has('CitySender')" class="form-control-feedback form-text" v-cloak>@{{
                            errors.first('CitySender')
                            }}
                        </div>
                    </div>

                </div>
                <div class="form-group row align-items-center"
                     :class="{'has-danger': errors.has('CityRecipient'), 'has-success': fields.CityRecipient && fields.CityRecipient.valid }">

                    <label for="city_recipient" class="col-form-label text-md-right"
                           :class="isFormLocalized ? 'col-md-2' : 'col-md-1'">{{ trans('admin.investigation.columns.category') }}</label>
                    <div :class="isFormLocalized ? 'col-md-2' : 'col-md-5 col-xl-4'">
                        <multiselect v-model="form.CityRecipient" placeholder="{{trans("placeholders.select_category")}}" :options="cities" label="Description"
                                     track-by="Ref" open-direction="bottom"></multiselect>
                        <div v-if="errors.has('CityRecipient')" class="form-control-feedback form-text" v-cloak>@{{
                            errors.first('CityRecipient')
                            }}
                        </div>
                    </div>
                </div>

                <div class="form-group row align-items-center"
                     :class="{'has-danger': errors.has('ServiceType'), 'has-success': fields.ServiceType && fields.ServiceType.valid }">

                    <label for="service_type" class="col-form-label text-md-right"
                           :class="isFormLocalized ? 'col-md-2' : 'col-md-1'">{{ trans('admin.investigation.columns.category') }}</label>
                    <div :class="isFormLocalized ? 'col-md-2' : 'col-md-5 col-xl-4'">
                        <multiselect v-model="form.ServiceType" placeholder="{{trans("placeholders.select_category")}}" :options="serviceTypes" label="Description"
                                     track-by="Ref" open-direction="bottom"></multiselect>
                        <div v-if="errors.has('ServiceType')" class="form-control-feedback form-text" v-cloak>@{{
                            errors.first('ServiceType')
                            }}
                        </div>
                    </div>
                </div>

                <div class="form-group row align-items-center"
                     :class="{'has-danger': errors.has('CargoType'), 'has-success': fields.CargoType && fields.CargoType.valid }">

                    <label for="cargo_type" class="col-form-label text-md-right"
                           :class="isFormLocalized ? 'col-md-2' : 'col-md-1'">{{ trans('admin.investigation.columns.category') }}</label>
                    <div :class="isFormLocalized ? 'col-md-2' : 'col-md-5 col-xl-4'">
                        <multiselect v-model="form.CargoType" placeholder="{{trans("placeholders.select_category")}}" :options="cargoTypes" label="Description"
                                     track-by="Ref" open-direction="bottom"></multiselect>
                        <div v-if="errors.has('CargoType')" class="form-control-feedback form-text" v-cloak>@{{
                            errors.first('CargoType')
                            }}
                        </div>
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

        </form>

    </new-post-calculator-form>

@endsection
