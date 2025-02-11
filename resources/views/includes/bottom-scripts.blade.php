<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- Include SweetAlert CDN -->
<script src="{{asset('/assets/sweetalert/sweetalert.min.js')}}"></script>
<!-- Include Paystack CDN -->
<script src="https://js.paystack.co/v1/inline.js"></script>
<!-- Include custom JavaScript file -->
<script src="{{asset('/js/script.js')}}"></script>
<script src="{{asset('/js/paystack.js')}}"></script>
@stack('js')
