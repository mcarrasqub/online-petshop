document.addEventListener('DOMContentLoaded', function() {
    const config = document.getElementById('partner-data').dataset;
    const container = document.getElementById('products-container');

    fetch(config.apiUrl)
        .then(response => response.json())
        .then(data => {
            container.innerHTML = '';
            document.getElementById('store-name').innerText = data.additionalData.storeName;

            data.data.forEach(product => {
                const price = new Intl.NumberFormat('es-CO').format(product.price);
                
                container.innerHTML += `
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="card-title text-primary">${product.title}</h5>
                                <p class="card-text"><strong>${config.price}:</strong> $${price}</p>
                                <p class="card-text"><strong>${config.category}:</strong> ${product.category}</p>
                                <p class="card-text"><strong>${config.stock}:</strong> ${product.stock}</p>
                                <a href="${product.links.view}" target="_blank" class="btn btn-primary btn-sm">${config.viewInStore}</a>
                            </div>
                        </div>
                    </div>
                `;
            });
        });
});
