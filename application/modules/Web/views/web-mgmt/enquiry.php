
<!-- Enquiry Modal -->
<div class="modal fade custom-modal" id="enquiryModal" tabindex="-1" aria-labelledby="enquiryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="detail-info p-4">
                            <h3 class="title-detail text-heading text-center mb-4">Enquiry Form</h3>
                            <form id="enquiryForm" action="#" method="post">
                                <div class="mb-3">
                                    <label for="enquiryService" class="form-label">Service Name</label>
                                    <input type="text" class="form-control" id="enquiryService" name="service" readonly>
                                    <input type="hidden" class="form-control" id="enquiryServiceId" name="serviceid" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="enquiryName" class="form-label">Your Name</label>
                                    <input type="text" class="form-control" id="enquiryName" name="name" placeholder="Enter your name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="enquiryEmail" class="form-label">Your Email</label>
                                    <input type="email" class="form-control" id="enquiryEmail" name="email" placeholder="Enter your email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="enquiryPhone" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="enquiryPhone" name="phone" placeholder="Enter your phone number" required>
                                </div>
                                <div class="mb-3">
                                    <label for="enquiryMessage" class="form-label">Message</label>
                                    <textarea class="form-control" id="enquiryMessage" name="message" rows="4" placeholder="Enter your message" required></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="button button-add-to-cart">Submit Enquiry</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const enquiryModal = document.getElementById("enquiryModal");
        const serviceInput = document.getElementById("enquiryService");
        const serviceId = document.getElementById("enquiryServiceId");
    
        enquiryModal.addEventListener("show.bs.modal", function (event) {
            // Get the button that triggered the modal
            const button = event.relatedTarget;
            // Extract the service name from data-service attribute
            const serviceName = button.getAttribute("data-service");
            const serviceid = button.getAttribute("data-serviceid");
            // Set the service name in the modal's input field
            serviceInput.value = serviceName;
            serviceId.value = serviceid;
        });
    });

</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const enquiryForm = document.getElementById("enquiryForm");

        enquiryForm.addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent default form submission

            const formData = new FormData(enquiryForm); // Gather form data

            // AJAX request
            fetch("<?php echo base_url('Web/submitenquiry'); ?>", {
                method: "POST",
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Enquiry submitted successfully!");
                        enquiryForm.reset(); // Reset the form
                        const enquiryModal = new bootstrap.Modal(document.getElementById('enquiryModal'));
                        enquiryModal.hide(); // Close the modal
                    } else {
                        alert("Error: " + data.message);
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("An error occurred while submitting your enquiry.");
                });
        });
    });
</script>
