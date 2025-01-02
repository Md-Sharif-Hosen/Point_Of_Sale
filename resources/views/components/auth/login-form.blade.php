<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 animated fadeIn col-lg-6 center-screen">
            <div class="card w-90  p-4">
                <div class="card-body">
                    <h4>SIGN IN</h4>
                    <br />
                    <input id="email" placeholder="User Email" class="form-control" type="email" />
                    <br />
                    <input id="password" placeholder="User Password" class="form-control" type="password" />
                    <br />
                    <button onclick="SubmitLogin()" class="btn w-100 bg-gradient-primary">Next</button>
                    <hr />
                    <div class="float-end mt-3">
                        <span>
                            <a class="text-center ms-3 h6" href="{{ url('/userRegistration') }}">Sign Up </a>
                            <span class="ms-1">|</span>
                            <a class="text-center ms-3 h6" href="{{ url('/sendOTP') }}">Forget Password</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async function SubmitLogin() {
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;

    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (email.length === 0) {
        errorToast("Email is required");
        return;
    } else if (!emailPattern.test(email)) {
        errorToast("Invalid email address");
        return;
    } else if (password.length === 0) {
        errorToast("Password is required");
        return;
    }

    showLoader();

    try {
        let res = await axios.post("/user_login", {
            email: email,
            password: password
        });
        hideLoader();

        if (res.status === 200 && res.data['status'] === 'success') {
            successToast(res.data['message']);
            setTimeout(function() {
                window.location.href = "/dashboard";
            }, 200);
        } else if (res.data['status'] === 'failed') {
            // Handle specific error cases based on the response message
            if (res.data['message'] === "This email is not registered") {
                errorToast("This email is not registered");
            } else if (res.data['message'] === "Incorrect password") {
                errorToast("Incorrect password");
            } else {
                errorToast(res.data['message']); // Generic message fallback
            }
        }
    } catch (error) {
        hideLoader();
        if (error.response && error.response.data) {
            // Display the specific error message from the server response
            errorToast(error.response.data.message);
        } else {
            // Fallback for any unknown errors
            errorToast("Something went wrong, please try again later");
        }
    }
}

</script>
