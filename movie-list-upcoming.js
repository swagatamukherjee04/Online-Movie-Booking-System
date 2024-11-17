var up_movies = [];  // Define a global variable to store movies

// Function to load movies from the server
async function loadUpcomingMovies() {
    try {
        const response = await fetch("api/fetch_upcoming_movies.php");
        up_movies = await response.json();
        displayUpcomingMovies(up_movies);  // Display movies once fetched
    } catch (error) {
        console.error("Error fetching movies:", error);
        if (container) {
            container.innerHTML = "<p>Error loading movies. Please try again later.</p>";
        }
    }
}


// Function to display movies
function displayUpcomingMovies(movieList) {
    const container = document.getElementById("upcoming-movies-container");
    container.innerHTML = "";  // Clear existing content

    if (movieList.length === 0) {
        container.innerHTML = "<p>No Results Found for Upcoming Movies</p>";
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

        const releaseDateEl = document.createElement("p");
        releaseDateEl.textContent = `Releasing On: ${movie.release_date}`;
        releaseDateEl.classList.add("movie-release-date");

        // Add click event to redirect to the "About Movie" page
        movieDiv.addEventListener("click", () => {
            window.location.href = `about_movies.php?id=${movie.id}&type=upcoming`;
        });

        // Append poster and title to the movie container
        movieDiv.appendChild(posterImg);
        movieDiv.appendChild(titleEl);
        movieDiv.appendChild(genreEl);
        movieDiv.appendChild(releaseDateEl);
        container.appendChild(movieDiv);
    });
}

document.getElementById("search-bar").addEventListener("input", function() {
    const query = this.value.toLowerCase();
    const filteredMovies = up_movies.filter(movie => movie.title.toLowerCase().includes(query));

    displayUpcomingMovies(filteredMovies);
});

// Fetch and display movies once the page is loaded
document.addEventListener("DOMContentLoaded", loadUpcomingMovies);