@if(Session::has('success'))
    <script>
        window.addEventListener('load', function() {
            function showSuccessAlert() {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Parabéns!',
                        text: "{{ Session::get('success') }}",
                        confirmButtonText: 'Ok, entendi!',
                        width: 400,
                        heightAuto: false,
                        padding: '2.5rem',
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: 'btn btn-success'
                        }
                    });
                } else {
                    setTimeout(showSuccessAlert, 200);
                }
            }
            showSuccessAlert();
        });
    </script>
@endif

@if(Session::has('error'))
    <script>
        window.addEventListener('load', function() {
            function showErrorAlert() {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro encontrado!',
                        text: "{{ Session::get('error') }}",
                        confirmButtonText: 'Ok, corrigir!',
                        width: 400,
                        heightAuto: false,
                        padding: '2.5rem',
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: 'btn btn-danger'
                        }
                    });
                } else {
                    setTimeout(showErrorAlert, 200);
                }
            }
            showErrorAlert();
        });
    </script>
@endif

@if($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function showValidationErrorAlert() {
                if (typeof Swal !== 'undefined') {
                    @foreach($errors->all() as $error)
                        Swal.fire({
                            icon: 'error',
                            title: 'Atenção!',
                            text: "{{ $error }}",
                            confirmButtonText: 'Ok, corrigir!',
                            width: 400,
                            heightAuto: false,
                            padding: '2.5rem',
                            buttonsStyling: false,
                            customClass: {
                                confirmButton: 'btn btn-danger'
                            }
                        });
                    @endforeach
                } else {
                    setTimeout(showValidationErrorAlert, 100);
                }
            }
            showValidationErrorAlert();
        });
    </script>
@endif

@if(Session::has('status'))
    <script>
        window.addEventListener('load', function() {
            function showStatusAlert() {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Atenção!',
                        text: "{{ Session::get('status') }}",
                        confirmButtonText: 'Ok, entendi!',
                        width: 400,
                        heightAuto: false,
                        padding: '2.5rem',
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: 'btn btn-warning'
                        }
                    });
                } else {
                    setTimeout(showStatusAlert, 200);
                }
            }
            showStatusAlert();
        });
    </script>
@endif
