document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        if (searchTerm.length > 0) {
            // Fetch data from your donation database or use static data
            fetch('data/donations.json')
                .then(response => response.json())
                .then(data => {
                    const filtered = data.filter(item => 
                        item.title.toLowerCase().includes(searchTerm)
                    );
                    displayResults(filtered);
                })
                .catch(error => console.error('Error:', error));
        } else {
            searchResults.style.display = 'none';
        }
    });

    function displayResults(results) {
        searchResults.innerHTML = '';
        searchResults.style.display = results.length ? 'block' : 'none';

        results.forEach(item => {
            const div = document.createElement('div');
            div.className = 'search-result-item';
            div.innerHTML = `
                <a href="donasi.html?id=${item.id}">
                    <img src="${item.image}" alt="${item.title}">
                    <div>
                        <h4>${item.title}</h4>
                        <p>${item.description}</p>
                    </div>
                </a>
            `;
            searchResults.appendChild(div);
        });
    }
});
