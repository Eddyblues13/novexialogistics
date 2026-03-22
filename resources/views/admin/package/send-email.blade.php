@include('admin.header')
<div class="main-panel">
    <div class="content bg-light">
        <div class="page-inner">
            @if(session('message'))
            <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
                <h1 class="title1 text-dark"><i class="fas fa-envelope mr-2"></i>Send Email Notification</h1>
            </div>

            <div class="alert alert-info border-0 shadow-sm mb-4"
                style="background: linear-gradient(135deg, #e0f2fe, #f0f9ff); border-left: 4px solid #0ea5e9 !important;">
                <i class="fas fa-info-circle text-info mr-2"></i>
                Select a package below and click <strong>Send Email</strong> to send a shipment notification email to
                the receiver.
            </div>

            <!-- Search -->
            <form method="GET" action="{{ route('admin.packages.send-email.index') }}" class="mb-3">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                    placeholder="Search by tracking number, sender, receiver or email..." oninput="this.form.submit()">
            </form>

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Tracking #</th>
                                    <th>Sender</th>
                                    <th>Receiver</th>
                                    <th>Receiver Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($packages as $package)
                                <tr>
                                    <td><strong>{{ $package->tracking_number }}</strong></td>
                                    <td>{{ $package->sender_name }}</td>
                                    <td>{{ $package->receiver_name }}</td>
                                    <td>
                                        @if($package->receiver_email)
                                        <span class="text-success">{{ $package->receiver_email }}</span>
                                        @elseif($package->sender_email)
                                        <span class="text-warning" title="Fallback to sender email">{{
                                            $package->sender_email }} <small>(sender)</small></span>
                                        @else
                                        <span class="text-danger">No email</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info send-email-btn" data-id="{{ $package->id }}"
                                            data-tracking="{{ $package->tracking_number }}"
                                            data-email="{{ $package->receiver_email ?? $package->sender_email ?? '' }}"
                                            {{ !$package->receiver_email && !$package->sender_email ? 'disabled' : ''
                                            }}>
                                            <i class="fas fa-paper-plane"></i> Send Email
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                        No packages found.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $packages->onEachSide(1)->links('pagination::bootstrap-4') }}
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

    $('.send-email-btn').on('click', function() {
        const btn = $(this);
        const packageId = btn.data('id');
        const tracking = btn.data('tracking');
        const email = btn.data('email');
        const originalHtml = btn.html();

        Swal.fire({
            title: 'Send Email Notification?',
            html: `Send shipment notification for <strong>${tracking}</strong> to:<br><strong>${email}</strong>`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#17a2b8',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-paper-plane"></i> Send Email',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Sending...');

                $.ajax({
                    url: '/admin/packages/' + packageId + '/send-email',
                    type: 'POST',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message || 'Failed to send email');
                        }
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON?.message || 'Failed to send email');
                    },
                    complete: function() {
                        btn.prop('disabled', false).html(originalHtml);
                    }
                });
            }
        });
    });
});
</script>