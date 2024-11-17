window.onload = function() {

    const urlParams = new URLSearchParams(window.location.search);
    const movieId = urlParams.get('id');

    if (!movieId) {
        console.error("Movie ID not found in URL");
        return;
    }

    // Fetch showtimes from the server
    fetch(`api/fetch_showtimes.php?movie_id=${movieId}`)
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('cinema-halls-container');

            container.innerHTML = '';
            
            if (!data || data.length === 0) {
                container.textContent = "No showtimes available for this movie.";
                return;
            }

            data.forEach(cinema => {
                // Create a container for each cinema hall
                const cinemaBox = document.createElement('div');
                cinemaBox.className = 'cinema-box';

                // Display cinema hall name
                const cinemaName = document.createElement('h2');
                cinemaName.textContent = cinema.name;
                cinemaBox.appendChild(cinemaName);

                // Show each available showtime as a button
                cinema.showtimes.forEach(time => {
                    const showtimeButton = document.createElement('button');
                    showtimeButton.className = 'showtime-button';
                    showtimeButton.textContent = time;
                    showtimeButton.onclick = function() {
                        alert(`Selected showtime: ${time} at ${cinema.name}`);
                        // Here, you can redirect to a booking page with showtime and cinema details
                    };
                    cinemaBox.appendChild(showtimeButton);
                });

                container.appendChild(cinemaBox);
            });
        })
        .catch(error => {
            console.error("Error fetching showtimes:", error);
        });
};
