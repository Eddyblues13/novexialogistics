@include('admin.header')
<div class="main-panel">
    <div class="content bg-light">
        <div class="page-inner">

            <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
                <h1 class="title1 text-dark"><i class="fas fa-pen-fancy mr-2"></i>Compose Email</h1>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-envelope-open-text mr-2"></i>New Email</h5>
                        </div>
                        <div class="card-body">
                            <form id="composeEmailForm">
                                @csrf

                                <div class="form-group">
                                    <label><i class="fas fa-at mr-1"></i> Recipient Email <span
                                            class="text-danger">*</span></label>
                                    <input type="email" name="recipient_email" id="recipientEmail" class="form-control"
                                        placeholder="e.g. customer@example.com" required>
                                    <span class="text-danger" id="recipient_email_error"></span>
                                </div>

                                <div class="form-group">
                                    <label><i class="fas fa-heading mr-1"></i> Subject <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="subject" id="emailSubject" class="form-control"
                                        placeholder="e.g. Update on your shipment" required>
                                    <span class="text-danger" id="subject_error"></span>
                                </div>

                                <div class="form-group">
                                    <label><i class="fas fa-align-left mr-1"></i> Message <span
                                            class="text-danger">*</span></label>
                                    <textarea name="message" id="emailMessage" class="form-control" rows="10"
                                        placeholder="Type your message here..." required></textarea>
                                    <span class="text-danger" id="message_error"></span>
                                    <small class="text-muted">Line breaks will be preserved in the email.</small>
                                </div>

                                <hr>

                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        The email will be sent from your configured mail address.
                                    </small>
                                    <button type="submit" class="btn btn-primary" id="sendBtn">
                                        <span id="sendText"><i class="fas fa-paper-plane mr-1"></i> Send Email</span>
                                        <span id="sendSpinner" class="spinner-border spinner-border-sm d-none"
                                            role="status"></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')

<script>
    $(document).ready(function() {
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000"
    };

    $('#composeEmailForm').on('submit', function(e) {
        e.preventDefault();

        const btn = $('#sendBtn');
        const sendText = $('#sendText');
        const sendSpinner = $('#sendSpinner');
        const email = $('#recipientEmail').val().trim();
        const subject = $('#emailSubject').val().trim();
        const message = $('#emailMessage').val().trim();

        // Clear previous errors
        $('.text-danger').text('');
        $('.is-invalid').removeClass('is-invalid');

        // Client-side validation
        let hasError = false;
        if (!email) {
            $('#recipient_email_error').text('Recipient email is required');
            $('#recipientEmail').addClass('is-invalid');
            hasError = true;
        }
        if (!subject) {
            $('#subject_error').text('Subject is required');
            $('#emailSubject').addClass('is-invalid');
            hasError = true;
        }
        if (!message) {
            $('#message_error').text('Message is required');
            $('#emailMessage').addClass('is-invalid');
            hasError = true;
        }
        if (hasError) return;

        Swal.fire({
            title: 'Send this email?',
            html: `To: <strong>${email}</strong><br>Subject: <strong>${subject}</strong>`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#007bff',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-paper-plane"></i> Send',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                sendText.html('<i class="fas fa-spinner fa-spin mr-1"></i> Sending...');
                sendSpinner.removeClass('d-none');
                btn.prop('disabled', true);

                $.ajax({
                    url: '{{ route("admin.compose-email.send") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        recipient_email: email,
                        subject: subject,
                        message: message
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                            // Clear form
                            $('#composeEmailForm')[0].reset();
                        } else {
                            toastr.error(response.message || 'Failed to send email');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            for (const field in errors) {
                                $(`#${field.replace('_', '_')}_error`).text(errors[field][0]);
                                $(`[name="${field}"]`).addClass('is-invalid');
                            }
                            toastr.error('Please fix the validation errors');
                        } else {
                            toastr.error(xhr.responseJSON?.message || 'Failed to send email');
                        }
                    },
                    complete: function() {
                        sendText.html('<i class="fas fa-paper-plane mr-1"></i> Send Email');
                        sendSpinner.addClass('d-none');
                        btn.prop('disabled', false);
                    }
                });
            }
        });
    });
});
</script>