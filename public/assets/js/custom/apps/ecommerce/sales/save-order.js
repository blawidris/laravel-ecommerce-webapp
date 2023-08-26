"use strict";

// Class definition
var KTAppEcommerceSalesSaveOrder = (function () {
    // Shared variables
    var table;
    var datatable;

    // Private functions
    const initSaveOrder = () => {
        // Init flatpickr
        $("#kt_ecommerce_edit_order_date").flatpickr({
            altInput: true,
            altFormat: "d F, Y",
            dateFormat: "Y-m-d",
        });

        // Init select2 country options
        // Format options
        const optionFormat = (item) => {
            if (!item.id) {
                return item.text;
            }

            var span = document.createElement("span");
            var template = "";

            template +=
                '<img src="' +
                item.element.getAttribute("data-kt-select2-country") +
                '" class="rounded-circle h-20px me-2" alt="image"/>';
            template += item.text;

            span.innerHTML = template;

            return $(span);
        };

        $("#kt_ecommerce_edit_customer").select2({
            placeholder: "Select a Customer",
            allowClear: true,
            minimumResultsForSearch: 10,
        });

        // Init Select2 --- more info: https://select2.org/
        $("#kt_ecommerce_edit_order_billing_country").select2({
            placeholder: "Select a country",
            minimumResultsForSearch: Infinity,
            templateSelection: optionFormat,
            templateResult: optionFormat,
        });

        $("#kt_ecommerce_edit_order_shipping_country").select2({
            placeholder: "Select a country",
            minimumResultsForSearch: Infinity,
            templateSelection: optionFormat,
            templateResult: optionFormat,
        });

        // Init datatable --- more info on datatables: https://datatables.net/manual/
        table = document.querySelector(
            "#kt_ecommerce_edit_order_product_table"
        );
        datatable = $(table).DataTable({
            order: [],
            scrollY: "400px",
            scrollCollapse: true,
            paging: false,
            info: false,
            columnDefs: [
                { orderable: false, targets: 0 }, // Disable ordering on column 0 (checkbox)
            ],
        });
    };

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = () => {
        const filterSearch = document.querySelector(
            '[data-kt-ecommerce-edit-order-filter="search"]'
        );
        filterSearch.addEventListener("keyup", function (e) {
            datatable.search(e.target.value).draw();
        });
    };

    // Handle shipping form
    const handleShippingForm = () => {
        // Select elements
        const element = document.getElementById(
            "kt_ecommerce_edit_order_shipping_form"
        );
        const checkbox = document.getElementById("same_as_billing");

        // Show/hide shipping form
        checkbox.addEventListener("change", (e) => {
            if (e.target.checked) {
                element.classList.add("d-none");
            } else {
                element.classList.remove("d-none");
            }
        });
    };

    // Handle product select
    const handleProductSelect = () => {
        // Define variables
        const checkboxes = table.querySelectorAll('[type="checkbox"]');
        const target = document.getElementById(
            "kt_ecommerce_edit_order_selected_products"
        );
        const totalPrice = document.getElementById(
            "kt_ecommerce_edit_order_total_price"
        );

        // Loop through all checked products
        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener("change", (e) => {
                // Select parent row element
                const parent = checkbox.closest("tr");

                // Clone parent element as variable
                const product = parent
                    .querySelector(
                        '[data-kt-ecommerce-edit-order-filter="product"]'
                    )
                    .cloneNode(true);

                // Create inner wrapper
                const innerWrapper = document.createElement("div");

                // Store inner content
                const innerContent = product.innerHTML;

                // Add & remove classes on parent wrapper
                const wrapperClassesAdd = ["col", "my-2"];
                const wrapperClassesRemove = ["d-flex", "align-items-center"];

                // Define additional classes
                const additionalClasses = [
                    "border",
                    "border-dashed",
                    "rounded",
                    "p-3",
                    "bg-body",
                ];

                // Update parent wrapper classes
                product.classList.remove(...wrapperClassesRemove);
                product.classList.add(...wrapperClassesAdd);

                // Remove parent default content
                product.innerHTML = "";

                // Update inner wrapper classes
                innerWrapper.classList.add(...wrapperClassesRemove);
                innerWrapper.classList.add(...additionalClasses);

                // Apply stored inner content into new inner wrapper
                innerWrapper.innerHTML = innerContent;

                // Append new inner wrapper to parent wrapper
                product.appendChild(innerWrapper);

                // Get product id
                const productId = product.getAttribute(
                    "data-kt-ecommerce-edit-order-id"
                );

                if (e.target.checked) {
                    // Add product to selected product wrapper
                    target.appendChild(product);
                } else {
                    // Remove product from selected product wrapper
                    const selectedProduct = target.querySelector(
                        '[data-kt-ecommerce-edit-order-id="' + productId + '"]'
                    );
                    if (selectedProduct) {
                        target.removeChild(selectedProduct);
                    }
                }

                // Trigger empty message logic
                detectEmpty();
            });
        });

        // Handle empty list message
        const detectEmpty = () => {
            // Select elements
            const message = target.querySelector("span");
            const products = target.querySelectorAll(
                '[data-kt-ecommerce-edit-order-filter="product"]'
            );

            // Detect if element is empty
            if (products.length < 1) {
                // Show message
                message.classList.remove("d-none");

                // Reset price
                totalPrice.innerText = "0.00";
            } else {
                // Hide message
                message.classList.add("d-none");

                // Calculate price
                calculateTotal(products);
            }
        };

        // Calculate total cost
        const calculateTotal = (products) => {
            let countPrice = 0;

            // Loop through all selected prodcucts
            products.forEach((product) => {
                // Get product price
                const price = parseFloat(
                    product.querySelector(
                        '[data-kt-ecommerce-edit-order-filter="price"]'
                    ).innerText
                );

                // Add to total
                countPrice = parseFloat(countPrice + price);
            });

            // Update total price
            totalPrice.innerText = countPrice.toFixed(2);
        };
    };

    // Handle product select
    const handleSelectedProduct = () => {
        // Define variables
        let checkboxes = table.querySelectorAll('[type="checkbox"]');
        checkboxes = Array.from(checkboxes);

        const targets = document.querySelectorAll(
            "[data-kt-ecommerce-edit-selected]"
        );

        const totalPrice = document.getElementById(
            "kt_ecommerce_edit_order_total_price"
        );

        // console.log(checkboxes);

        for (let index = 0; index < targets.length; index++) {
            const element = targets[index];

            const productId = element.getAttribute(
                "data-kt-ecommerce-edit-product-id"
            );

            console.log(productId);

            checkboxes.filter((el) => {
                const elValue = el.value;

                if (elValue === productId) {
                    el.setAttribute("checked", "checked");
                }
            });
        }

        // targets.forEach((element) => {
        //     //  const element = targets[index];

        // });
    };

    // Submit form handler
    const handleSubmit = () => {
        // Define variables
        let validator;

        // Get elements
        const form = document.getElementById("kt_ecommerce_edit_order_form");
        const submitButton = document.getElementById(
            "kt_ecommerce_edit_order_submit"
        );

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(form, {
            fields: {
                payment_method: {
                    validators: {
                        notEmpty: {
                            message: "Payment method is required",
                        },
                    },
                },
                shipping_method: {
                    validators: {
                        notEmpty: {
                            message: "Shipping method is required",
                        },
                    },
                },
                customer: {
                    validators: {
                        notEmpty: {
                            message: "Customer is required",
                        },
                    },
                },

                product: {
                    validators: {
                        notEmpty: {
                            message: "Customer is required",
                        },
                    },
                },
                // 'order_date': {
                //     validators: {
                //         notEmpty: {
                //             message: 'Order date is required'
                //         }
                //     }
                // },
                billing_address: {
                    validators: {
                        notEmpty: {
                            message: "Address line is required",
                        },
                    },
                },
                billing_postcode: {
                    validators: {
                        notEmpty: {
                            message: "Postcode is required",
                        },
                    },
                },
                billing_state: {
                    validators: {
                        notEmpty: {
                            message: "State is required",
                        },
                    },
                },
                billing_country: {
                    validators: {
                        notEmpty: {
                            message: "Country is required",
                        },
                    },
                },
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap: new FormValidation.plugins.Bootstrap5({
                    rowSelector: ".fv-row",
                    eleInvalidClass: "",
                    eleValidClass: "",
                }),
            },
        });

        // Handle submit button
        submitButton.addEventListener("click", (e) => {
            e.preventDefault();

            // Validate form before submit
            if (validator) {
                validator.validate().then(async function (status) {
                    console.log("validated!");

                    if (status == "Valid") {
                        submitButton.setAttribute("data-kt-indicator", "on");

                        // Disable submit button whilst loading
                        submitButton.disabled = true;

                        const url = "/order/store";

                        const method = "POST";

                        await handles.formRequest(
                            url,
                            form,
                            method,
                            submitButton
                        );
                    } else {
                        Swal.fire({
                            html: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            },
                        });
                    }
                });
            }
        });
    };

    const handleSelectedCustomer = () => {
        $("#kt_ecommerce_edit_customer").on("select2:select", async (e) => {
            e.preventDefault();

            // select input data

            let address1 = document.querySelector(
                "input[name=billing_address_1]"
            );
            let address2 = document.querySelector(
                "input[name=billing_address_2]"
            );
            let city = document.querySelector("input[name=billing_city]");
            let state = document.querySelector("input[name=billing_state]");
            let zipcode = document.querySelector(
                "input[name=billing_postcode]"
            );

            let country = document.getElementById(
                "kt_ecommerce_edit_order_billing_country"
            );

            const url = "/admin/customer/address/" + e.params.data.id;

            try {
                let response = await fetch(url).then((result) => {
                    if (!result.ok) {
                        throw new Error("User information empty");
                    }

                    return result.json();
                });

                // set value to input
                address1.value = response.address;
                address2.value = response.address2;
                city.value = response.city;
                state.value = response.state;
                zipcode.value = response.zipcode;

                // set seleted country
                const selectedOption = country.querySelector(
                    `[value="${response.country}"]`
                );

                if (selectedOption) {
                    selectedOption.selected = true;
                }
            } catch (error) {
                console.error(error);

                address1.value = "";
                address2.value = "";
                city.value = "";
                state.value = "";
                zipcode.value = "";
            }
        });
    };

    // Public methods
    return {
        init: function () {
            initSaveOrder();
            handleSearchDatatable();
            handleShippingForm();
            handleProductSelect();
            handleSubmit();
            handleSelectedProduct();
            handleSelectedCustomer();
        },
    };
})();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTAppEcommerceSalesSaveOrder.init();
});
