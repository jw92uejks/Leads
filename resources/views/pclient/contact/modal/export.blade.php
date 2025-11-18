<div class="modal fade" id="kt_customers_export_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bold">Exportar Contatos</h2>
                <div id="kt_customers_export_close" class="btn btn-icon btn-sm btn-active-icon-primary">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i> </div>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <form id="kt_customers_export_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
                    <div class="fv-row mb-10">
                        <label class="fs-5 fw-semibold form-label mb-5">Selecione o Formato de Exportação:</label>
                        <select name="country" data-control="select2" data-placeholder="Selecione um formato" data-hide-search="true" class="form-select form-select-solid select2-hidden-accessible" data-select2-id="select2-data-15-n3is" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                            <option value="excell" data-select2-id="select2-data-17-p4lu">Excel</option>
                            <option value="pdf">PDF</option>
                            <option value="csv">CSV</option>
                            <option value="zip">ZIP</option>
                        </select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-16-o02b" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-country-eu-container" aria-controls="select2-country-eu-container"><span class="select2-selection__rendered" id="select2-country-eu-container" role="textbox" aria-readonly="true" title="Excel">Excel</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                    </div>
                    <div class="fv-row mb-10 fv-plugins-icon-container">
                        <label class="fs-5 fw-semibold form-label mb-5">Selecione o Intervalo de Datas:</label>
                        <input class="form-control form-control-solid flatpickr-input" placeholder="Escolha uma data" name="date" type="hidden"><input class="form-control form-control-solid form-control input" placeholder="Escolha uma data" tabindex="0" type="text" readonly="readonly">
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                    </div>
                    <div class="row fv-row mb-15">
                        <label class="fs-5 fw-semibold form-label mb-5">Tipo de Pagamento:</label>
                        <div class="d-flex flex-column">
                            <label class="form-check form-check-custom form-check-sm form-check-solid mb-3">
                                <input class="form-check-input" type="checkbox" value="1" checked="checked" name="payment_type">
                                <span class="form-check-label text-gray-600 fw-semibold">
                                    Todos
                                </span>
                            </label>
                            <label class="form-check form-check-custom form-check-sm form-check-solid mb-3">
                                <input class="form-check-input" type="checkbox" value="2" checked="checked" name="payment_type">
                                <span class="form-check-label text-gray-600 fw-semibold">
                                    Visa
                                </span>
                            </label>
                            <label class="form-check form-check-custom form-check-sm form-check-solid mb-3">
                                <input class="form-check-input" type="checkbox" value="3" name="payment_type">
                                <span class="form-check-label text-gray-600 fw-semibold">
                                    Mastercard
                                </span>
                            </label>
                            <label class="form-check form-check-custom form-check-sm form-check-solid">
                                <input class="form-check-input" type="checkbox" value="4" name="payment_type">
                                <span class="form-check-label text-gray-600 fw-semibold">
                                    American Express
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="reset" id="kt_customers_export_cancel" class="btn btn-light me-3">
                            Descartar
                        </button>
                        <button type="submit" id="kt_customers_export_submit" class="btn btn-primary">
                            <span class="indicator-label">
                                Enviar
                            </span>
                            <span class="indicator-progress">
                                Por favor, aguarde... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>