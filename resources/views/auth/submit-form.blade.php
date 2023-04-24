<script>
    $("#email").keyup(function(event) {
        if (event.keyCode === 13) {
            $("#password").focus();
        }
    });

    $("#password").keyup(function(event) {
        if (event.keyCode === 13) {
            $("#login-btn").click();
        }
    });
</script>

<script>
    const form = document.getElementById('form-login');
    function callback() {
        form.submit();
    }
</script>