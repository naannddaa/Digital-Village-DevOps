document
    .getElementById("toggle-description")
    .addEventListener("click", function (e) {
        e.preventDefault();
        var moreText = document.getElementById("more-text");
        var btn = document.getElementById("toggle-description");

        if (moreText.style.display === "none") {
            moreText.style.display = "inline";
            btn.textContent = "View Less";
        } else {
            moreText.style.display = "none";
            btn.textContent = "View More";
        }
    });

// When the DOM is fully loaded
document.addEventListener("DOMContentLoaded", function () {
    const navLinks = document.querySelectorAll(".header-section .menu ul li a");

    navLinks.forEach((link) => {
        link.addEventListener("click", function (e) {
            e.preventDefault(); // Prevent default anchor behavior

            // Remove 'active' from all links
            navLinks.forEach((nav) => nav.classList.remove("active"));

            // Add 'active' to the clicked link
            this.classList.add("active");

            // Scroll to the corresponding section smoothly
            const targetId = this.getAttribute("href");
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({ behavior: "smooth" });
            }

            console.log("Clicked link: ", this); // Debugging log to confirm the link is being clicked
        });
    });
});
