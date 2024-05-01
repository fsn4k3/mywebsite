// JavaScript to toggle section visibility
document.getElementById("about-link").addEventListener("click", function(event) {
    event.preventDefault();
    toggleSection("about");
});

document.getElementById("experience-link").addEventListener("click", function(event) {
    event.preventDefault();
    toggleSection("experience");
});

document.getElementById("contact-link").addEventListener("click", function(event) {
    event.preventDefault();
    toggleSection("contact");
});

function toggleSection(sectionId) {
    // Hide all sections
    var sections = document.querySelectorAll("main section");
    sections.forEach(function(section) {
        section.style.display = "none";
    });

    // Show the selected section
    document.getElementById(sectionId).style.display = "block";
}
