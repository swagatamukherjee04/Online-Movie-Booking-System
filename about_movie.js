window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    const movieId = urlParams.get('id');  // Extract movieId from URL
    const movieType = urlParams.get('type');  // Extract movieType from URL
    
    if (!movieId || !movieType) {
        alert("Movie ID or type not provided.");
        return;
    }

    // Fetch movie details from your PHP endpoint
    fetch(`about_movie_data.php?id=${movieId}&type=${movieType}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }

            // Fill in the movie details
            const elements = {
                title: document.getElementById('movie-title'),
                releaseDate: document.getElementById('release-date'),
                rating: document.getElementById('rating'),
                specification: document.getElementById('specification'),
                genre: document.getElementById('genre'),
                certification: document.getElementById('certification'),
                language: document.getElementById('language'),
                description: document.getElementById('movie-description'),
                duration: document.getElementById('duration'),
                poster: document.getElementById('movie-poster'),
                castList: document.getElementById('movie-cast'),
                crewList: document.getElementById('movie-crew'),
                bookTicketsBtn: document.getElementById('show-btn')
            };

            // Set movie details in HTML
            elements.title.textContent = data.title;
            elements.releaseDate.textContent = `Release Date: ${data.release_date}`;
            elements.rating.textContent = `Rating: ${data.rating || 'NA'}`;
            elements.specification.textContent = `Specification: ${data.specification}`;
            elements.genre.textContent = `Genre: ${data.genre}`;
            elements.certification.textContent = `Certification: ${data.certification}`;
            elements.language.textContent = `Language: ${data.language}`;
            elements.description.textContent = data.description;

            // Add duration for recommended movies only
            if (movieType === 'recommended') {
                elements.duration.textContent = `Duration: ${data.duration}`;
            } else {
                elements.duration.style.display = 'none';  // Hide duration for upcoming movies
            }

            // Set movie poster image
            elements.poster.src = `${data.poster}`;

            // Add cast and crew to lists
            data.cast.forEach(actor => {
                const li = document.createElement('li');
                li.textContent = actor;
                elements.castList.appendChild(li);
            });
            data.crew.forEach(member => {
                const li = document.createElement('li');
                li.textContent = member;
                elements.crewList.appendChild(li);
            });

            const trailerContainer = document.getElementById('movie-trailer');
            
            const noTrailerMessage = document.getElementById('no-trailer-message');

            if (data.trailer_link) {
                trailerContainer.innerHTML = `<iframe src="${data.trailer_link}" allow="autoplay; encrypted-media" allowfullscreen></iframe>`;
                trailerContainer.style.display = 'block';
                noTrailerMessage.style.display = 'none';
            } else {
                //trailerContainer.textContent = "Trailer not available";
                noTrailerMessage.style.display = 'block';
            }

            // Handle Book Tickets button click
            elements.bookTicketsBtn.addEventListener('click', () => {
                window.location.href = `book_tickets.php?id=${movieId}`;  // Redirect to ticket booking page
            });
        })
        .catch(error => {
            console.error('Error fetching movie data:', error);
            alert('An error occurred while fetching the movie details.');
        });
};
