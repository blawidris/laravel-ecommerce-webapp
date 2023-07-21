@extends('layouts.master')

@section('pageTitle', $pageTitle)

@section('content')
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">

        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">



                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Edit Category
                    </h1>
                    <!--end::Title-->


                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="index.html" class="text-muted text-hover-primary">
                                Home </a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->

                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            eCommerce </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->

                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            Catalog </li>
                        <!--end::Item-->

                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->

            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->

        <!--begin::Content-->
        <div id="kt_app_content" class="app-content  flex-column-fluid ">


            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container  container-xxl ">
                <form id="kt_ecommerce_add_category_form" class="form d-flex flex-column flex-lg-row"
                    data-kt-redirect="{{ route('categories') }}">

                    @csrf
                    @method('PUT')

                    {{-- @dd($category) --}}
                    <input type="hidden" name="id" value="{{ $category->id }}">


                    <!--begin::Aside column-->
                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                        <!--begin::Thumbnail settings-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>Thumbnail</h2>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body text-center pt-0">
                                <!--begin::Image input-->

                                <!--begin::Image input-->
                                <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3"
                                    data-kt-image-input="true">
                                    <!--begin::Preview existing avatar-->
                                    <div class="image-input-wrapper w-150px h-150px"
                                        style="background-image: url({{ asset('storage/' . $category->thumbnail ?? 'assets/media/svg/files/blank-image.svg') }})">
                                    </div>
                                    <!--end::Preview existing avatar-->

                                    <!--begin::Label-->
                                    <label
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                        <!--begin::Icon-->
                                        <i class="ki-duotone ki-pencil fs-7"><span class="path1"></span><span
                                                class="path2"></span></i>
                                        <!--end::Icon-->

                                        <!--begin::Inputs-->
                                        <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="avatar_remove" />
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Label-->

                                    <!--begin::Cancel-->
                                    <span
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                        <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span
                                                class="path2"></span></i> </span>
                                    <!--end::Cancel-->

                                    <!--begin::Remove-->
                                    <span
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                        <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span
                                                class="path2"></span></i> </span>
                                    <!--end::Remove-->
                                </div>
                                <!--end::Image input-->

                                <!--begin::Description-->
                                <div class="text-muted fs-7">Set the category thumbnail image. Only *.png, *.jpg
                                    and *.jpeg image files are accepted</div>
                                <!--end::Description-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Thumbnail settings-->
                        <!--begin::Status-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>Status</h2>
                                </div>
                                <!--end::Card title-->

                                <!--begin::Card toolbar-->
                                <div class="card-toolbar">
                                    <div class="rounded-circle bg-success w-15px h-15px"
                                        id="kt_ecommerce_add_category_status" data-catgory-status="{{ $category->status }}">
                                    </div>
                                </div>
                                <!--begin::Card toolbar-->
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Select2-->
                                <select class="form-select mb-2" data-control="select2" data-hide-search="true"
                                    data-placeholder="Select an option" id="kt_ecommerce_add_category_status_select"
                                    name="status">
                                    <option></option>
                                    <option value="published" {{ $category->status == 'published' ? 'selected ' : '' }}>
                                        Published
                                    </option>
                                    <option value="scheduled" {{ $category->status == 'scheduled' ? 'selected ' : '' }}>
                                        Scheduled
                                    </option>
                                    <option value="unpublished" {{ $category->status == 'unpublished' ? 'selected ' : '' }}>
                                        Unpublished</option>
                                </select>
                                <!--end::Select2-->

                                <!--begin::Description-->
                                <div class="text-muted fs-7">Set the category status.</div>
                                <!--end::Description-->

                                <!--begin::Datepicker-->
                                <div class="{{ $category->status == 'scheduled' ? 'd-block' : 'd-none' }}  mt-10">
                                    <label for="kt_ecommerce_add_category_status_datepicker" class="form-label">Select
                                        publishing date and time</label>

                                    <input class="form-control" id="kt_ecommerce_add_category_status_datepicker"
                                        placeholder="Pick date & time" value="{{ $category->published_date ?? '' }}"
                                        name="published_date" data-kt-date="{{ $category->published_date ?? '' }}" />
                                </div>
                                <!--end::Datepicker-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Status-->
                    </div>
                    <!--end::Aside column-->

                    <!--begin::Main column-->
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <!--begin::General options-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>General</h2>
                                </div>
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row">
                                    <!--begin::Label-->
                                    <label class="required form-label">Category Name</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" name="category_name" class="form-control mb-2"
                                        placeholder="Category name" value="{{ $category->name }}" />
                                    <!--end::Input-->

                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">A category name is required and recommended to be
                                        unique.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div>
                                    <!--begin::Label-->
                                    <label class="form-label">Description</label>
                                    <!--end::Label-->

                                    <!--begin::Editor-->
                                    <div id="kt_ecommerce_add_category_description"
                                        name="kt_ecommerce_add_category_description" class="min-h-200px mb-2">
                                        {{ $category->description }}
                                    </div>
                                    <input type="hidden" name="description"
                                        id="kt_ecommerce_add_category_description_input"
                                        value="{{ $category->description }}">

                                    <!--end::Editor-->

                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set a description to the category for better
                                        visibility.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Card header-->
                        </div>
                        <!--end::General options-->
                        <!--begin::Meta options-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Meta Options</h2>
                                </div>
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label">Meta Tag Title</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" class="form-control mb-2" name="meta_title"
                                        placeholder="Meta tag name" value="{{ $category->meta_tag->title ?? '' }}" />
                                    <!--end::Input-->

                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set a meta tag title. Recommended to be simple
                                        and precise keywords.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label">Meta Tag Description</label>
                                    <!--end::Label-->

                                    <input type="hidden" name="meta_description"
                                        id="kt_ecommerce_add_category_meta_description_input">

                                    <!--begin::Editor-->
                                    <div id="kt_ecommerce_add_category_meta_description"
                                        name="kt_ecommerce_add_category_meta_description" class="min-h-100px mb-2"></div>
                                    <!--end::Editor-->

                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set a meta tag description to the category for
                                        increased SEO ranking.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div>
                                    <!--begin::Label-->
                                    <label class="form-label">Meta Tag Keywords</label>
                                    <!--end::Label-->

                                    <!--begin::Editor-->
                                    <input id="kt_ecommerce_add_category_meta_keywords" name="meta_keywords"
                                        class="form-control mb-2" value="{{ $category->meta_tag->keywords ?? '' }}" />
                                    <!--end::Editor-->

                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set a list of keywords that the category is
                                        related to. Separate the keywords by adding a comma <code>,</code> between
                                        each keyword.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Card header-->
                        </div>
                        <!--end::Meta options-->

                        <!--begin::Automation-->
                        {{-- <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Automation</h2>
                                </div>
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div>
                                    <!--begin::Label-->
                                    <label class="form-label mb-5">Product assignment method</label>
                                    <!--end::Label-->

                                    <!--begin::Methods-->
                                    <!--begin::Input row-->
                                    <div class="d-flex fv-row">
                                        <!--begin::Radio-->
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="method" type="radio"
                                                value="0" id="kt_ecommerce_add_category_automation_0" />
                                            <!--end::Input-->

                                            <!--begin::Label-->
                                            <label class="form-check-label" for="kt_ecommerce_add_category_automation_0">
                                                <div class="fw-bold text-gray-800">Manual</div>
                                                <div class="text-gray-600">Add products to this category one by
                                                    one by manually selecting this category during product creation
                                                    or update.</div>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Radio-->
                                    </div>
                                    <!--end::Input row-->

                                    <div class='separator separator-dashed my-5'></div>
                                    <!--begin::Input row-->
                                    <div class="d-flex fv-row">
                                        <!--begin::Radio-->
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="method" type="radio"
                                                value="1" id="kt_ecommerce_add_category_automation_1"
                                                checked='checked' />
                                            <!--end::Input-->

                                            <!--begin::Label-->
                                            <label class="form-check-label" for="kt_ecommerce_add_category_automation_1">
                                                <div class="fw-bold text-gray-800">Automatic</div>
                                                <div class="text-gray-600">Products matched with the following
                                                    conditions will be automatically assigned to this category.
                                                </div>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Radio-->
                                    </div>
                                    <!--end::Input row-->

                                    <!--end::Methods-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class=" mt-10" data-kt-ecommerce-catalog-add-category="auto-options">
                                    <!--begin::Label-->
                                    <label class="form-label">Conditions</label>
                                    <!--end::Label-->

                                    <!--begin::Conditions-->
                                    <div class="d-flex flex-wrap align-items-center text-gray-600 gap-5 mb-7">
                                        <span>Products must match:</span>

                                        <!--begin::Radio-->
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" name="conditions"
                                                value="" id="all_conditions" checked="checked" />
                                            <label class="form-check-label" for="all_conditions">
                                                All conditions
                                            </label>
                                        </div>
                                        <!--end::Radio-->

                                        <!--begin::Radio-->
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" name="conditions"
                                                value="" id="any_conditions" />
                                            <label class="form-check-label" for="any_conditions">
                                                Any conditions
                                            </label>
                                        </div>
                                        <!--end::Radio-->
                                    </div>
                                    <!--end::Conditions-->

                                    <!--begin::Repeater-->
                                    <div id="kt_ecommerce_add_category_conditions">
                                        <!--begin::Form group-->
                                        <div class="form-group">
                                            <div data-repeater-list="kt_ecommerce_add_category_conditions"
                                                class="d-flex flex-column gap-3">
                                                <div data-repeater-item
                                                    class="form-group d-flex flex-wrap align-items-center gap-5">
                                                    <!--begin::Select2-->
                                                    <div class="w-100 w-md-200px">
                                                        <select class="form-select" name="condition_type"
                                                            data-placeholder="Select an option"
                                                            data-kt-ecommerce-catalog-add-category="condition_type">
                                                            <option></option>
                                                            <option value="title">Product Title</option>
                                                            <option value="tag" selected>Product Tag</option>
                                                            <option value="price">Prodict Price</option>
                                                        </select>
                                                    </div>
                                                    <!--end::Select2-->

                                                    <!--begin::Select2-->
                                                    <div class="w-100 w-md-200px">
                                                        <select class="form-select" name="condition_equals"
                                                            data-placeholder="Select an option"
                                                            data-kt-ecommerce-catalog-add-category="condition_equals">
                                                            <option></option>
                                                            <option value="equal" selected>is equal to</option>
                                                            <option value="notequal">is not equal to</option>
                                                            <option value="greater">is greater than</option>
                                                            <option value="less">is less than</option>
                                                            <option value="starts">starts with</option>
                                                            <option value="ends">ends with</option>
                                                        </select>
                                                    </div>
                                                    <!--end::Select2-->

                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control mw-100 w-200px"
                                                        name="condition_label" placeholder="" />
                                                    <!--end::Input-->

                                                    <!--begin::Button-->
                                                    <button type="button" data-repeater-delete
                                                        class="btn btn-sm btn-icon btn-light-danger">
                                                        <i class="ki-duotone ki-cross fs-2"><span
                                                                class="path1"></span><span class="path2"></span></i>
                                                    </button>
                                                    <!--end::Button-->
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Form group-->

                                        <!--begin::Form group-->
                                        <div class="form-group mt-5">
                                            <!--begin::Button-->
                                            <button type="button" data-repeater-create
                                                class="btn btn-sm btn-light-primary">
                                                <i class="ki-duotone ki-plus fs-2"></i> Add another condition
                                            </button>
                                            <!--end::Button-->
                                        </div>
                                        <!--end::Form group-->
                                    </div>
                                    <!--end::Repeater-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Card header-->
                        </div> --}}
                        <!--end::Automation-->

                        <div class="d-flex justify-content-end">
                            <!--begin::Button-->
                            <a href="products.html" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">
                                Cancel
                            </a>
                            <!--end::Button-->

                            <!--begin::Button-->
                            <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                                <span class="indicator-label">
                                    Save Changes
                                </span>
                                <span class="indicator-progress">
                                    Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                            <!--end::Button-->
                        </div>
                    </div>
                    <!--end::Main column-->
                </form>
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
@endsection


@section('custom-js')
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <!--end::Vendors Javascript-->

    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('assets/js/custom/apps/ecommerce/catalog/save-category.js') }}"></script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
@endsection
