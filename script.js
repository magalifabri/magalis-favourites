// import { COLLECTION } from "./collection.js";

// const cardsContainerElem = document.querySelector(".cards-container");
// // create card HTML elements and their content
// for (const movie of COLLECTION) {
//     const newTitleElem = document.createElement("p");
//     newTitleElem.classList.add("title");
//     newTitleElem.textContent = movie.title;

//     const newDescriptionElem = document.createElement("p");
//     newDescriptionElem.classList.add("description");
//     newDescriptionElem.textContent = movie.description;

//     const newYearElem = document.createElement("p");
//     newYearElem.classList.add("year");
//     newYearElem.textContent = movie.releaseYear;

//     const newCoverElem = document.createElement("img");
//     newCoverElem.classList.add("cover-img");
//     newCoverElem.setAttribute("src", movie.coverImage);
//     newCoverElem.setAttribute("alt", `${movie.title}'s cover image`);

//     const newLinkElem = document.createElement("a");
//     newLinkElem.classList.add("link");
//     newLinkElem.setAttribute("href", movie.IMDbLink);
//     newLinkElem.textContent = `IMDb: ${movie.IMDbRating}`;

//     const newGenresContainer = document.createElement("div");
//     newGenresContainer.classList.add("genres-container");
//     for (const genre of movie.genres) {
//         const newGenreElem = document.createElement("p");
//         newGenreElem.classList.add("genre");
//         newGenreElem.classList.add(genre);
//         newGenreElem.textContent = genre;
//         newGenresContainer.appendChild(newGenreElem);
//     }

//     const newDataContainer = document.createElement("div");
//     newDataContainer.classList.add("data-container");
//     newDataContainer.appendChild(newYearElem);
//     newDataContainer.appendChild(newLinkElem);

//     const newCardElem = document.createElement("div");
//     newCardElem.classList.add("card");
//     newCardElem.appendChild(newCoverElem);
//     newCardElem.appendChild(newTitleElem);
//     newCardElem.appendChild(newGenresContainer);
//     newCardElem.appendChild(newDescriptionElem);
//     newCardElem.appendChild(document.createElement("hr"));
//     newCardElem.appendChild(newDataContainer);

//     cardsContainerElem.appendChild(newCardElem);
// }

// const cards = document.querySelectorAll(".card");

// // add HTML card node to collection objects for easier interactions
// for (const movie of COLLECTION) {
//     for (const card of cards) {
//         const cardMovieTitle = card.querySelector(".title").textContent;
//         if (cardMovieTitle === movie.title) {
//             movie.node = card;
//             break ;
//         }
//     }
// }

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
// const filterButtons = document.querySelectorAll(".filter-button");
// filterButtons.forEach(button => {
//     button.addEventListener("click", () => {
//         const genreToFilter = button.textContent;
//         for (const movie of COLLECTION) {
//             if (movie.genres.includes(genreToFilter)) {
//                 movie.node.style.display = "flex";
//             } else {
//                 movie.node.style.display = "none";
//             }
//         }
//     });
// });

// const searchElem = document.querySelector("input.search-bar");
// searchElem.addEventListener("input", () => {
//     for (const movie of COLLECTION) {
//         const query = searchElem.value.toLowerCase().trim();

//         const titleMatch = movie.title.toLowerCase().includes(query);
//         const yearMatch = movie.releaseYear.toString().includes(query);
//         let genreMatch;
//         for (const genre of movie.genres) {
//             genreMatch = genre.toLowerCase().includes(query);
//             if (genreMatch) {
//                 break ;
//             }
//         }
//         if (titleMatch || yearMatch || genreMatch) {
//             movie.node.style.display = "flex";
//         } else {
//             movie.node.style.display = "none";
//         }
//     }
// });
