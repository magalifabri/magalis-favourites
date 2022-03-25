const cards = document.querySelectorAll(".card");
const showAllButton = document.querySelector(".show-all-button");

showAllButton.addEventListener("click", () => {
    for (const card of cards) {
        card.style.display = "flex";
    }
});


const filterButtons = document.querySelectorAll(".filter-button");

filterButtons.forEach(button => {
    button.addEventListener("click", () => {
        const genreToFilter = button.textContent;

        for (const card of cards) {
            card.style.display = "none";
            const genrePs = card.children[2].children;

            for (const genreP of genrePs) {
                if (genreP.classList.contains(genreToFilter)) {
                    card.style.display = "flex";
                    break;
                }
            }
        }
    });
});


const searchElem = document.querySelector("input.search-bar");

searchElem.addEventListener("input", () => {
    for (const card of cards) {
        const query = searchElem.value.toLowerCase().trim();
        const title = card.children[1].textContent
        const year = card.children[5].children[0].textContent

        const titleMatch = title.toLowerCase().includes(query);
        const yearMatch = year.toString().includes(query);

        if (titleMatch || yearMatch) {
            card.style.display = "flex";
        } else {
            card.style.display = "none";
        }
    }
});
