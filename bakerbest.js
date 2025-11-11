if (window.innerWidth > 768) {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("show");
            } else {
                entry.target.classList.remove("show");
            }
        });
    }, {
        threshold: 0.2 // triggers when 20% of element is visible
    });

    const leftBlocks = document.querySelectorAll(".block");
    leftBlocks.forEach(el => observer.observe(el));

    const rightBlocks = document.querySelectorAll(".block-right");
    rightBlocks.forEach(el => observer.observe(el));

    window.addEventListener("wheel", function (e) {
        e.preventDefault();
        window.scrollBy({
            top: e.deltaY * 0.4,
            left: 0,
            behavior: "auto"
        });
    }, { passive: false });
} else {
    console.log("Scroll animation disabled on small screens");
}



