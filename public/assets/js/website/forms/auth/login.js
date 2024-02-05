$(document).ready(function () {
    const LoginUrl = "http://127.0.0.1/api/login";
    //Login Button Click Event
    $("#LoginBtn").on("click", function (e) {
        e.preventDefault();
        const formValues = $("#LoginForm").serializeArray();

        const data = {};
        $.each(formValues, function () {
            data[this.name] = this.value;
        });

        Login(data);

    });

    //Login Request
    function Login(data) {
        $.ajax({
            url: LoginUrl,
            method: 'POST',
            data: data,
            success: function (res) {
                console.log(res);
                location.href=welcomePageUrl;
                // alert(res.message);
                const token = res.token;
                localStorage.setItem('token',token);
            },
            error: function  (jqXHR,textStatus,errorThrown ) {
                console.log('jqxHR:',jqXHR);
                console.log(`textStatus:`,textStatus);
                console.log(`errorThrown`,errorThrown);
                const error = jqXHR.responseJSON;
                alert(error.message);
                
            }
        })
    }




});