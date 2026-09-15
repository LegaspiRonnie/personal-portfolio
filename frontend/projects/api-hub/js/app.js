const cityInput = document.getElementById('cityInput');
const weatherForm = document.getElementById('weatherForm');
const weatherResult = document.getElementById('weatherResult');
const modalButtons = document.querySelectorAll('.api-footer-link');
const modalOverlays = document.querySelectorAll('.api-card-modal');

weatherForm.addEventListener('submit', async (event) => {
    event.preventDefault();
    await getWeather();
});

modalButtons.forEach((button) => {
    button.addEventListener('click', () => {
        const modalId = button.dataset.modal;
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('hidden');
        }
    });
});

document.querySelectorAll('.modal-close').forEach((button) => {
    button.addEventListener('click', () => {
        const modal = button.closest('.api-card-modal');
        if (modal) {
            modal.classList.add('hidden');
        }
    });
});

modalOverlays.forEach((modal) => {
    modal.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.classList.add('hidden');
        }
    });
});

function formatTime(dateString) {
    if (!dateString) return 'Time unavailable';

    const date = new Date(dateString);
    if (Number.isNaN(date.getTime())) return 'Time unavailable';

    return new Intl.DateTimeFormat('en-US', {
        hour: 'numeric',
        minute: '2-digit',
        hour12: true,
        day: 'numeric',
        month: 'short'
    }).format(date);
}

async function getWeather() {
    const city = cityInput.value.trim();

    if (!city) {
        showError('Please enter a city name.');
        return;
    }

    weatherResult.className = 'weather-content loading-state';
    weatherResult.innerHTML = `
        <div class="weather-header">
            <div class="weather-icon"><i class="fa-solid fa-cloud-bolt"></i></div>
            <div class="weather-temp-block">
                <div class="temperature">--</div>
                <div class="unit">°C</div>
            </div>
        </div>

        <div class="weather-location-block">
            <div class="location-main">${city}</div>
            <div class="location-sub">Loading location...</div>
            <div class="time-sub">Loading time...</div>
        </div>

        <div class="weather-meta">
            <p>Precipitation: --</p>
            <p>Humidity: --</p>
            <p>Wind: --</p>
        </div>

        <div class="metric-tabs">
            <span class="active">Temperature</span>
            <span>Precipitation</span>
            <span>Wind</span>
        </div>
    `;

    try {
        // Call the API Hub endpoint from its migrated backend project folder.
        const response = await fetch(
            `/personal-portfolio/backend/projects/api-hub/api/weather.php?city=${encodeURIComponent(city)}`
        );

        const result = await response.json();

        if (!response.ok || !result.success) {
            throw new Error(result.message || 'Unable to get weather.');
        }

        displayWeather(result.data, result.weather);
    } catch (error) {
        showError(error.message || 'Something went wrong.');
    }
}

function displayWeather(data, weather) {
    const temp = Number(weather.temperature ?? 0);
    const humidity = Number(weather.humidity ?? 0);
    const wind = Number(weather.wind_speed ?? 0);
    const precipitation = Math.max(0, Math.min(100, humidity));
    const currentTime = formatTime(new Date().toISOString());

    weatherResult.className = 'weather-content';
    weatherResult.innerHTML = `
        <div class="weather-header">
            <div class="weather-icon"><i class="fa-solid fa-cloud-bolt"></i></div>
            <div class="weather-temp-block">
                <div class="temperature">${temp.toFixed(0)}</div>
                <div class="unit">°C</div>
            </div>
        </div>

        <div class="weather-location-block">
            <div class="location-main">${data.city || cityInput.value.trim()}</div>
            <div class="location-sub">${data.country || 'Unknown country'}</div>
            <div class="time-sub">${currentTime}</div>
        </div>

        <div class="weather-meta">
            <p>Precipitation: ${precipitation}%</p>
            <p>Humidity: ${humidity}%</p>
            <p>Wind: ${wind} km/h</p>
        </div>

        <div class="metric-tabs">
            <span class="active">Temperature</span>
            <span>Precipitation</span>
            <span>Wind</span>
        </div>
    `;
}

function showError(message) {
    weatherResult.className = 'weather-content error-state';
    weatherResult.innerHTML = `
        <div class="weather-header">
            <div class="weather-icon"><i class="fa-solid fa-circle-exclamation"></i></div>
            <div class="weather-temp-block">
                <div class="temperature small">Error</div>
                <div class="unit">!</div>
            </div>
        </div>

        <div class="weather-location-block">
            <div class="location-main">${cityInput.value.trim() || 'City'}</div>
            <div class="location-sub">Unable to fetch</div>
            <div class="time-sub">${formatTime(new Date().toISOString())}</div>
        </div>

        <div class="weather-meta">
            <p>${message}</p>
        </div>

        <div class="metric-tabs">
            <span class="active">Weather</span>
            <span>Info</span>
            <span>Retry</span>
        </div>
    `;
}

window.addEventListener('DOMContentLoaded', () => {
    cityInput.value = 'Manila';
    getWeather();
});