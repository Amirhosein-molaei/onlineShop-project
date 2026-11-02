@extends('app.layouts.master')
@section('title', 'پروفایل')

@section('content')

    <!-- start body -->
    <section class="">
        <section id="main-body-two-col" class="container-xxl body-container">
            <section class="row">
                <aside id="sidebar" class="sidebar col-md-3">


                    <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
                        @include('app.profile.partials.sidebar')
                    </section>

                </aside>
                <main id="main-body" class="main-body col-md-9">
                    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">

                        @if (session('success'))
                            <section class="alert alert-success">
                                {{ session('success') }}
                            </section>
                        @endif
                        <!-- start vontent header -->
                        <section class="content-header mb-4">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>آدرس های من</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- end vontent header -->



                        <section class="my-addresses">
                            @foreach ($user->addresses as $address)
                                <section class="my-address-wrapper mb-2 p-2">
                                    <section class="mb-2">
                                        <i class="fa fa-map-marker-alt mx-1"></i>
                                        {{ $address->city->province->name . '/' . $address->city->name . '/' . $address->address }}
                                    </section>
                                    <section class="mb-2">
                                        <i class="fa fa-user-tag mx-1"></i>
                                        گیرنده : {{ $address->user->name }}
                                    </section>
                                    <section class="mb-2">
                                        <i class="fa fa-mobile-alt mx-1"></i>
                                        موبایل گیرنده : {{ $address->user->mobile }}
                                    </section>
                                    <section class="mb-2">
                                        <i class="fa fa-building mx-1"></i>
                                        پلاک {{ $address->no }} - واحد {{ $address->unit }}
                                    </section>
                                    <form action="{{ route('profile.address.destroy', $address) }}" method="post"
                                        class="mt-3">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash"></i> حذف آدرس
                                        </button>
                                    </form>
                                    <a class="" data-bs-toggle="modal" data-bs-target="#edit-address{{$address->id}}"
                                        href="#"><i class="fa fa-edit"></i> ویرایش آدرس</a>
                                    <section class="address-add-wrapper">
                                        <!-- start add address Modal -->
                                        <section class="modal fade" id="edit-address{{$address->id}}" tabindex="-1"
                                            aria-labelledby="add-address-label" aria-hidden="true">
                                            <section class="modal-dialog">
                                                <section class="modal-content">
                                                    <section class="modal-header">
                                                        <h5 class="modal-title" id="add-address-label"><i
                                                                class="fa fa-edit"></i>
                                                            ویرایش آدرس</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </section>
                                                    <section class="modal-body">
                                                        <form class="row"
                                                            action="{{ route('profile.address.update', $address) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <section class="col-6 mb-2">
                                                                <label for="province_id_edit"
                                                                    class="form-label mb-1">استان</label>
                                                                <select class="form-select form-select-sm"
                                                                    name="province_id" id="province_id_edit">
                                                                    <option selected>استان را انتخاب کنید</option>
                                                                    @foreach ($provinces as $province)
                                                                        <option value="{{ $province->id }}">
                                                                            {{ $province->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </section>

                                                            <section class="col-6 mb-2">
                                                                <label for="city_id_edit"
                                                                    class="form-label mb-1">شهر</label>
                                                                <select name="city_id" class="form-select form-select-sm"
                                                                    id="city_id_edit">
                                                                    <option value="" selected>ابتدا استان را انتخاب
                                                                        کنید
                                                                    </option>
                                                                </select>
                                                            </section>
                                                            <section class="col-12 mb-2">
                                                                <label for="address" class="form-label mb-1">نشانی</label>
                                                                <input type="text" name="address"
                                                                    class="form-control form-control-sm" id="address"
                                                                    value="{{ $address->address }}">
                                                            </section>

                                                            <section class="col-6 mb-2">
                                                                <label for="postal_code" class="form-label mb-1">کد
                                                                    پستی</label>
                                                                <input type="text" name="postal_code"
                                                                    class="form-control form-control-sm" id="postal_code"
                                                                    value="{{ $address->postal_code }}">
                                                            </section>

                                                            <section class="col-3 mb-2">
                                                                <label for="no" class="form-label mb-1">پلاک</label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                    id="no" name="no"
                                                                    value="{{ $address->no }}">
                                                            </section>

                                                            <section class="col-3 mb-2">
                                                                <label for="unit" class="form-label mb-1">واحد</label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                    id="unit" name="unit"
                                                                    value="{{ $address->unit }}">
                                                            </section>

                                                            <button type="submit"
                                                                class="btn btn-sm btn-primary w-50 mt-2 mx-auto">ویرایش
                                                                آدرس</button>
                                                        </form>
                                                    </section>
                                                    <section class="modal-footer py-1">
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            data-bs-dismiss="modal">بستن</button>
                                                    </section>
                                                </section>
                                            </section>
                                        </section>
                                        <!-- end add address Modal -->
                                    </section>
                                </section>
                            @endforeach
                            <span class="address-selected">کالاها به این آدرس ارسال می شوند</span>

                            <section class="address-add-wrapper">
                                <button class="address-add-button" type="button" data-bs-toggle="modal"
                                    data-bs-target="#add-address"><i class="fa fa-plus"></i> ایجاد آدرس جدید</button>
                                <!-- start add address Modal -->
                                <section class="modal fade" id="add-address" tabindex="-1"
                                    aria-labelledby="add-address-label" aria-hidden="true">
                                    <section class="modal-dialog">
                                        <section class="modal-content">
                                            <section class="modal-header">
                                                <h5 class="modal-title" id="add-address-label"><i class="fa fa-plus"></i>
                                                    ایجاد آدرس جدید</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </section>
                                            <section class="modal-body">
                                                <form class="row" action="{{ route('profile.address.store') }}"
                                                    method="post">
                                                    @csrf
                                                    <section class="col-6 mb-2">
                                                        <label for="province_id_create"
                                                            class="form-label mb-1">استان</label>
                                                        <select class="form-select form-select-sm" name="province_id"
                                                            id="province_id_create">
                                                            <option selected>استان را انتخاب کنید</option>
                                                            @foreach ($provinces as $province)
                                                                <option value="{{ $province->id }}">
                                                                    {{ $province->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </section>

                                                    <section class="col-6 mb-2">
                                                        <label for="city_id_create" class="form-label mb-1">شهر</label>
                                                        <select name="city_id" class="form-select form-select-sm"
                                                            id="city_id_create">
                                                            <option value="" selected>ابتدا استان را انتخاب
                                                                کنید
                                                            </option>
                                                        </select>
                                                    </section>
                                                    <section class="col-12 mb-2">
                                                        <label for="address" class="form-label mb-1">نشانی</label>
                                                        <input type="text" name="address"
                                                            class="form-control form-control-sm" id="address"
                                                            placeholder="نشانی">
                                                    </section>

                                                    <section class="col-6 mb-2">
                                                        <label for="postal_code" class="form-label mb-1">کد
                                                            پستی</label>
                                                        <input type="text" name="postal_code"
                                                            class="form-control form-control-sm" id="postal_code"
                                                            placeholder="کد پستی">
                                                    </section>

                                                    <section class="col-3 mb-2">
                                                        <label for="no" class="form-label mb-1">پلاک</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            id="no" name="no" placeholder="پلاک">
                                                    </section>

                                                    <section class="col-3 mb-2">
                                                        <label for="unit" class="form-label mb-1">واحد</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            id="unit" name="unit" placeholder="واحد">
                                                    </section>

                                                    <button type="submit"
                                                        class="btn btn-sm btn-primary w-50 mt-2 mx-auto">ثبت
                                                        آدرس</button>
                                                </form>
                                            </section>
                                            <section class="modal-footer py-1">
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    data-bs-dismiss="modal">بستن</button>
                                            </section>
                                        </section>
                                    </section>
                                </section>
                                <!-- end add address Modal -->
                            </section>

                        </section>


                    </section>
                </main>
            </section>
        </section>
    </section>
    <!-- end body -->
@endsection

@section('scripts')
    @parent
    <script>
        document.getElementById('province_id_edit').addEventListener('change', function() {
            handleProvinceChange(this.value, 'city_id_edit');
        });

        document.getElementById('province_id_create').addEventListener('change', function() {
            handleProvinceChange(this.value, 'city_id_create');
        });

        function handleProvinceChange(provinceId, citySelectId) {
            const citySelect = document.getElementById(citySelectId);

            citySelect.innerHTML = '<option value="" selected>در حال بارگذاری...</option>';

            if (!provinceId) {
                citySelect.innerHTML = '<option value="" selected>ابتدا استان را انتخاب کنید</option>';
                return;
            }

            fetch(`/get-cities/${provinceId}`)
                .then(response => response.json())
                .then(data => {
                    citySelect.innerHTML = '<option value="" selected>شهر را انتخاب کنید</option>';
                    data.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.id;
                        option.textContent = city.name;
                        citySelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching cities:', error);
                    citySelect.innerHTML = '<option value="" selected>خطا در بارگذاری شهرها</option>';
                });
        }
    </script>

@show
