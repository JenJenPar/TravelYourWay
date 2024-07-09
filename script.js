document.addEventListener("DOMContentLoaded", function() {

    const signupForm = document.getElementById("signupForm");
    const loginForm = document.getElementById("loginForm");

    // Event listener for signup form submission
    if (signupForm) {
        signupForm.addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the default form submission

            const username = document.getElementById("signupUsername").value;
            const email = document.getElementById("signupEmail").value;
            const password = document.getElementById("signupPassword").value;
            const dateJoined = new Date().toLocaleDateString();

            // Store user information in localStorage
            const user = { username, email, password, dateJoined };
            localStorage.setItem(username, JSON.stringify(user));

            // Redirect to the account page
            window.location.href = "account.html";
        });
    }

    // Event listener for login form submission
    if (loginForm) {
        loginForm.addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the default form submission

            const username = document.getElementById("loginUsername").value;
            const password = document.getElementById("loginPassword").value;

            // Retrieve user information from localStorage
            const user = JSON.parse(localStorage.getItem(username));

            if (user && user.password === password) {
                // Store the current logged-in user in localStorage
                localStorage.setItem("currentUser", username);

                // Redirect to the account page
                window.location.href = "account.html";
            } else {
                alert("Invalid username or password.");
            }
        });
    }

    // Display user information on the account page
    if (document.body.contains(document.getElementById("username"))) {
        const currentUser = localStorage.getItem("currentUser");
        const user = JSON.parse(localStorage.getItem(currentUser));

        if (user) {
            document.getElementById("username").textContent = user.username;
            document.getElementById("dateJoined").textContent = user.dateJoined;
        } else {
            // Redirect to login page if no user is logged in
            window.location.href = "login.html";
        }
    }
});
