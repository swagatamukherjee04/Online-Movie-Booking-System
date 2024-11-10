// Sample movie data
const movies = [
    { title: "Movie 1" },
    { title: "Movie 2" },
    { title: "Movie 3" },
    { title: "Movie 4" },
    { title: "Movie 5" }
];

// Function to display movies
function displayMovies(movieList) {
    const container = document.getElementById("movies-container");
    container.innerHTML = ""; // Clear existing content

    movieList.forEach(movie => {
        const movieDiv = document.createElement("div");
        movieDiv.classList.add("movie-item");
        movieDiv.innerHTML = `<h3>${movie.title}</h3>`;
        container.appendChild(movieDiv);
    });
}

// Function to search movies
document.getElementById("search-bar").addEventListener("input", function() {
    const query = this.value.toLowerCase();
    const filteredMovies = movies.filter(movie => movie.title.toLowerCase().includes(query));
    displayMovies(filteredMovies);
});

// Initial display of all movies
displayMovies(movies);
