<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <span class="navbar-brand"><span class="blue-color" id="title">Rural Connect</span><span
                class="reg-w">Subscription</span></span>
        <div class="nav-links">
            <a href="#" id="admin_logout">Logout</a>
        </div>
    </div>
</nav>

<script>
    const title = document.getElementById("title");

    title.addEventListener("click", () => {
        location.href = "../subscription/";
    });
</script>

<script type="module" src="../assets/js/logout.js"></script>