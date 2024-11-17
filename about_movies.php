
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Details</title>
    <link rel="stylesheet" href="css/style2.css">
</head>
<body>
    <header>
        <div class="header-left">
            <h1>OMBS - About Movie</h1>
        </div>
        <div class="header-right">
            <button id="show-btn" class="book-tickets-btn">Book Tickets</button>
        </div>
    </header>

    <div class="movie-container">
        <!-- Top Section with Movie Info -->
        <div class="movie-info-box">
            <img id="movie-poster" class="movie-poster" src="" alt="Movie Poster">
            <div class="movie-details">
                <h2 id="movie-title">Movie Title</h2>
                <p id="release-date">Release Date: </p>
                <p id="rating">Rating: </p>
                <p id="specification">Specification: </p>
                <p id="genre">Genre: </p>
                <p id="certification">Certification: </p>
                <p id="language">Language: </p>
                <p id="duration">Duration: </p>
            </div>
        </div>

        <div class="movie-trailer">
            <h3>Trailer</h3>
            <div class="trailer-container" id="movie-trailer-container">
                <div id="movie-trailer"></div>
                <p id="no-trailer-message" style="display: none;">Trailer not available</p>
            </div>
        </div>

        <!-- Description Section -->
        <div class="movie-description-section">
            <h3>Description</h3>
            <p id="movie-description">Movie description goes here.</p>
        </div>

        <!-- Cast Section -->
        <div class="movie-cast-section">
            <h3>Cast</h3>
            <ul id="movie-cast" class="cast-list">
                <!-- Cast members will be populated here -->
            </ul>
        </div>

        <!-- Crew Section -->
        <div class="movie-crew-section">
            <h3>Crew</h3>
            <ul id="movie-crew" class="crew-list">
                <!-- Crew members will be populated here -->
            </ul>
        </div>
    </div>
    <script src="js/about_movie.js"></script> <!-- Link to your JS file here -->
</body>
</html>
