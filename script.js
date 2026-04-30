function toggleForm() {
    const loginForm = document.querySelector('.form-container:first-of-type');
    const registerForm = document.getElementById('registerForm');
    
    if (loginForm.style.display === 'none') {
        loginForm.style.display = 'block';
        registerForm.style.display = 'none';
    } else {
        loginForm.style.display = 'none';
        registerForm.style.display = 'block';
    }
}


document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            const email = document.querySelector('input[name="email"]').value;
            const password = document.querySelector('input[name="password"]').value;
            
            if (!email || !password) {
                e.preventDefault();
                alert('Veuillez remplir tous les champs');
                return false;
            }
            
            if (!validateEmail(email)) {
                e.preventDefault();
                alert('Email invalide');
                return false;
            }
        });
    }

    
    const signupForm = document.getElementById('signupForm');
    if (signupForm) {
        signupForm.addEventListener('submit', function(e) {
            const nom = document.querySelector('input[name="nom"]').value;
            const email = document.querySelector('input[name="email"]').value;
            const password = document.querySelector('input[name="password"]').value;
            const confirmPassword = document.querySelector('input[name="confirm_password"]').value;
            
            if (!nom || !email || !password || !confirmPassword) {
                e.preventDefault();
                alert('Veuillez remplir tous les champs');
                return false;
            }
            
            if (!validateEmail(email)) {
                e.preventDefault();
                alert('Email invalide');
                return false;
            }
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Les mots de passe ne correspondent pas');
                return false;
            }
            
            if (password.length < 6) {
                e.preventDefault();
                alert('Le mot de passe doit contenir au moins 6 caractères');
                return false;
            }
        });
    }

    const categoryFilter = document.getElementById('categoryFilter');
    if (categoryFilter) {
        categoryFilter.addEventListener('change', function() {
            const category = this.value;
            filterBooks(category);
        });
    }

    const searchBtn = document.getElementById('searchBtn');
    const searchInput = document.getElementById('searchInput');
    if (searchBtn && searchInput) {
        searchBtn.addEventListener('click', function() {
            const search = searchInput.value.trim();
            if (search) {
                searchBooks(search);
            } else {
                filterBooks('');
            }
        });

        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                searchBtn.click();
            }
        });
    }
});


function validateEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

function filterBooks(category) {
    console.log('Filtering by category:', category);
    fetch('filter_books.php?category=' + encodeURIComponent(category))
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.text();
        })
        .then(data => {
            console.log('Filter response received:', data.length, 'characters');
            const table = document.querySelector('.books-table tbody');
            if (table) {
                table.innerHTML = data;
            } else {
                console.error('Table tbody not found');
            }
        })
        .catch(error => console.error('Erreur de filtrage:', error));
}

function searchBooks(search) {
    console.log('Searching for:', search);
    fetch('filter_books.php?search=' + encodeURIComponent(search))
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.text();
        })
        .then(data => {
            console.log('Search response received:', data.length, 'characters');
            const table = document.querySelector('.books-table tbody');
            if (table) {
                table.innerHTML = data;
            } else {
                console.error('Table tbody not found');
            }
        })
        .catch(error => console.error('Erreur de recherche:', error));
}

document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            this.style.opacity = '0.8';
            setTimeout(() => {
                this.style.opacity = '1';
            }, 100);
        });
    });
});

function checkEmailAvailability(email) {
    fetch('back/check_email.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'email=' + encodeURIComponent(email)
    })
    .then(response => response.json())
    .then(data => {
        if (data.exists) {
            alert('Cet email est déjà utilisé');
        }
    })
    .catch(error => console.error('Erreur:', error));
}
