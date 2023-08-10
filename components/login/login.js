
const form = document.getElementById('login');

form.addEventListener('submit', function (event) {
    event.preventDefault()
    mobi.post(
        "bk-api/connection",
        "login",
        function (data) {
            console.log("Data Loaded: " + data);
        },
        function (error) {
            console.log("Error: " + error);
        }
    );
});
