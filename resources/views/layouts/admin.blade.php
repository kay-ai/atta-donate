<div class="admin-contain">
    @include('partials.admin.sidebar')
    <div class="main-content">
        @include('partials.admin.header')
        <div class="admin-contain-content">
            @include('includes.messages')
            @yield('content')
        </div>
    </div>
</div>

@push('js')
<script>
    function approveApplication(applicationId) {
        const button = document.getElementById(`approve-btn-${applicationId}`);

        if (confirm("Are you sure you want to approve this application?")) {
            // Disable the button and change text to indicate processing
            button.disabled = true;
            button.textContent = "Approving...";

            fetch(`/backend/den/application/${applicationId}/approve`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json",
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Application approved successfully!");
                    location.reload();
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Something went wrong! Please try again.");
            })
            .finally(() => {
                // Re-enable the button and reset text only if the page doesn't reload
                button.disabled = false;
                button.textContent = "Approve";
            });
        }
    }


    function deleteApplication(applicationId) {
        if (confirm("Are you sure you want to delete this application?")) {
            fetch(`/backend/den/application/${applicationId}/delete`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json",
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Application deleted successfully!");
                    location.reload();
                }
            })
            .catch(error => console.error("Error:", error));
        }
    }

</script>
@endpush
