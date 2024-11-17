var rem_movies = [];  // Define a global variable to store movies

// Function to load movies from the server
async function loadRecommendedMovies() {
    try {
        const response = await fetch("api/fetch_movies.php");
        rem_movies = await response.json();
        displayRecommendedMovies(rem_movies);  // Display movies once fetched
    } catch (error) {
        console.error("Error fetching movies:", error);
    }
}


// Function to display movies
function displayRecommendedMovies(movieList) {
    const container = document.getElementById("movies-container");
    container.innerHTML = "";  // Clear existing content

    if (movieList.length === 0) {
        // Display "No Results Found" if no movies match the search
        container.innerHTML = "<p>No Results Found for Recommended Movies</p>";
        return;
    }

    movieList.forEach(movie => {
        const movieDiv = document.createElement("div");
        movieDiv.classList.add("movie-item");

        // Create the image element for the movie poster
        const posterImg = document.createElement("img");
        posterImg.src = movie.poster;  // Path to poster image from database
        posterImg.alt = `${movie.title} Poster`;
        posterImg.classList.add("movie-poster");

        // Create the title element
        const titleEl = document.createElement("h3");
        titleEl.textContent = movie.title;
        titleEl.classList.add("movie-title");

        const genreEl = document.createElement("p");
        genreEl.textContent = movie.genre;
        genreEl.classList.add("movie-genre");

        // Add click event to redirect to the "About Movie" page
        movieDiv.addEventListener("click", () => {
            window.location.href = `about_movies.php?id=${movie.id}&type=recommended`;
        });

        // Append poster and title to the movie container
        movieDiv.appendChild(posterImg);
        movieDiv.appendChild(titleEl);
        movieDiv.appendChild(genreEl);
        container.appendChild(movieDiv);
    });
}

function filterRecommendedMovies(query) {
    const filteredMovies = rem_movies.filter(movie => 
        movie.title.toLowerCase().includes(query.toLowerCase())
    );
    displayRecommendedMovies(filteredMovies);
}

// Search functionality for movies
document.getElementById("search-bar").addEventListener("input", function() {
    const query = this.value;
    filterRecommendedMovies(query);
});


// Fetch and display movies once the page is loaded
document.addEventListener("DOMContentLoaded", loadRecommendedMovies);

